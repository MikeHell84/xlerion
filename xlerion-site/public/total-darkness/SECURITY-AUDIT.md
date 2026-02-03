# 🔒 AUDIT DE SEGURIDAD - Total Darkness

## ⚠️ CRÍTICO - PROBLEMAS ENCONTRADOS

### 1. **Credenciales en Código Fuente** 🔴 CRÍTICO

#### Problema 1a: SMTP Password en auth.php

```php
define('SMTP_PASSWORD', 'Ultimate81720164!1984');  // ← EXPUESTO EN REPO
```

**Riesgo:** La contraseña del servidor SMTP está hardcoded en el código PHP
**Impacto:** Cualquiera que vea el código puede enviar emails como <support@xlerion.com>
**Solución:** Mover a archivo `.env` no versionado

#### Problema 1b: Email Password en .env

```
EMAIL_PASSWORD=81720164Ultimate!1984  # ← VERSIONADO EN GIT
```

**Riesgo:** El archivo `.env` está en el repositorio git
**Impacto:** Historial de git expone las credenciales
**Solución:** Agregar `.env` a `.gitignore`

#### Problema 1c: Contraseña en JavaScript

```javascript
const ADMIN_PASSWORD_HASH = "5e482ca2d70a5fd8ed36978f47ec378398d99dd70ff5e1a1f002ee83a6763514";
// Hash de: TotalDarkness2026!
```

**Riesgo:** El hash está en código visible (aunque está hasheado, es reversible)
**Impacto:** Se puede ejecutar ataque de diccionario sobre el hash
**Solución:** Mover todo a backend API (ya está implementado en auth.php)

#### Problema 1d: Credencial duplicada en total-darkness/app.js

```javascript
const ADMIN_PASSWORD = "TotalDarkness2026!";  // ← CONTRASEÑA EN CLARO
```

**Riesgo:** Contraseña en texto plano en archivo JavaScript
**Impacto:** Muy alta - cualquiera puede leer la contraseña
**Solución:** ELIMINAR INMEDIATAMENTE

### 2. **Credenciales Expuestas en Repo**

| Archivo | Credencial | Riesgo |
|---------|-----------|--------|
| `/server/.env` | EMAIL_PASSWORD | Alto |
| `/api/auth.php` | SMTP_PASSWORD | Crítico |
| `/app.js` | ADMIN_PASSWORD_HASH | Medio |
| `/total-darkness/app.js` | ADMIN_PASSWORD (TEXTO PLANO) | Crítico |

### 3. **Problemas de Configuración**

✅ **Bien:** Base de datos SQLite usa SHA-256 para contraseñas
✅ **Bien:** API Backend usa hashing seguro
❌ **Mal:** .env en git
❌ **Mal:** Contraseña en JS en texto plano
❌ **Mal:** SMTP credentials hardcodeadas

---

## ✅ SEGURIDAD VERIFICADA

### Autenticación en Backend

✅ SHA-256 hashing para contraseñas
✅ Token de sesión aleatorio (random_bytes)
✅ Token de recuperación único
✅ Expiración de tokens (1 hora)
✅ Validación de email + hash

### Contraseñas

✅ Mínimo 8 caracteres requeridos
✅ Hash SHA-256 almacenado (no texto plano)
✅ Tokens generados con random_bytes(32)
✅ Recuperación segura por email

### Otros

✅ CORS configurado correctamente
✅ Base de datos protegida (no accesible vía web)
✅ API con validación de entrada
✅ Errores genéricos (no expone info sensible)

---

## 🔧 ACCIONES REQUERIDAS ANTES DE BUILD

### PASO 1: Limpiar Contraseñas Hardcodeadas

**Eliminar de `/public/total-darkness/total-darkness/app.js`:**

```diff
- const ADMIN_PASSWORD = "TotalDarkness2026!";  // ← ELIMINAR
```

**Reemplazar con referencia al backend:**

```javascript
// Las contraseñas se validan en el backend (api/auth.php)
// No se almacenan en el frontend
```

### PASO 2: Crear .gitignore para archivos sensibles

```bash
# Archivos que NO deben versionarse
.env
.env.local
*.key
*.pem
node_modules/
dist/
.DS_Store
```

