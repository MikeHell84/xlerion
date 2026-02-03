# El Ropero - Backend (Laravel 10) - Autenticación

Este directorio contiene una implementación base de la autenticación (migraciones, modelo, controlador, middleware, tests) para El Ropero.

Requisitos

- PHP 8.1+
- Composer
- MariaDB

Instalación (local)

1. Desde `backend/laravel` instalar dependencias:

```bash
composer install
```

1. Copiar `.env.example` a `.env` y configurar conexión a la base de datos y SMTP (SendGrid/Mailgun).
2. Generar clave de la app:

```bash
php artisan key:generate
```

1. Ejecutar migraciones:

```bash
php artisan migrate
```

Rutas principales (API)

- `POST /api/register` { name, email, password, password_confirmation, role? }
- `POST /api/login` { email, password }
- `POST /api/logout` (requiere sesión)
- `POST /api/password/forgot` { email }
- `POST /api/password/reset` { email, token, password, password_confirmation }
- `GET /api/user` (requiere sesión)

Respuesta ejemplo registro (201):

```json
{ "user": { "id": 1, "name": "...", "email": "...", "role": "buyer" } }
```

Seguridad y notas

- Passwords hasheadas con `bcrypt` (Hash::make).
- CSRF habilitado para rutas web; las rutas API usan sesiones/headers CSRF cuando se integren con frontend Blade.
- Login protegido con `throttle:5,1` (5 intentos por minuto).

Tests

```bash
php artisan test
```

Queue (emails)
----------------

To send emails in background you should configure a queue driver (e.g. `database`, `redis`) and run a worker.

Example (database driver):

```bash
php artisan queue:table
php artisan migrate
php artisan queue:work
```

The `WelcomeMail` and `PasswordResetMail` are queued by default. If queue is not configured, the app will attempt to queue and will log an error; emails may still be sent synchronously if you change calls to `Mail::send()`.

Sanctum (token API)
--------------------

This project is prepared to use Laravel Sanctum for API tokens. After running `composer install`, publish and migrate Sanctum:

```bash
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate
```

Login endpoint can return a `token` when called with `device_name` (or if the request expects JSON). Use that Bearer token for authenticated requests.

Systemd example to run queue worker (production):

```ini
[Unit]
Description=Laravel Queue Worker

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /path/to/backend/laravel/artisan queue:work --sleep=3 --tries=3

[Install]
WantedBy=multi-user.target
```

Commits sugeridos

- `feat(auth): crear migración users y modelo`
- `feat(auth): implementar registro y validaciones`
- `feat(auth): login y logout con sesiones`
- `feat(auth): recuperación de contraseña`
- `test(auth): agregar pruebas de autenticación`
