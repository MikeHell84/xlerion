# 🚀 Inicio Rápido - Backend PHP

## Problema: "Unexpected token '<', "<?php..."

Este error significa que **PHP no se está ejecutando**. Vite solo sirve archivos estáticos, no puede ejecutar PHP.

## ✅ Solución: Ejecutar Servidor PHP

### Paso 1: Verificar que tienes PHP instalado

```powershell
php -v
```

**Si no está instalado:**

```powershell
# Con Chocolatey
choco install php

# O descargar de: https://windows.php.net/download/
```

### Paso 2: Iniciar el Servidor PHP

```powershell
cd x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness
.\start-php-server.ps1
```

**O manualmente:**

```powershell
cd x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness
php -S localhost:8080 -c php.ini
```

### Paso 3: Mantener Ambos Servidores Corriendo

Necesitas **2 terminales**:

**Terminal 1 - Vite (Frontend):**

```powershell
npm run dev
# Corre en: http://localhost:5173
```

**Terminal 2 - PHP (Backend):**

```powershell
.\start-php-server.ps1
# Corre en: http://localhost:8080
```

### Paso 4: Acceder a la Aplicación

- **Panel Admin:** <http://localhost:5173/total-darkness/>
- **Testing:** <http://localhost:5173/total-darkness/test-backend-auth.html>
- **API Directa:** <http://localhost:8080/total-darkness/api/auth.php>

---

## 📧 Configurar Correo Electrónico

### Opción A: MailHog (Desarrollo - Recomendado)

1. **Instalar MailHog:**

```powershell
choco install mailhog
```

1. **Ejecutar MailHog:**

```powershell
mailhog
```

1. **Ver correos capturados:**
<http://localhost:8025>

2. **Actualizar php.ini (ya configurado):**

```ini
SMTP = localhost
smtp_port = 1025
```

### Opción B: SMTP Real de Xlerion (Producción)

1. **Obtener credenciales SMTP de tu proveedor:**
   - Servidor: `mail.xlerion.com` (o el que uses)
   - Puerto: `587` (STARTTLS) o `465` (SSL)
   - Usuario: Tu email o usuario SMTP
   - Contraseña: Tu contraseña SMTP

2. **Actualizar `php.ini`:**

```ini
SMTP = mail.xlerion.com
smtp_port = 587
sendmail_from = noreply@xlerion.com
```

1. **Para autenticación SMTP (si es necesaria):**

Edita `api/auth.php` para usar PHPMailer o SwiftMailer:

```php
// Instalar PHPMailer (en el directorio del proyecto)
composer require phpmailer/phpmailer

// En auth.php, reemplazar la función sendRecoveryEmail():
use PHPMailer\PHPMailer\PHPMailer;

function sendRecoveryEmail($email, $token) {
    $mail = new PHPMailer(true);
    
    // Configuración SMTP
    $mail->isSMTP();
    $mail->Host = 'mail.xlerion.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'tu-usuario-smtp@xlerion.com';
    $mail->Password = 'tu-contraseña-smtp';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    
    // Configurar correo
    $mail->setFrom('noreply@xlerion.com', 'Total Darkness');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Recuperación de Contraseña - Total Darkness';
    $mail->Body = '...'; // HTML del correo
    
    return $mail->send();
}
```

---

## 🧪 Probar el Sistema

1. **Inicia ambos servidores** (Vite + PHP)

2. **Abre:** <http://localhost:5173/total-darkness/test-backend-auth.html>

3. **Haz clic en:** "Ejecutar Todos los Tests"

4. **Verifica que todos pasan ✅**

### Tests Disponibles

1. ✅ API responde
2. ✅ Base de datos se crea
3. ✅ Login con admin por defecto funciona
4. ✅ Login incorrecto es rechazado
5. ✅ Solicitud de recuperación funciona
6. ✅ Token inválido es rechazado
7. ✅ Listar administradores funciona
8. ✅ Crear admin requiere autenticación

---

## 🔐 Credenciales por Defecto

**Admin por defecto:**

- Email: `admin@xlerion.com`
- Password: `TotalDarkness2026!`

**⚠️ IMPORTANTE:** Cambia esta contraseña en producción

---

## 📁 Estructura de Archivos

```
total-darkness/
├── start-php-server.ps1    ← EJECUTA ESTO
├── php.ini                  ← Configuración PHP
├── api/
│   └── auth.php            ← Backend API
├── data/
│   ├── .htaccess           ← Protección
│   └── admins.db           ← Base de datos (se crea automático)
├── recovery.html
├── reset-password.html
├── admin-management.js
└── test-backend-auth.html  ← Para probar
```

---

## 🐛 Solución de Problemas

### "No se pudo conectar al API"

- ✅ Verifica que el servidor PHP está corriendo
- ✅ Abre: <http://localhost:8080/total-darkness/api/auth.php>
- ✅ Debe mostrar: `{"success":false,"error":"Acción no válida"}`

### "Database error: unable to open database"

- ✅ Verifica permisos en carpeta `data/`
- ✅ Ejecuta como administrador si es necesario

### "Error al enviar correo"

- ✅ Usa MailHog para desarrollo
- ✅ Verifica configuración SMTP en `php.ini`
- ✅ Revisa logs de PHP

### "Token inválido o expirado"

- ✅ Los tokens expiran en 1 hora
- ✅ Solicita un nuevo enlace de recuperación

---

## 📞 Información de Xlerion

**Correos configurados:**

- `noreply@xlerion.com` - Para correos automáticos
- `contactus@xlerion.com` - Para soporte

**Servidor SMTP:**

- Pregunta a tu proveedor de hosting por:
  - Servidor SMTP
  - Puerto (587 o 465)
  - Usuario/Contraseña

---

## ✅ Checklist de Inicio

- [ ] PHP instalado y en PATH
- [ ] MailHog instalado (para desarrollo)
- [ ] Servidor Vite corriendo (puerto 5173)
- [ ] Servidor PHP corriendo (puerto 8080)
- [ ] MailHog corriendo (puerto 8025)
- [ ] Tests pasando correctamente
- [ ] Recuperación de contraseña funcionando

---

**Listo para usar!** 🎉

Si tienes problemas, revisa el archivo `BACKEND-AUTH-README.md` para más detalles.