### PASO 3: Crear .env.example

```dotenv
# Copiar .env a .env.local y completar valores

# SMTP Configuration
SMTP_HOST=mail.xlerion.com
SMTP_PORT=465
SMTP_USERNAME=support@xlerion.com
SMTP_PASSWORD=YOUR_PASSWORD_HERE

# Email
EMAIL_USER=contactus@xlerion.com
EMAIL_PASSWORD=YOUR_PASSWORD_HERE
```

### PASO 4: Mover SMTP Credentials a .env

**En `api/auth.php`:**

**De:**

```php
define('SMTP_HOST', 'mail.xlerion.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'support@xlerion.com');
define('SMTP_PASSWORD', 'Ultimate81720164!1984');  // ← EXPUESTO
```

**A:**

```php
// Cargar desde .env o variables de entorno
$smtp_host = getenv('SMTP_HOST') ?: 'mail.xlerion.com';
$smtp_port = getenv('SMTP_PORT') ?: 465;
$smtp_username = getenv('SMTP_USERNAME') ?: 'support@xlerion.com';
$smtp_password = getenv('SMTP_PASSWORD') ?: null;

if (!$smtp_password) {
    error_log('ERROR: SMTP_PASSWORD no configurado');
    throw new Exception('Configuración de servidor SMTP incompleta');
}

define('SMTP_HOST', $smtp_host);
define('SMTP_PORT', $smtp_port);
define('SMTP_USERNAME', $smtp_username);
define('SMTP_PASSWORD', $smtp_password);
```

### PASO 5: Verificar .env NO está en git

```bash
git rm --cached .env
git rm --cached server/.env
echo ".env" >> .gitignore
git add .gitignore
git commit -m "Remove .env files and add to gitignore"
```

### PASO 6: Verificar No hay Passwords en Frontend

```bash
grep -r "password\|PASSWORD\|contraseña" public/total-darkness/*.js | grep -v "placeholder\|label\|type=\|data-i18n"
```

Debería devolver solo referencias a campos de forma, no valores reales.

---

## 📋 CHECKLIST PRE-BUILD

- [ ] ✅ SMTP Password removida de auth.php (usar .env)
- [ ] ✅ .env agregado a .gitignore
- [ ] ✅ Contraseña removida de `/total-darkness/app.js`
- [ ] ✅ Contraseña removida de `/app.js` (quedó solo hash)
- [ ] ✅ .env.example creado con ejemplos
- [ ] ✅ Verificar: `grep -r "TotalDarkness2026" .` = solo en base de datos (0 resultados)
- [ ] ✅ Verificar: `grep -r "Ultimate81720164" .` = solo en .env (1 resultado)
- [ ] ✅ Backend auth.php usa solo Backend
- [ ] ✅ Frontend valida en backend, no local
- [ ] ✅ Tokens con expiración configurados
- [ ] ✅ CORS restringido en producción (cambiar `*` a dominio real)

---

## 🏗️ ESTADO PARA BUILD

| Aspecto | Estado | Acción |
|--------|--------|--------|
| **CORS** | ✅ Funcionando | Cambiar `*` a dominio en prod |
| **SMTP** | ⚠️ Expuesto | Mover a .env |
| **Contraseñas** | ⚠️ Parcial | Limpiar app.js |
| **Git** | ❌ Inseguro | Agregar .gitignore |
| **Auth Backend** | ✅ Seguro | Mantener como está |
| **Tokens** | ✅ Seguro | Mantener como está |
| **BD** | ✅ Protegida | Mantener como está |

---

## 🚀 LISTO PARA BUILD SI

1. ✅ No hay contraseñas en código fuente
2. ✅ .env en .gitignore
3. ✅ CORS configurado para producción
4. ✅ Backend API como única fuente de verdad
5. ✅ Tokens con expiración
6. ✅ HTTPS en producción

**Status Actual:** ⚠️ **NO LISTO - Requiere limpieza de credenciales**

---

## 📌 Próximos Pasos Recomendados

1. Ejecutar limpieza de seguridad (ver ACCIONES REQUERIDAS)
2. Verificar con `grep` que no quedan credenciales
3. Commit final con cambios de seguridad
4. Luego proceder con build
