# 👗 El Ropero Mag&co - Plataforma de Subastas de Moda

Sistema de subastas en línea para prendas de segunda mano de alta calidad.

[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.4-blue.svg)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.13-8BC0D0.svg)](https://alpinejs.dev)

---

## 📋 Estado del Proyecto

**Versión:** 1.0.0-beta  
**Estado:** ✅ **Frontend completo - Listo para integración con backend**

🎯 **Frontend MVP:** 100% implementado  
⏳ **Backend:** Pendiente de implementación  
⏳ **Testing E2E:** Plantillas creadas  
⏳ **Deployment:** Pendiente autorización del usuario

---

## 🚀 Inicio Rápido

### Requisitos Previos

- **PHP:** >= 8.1
- **Composer:** >= 2.5
- **Node.js:** >= 18.x
- **npm:** >= 9.x
- **MySQL/PostgreSQL:** >= 8.0 / 14
- **Redis:** (opcional, recomendado para producción)

### Instalación Local (5 minutos)

```bash
# 1. Instalar dependencias PHP
composer install

# 2. Configurar entorno
cp .env.example .env
php artisan key:generate

# 3. Configurar base de datos en .env
# DB_DATABASE=el_ropero
# DB_USERNAME=root
# DB_PASSWORD=

# 4. Migrar base de datos
php artisan migrate

# 5. Seed de datos (opcional)
php artisan db:seed

# 6. Instalar dependencias frontend
npm install

# 7. Iniciar servidores de desarrollo
# Terminal 1:
php artisan serve

# Terminal 2:
npm run dev

# 8. Abrir navegador
# http://localhost:8000
```

---

## 📚 Documentación Completa

### 🎯 Para Empezar

- **[PROJECT_STATUS.md](./PROJECT_STATUS.md)** - 📊 Estado completo del proyecto y entregables
- **[DOCS_INDEX.md](./DOCS_INDEX.md)** - 🗺️ Índice de navegación de toda la documentación

### 🔧 Desarrollo

- **[FRONTEND_README.md](./FRONTEND_README.md)** - 📘 Documentación principal del frontend (400+ líneas)
- **[ENV_VARIABLES.md](./ENV_VARIABLES.md)** - 🔐 Variables de entorno explicadas con ejemplos

### ✅ Testing & Calidad

- **[PLAYWRIGHT_TESTS.md](./PLAYWRIGHT_TESTS.md)** - 🧪 Tests E2E completos con 5+ ejemplos
- **[ACCESSIBILITY_CHECKLIST.md](./ACCESSIBILITY_CHECKLIST.md)** - ♿ WCAG 2.1 AA compliance checklist

---

## ✨ Funcionalidades Principales

### Para Compradores

- 🔍 Búsqueda y filtros avanzados
- 🖼️ Galería de imágenes con zoom
- ⏱️ Countdown en tiempo real
- 💰 Sistema de pujas con validación
- 📊 Historial de pujas (pseudo-realtime)
- 🛒 Checkout con Stripe
- 📦 Historial de compras

### Para Vendedores

- ➕ Crear productos con multi-imagen upload
- ⚙️ Configurar subastas (duración, incremento)
- 📈 Dashboard con estadísticas
- 📋 Gestión de inventario (CRUD)
- 💸 Historial de ventas

### Para Administradores

- ✅ Moderación de listados
- ⚖️ Resolución de disputas
- 👥 Gestión de usuarios
- 📊 Dashboard con métricas

---

## 🏗️ Stack Tecnológico

**Frontend:**

- Laravel Blade 10.x
- Tailwind CSS 3.4.1
- Alpine.js 3.13.3
- Vite 5 + HMR
- Axios 1.6.4

**Backend:**

- Laravel 10.x
- MySQL/PostgreSQL
- Redis (cache & queues)
- AWS S3 (images)
- Stripe (payments)

---

## 📦 Build para Producción

```bash
# 1. Instalar dependencias
composer install --optimize-autoloader --no-dev
npm ci

# 2. Compilar assets
npm run build

# 3. Cachear configuraciones
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 4. Crear archivo de deploy
# Ver FRONTEND_README.md para checklist completo
```

---

## 🚢 Deploy a cPanel

1. **Verificar espacio en disco** (root al 89% en tu brief)
2. **Upload** `el-ropero-deploy.zip` a `/home/<usuario>/`
3. **Unzip** a `/home/<usuario>/el-ropero`
4. **Permisos:** `chmod -R 775 storage bootstrap/cache`
5. **Dominio:** Configurar en cPanel → `el-ropero/public`
6. **PHP:** Habilitar PHP 8.x con PHP-FPM
7. **SSL:** Habilitar Let's Encrypt
8. **Variables:** Configurar `.env` en servidor
9. **Migrar:** `php artisan migrate --force`
10. **Cron:** `* * * * * php /path/to/artisan schedule:run`

**Ver:** [FRONTEND_README.md](./FRONTEND_README.md) - Sección "Checklist de Despliegue"

---

## 🧪 Testing

```bash
# E2E Tests (Playwright)
npm run test:e2e              # Todos los tests
npm run test:e2e:ui           # UI interactivo
npm run test:e2e:debug        # Debug mode

# Linting
npm run lint                  # Ver errores
npm run lint:fix              # Auto-fix

# Accessibility
# Chrome DevTools > Lighthouse > Accessibility (target: >= 90)
# axe DevTools Extension > Scan (target: 0 critical issues)
```

---

## 📁 Estructura del Proyecto

```
el-ropero/
├── app/                        # Laravel app
├── resources/
│   ├── views/                  # 30+ Blade templates
│   ├── js/                     # Alpine.js stores & utilities
│   └── css/                    # Tailwind CSS
├── routes/
│   ├── web.php                 # 20+ frontend routes
│   └── api.php                 # API endpoints
├── public/                     # Assets compilados
├── tests/                      # Tests E2E
├── package.json                # Frontend dependencies
├── vite.config.js              # Build config
├── tailwind.config.js          # Tailwind config
├── FRONTEND_README.md          # Documentación principal
├── PLAYWRIGHT_TESTS.md         # Tests E2E con ejemplos
├── ACCESSIBILITY_CHECKLIST.md  # WCAG 2.1 AA
├── ENV_VARIABLES.md            # Variables documentadas
├── PROJECT_STATUS.md           # Estado completo
└── DOCS_INDEX.md               # Índice de navegación
```

---

## 🤝 Contribución

Ver [DOCS_INDEX.md](./DOCS_INDEX.md) para workflow completo y convenciones.

**Quick:**

1. Branch: `feature/nueva-funcionalidad`
2. Commits: [Conventional Commits](https://www.conventionalcommits.org/)
3. Lint: `npm run lint:fix`
4. Tests: `npm run test:e2e`
5. Pull Request

---

## 📞 Soporte & Contacto

- **Documentación:** Ver `/DOCS` en este repositorio
- **Email:** <support@elropero.com>
- **Desarrollado por:** XlerionWeb para Mag&co

---

## 🗺️ Roadmap

### v1.0 (MVP) - En Progreso

- [x] Frontend completo (30+ páginas)
- [ ] Backend API (20+ endpoints)
- [ ] Testing E2E implementado
- [ ] Deploy a staging

### v1.1 - Planificado

- [ ] WebSockets (real-time bidding)
- [ ] PWA + Push notifications
- [ ] Chat entre usuarios
- [ ] Sistema de reviews

---

**¿Listo para comenzar?** 👉 [DOCS_INDEX.md](./DOCS_INDEX.md)

**Frontend completo?** 👉 [PROJECT_STATUS.md](./PROJECT_STATUS.md)

- `app/Console/Commands/CloseAuctions.php` — artisan command
- `.github/workflows/ci.yml` — CI to build and produce ZIP
- `deploy.sh` — helper script to create deployable zip
- `runbook/` — runbook and predeploy checklist

Read `runbook/runbook.md` for operational procedures.

---
Please fill `.env` secrets locally and never commit them.
