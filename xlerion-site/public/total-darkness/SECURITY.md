# 🔐 GUÍA DE SEGURIDAD - Panel de Administración Xlerion Stories

## ⚠️ PROBLEMA ANTERIOR

La contraseña estaba almacenada en **texto plano** en el archivo `app.js`, visible para cualquiera que inspeccionara el código fuente.

## ✅ SOLUCIÓN IMPLEMENTADA

### 1. Hash SHA-256

- La contraseña ya NO está en texto plano
- Se almacena un **hash SHA-256** de la contraseña
- Cuando el usuario ingresa su contraseña, se hashea y compara con el hash almacenado
- Nadie puede obtener la contraseña original viendo el código

### 2. Delay Anti Fuerza Bruta

- Añadido delay de 1 segundo después de un intento fallido
- Dificulta ataques automatizados

## 🔒 CÓMO CAMBIAR LA CONTRASEÑA

### Paso 1: Genera tu hash

1. Ve a: <https://emn178.github.io/online-tools/sha256.html>
2. Ingresa tu nueva contraseña (por ejemplo: `MiContraseñaSuperSegura2026!`)
3. Copia el hash generado (64 caracteres hexadecimales)

### Paso 2: Actualiza el código

En `app.js` línea ~9, reemplaza:

```javascript
const ADMIN_PASSWORD_HASH = "PEGA_AQUI_TU_NUEVO_HASH";
```

### Paso 3: (Opcional) Cambia el email

```javascript
const ADMIN_EMAIL = "tu_nuevo_email@dominio.com";
```

## 🛡️ RECOMENDACIONES DE SEGURIDAD ADICIONALES

### CRÍTICO - Implementar autenticación del lado del servidor

**El sistema actual sigue siendo vulnerable** porque la validación se hace en el cliente (JavaScript). La solución DEFINITIVA requiere:

1. **Backend con Node.js/PHP/Python:**

   ```javascript
   // Ejemplo con Node.js + Express
   app.post('/api/login', async (req, res) => {
       const { email, password } = req.body;
       const hash = crypto.createHash('sha256').update(password).digest('hex');
       
       if (email === process.env.ADMIN_EMAIL && 
           hash === process.env.ADMIN_PASSWORD_HASH) {
           // Generar JWT token
           const token = jwt.sign({ email }, process.env.JWT_SECRET);
           res.json({ success: true, token });
       } else {
           res.status(401).json({ success: false });
       }
   });
   ```

2. **Variables de entorno (.env):**

   ```
   ADMIN_EMAIL=admin@xlerion.com
   ADMIN_PASSWORD_HASH=a8f5f167f44f4964e6c998dee827110c
   JWT_SECRET=clave_super_secreta_aleatoria
   ```

3. **Rate Limiting:**
   - Limitar intentos de login (ej: 5 intentos por 15 minutos)
   - Usar librerías como `express-rate-limit`

4. **HTTPS Obligatorio:**
   - Activar redirección HTTPS en `.htaccess` (ya configurado)
   - Obtener certificado SSL (Let's Encrypt gratis)

### Mediano Plazo

1. **Session Management:**
   - Usar JWT tokens o sessions con expiración
   - Invalidar sesión después de 30 min de inactividad

2. **Autenticación de 2 Factores (2FA):**
   - Google Authenticator
   - Códigos por email

3. **Logs de Seguridad:**
   - Registrar intentos de login fallidos
   - Alertas por email en caso de múltiples intentos

4. **IP Whitelisting:**
   - Permitir acceso solo desde IPs específicas

### Buenas Prácticas

- ✅ **Contraseña fuerte**: Mínimo 16 caracteres, mayúsculas, minúsculas, números, símbolos
- ✅ **Cambiar contraseña regularmente**: Cada 3-6 meses
- ✅ **No compartir credenciales**: Usar gestores de contraseñas (1Password, Bitwarden)
- ✅ **Revisar logs periódicamente**: Detectar accesos sospechosos
- ⚠️ **NUNCA commitear contraseñas**: Añadir `auth-config.js` a `.gitignore`

## 🚨 ACCIÓN INMEDIATA REQUERIDA

1. **CAMBIA LA CONTRASEÑA AHORA:**
   - El hash actual es genérico y está en este documento
   - Genera tu propio hash con una contraseña única

2. **Activa HTTPS:**
   - Descomenta las líneas en `.htaccess`:

     ```apache
     RewriteCond %{HTTPS} off
     RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
     ```

3. **Considera implementar backend:**
   - La autenticación del lado del cliente es solo temporal
   - Para producción seria, necesitas un servidor

## 📚 Recursos

- [OWASP Authentication Cheat Sheet](https://cheatsheetseries.owasp.org/cheatsheets/Authentication_Cheat_Sheet.html)
- [Generador SHA-256 Online](https://emn178.github.io/online-tools/sha256.html)
- [Let's Encrypt (SSL Gratis)](https://letsencrypt.org/)
- [Express Rate Limit](https://www.npmjs.com/package/express-rate-limit)

## ⚖️ Nivel de Seguridad Actual

| Aspecto | Estado | Nivel |
|---------|--------|-------|
| Contraseña en texto plano | ✅ Resuelto | Bajo → Medio |
| Validación cliente | ⚠️ Presente | Medio |
| Hash SHA-256 | ✅ Implementado | Medio |
| HTTPS | ⚠️ Por configurar | Bajo |
| Backend seguro | ❌ No existe | N/A |
| Rate limiting | ❌ No existe | Bajo |
| 2FA | ❌ No existe | N/A |

**Nivel de seguridad actual: MEDIO** (aceptable para desarrollo, insuficiente para producción)

## 🎯 Roadmap de Seguridad

- [x] Eliminar contraseña en texto plano
- [x] Implementar hash SHA-256
- [x] Añadir delay anti-fuerza bruta
- [ ] Activar HTTPS
- [ ] Implementar backend con Express/PHP
- [ ] Variables de entorno
- [ ] Rate limiting
- [ ] JWT tokens
- [ ] 2FA (futuro)

---

**Última actualización:** 12 de Enero, 2026
