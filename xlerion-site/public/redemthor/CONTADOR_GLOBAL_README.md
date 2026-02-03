# Contador Global de Visitas - Redemthor

**Fecha**: 20 Enero 2026  
**Autor**: Miguel Eduardo Rodríguez Martínez

## 📊 Descripción

Sistema de contador de visitas **global y compartido** para el sitio Redemthor. Todos los usuarios ven el **mismo número total de visitas** en tiempo real, almacenado en el servidor.

---

## ❌ Problema Anterior

El contador usaba **localStorage/sessionStorage/cookies locales**, por lo que:

- ❌ Cada usuario veía su propio contador (iniciando en 1)
- ❌ No reflejaba el total real de visitas al sitio
- ❌ Los datos se perdían al limpiar navegador

---

## ✅ Solución Implementada

### **Backend PHP**

- **Endpoint API**: `/redemthor/api/contador.php`
- **Almacenamiento**: Archivo de texto `data/contador-visitas.txt`
- **Log de visitas**: `data/visitas-log.txt` (para cooldown de 30 minutos)
- **Identificación única**: IP + User Agent (hash MD5)
- **Cooldown**: 30 minutos (evita múltiples conteos del mismo usuario)

### **Frontend JavaScript**

- Hace petición `POST` al API al cargar la página
- Muestra el contador global a todos los usuarios
- Animación `pulse` cuando se incrementa el contador
- Fallback a `GET` si falla el incremento
- Manejo de errores con ⚠️

---

## 📁 Estructura de Archivos

```text
public/redemthor/
├── api/
│   └── contador.php          ← Backend PHP (API)
├── data/                     ← Creado automáticamente
│   ├── contador-visitas.txt  ← Número total (ejemplo: "1234")
│   └── visitas-log.txt       ← Log temporal (fingerprint|timestamp)
├── index.html                ← Frontend actualizado
└── ...
```

---

## 🔧 API Endpoints

### **GET /redemthor/api/contador.php?action=get**

Obtiene el contador actual **sin incrementar**.

**Respuesta**:

```json
{
  "success": true,
  "count": 1234,
  "action": "get"
}
```

---

### **POST /redemthor/api/contador.php?action=count**

Incrementa el contador (si el usuario no visitó en los últimos 30 minutos).

**Respuesta (incrementado)**:

```json
{
  "success": true,
  "count": 1235,
  "action": "count",
  "incremented": true,
  "message": "Visit counted successfully"
}
```

**Respuesta (cooldown activo)**:

```json
{
  "success": true,
  "count": 1235,
  "action": "count",
  "incremented": false,
  "message": "Recent visit detected (cooldown active)"
}
```

**Respuesta (error)**:

```json
{
  "success": false,
  "error": "Failed to increment counter"
}
```

---

## 🛡️ Sistema de Cooldown

Para evitar spam y múltiples conteos del mismo usuario:

1. **Identificación única**: `MD5(IP + User Agent)`
2. **Log temporal**: Se guarda en `visitas-log.txt`
3. **Cooldown**: 30 minutos
4. **Limpieza automática**: Entradas viejas se eliminan al consultar

**Formato del log**:

```text
<fingerprint>|<timestamp_unix>
a3c5e8d2f1b4...  |1737414000
b2d4f6a8c1e3...  |1737415200
```

---

## 🔒 Seguridad

### **File Locking**

```php
$fp = fopen(COUNTER_FILE, 'c+');
if (flock($fp, LOCK_EX)) {
    // Incrementar contador (evita race conditions)
}
```

### **Path Validation**

```php
$dataDir = dirname(COUNTER_FILE);
if (!file_exists($dataDir)) {
    mkdir($dataDir, 0755, true);
}
```

### **CORS Headers**

```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
```

---

## 🧪 Testing Local

### **1. Iniciar servidor PHP**

```powershell
cd X:\Programacion\XlerionWeb\xlerion-site\public
php -S localhost:8080 router.php
```

### **2. Probar API directamente**

**Obtener contador**:

```powershell
curl http://localhost:8080/redemthor/api/contador.php?action=get
```

**Incrementar contador**:

```powershell
curl -X POST http://localhost:8080/redemthor/api/contador.php?action=count
```

### **3. Verificar archivos**

**Archivo de contador**:

```powershell
Get-Content public\redemthor\data\contador-visitas.txt
# Output: 1235
```

**Log de visitas**:

```powershell
Get-Content public\redemthor\data\visitas-log.txt
# Output:
# a3c5e8d2f1b4...|1737414000
# b2d4f6a8c1e3...|1737415200
```

### **4. Abrir en navegador**

```text
http://localhost:8080/redemthor/
```

El contador debería:

- Mostrar `...` mientras carga
- Mostrar número real del servidor (ej: `1,235`)
- Animarse con `pulse` si se incrementó

---

## 🌐 Deployment en Producción

### **Archivos a incluir en ZIP**

```text
✅ public/redemthor/api/contador.php       (nuevo)
✅ public/redemthor/index.html              (modificado)
✅ public/router.php                        (modificado)
```

### **Permisos en servidor**

El directorio `data/` debe tener permisos de escritura:

```bash
# En servidor Apache/cPanel
chmod 755 public_html/redemthor/data/
chmod 644 public_html/redemthor/data/contador-visitas.txt
chmod 644 public_html/redemthor/data/visitas-log.txt
```

**Nota**: Los archivos se crean automáticamente si no existen.

---

## 🔄 Migración desde Sistema Anterior

### **Resetear contador** (empezar desde un número específico)

Si quieres partir de un número estimado (ej: 5000 visitas previas):

```php
<?php
file_put_contents('public/redemthor/data/contador-visitas.txt', '5000');
echo "Contador inicializado en 5000\n";
```

### **Limpiar log de visitas** (reiniciar cooldown)

```php
<?php
file_put_contents('public/redemthor/data/visitas-log.txt', '');
echo "Log de visitas limpiado\n";
```

---

## 📊 Monitoreo

### **Ver contador actual**

```bash
cat public/redemthor/data/contador-visitas.txt
```

### **Ver últimas visitas (log)**

```bash
tail -n 10 public/redemthor/data/visitas-log.txt
```

### **Estadísticas**

```bash
# Total de visitas
cat public/redemthor/data/contador-visitas.txt

# Visitas activas (últimos 30 min)
wc -l < public/redemthor/data/visitas-log.txt
```

---

## 🐛 Troubleshooting

### **Contador muestra `...` indefinidamente**

**Causa**: No puede conectar con el API.

**Solución**:

1. Verificar que `contador.php` existe en `/redemthor/api/`
2. Verificar CORS en `router.php`
3. Revisar consola del navegador (F12)
4. Probar endpoint directamente: `curl https://xlerion.com/redemthor/api/contador.php?action=get`

---

### **Contador muestra `⚠️`**

**Causa**: Error en el servidor (permisos, archivo corrupto, etc.)

**Solución**:

1. Verificar permisos del directorio `data/`
2. Verificar logs del servidor PHP
3. Recrear archivo de contador:

   ```bash
   echo "0" > public/redemthor/data/contador-visitas.txt
   chmod 644 public/redemthor/data/contador-visitas.txt
   ```

---

### **Contador se incrementa múltiples veces por usuario**

**Causa**: Cooldown no está funcionando (problema con log de visitas).

**Solución**:

1. Verificar que `visitas-log.txt` tiene permisos de escritura
2. Verificar que la IP del usuario se captura correctamente:

   ```php
   var_dump($_SERVER['REMOTE_ADDR']); // Debería mostrar IP real
   ```

---

### **Contador no incrementa después de deployment**

**Causa**: Archivo `contador-visitas.txt` no existe o no tiene permisos.

**Solución**:

```bash
# Crear manualmente
mkdir -p public_html/redemthor/data
echo "0" > public_html/redemthor/data/contador-visitas.txt
echo "" > public_html/redemthor/data/visitas-log.txt
chmod 755 public_html/redemthor/data/
chmod 644 public_html/redemthor/data/*
```

---

## 🔐 Privacidad

- **No se almacenan IPs en texto plano**: Solo hash MD5 de `IP + User Agent`
- **Log temporal**: Se limpia automáticamente (solo entradas < 30 min)
- **No se almacenan cookies**: Sistema 100% server-side
- **Anónimo**: No se identifica individualmente a los usuarios

---

## 📈 Ventajas del Sistema

| Aspecto | Sistema Anterior | Sistema Actual |

| Aspecto | Sistema Anterior | Sistema Actual |
| ------- | ---------------- | -------------- |
| **Contador** | Local por usuario | Global compartido |
| **Persistencia** | Se pierde al limpiar navegador | Permanente en servidor |
| **Privacidad** | Cookies/localStorage | Hash MD5 temporal |
| **Compatibilidad** | Problemas en Opera GX | Funciona en todos los navegadores |
| **Precisión** | Cada usuario ve su propio número | Todos ven el total real |
| **Cooldown** | 30 min (por navegador) | 30 min (por IP+UA) |

---

## 🚀 Próximos Pasos

1. **Testing local**: Verificar funcionamiento con `php -S localhost:8080 router.php`
2. **Build**: `npm run build` en `xlerion-site/`
3. **ZIP deployment**: Incluir archivos nuevos/modificados
4. **Upload a producción**: Subir a xlerion.com
5. **Verificar en producción**: `curl https://xlerion.com/redemthor/api/contador.php?action=get`
6. **Monitorear**: Revisar que el contador incrementa correctamente

---

## 📝 Changelog

### **v2.0 - 20 Enero 2026**

- ✅ Contador global server-side implementado
- ✅ API REST con PHP (`contador.php`)
- ✅ Sistema de cooldown 30 minutos
- ✅ Log de visitas temporal
- ✅ File locking para evitar race conditions
- ✅ Fallback a `GET` si `POST` falla
- ✅ Manejo de errores con ⚠️

### **v1.0 - 18 Enero 2026** (Sistema anterior)

- ❌ Contador local (localStorage/sessionStorage/cookies)
- ❌ Fix para Opera GX (fallback a cookies)
- ❌ Cada usuario veía su propio contador

---

## 📧 Contacto

**Desarrollador**: Miguel Eduardo Rodríguez Martínez  
**Email**: <contacto@xlerion.tech>  
**Proyecto**: XLERION - Ingeniería Creativa Modular

---

## Fin del documento
