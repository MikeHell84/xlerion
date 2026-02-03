# 🔧 CORS Error - Solución Inmediata

## 🚨 El Problema

```
Access to fetch at 'http://localhost:8080/total-darkness/api/auth.php'
has been blocked by CORS policy
```

## ✅ La Solución

### Paso 1: Reiniciar el servidor PHP

El archivo `auth.php` ha sido actualizado con mejor manejo de CORS. Debes reiniciar el servidor:

**Opción A: Usar el script (RECOMENDADO)**

```powershell
cd x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness
.\restart-php-server.ps1
```

**Opción B: Manual**

```powershell
# Detener el servidor actual (Ctrl+C en la terminal)
# Luego ejecutar:
cd x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness
php -S localhost:8080
```

### Paso 2: Limpiar Cache del Navegador

**Chrome/Edge/Brave:**

```
Ctrl + Shift + R
```

**Firefox:**

```
Ctrl + Shift + Delete
```

### Paso 3: Probar CORS

Abre esta URL en tu navegador:

```
http://localhost:5173/total-darkness/cors-diagnostic.html
```

Haz clic en los botones de prueba:

1. **Test 1: Direct Connection** - Verifica conexión básica
2. **Test 2: OPTIONS Preflight** - Verifica headers CORS en preflight
3. **Test 3: PHP Headers Handler** - Verifica que PHP está enviando headers
4. **Test 4: Auth API Login** - Verifica login funcionando

**Resultado esperado:** Todos los tests deben mostrar ✅ con:

```
Access-Control-Allow-Origin: *
```

---

## 🔍 Qué fue el problema

1. **PHP Development Server** no respeta archivos `.htaccess` (solo Apache)
2. El navegador hace un **preflight OPTIONS** para solicitudes CORS
3. Si `auth.php` no responde con headers CORS, la solicitud es bloqueada

## ✨ Cambios realizados

### `api/auth.php`

- ✅ Headers CORS movidos al inicio del archivo (línea 1-18)
- ✅ Mejor manejo de preflight OPTIONS
- ✅ Agregar debugging info en respuesta OPTIONS

### `.htaccess` (archivos)

- ✅ Agregada configuración CORS para cuando uses Apache en producción
- ✅ Actualizada CSP para permitir localhost:8080 en desarrollo

### `api/.htaccess` (nuevo)

- ✅ Configuración específica CORS para endpoints API

### `test-php-headers.php` (nuevo)

- ✅ Test directo para verificar que PHP está enviando headers

### `cors-diagnostic.html` (nuevo)

- ✅ Herramienta visual para diagnosticar problemas CORS

---

## 📋 Verificación Rápida

En la consola del navegador (F12), ejecuta:

```javascript
fetch('http://localhost:8080/total-darkness/api/auth.php', {
  method: 'OPTIONS'
})
.then(r => r.headers.get('Access-Control-Allow-Origin'))
.then(origin => console.log('✅ CORS:', origin || '❌ Missing'))
.catch(e => console.error('❌ Error:', e.message))
```

Deberías ver en la consola:

```
✅ CORS: *
```

---

## 🆘 Si aún no funciona

1. **Verifica que el servidor PHP está corriendo:**

   ```powershell
   # En otra terminal
   netstat -ano | findstr :8080
   ```

   Deberías ver una línea con `LISTENING`

2. **Verifica que archivo se está cargando:**

   ```powershell
   # En la terminal del servidor PHP, deberías ver:
   [Sun Jan 12 12:00:00 2026] Accepted
   [Sun Jan 12 12:00:00 2026] "OPTIONS /total-darkness/api/auth.php HTTP/1.1" 200 -
   ```

3. **Prueba con curl:**

   ```powershell
   curl -i -X OPTIONS http://localhost:8080/total-darkness/api/auth.php
   ```

   Busca las líneas:

   ```
   HTTP/1.1 200 OK
   Access-Control-Allow-Origin: *
   ```

4. **Revisa los logs:**
   - Terminal del servidor PHP debe mostrar `"OPTIONS ... 200"`
   - DevTools → Console debe mostrar el error CORS específico

---

## 🎯 Próximos Pasos

Una vez que CORS funcione ✅:

1. Abre `http://localhost:5173/total-darkness/test-cors.html`
2. Abre `http://localhost:5173/total-darkness/test-smtp.html`
3. Prueba enviar un email
4. Prueba la recuperación de contraseña completa

---

## 📞 Credenciales de Prueba

**Admin Login:**

- Email: `admin@xlerion.com`
- Password: `TotalDarkness2026!`

**SMTP (automático):**

- From: `support@xlerion.com`
- Server: `mail.xlerion.com:465`
- Credenciales: Configuradas automáticamente

---

**Última actualización:** 12/01/2026  
**Status:** Esperando confirmación que CORS funciona ✅
