# Sistema de Autenticación Backend - Total Darkness

## 🔐 Características Implementadas

### 1. Recuperación Automática de Contraseña

- Los usuarios pueden solicitar un enlace de recuperación desde la página de login
- Se envía un correo automático con un token único válido por 1 hora
- El usuario puede crear una nueva contraseña sin intervención manual

### 2. Gestión Multi-Administrador

- Crear nuevos administradores desde el panel
- Requiere autenticación del administrador actual
- Listar todos los administradores del sistema
- Desactivar administradores (no se pueden eliminar para mantener historial)

### 3. Base de Datos SQLite

- Almacenamiento seguro de credenciales con hash SHA-256
- Tabla de administradores con campos: email, hash, nombre, fechas
- Tabla de tokens de recuperación con expiración
- Administrador por defecto: <admin@xlerion.com> / TotalDarkness2026!

---

## 📋 Requisitos del Servidor

### PHP

- PHP 7.4 o superior
- Extensiones requeridas:
  - `PDO` (activada por defecto)
  - `pdo_sqlite` (activada por defecto)
  - `openssl` (para hashing)
  - `mail()` función habilitada

### Permisos

El servidor web necesita permisos de escritura en:

```
total-darkness/
├── data/              (crear este directorio)
│   └── admins.db     (se crea automáticamente)
└── api/
    └── auth.php
```

---

## ⚙️ Configuración

### 1. Crear Directorio de Datos

En tu servidor, crea el directorio `data`:

**Windows PowerShell:**

```powershell
New-Item -ItemType Directory -Force -Path "x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness\data"
```

**Linux/Mac:**

```bash
mkdir -p /ruta/a/total-darkness/data
chmod 755 /ruta/a/total-darkness/data
```

### 2. Configurar el Envío de Correos (PHP mail)

#### Opción A: Servidor SMTP Local (Recomendado para producción)

Edita `php.ini` y configura tu servidor SMTP:

**Windows:**

```ini
[mail function]
SMTP = smtp.gmail.com
smtp_port = 587
sendmail_from = noreply@xlerion.com
```

**Linux (usar sendmail o postfix):**

```ini
[mail function]
sendmail_path = /usr/sbin/sendmail -t -i
```

#### Opción B: Servicio de Correo Externo (Gmail, SendGrid, etc.)

Para Gmail, necesitas:

1. Habilitar "Aplicaciones menos seguras" o usar OAuth2
2. Usar una contraseña de aplicación

**Modificar `api/auth.php` línea ~90-95:**

```php
// Cambiar de mail() a una librería como PHPMailer
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'tu-email@gmail.com';
$mail->Password = 'tu-contraseña-de-aplicacion';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;
```

#### Opción C: Testing Local (Solo desarrollo)

Para probar sin configurar correo real:

1. Instala **MailHog** (captura correos localmente):

   ```bash
   # Windows (con Chocolatey)
   choco install mailhog
   
   # Mac
   brew install mailhog
   
   # Linux
   wget https://github.com/mailhog/MailHog/releases/download/v1.0.1/MailHog_linux_amd64
   sudo mv MailHog_linux_amd64 /usr/local/bin/mailhog
   chmod +x /usr/local/bin/mailhog
   ```

2. Ejecuta MailHog:

   ```bash
   mailhog
   ```

3. Configura PHP para usar MailHog (`php.ini`):

   ```ini
   [mail function]
   SMTP = localhost
   smtp_port = 1025
   ```

4. Abre <http://localhost:8025> para ver los correos capturados

### 3. Verificar Instalación

Visita en tu navegador:

```
http://localhost:5173/total-darkness/api/auth.php?action=test
```

Si ves un error JSON (normal, no hay acción 'test'), significa que PHP funciona correctamente.

---

## 🚀 Uso del Sistema

### Para Usuarios

#### Recuperar Contraseña

1. En la página de login, haz clic en "¿Olvidaste tu contraseña?"
2. Ingresa tu correo registrado
3. Recibirás un correo con un enlace de recuperación
4. Haz clic en el enlace (válido 1 hora)
5. Ingresa tu nueva contraseña

#### Cambiar Contraseña (estando autenticado)

1. Ve a Settings (en futuras versiones)
2. O solicita recuperación de contraseña

### Para Administradores

#### Crear un Nuevo Administrador

1. Inicia sesión en el panel
2. Haz clic en el ícono de "Gestión de Administradores" (🔧👥) en la esquina superior derecha
3. Ve a la pestaña "Crear Administrador"
4. Ingresa:
   - Tu correo y contraseña actual (autenticación)
   - Nombre completo del nuevo administrador
   - Correo del nuevo administrador
   - Contraseña para el nuevo administrador (mínimo 8 caracteres)
5. Haz clic en "Crear Administrador"

#### Ver Lista de Administradores

1. Abre "Gestión de Administradores"
2. La pestaña "Lista de Administradores" muestra:
   - Nombre y correo
   - Fecha de creación
   - Último acceso
   - Estado (activo/inactivo)

#### Desactivar un Administrador

1. En la lista de administradores
2. Haz clic en el botón rojo "🚫" junto al administrador
3. Confirma la acción
4. Ingresa tu contraseña actual

**Nota:** No puedes desactivar tu propia cuenta ni eliminar definitivamente a un administrador (se mantiene historial).

---

## 🔒 Seguridad

### Medidas Implementadas

