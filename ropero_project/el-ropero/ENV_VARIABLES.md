# Variables de Entorno - El Ropero Mag&co

Este archivo documenta todas las variables de entorno requeridas para el funcionamiento completo del proyecto.

## 📋 Plantilla .env

Copiar este contenido a tu archivo `.env` y personalizar los valores:

```bash
# ======================
# CONFIGURACIÓN BÁSICA
# ======================

APP_NAME="El Ropero Mag&co"
APP_ENV=local                     # local | staging | production
APP_KEY=                          # Generar con: php artisan key:generate
APP_DEBUG=true                    # false en producción
APP_URL=http://localhost:8000

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

# ======================
# BASE DE DATOS
# ======================

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=el_ropero
DB_USERNAME=root
DB_PASSWORD=

# ======================
# CACHE Y SESIONES
# ======================

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync             # database | redis para producción
SESSION_DRIVER=file
SESSION_LIFETIME=120

# ======================
# REDIS (Opcional)
# ======================

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

# ======================
# EMAIL (SMTP)
# ======================

MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io        # Mailtrap para desarrollo
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@elropero.com"
MAIL_FROM_NAME="${APP_NAME}"

# Producción (ejemplo con Gmail):
# MAIL_MAILER=smtp
# MAIL_HOST=smtp.gmail.com
# MAIL_PORT=587
# MAIL_USERNAME=tu-email@gmail.com
# MAIL_PASSWORD=tu-app-password
# MAIL_ENCRYPTION=tls

# ======================
# AWS S3 (Imágenes)
# ======================

AWS_ACCESS_KEY_ID=                # Tu access key
AWS_SECRET_ACCESS_KEY=            # Tu secret key
AWS_DEFAULT_REGION=us-east-1      # Región del bucket
AWS_BUCKET=el-ropero-images       # Nombre del bucket
AWS_URL=                          # CloudFront URL (opcional)
AWS_USE_PATH_STYLE_ENDPOINT=false

# Configuración S3:
# - Bucket debe ser público para lectura (o usar signed URLs)
# - CORS configurado para permitir uploads desde tu dominio
# - IAM policy con permisos: s3:PutObject, s3:GetObject, s3:DeleteObject

# ======================
# STRIPE (Pagos)
# ======================

STRIPE_KEY=pk_test_...            # Public key (test)
STRIPE_SECRET=sk_test_...         # Secret key (test)
STRIPE_WEBHOOK_SECRET=whsec_...   # Webhook signing secret

# Producción:
# STRIPE_KEY=pk_live_...
# STRIPE_SECRET=sk_live_...
# STRIPE_WEBHOOK_SECRET=whsec_...

# Configuración Stripe Dashboard:
# - Webhook endpoint: https://tudominio.com/api/stripe/webhook
# - Eventos a escuchar:
#   - payment_intent.succeeded
#   - payment_intent.payment_failed
#   - charge.refunded

# ======================
# CONFIGURACIÓN DE SUBASTAS
# ======================

# Duración por defecto de subastas (días)
AUCTION_DEFAULT_DURATION=7

# Incremento mínimo de puja (porcentaje)
AUCTION_MIN_INCREMENT_PERCENT=1

# Incremento mínimo absoluto (COP)
AUCTION_MIN_INCREMENT_AMOUNT=500

# Polling interval para actualizaciones (segundos)
AUCTION_POLL_INTERVAL=5

# Comisión de la plataforma (porcentaje)
PLATFORM_COMMISSION_PERCENT=5

# ======================
# LÍMITES DE UPLOAD
# ======================

# Tamaño máximo de imagen (MB)
MAX_IMAGE_SIZE=2

# Número máximo de imágenes por producto
MAX_IMAGES_PER_PRODUCT=5

# Dimensiones de thumbnails (px)
THUMBNAIL_WIDTH=300
THUMBNAIL_HEIGHT=300

# Dimensiones de imagen grande (px)
LARGE_IMAGE_WIDTH=1200
LARGE_IMAGE_HEIGHT=1200

# ======================
# SEGURIDAD
# ======================

# Intentos de login antes de bloqueo
LOGIN_MAX_ATTEMPTS=5
LOGIN_LOCKOUT_MINUTES=15

# Tiempo de expiración de tokens (minutos)
JWT_TTL=60
REFRESH_TTL=20160                 # 14 días

# CORS (dominios permitidos, separados por coma)
CORS_ALLOWED_ORIGINS=http://localhost:5173,http://localhost:8000

# ======================
# NOTIFICACIONES
# ======================

# Notificaciones de email habilitadas
NOTIFICATIONS_EMAIL_ENABLED=true

# Notificaciones push (futuro)
NOTIFICATIONS_PUSH_ENABLED=false

# Enviar email a vendedor cuando recibe puja
NOTIFY_SELLER_ON_BID=true

# Enviar email a comprador cuando es superado
NOTIFY_BUYER_ON_OUTBID=true

# Enviar email cuando subasta finaliza
NOTIFY_ON_AUCTION_END=true

# ======================
# RECAPTCHA (Anti-spam)
# ======================

RECAPTCHA_SITE_KEY=
RECAPTCHA_SECRET_KEY=
RECAPTCHA_ENABLED=false           # true en producción

# ======================
# ANALÍTICAS
# ======================

GOOGLE_ANALYTICS_ID=              # UA-XXXXX-Y o G-XXXXXXXXXX
FACEBOOK_PIXEL_ID=

# ======================
# SOCIAL AUTH (Futuro)
# ======================

GOOGLE_CLIENT_ID=
GOOGLE_CLIENT_SECRET=
GOOGLE_REDIRECT_URI=

FACEBOOK_CLIENT_ID=
FACEBOOK_CLIENT_SECRET=
FACEBOOK_REDIRECT_URI=

# ======================
# CRON JOBS
# ======================

# Hora de cierre de subastas (UTC)
# Cron: php artisan schedule:run
AUCTION_CLOSE_HOUR=23             # 11 PM UTC
AUCTION_CLOSE_MINUTE=59

# ======================
# DEBUG Y LOGGING
# ======================

# Habilitar query logging (solo desarrollo)
DB_QUERY_LOG=false

# Habilitar debug bar (solo desarrollo)
DEBUGBAR_ENABLED=true

# Telescope (solo desarrollo)
TELESCOPE_ENABLED=true
```

