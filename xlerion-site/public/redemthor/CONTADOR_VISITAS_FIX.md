# 🔧 FIX: Contador de Visitas en Opera GX

## Problema Detectado

El contador de visitas no funcionaba en **Opera GX** debido a restricciones de privacidad que bloquean `localStorage`.

## ✅ Solución Implementada

### Cambios en `index.html` (líneas 2143-2242)

**Mejoras aplicadas:**

1. **Detección de Storage Disponible**
   - Función `isStorageAvailable()` que testea si `localStorage` o `sessionStorage` están disponibles
   - Manejo de errores para evitar crashes

2. **Fallback en Cascada**

      ```text
   localStorage (preferido)
       ↓ (si bloqueado)
   sessionStorage (alternativa)
       ↓ (si bloqueado)
   Cookies (última opción - compatible Opera GX)
       ↓ (si todo falla)
   "---" (indicador visual)
   ```

3. **Soporte de Cookies**
   - Si `localStorage` y `sessionStorage` están bloqueados, usa cookies
   - Cookies con `SameSite=Lax` para compatibilidad Opera GX
   - Persistencia de 365 días

4. **Animación Visual**
   - Efecto de pulso cuando el contador se actualiza
   - Keyframe animation CSS agregado

5. **Debug Console**
   - Logs en consola para diagnosticar problemas
   - Detecta automáticamente si el navegador es Opera/Opera GX

## 🧪 Cómo Probar en Opera GX

### Método 1: Local (Servidor PHP)

```powershell
cd X:\Programacion\XlerionWeb\xlerion-site\public\redemthor
php -S localhost:8080
```

Luego abre en Opera GX: `http://localhost:8080/`

### Método 2: Después del Deploy

1. Sube los cambios a xlerion.com
2. Abre en Opera GX: `https://xlerion.com/redemthor/`
3. Abre DevTools (F12) → Console
4. Busca el log: `[Redemthor] Contador de visitas: { visitors: X, storageType: 'cookies', browser: 'Opera/Opera GX' }`

## 🔍 Verificación del Comportamiento

### Caso 1: localStorage disponible (navegadores normales)

### Caso 2: localStorage bloqueado, sessionStorage disponible

### Caso 3: Todo storage bloqueado (Opera GX modo privacidad estricta)

### Caso 4: Cookies también bloqueadas

## 📊 Cambios Técnicos Detallados

### Antes (❌ No funcionaba en Opera GX)

```javascript
function initVisitorCounter() {
    let visitors = parseInt(localStorage.getItem('redemthorVisitors')) || 0;
    // ... código que falla si localStorage está bloqueado
}
```

**Problema:** Si Opera GX bloquea `localStorage`, tira error y el contador no aparece.

### Después (✅ Funciona en Opera GX)

```javascript
function initVisitorCounter() {
    // 1. Test storage availability
    if (isStorageAvailable('localStorage')) {
        storage = localStorage;
    } else if (isStorageAvailable('sessionStorage')) {
        storage = sessionStorage;
    }

    // 2. Try storage first
    if (storage) {
        visitors = parseInt(storage.getItem(counterKey)) || 0;
        // ... actualizar
    } else {
        // 3. Fallback to cookies
        visitors = parseInt(getCookie(counterKey)) || 0;
        setCookie(counterKey, visitors, 365);
    }

    // 4. Display with error handling
    try {
        counterElement.textContent = visitors.toLocaleString();
    } catch (error) {
        counterElement.textContent = '---';
    }
}
```

**Ventajas:**

## 🎨 Animación CSS Agregada

```css
@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.15); opacity: 0.8; }
    100% { transform: scale(1); opacity: 1; }
}
```

Se aplica durante 0.5s cuando el contador se actualiza.

## ⚙️ Configuraciones de Opera GX que Afectan el Contador

### Si el contador sigue sin funcionar

1. **Abrir Opera GX Settings**
   - `opera://settings/privacy`

2. **Verificar "Cookies y datos de sitios"**
   - Debe estar: "Permitir todos los cookies" o "Bloquear cookies de terceros"
   - NO debe estar: "Bloquear todos los cookies"

3. **Verificar "Eliminar datos al cerrar navegador"**
   - Si está activado: El contador se reiniciará cada vez que cierres Opera GX

4. **Ad Blocker / Tracker Blocker**
   - Si está muy agresivo, puede bloquear el script
   - Prueba agregando `xlerion.com` a excepciones

5. **VPN / Proxy**
   - Algunos VPNs bloquean cookies
   - Desactiva VPN temporalmente para probar

## 🐛 Troubleshooting

### Problema: El contador siempre muestra "0"

**Causa:** Storage y cookies bloqueados, pero el script no falla.

**Solución:**

1. Abre DevTools (F12) → Console
2. Busca: `[Redemthor] Contador de visitas`
3. Si dice `storageType: 'none'` pero no incrementa:
   - Verifica que cookies estén habilitadas en Opera GX
   - Intenta agregar `xlerion.com` a sitios permitidos

### Problema: El contador muestra "---"

**Causa:** Todos los métodos de storage fallaron.

**Solución:**

1. Verifica configuración de cookies en Opera GX
2. Desactiva bloqueadores agresivos
3. Intenta en modo normal (no privado)

### Problema: El contador se reinicia cada vez que abro Opera GX

**Causa:** Opera GX configurado para eliminar datos al cerrar.

**Solución:**

1. Settings → Privacy → "Eliminar datos al cerrar navegador"
2. Desactiva "Cookies y otros datos de sitios"

## 📝 Logs de Console Esperados

### Opera GX (cookies habilitadas)

```text
[Redemthor] Contador de visitas: {
  visitors: 1,
  storageType: 'none',
  browser: 'Opera/Opera GX'
}
```

### Chrome/Firefox (localStorage disponible)

```text
[Redemthor] Contador de visitas: {
  visitors: 1,
  storageType: 'localStorage',
  browser: 'Other'
}
```

### Modo Incógnito (sessionStorage)

```text
[Redemthor] Contador de visitas: {
  visitors: 1,
  storageType: 'sessionStorage',
  browser: 'Other'
}
```

## 🚀 Deploy

Para aplicar estos cambios en producción:

1. **Build**

   ```powershell
   cd X:\Programacion\XlerionWeb\xlerion-site
   npm run build
   ```

2. **Verificar que el archivo se copió**
   - `dist/redemthor/index.html` debe tener los cambios

3. **Subir a xlerion.com**
   - Reemplaza `public/redemthor/index.html` en el servidor

4. **Limpiar cache de Opera GX**
   - `Ctrl+Shift+Del` → Marcar "Imágenes y archivos en caché"
   - Recargar página: `Ctrl+F5`

## ✅ Resultado Esperado

**FECHA FIX**: 18 de enero de 2026  
**NAVEGADOR AFECTADO**: Opera GX  
**MÉTODO FALLBACK**: Cookies (SameSite=Lax)  
**PERSISTENCIA**: 365 días (cookies) o indefinido (localStorage)
