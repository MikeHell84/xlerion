# 🔧 Solución: Error CORS - Paso a Paso

## ❌ El Problema

```
Access to fetch at 'http://localhost:8080/total-darkness/api/auth.php' 
from origin 'http://localhost:5173' has been blocked by CORS policy
```

## ✅ La Solución

### Paso 1: Actualizar PHP (YA HECHO ✓)

El archivo `api/auth.php` ya tiene la configuración CORS correcta:

```php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');
```

### Paso 2: Limpiar Cache del Navegador

#### **Chrome/Edge/Brave:**

**Opción A - Hard Refresh:**

```
Ctrl + Shift + R  (Windows)
Cmd + Shift + R   (Mac)
```

**Opción B - DevTools:**

1. Abre DevTools (F12)
2. Click derecho en el botón "Refresh"
3. Selecciona "Empty cache and hard refresh"

**Opción C - Limpiar Todo:**

1. Abre DevTools (F12)
2. Ve a Application → Cache Storage
3. Borra todos los caches
4. Storage → Clear site data

#### **Firefox:**

```
Ctrl + Shift + Delete  (Windows)
Cmd + Shift + Delete   (Mac)
```

### Paso 3: Probar CORS

#### **Opción A: Usar el Test CORS**

```
http://localhost:5173/total-darkness/test-cors.html
```

Presiona los botones para verificar:

1. ✅ Conectar al API
2. ✅ Verificar CORS Headers
3. ✅ Probar Login
4. ✅ Solicitar Recuperación

#### **Opción B: Consola del Navegador**

Abre DevTools (F12) y ejecuta:

```javascript
fetch('http://localhost:8080/total-darkness/api/auth.php', {
  method: 'OPTIONS'
}).then(r => {
  console.log('✅ CORS Funciona');
  console.log('Access-Control-Allow-Origin:', r.headers.get('Access-Control-Allow-Origin'));
}).catch(e => console.error('❌ Error:', e));
```

#### **Opción C: Curl desde Terminal**

```powershell
curl -i -X OPTIONS http://localhost:8080/total-darkness/api/auth.php
```

Deberías ver:

```
HTTP/1.1 200 OK
Access-Control-Allow-Origin: *
Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE
```

### Paso 4: Reiniciar el Servidor PHP (si es necesario)

Si después de limpiar cache aún tienes problemas:

```powershell
# En la terminal del servidor PHP, presiona Ctrl+C para detener
# Luego ejecuta de nuevo:
cd x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness
php -S localhost:8080 -c php.ini
```

---

## 📋 Checklist Rápido

- [ ] Ejecuté `Ctrl+Shift+R` para limpiar cache
- [ ] Cerré y reabrí la pestaña del navegador
- [ ] El servidor PHP está corriendo (localhost:8080)
- [ ] Acceso a <http://localhost:5173/total-darkness/test-cors.html>
- [ ] Los tests de CORS pasan ✅

---

## 🧪 Test Rápido de Verificación

Después de hacer los pasos anteriores, abre la consola (F12) y copia-pega:

```javascript
// Test CORS simple
const testCors = async () => {
  try {
    const res = await fetch('http://localhost:8080/total-darkness/api/auth.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ action: 'login', email: 'admin@xlerion.com', password: 'TotalDarkness2026!' })
    });
    const data = await res.json();
    console.log('✅ CORS FUNCIONA:', data);
  } catch(e) {
    console.error('❌ Error:', e.message);
  }
};
testCors();
```

Si ves en la consola: `✅ CORS FUNCIONA: {success: true, user: {...}}`, entonces **¡TODO FUNCIONA!**

---

## 🚀 Próximo Paso

Una vez que CORS funciona, abre:

```
http://localhost:5173/total-darkness/test-smtp.html
```

Y prueba enviar un correo de test.

---

## 💡 Nota Técnica

El error de CORS ocurre cuando:

1. **Origen diferente:** localhost:5173 intenta acceder a localhost:8080
2. **Preflights bloqueados:** El navegador hace un OPTIONS preflight que no tiene headers correctos
3. **Headers faltantes:** El servidor no responde con `Access-Control-Allow-*`

Esto ya está **arreglado en el código**, solo necesitas:

- Limpiar cache
- Reiniciar el servidor PHP (opcional)
- Recargar la página

---

**¿Problema resuelto?** Abre `test-cors.html` y verifica que todos los tests pasan ✅