## 🚀 Setup por Entorno

### Development (Local)

```bash
# Copiar plantilla
cp .env.example .env

# Generar key
php artisan key:generate

# Configurar DB local
DB_DATABASE=el_ropero
DB_USERNAME=root
DB_PASSWORD=

# Email con Mailtrap
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu-username
MAIL_PASSWORD=tu-password

# S3 con LocalStack o cuenta de desarrollo
AWS_ACCESS_KEY_ID=tu-dev-key
AWS_SECRET_ACCESS_KEY=tu-dev-secret
AWS_BUCKET=el-ropero-dev

# Stripe test mode
STRIPE_KEY=pk_test_...
STRIPE_SECRET=sk_test_...
```

### Staging

```bash
APP_ENV=staging
APP_DEBUG=false
APP_URL=https://staging.elropero.com

# DB en servidor staging
DB_HOST=staging-db-host
DB_DATABASE=el_ropero_staging
DB_USERNAME=staging_user
DB_PASSWORD=strong-staging-password

# Queue con Redis
QUEUE_CONNECTION=redis
REDIS_HOST=staging-redis-host

# Email real (SendGrid, Mailgun, etc.)
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_USERNAME=apikey
MAIL_PASSWORD=tu-sendgrid-api-key

# S3 bucket de staging
AWS_BUCKET=el-ropero-staging

# Stripe test mode (aún)
STRIPE_KEY=pk_test_...
```

### Production

```bash
APP_ENV=production
APP_DEBUG=false
APP_URL=https://elropero.com

# DB en servidor de producción (alta disponibilidad)
DB_HOST=prod-db-cluster
DB_DATABASE=el_ropero_prod
DB_USERNAME=prod_user
DB_PASSWORD=very-strong-production-password

# Queue con Redis (para jobs)
QUEUE_CONNECTION=redis
REDIS_HOST=prod-redis-cluster

# Cache con Redis
CACHE_DRIVER=redis

# Sesiones en Redis (para load balancing)
SESSION_DRIVER=redis

# Email transaccional (SendGrid, AWS SES, etc.)
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_USERNAME=apikey
MAIL_PASSWORD=tu-sendgrid-production-key

# S3 producción con CloudFront
AWS_BUCKET=el-ropero-production
AWS_URL=https://cdn.elropero.com

# Stripe LIVE mode
STRIPE_KEY=pk_live_...
STRIPE_SECRET=sk_live_...

# reCAPTCHA habilitado
RECAPTCHA_ENABLED=true
RECAPTCHA_SITE_KEY=tu-site-key
RECAPTCHA_SECRET_KEY=tu-secret-key

# SSL forzado (agregar en AppServiceProvider)
# URL::forceScheme('https')

# Seguridad aumentada
LOGIN_MAX_ATTEMPTS=3
LOGIN_LOCKOUT_MINUTES=30
```