1. **Hash SHA-256** para todas las contraseñas
2. **Tokens únicos** para recuperación con expiración de 1 hora
3. **Delay de 1 segundo** en login fallido (anti-brute force)
4. **Validación de tokens** antes de permitir cambio de contraseña
5. **Autenticación requerida** para crear/desactivar administradores
6. **Base de datos local** (no expuesta en web)
7. **CORS configurado** para permitir solo tu dominio

### Recomendaciones Adicionales

1. **HTTPS:** Usa siempre HTTPS en producción

   ```apache
   # .htaccess
   RewriteEngine On
   RewriteCond %{HTTPS} off
   RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
   ```

2. **Rate Limiting:** Limita intentos de login por IP

   ```php
   // Agregar al inicio de auth.php
   session_start();
   $attempts = $_SESSION['login_attempts'] ?? 0;
   if ($attempts > 5) {
       http_response_code(429);
       die(json_encode(['error' => 'Demasiados intentos. Espera 15 minutos.']));
   }
   ```

3. **Backup de Base de Datos:**

   ```bash
   # Cron job diario
   0 2 * * * cp /ruta/a/data/admins.db /ruta/a/backups/admins-$(date +\%Y\%m\%d).db
   ```

4. **Proteger el directorio data:**

   ```apache
   # En total-darkness/data/.htaccess
   Order deny,allow
   Deny from all
   ```

5. **Cambiar credenciales por defecto:**
   - Al primer login, cambia la contraseña de <admin@xlerion.com>

---

## 🧪 Testing

### Probar Recuperación de Contraseña

1. Ve a <http://localhost:5173/total-darkness/recovery.html>
2. Ingresa: <admin@xlerion.com>
3. Verifica que llegó el correo (o en MailHog si estás en desarrollo)
4. Haz clic en el enlace del correo
5. Ingresa nueva contraseña
6. Intenta hacer login con la nueva contraseña

### Probar Creación de Administrador

1. Login como <admin@xlerion.com>
2. Abre panel de administradores
3. Crea un nuevo admin: <test@xlerion.com> / Test123456
4. Cierra sesión
5. Intenta login con <test@xlerion.com>
6. Verifica que puedes acceder

### Probar Desactivación

1. Login como <admin@xlerion.com>
2. En la lista de administradores, desactiva <test@xlerion.com>
3. Cierra sesión
4. Intenta login con <test@xlerion.com>
5. Verifica que no permite acceso

---

## 📁 Estructura de Archivos

```
total-darkness/
├── index.html                 # Panel principal (actualizado con botón admin)
├── recovery.html              # Página para solicitar recuperación
├── reset-password.html        # Página para crear nueva contraseña
├── admin-management.js        # JavaScript para gestión de admins
├── app.js                     # App principal (sin cambios)
├── api/
│   └── auth.php              # Backend API de autenticación
└── data/
    └── admins.db             # Base de datos SQLite (se crea automáticamente)
```

---

## 🐛 Troubleshooting

### "Error al enviar correo"

**Causa:** PHP mail() no configurado o servidor SMTP inaccesible

**Solución:**

1. Verifica configuración SMTP en `php.ini`
2. Prueba con MailHog para desarrollo
3. Usa PHPMailer con Gmail/SendGrid para producción

### "Database error: unable to open database"

**Causa:** Permisos insuficientes en directorio `data/`

**Solución:**

```bash
# Linux/Mac
chmod 755 data/
chmod 644 data/admins.db

# Windows
# Click derecho > Propiedades > Seguridad > Editar
# Dar "Control total" al usuario del servidor web (IIS_IUSRS o similar)
```

### "Token inválido o expirado"

**Causa:** El token de recuperación venció (1 hora) o ya fue usado

**Solución:**

- Solicita un nuevo enlace de recuperación
- Verifica que la URL del enlace está completa (no cortada)

### "No autorizado" al listar administradores

**Causa:** El usuario actual no está en la base de datos

**Solución:**

- Cierra sesión y vuelve a iniciar
- Verifica que `localStorage` tiene el email correcto
- Elimina `data/admins.db` para recrear la base de datos

---

## 🔄 Migración de Sistema Antiguo

Si ya tienes usuarios con el sistema antiguo (solo app.js):

1. Los usuarios existentes deben hacer "Recuperar contraseña"
2. O puedes agregar manualmente a la base de datos:

   ```php
   $email = 'usuario@example.com';
   $password = 'su-contraseña';
   $hash = hash('sha256', $password);
   
   $db->exec("INSERT INTO admins (email, password_hash, name, created_by) 
              VALUES ('$email', '$hash', 'Nombre Usuario', 'MIGRATION')");
   ```

---

## 📞 Soporte

Si encuentras problemas:

1. Revisa los logs de PHP: `php -l api/auth.php`
2. Revisa los logs del servidor web (Apache/Nginx)
3. Contacta a: <contactus@xlerion.com>

---

## 📝 Próximas Mejoras

- [ ] Autenticación de dos factores (2FA)
- [ ] Roles y permisos (admin, editor, viewer)
- [ ] Historial de cambios de contraseña
- [ ] Notificaciones por correo de login sospechoso
- [ ] API para integración con sistemas externos
- [ ] Panel de auditoría de acciones

---

**Versión:** 1.0.0  
**Última actualización:** 2026-01-12  
**Desarrollado para:** Total Darkness Story Management System
