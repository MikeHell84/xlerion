<?php
/**
 * Contador Global de Visitas - Redemthor
 * 
 * Sistema de contador de visitas compartido entre todos los usuarios.
 * Usa archivo de texto para persistencia y evita contar múltiples veces
 * al mismo usuario en 30 minutos usando IP + User Agent.
 * 
 * Endpoints:
 * - GET  /api/contador.php?action=get    → Obtiene el contador actual
 * - POST /api/contador.php?action=count  → Incrementa el contador
 * 
 * @author Miguel Eduardo Rodríguez Martínez
 * @date 2026-01-20
 */

// CORS headers (permitir acceso desde el frontend)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header('Content-Type: application/json; charset=utf-8');

// Handle preflight OPTIONS request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Configuración
define('COUNTER_FILE', __DIR__ . '/../data/contador-visitas.txt');
define('VISITS_LOG_FILE', __DIR__ . '/../data/visitas-log.txt');
define('COOLDOWN_MINUTES', 30); // No contar la misma IP en 30 minutos

// Crear directorio data si no existe
$dataDir = dirname(COUNTER_FILE);
if (!file_exists($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Inicializar archivo de contador si no existe
if (!file_exists(COUNTER_FILE)) {
    file_put_contents(COUNTER_FILE, '0');
}

// Inicializar archivo de log si no existe
if (!file_exists(VISITS_LOG_FILE)) {
    file_put_contents(VISITS_LOG_FILE, '');
}

/**
 * Obtiene el contador actual de visitas
 */
function getVisitorCount() {
    $count = (int) file_get_contents(COUNTER_FILE);
    return $count;
}

/**
 * Incrementa el contador de visitas
 */
function incrementVisitorCount() {
    // Usar file locking para evitar race conditions
    $fp = fopen(COUNTER_FILE, 'c+');
    if (flock($fp, LOCK_EX)) {
        $count = (int) fread($fp, 20);
        $count++;
        ftruncate($fp, 0);
        rewind($fp);
        fwrite($fp, (string) $count);
        fflush($fp);
        flock($fp, LOCK_UN);
        fclose($fp);
        return $count;
    } else {
        fclose($fp);
        return false;
    }
}

/**
 * Verifica si el usuario ya visitó recientemente (cooldown de 30 minutos)
 * Usa IP + User Agent como identificador único
 */
function hasRecentVisit() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $fingerprint = md5($ip . '|' . $userAgent);
    $now = time();
    $cooldownSeconds = COOLDOWN_MINUTES * 60;

    // Leer log de visitas
    $logContent = file_get_contents(VISITS_LOG_FILE);
    $lines = explode("\n", trim($logContent));
    
    $newLines = [];
    $hasVisited = false;

    foreach ($lines as $line) {
        if (empty($line)) continue;
        
        $parts = explode('|', $line);
        if (count($parts) !== 2) continue;
        
        $logFingerprint = $parts[0];
        $logTimestamp = (int) $parts[1];
        
        // Remover entradas viejas (más de cooldown)
        if ($now - $logTimestamp > $cooldownSeconds) {
            continue; // No agregar a newLines (eliminar entrada vieja)
        }
        
        // Verificar si este usuario ya visitó recientemente
        if ($logFingerprint === $fingerprint) {
            $hasVisited = true;
        }
        
        $newLines[] = $line;
    }

    // Actualizar log (remover entradas viejas)
    file_put_contents(VISITS_LOG_FILE, implode("\n", $newLines) . "\n");

    return $hasVisited;
}

/**
 * Registra una nueva visita en el log
 */
function logVisit() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
    $fingerprint = md5($ip . '|' . $userAgent);
    $timestamp = time();
    
    $logEntry = $fingerprint . '|' . $timestamp . "\n";
    file_put_contents(VISITS_LOG_FILE, $logEntry, FILE_APPEND | LOCK_EX);
}

// Procesar la solicitud
$action = $_GET['action'] ?? $_POST['action'] ?? 'get';

try {
    switch ($action) {
        case 'get':
            // Obtener contador actual (no incrementa)
            $count = getVisitorCount();
            echo json_encode([
                'success' => true,
                'count' => $count,
                'action' => 'get'
            ]);
            break;

        case 'count':
            // Incrementar contador si el usuario no visitó recientemente
            if (hasRecentVisit()) {
                // Usuario ya visitó en los últimos 30 minutos
                $count = getVisitorCount();
                echo json_encode([
                    'success' => true,
                    'count' => $count,
                    'action' => 'count',
                    'incremented' => false,
                    'message' => 'Recent visit detected (cooldown active)'
                ]);
            } else {
                // Nueva visita - incrementar contador
                $count = incrementVisitorCount();
                if ($count === false) {
                    throw new Exception('Failed to increment counter');
                }
                logVisit();
                echo json_encode([
                    'success' => true,
                    'count' => $count,
                    'action' => 'count',
                    'incremented' => true,
                    'message' => 'Visit counted successfully'
                ]);
            }
            break;

        default:
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'error' => 'Invalid action. Use action=get or action=count'
            ]);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