## 🔐 Secretos y Seguridad

### ¡NUNCA COMMITEAR

- **NUNCA** subir `.env` al repositorio
- `.env` debe estar en `.gitignore`
- Usar `.env.example` como plantilla (sin valores reales)

### Gestión de Secretos en Producción

**Opciones:**

1. **Variables de entorno del servidor** (recomendado)

   ```bash
   # En hosting/VPS
   export STRIPE_SECRET=sk_live_...
   ```

2. **AWS Secrets Manager** (para AWS)

   ```bash
   aws secretsmanager get-secret-value --secret-id el-ropero/prod
   ```

3. **Laravel Forge** (si usas Forge)
   - Secrets en panel de control
   - Encriptación automática

4. **Vault by HashiCorp** (para empresas)
   - Gestión centralizada de secretos
   - Rotación automática de keys

### Encriptar Valores Sensibles

Laravel permite encriptar valores en `.env`:

```bash
# Encriptar
php artisan env:encrypt --key=base64:your-encryption-key

# Desencriptar (producción)
php artisan env:decrypt --key=base64:your-encryption-key
```

## ✅ Checklist de Configuración

### Desarrollo Local

- [ ] `.env` creado desde `.env.example`
- [ ] `APP_KEY` generada con `php artisan key:generate`
- [ ] Base de datos MySQL/PostgreSQL corriendo
- [ ] Credenciales de DB correctas
- [ ] Mailtrap configurado para emails
- [ ] S3 local o cuenta de desarrollo
- [ ] Stripe test keys configuradas
- [ ] `npm install` ejecutado
- [ ] Migraciones corridas: `php artisan migrate`
- [ ] Seed de datos: `php artisan db:seed`

### Staging

- [ ] Variables de entorno configuradas en servidor
- [ ] `APP_DEBUG=false`
- [ ] Base de datos de staging poblada
- [ ] Redis configurado y corriendo
- [ ] S3 bucket de staging creado y configurado
- [ ] Emails enviándose correctamente (SendGrid/Mailgun)
- [ ] Stripe test mode funcionando
- [ ] SSL configurado (Let's Encrypt)
- [ ] Cron job configurado: `* * * * * php /path/to/artisan schedule:run`
- [ ] Logs monitoreados (Papertrail, Sentry, etc.)

### Producción

- [ ] **TODOS** los secretos rotatados desde staging
- [ ] `APP_DEBUG=false` (verificar 2x)
- [ ] Base de datos de producción con backups automáticos
- [ ] Redis en alta disponibilidad
- [ ] Queue workers corriendo: `php artisan queue:work --daemon`
- [ ] S3 con CloudFront configurado
- [ ] **Stripe LIVE mode** con webhooks verificados
- [ ] reCAPTCHA habilitado y funcionando
- [ ] SSL/TLS con certificado válido
- [ ] Headers de seguridad configurados (CSP, HSTS, etc.)
- [ ] Rate limiting configurado
- [ ] Monitoring configurado (Uptime Robot, New Relic, etc.)
- [ ] Alertas configuradas para errores críticos
- [ ] Backups automáticos diarios de DB
- [ ] Plan de disaster recovery documentado

## 🔍 Verificación

### Script de Verificación

Crear `scripts/verify-env.php`:

```php
<?php

$required = [
    'APP_KEY',
    'DB_DATABASE',
    'DB_USERNAME',
    'AWS_ACCESS_KEY_ID',
    'AWS_SECRET_ACCESS_KEY',
    'AWS_BUCKET',
    'STRIPE_KEY',
    'STRIPE_SECRET',
];

$missing = [];

foreach ($required as $key) {
    if (empty(env($key))) {
        $missing[] = $key;
    }
}

if (!empty($missing)) {
    echo "❌ Missing required environment variables:\n";
    foreach ($missing as $key) {
        echo "   - $key\n";
    }
    exit(1);
}

echo "✅ All required environment variables are set!\n";
exit(0);
```

Ejecutar:

```bash
php scripts/verify-env.php
```

## 📞 Soporte

Si tienes problemas con la configuración:

1. Revisar logs: `storage/logs/laravel.log`
2. Verificar sintaxis del `.env` (sin espacios alrededor del `=`)
3. Cachear config: `php artisan config:cache`
4. Limpiar cache si cambiaste `.env`: `php artisan config:clear`

---

**Última actualización:** 2026-01-31
