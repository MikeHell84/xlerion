# El Ropero Mag&co - Frontend

## Stack Tecnológico

- **Framework**: Laravel 10 (Blade templates)
- **Frontend**: Alpine.js 3 + Tailwind CSS 3
- **Build**: Vite 5
- **Imágenes**: S3 (CDN URLs)
- **Testing**: Playwright / Cypress (E2E)

## Estructura del Proyecto

```
resources/
├── views/
│   ├── layouts/
│   │   └── app.blade.php          # Layout base
│   ├── components/
│   │   ├── header.blade.php
│   │   ├── footer.blade.php
│   │   ├── auction-card.blade.php
│   │   ├── skeleton-card.blade.php
│   │   └── bid-modal.blade.php
│   ├── home.blade.php             # Página de inicio
│   ├── auctions/
│   │   ├── index.blade.php        # Listado con filtros y paginación
│   │   └── show.blade.php         # Detalle con galería y polling
│   ├── auth/
│   │   ├── login.blade.php
│   │   ├── register.blade.php
│   │   ├── forgot-password.blade.php
│   │   └── reset-password.blade.php
│   ├── seller/
│   │   ├── dashboard.blade.php
│   │   ├── products.blade.php
│   │   ├── products-create.blade.php
│   │   └── products-edit.blade.php
│   ├── profile/
│   │   ├── index.blade.php
│   │   ├── orders.blade.php
│   │   └── sales.blade.php
│   ├── checkout/
│   │   └── index.blade.php
│   └── admin/
│       ├── dashboard.blade.php
│       ├── listings.blade.php
│       ├── disputes.blade.php
│       └── users.blade.php
├── js/
│   ├── app.js                     # Entry point
│   ├── components/                # Componentes Alpine reutilizables
│   ├── stores/
│   │   ├── auctionStore.js        # Polling y gestión de subastas
│   │   └── authStore.js           # Estado de autenticación
│   └── utils/
│       ├── notifications.js       # Sistema de toasts
│       └── helpers.js             # Utilidades (fechas, moneda, etc.)
└── css/
    └── app.css                    # Tailwind + utilidades custom
```

## Desarrollo Local

### Instalación

```bash
cd el-ropero

# Instalar dependencias Node
npm install

# Instalar dependencias PHP (si Composer no se ha ejecutado)
composer install

# Copiar .env
cp .env.example .env

# Generar clave de aplicación
php artisan key:generate

# Crear base de datos y ejecutar migraciones
php artisan migrate

# Compilar assets
npm run build
```

### Desarrollo con Hot Module Reloading

```bash
# Terminal 1: Servidor Laravel
php artisan serve

# Terminal 2: Vite dev server
npm run dev
```

Visita `http://localhost:8000` (o el puerto que indique `php artisan serve`)

## Build para Producción

```bash
npm run build
php artisan view:cache
php artisan config:cache
```

Esto genera:

- Assets minificados en `public/build/`
- Vistas Blade compiladas en `bootstrap/cache/`

## Características Implementadas

### 1. Layout Base y Componentes

- ✅ Header con búsqueda, notificaciones y menú usuario
- ✅ Footer con enlaces legales y redes sociales
- ✅ Sistema de toasts (notificaciones)
- ✅ Skeleton loaders para estados de carga

### 2. Página de Inicio

- ✅ Héroe con call-to-action
- ✅ Carrusel de subastas destacadas
- ✅ Sección "Cómo funciona"
- ✅ Categorías de prendas

### 3. Listado de Subastas

- ✅ Paginación
- ✅ Filtros: búsqueda, estado, precio máximo, marca, ordenamiento
- ✅ Grid responsivo con shadow cards
- ✅ Lazy loading de imágenes

### 4. Detalle de Subasta

- ✅ Galería de imágenes con thumbnails
- ✅ Información del producto (marca, condición, talla)
- ✅ Contador regresivo actualizado cada segundo
- ✅ Historial de pujas con tiempo relativo
- ✅ Polling de datos cada 5 segundos (pseudo-realtime)
- ✅ Modal de puja con validaciones
- ✅ Información del vendedor
- ✅ Compartir subasta

### 5. Autenticación

- ✅ Login con email/contraseña
- ✅ Registro con validación
- ✅ Recuperar contraseña
- ✅ Restablecer contraseña

### 6. Panel Vendedor

- ✅ Dashboard con estadísticas
- ✅ Listado de prendas (crear, editar, eliminar)
- ✅ Creación de prendas con:
  - Carga de múltiples imágenes
  - Información de producto
  - Configuración de subasta

### 7. Perfil de Usuario

- ✅ Edición de perfil
- ✅ Cambio de contraseña
- ✅ Historial de compras
- ✅ Historial de ventas
- ✅ Estadísticas de vendedor

### 8. Checkout

- ✅ Resumen de compra
- ✅ Dirección de envío
- ✅ Método de pago
- ✅ Breakdown de costos
- ✅ Integración con Stripe (Sandbox)

### 9. Admin

- ✅ Dashboard con estadísticas
- ✅ Moderación de listados (aprobar/rechazar)
- ✅ Gestión de disputas
- ✅ Gestión de usuarios (ban)

## Validaciones y Accesibilidad

**Ver documentación completa:** [`ACCESSIBILITY_CHECKLIST.md`](./ACCESSIBILITY_CHECKLIST.md)

### Validaciones Cliente

- Email válido
- Contraseña mínimo 8 caracteres
- Cantidad de puja >= mínimo
- Imágenes máximo 5, tamaño límite 2MB
- Campos requeridos en formularios

### WCAG 2.1 AA

- ✅ Labels asociados a inputs
- ✅ Contraste de colores (primary: #00e9fa sobre dark: #000000)
- ✅ Navegación por teclado (tabs, Enter para submit)
- ✅ ARIA labels en botones y elementos interactivos
- ✅ Textos alternativos en imágenes
- ✅ Estructura semántica (header, main, footer, nav, aside)

### Responsive

- Mobile first approach
- Breakpoints: sm (640px), md (768px), lg (1024px), xl (1280px)
- Flexbox y grid para layouts
- Hamburger menu en mobile

El archivo [`ACCESSIBILITY_CHECKLIST.md`](./ACCESSIBILITY_CHECKLIST.md) incluye:

- Checklist completo de WCAG 2.1 AA
- Testing con herramientas automáticas (axe, Lighthouse, WAVE)
- Testing manual con teclado y screen readers
- Guías específicas para cada componente (modales, formularios, carruseles)

## Integración con Backend

### Endpoints Consumidos

| Método | Ruta                           | Propósito                   |
|--------|--------------------------------|-----------------------------|
| GET    | `/api/auctions`                | Listar subastas con filtros |
| GET    | `/api/auctions/{id}`           | Detalle de subasta          |
| POST   | `/api/auctions/{id}/bids`      | Crear puja                  |
| POST   | `/api/products`                | Crear prenda (upload)       |
| GET    | `/api/products?mine=true`      | Listado de mis prendas      |
| GET    | `/api/profile/orders`          | Mis compras                 |
| GET    | `/api/profile/sales`           | Mis ventas                  |
| POST   | `/api/auth/login`              | Login (Laravel Auth)        |
| POST   | `/api/auth/register`           | Registro                    |
| POST   | `/api/auth/logout`             | Logout                      |
| POST   | `/api/auth/forgot-password`    | Solicitar reset             |
| POST   | `/api/auth/reset-password`     | Reset de contraseña         |

### Headers Requeridos

```javascript
// CSRF token (automático con Blade)
X-CSRF-TOKEN: {{ csrf_token() }}

// Authorization (Bearer token)
Authorization: Bearer {token}
```

### Ejemplos de Response

**GET /api/auctions?page=1&status=active**

```json
{
  "data": [
    {
      "id": 1,
      "title": "Camiseta Mag&co",
      "description": "...",
      "image_url": "https://s3.amazonaws.com/...",
      "images": [
        {
          "url": "https://...",
          "thumbnail_url": "https://..."
        }
      ],
      "brand": "Mag&co",
      "condition": "like_new",
      "size": "M",
      "status": "active",
      "current_bid": 45000,
      "bids_count": 5,
      "end_date": "2026-02-03T14:30:00Z",
      "seller": {
        "id": 1,
        "name": "Juan Vendedor",
        "avatar_url": "..."
      }
    }
  ],
  "meta": {
    "total": 100,
    "per_page": 10,
    "current_page": 1,
    "last_page": 10
  }
}
```

**POST /api/auctions/{id}/bids**

```json
{
  "data": {
    "id": 1,
    "current_bid": 50000,
    "bids_count": 6
  },
  "bids": [
    {
      "id": 6,
      "amount": 50000,
      "user": {
        "name": "Pedro Comprador"
      },
      "created_at": "2026-02-01T10:30:00Z"
    }
  ]
}
```

## Performance y Optimización

### Lazy Loading

- Imágenes: `loading="lazy"` en etiquetas `<img>`
- Componentes: Alpine.js `x-show` vs `x-if` para DOM manipulation

### Caching

- Vite gestiona cache busting con hashes
- Configurar headers en Apache/Nginx:

  ```
  assets/: Cache-Control: public, max-age=31536000
  index.html: Cache-Control: no-cache, no-store
  ```

### Minificación

- CSS: Tailwind purge (automatic)
- JS: Vite minifica en producción

### Bundle Size Target

- JS: < 200KB (comprimido)
- CSS: < 50KB (comprimido)

## Testing E2E

**Ver documentación completa:** [`PLAYWRIGHT_TESTS.md`](./PLAYWRIGHT_TESTS.md)

### Setup

```bash
npm install -D @playwright/test
npx playwright install
```

### Tests Críticos

```bash
# Crear user > pujar > checkout > pago sandbox
npx playwright test tests/e2e/bidding-flow.spec.js

# Login > crear prenda > subasta inicia > cierre por cron
npx playwright test tests/e2e/seller-flow.spec.js

# Moderar listado > resolver disputa
npx playwright test tests/e2e/admin-flow.spec.js

# Todos los tests
npx playwright test

# UI interactivo
npx playwright test --ui
```

El archivo [`PLAYWRIGHT_TESTS.md`](./PLAYWRIGHT_TESTS.md) incluye:

- 5+ ejemplos completos (Auth, Listing, Detail, Seller, Admin)
- Configuración de Playwright
- CI/CD integration con GitHub Actions
- Fixtures y test data patterns

## Checklist de Despliegue

- [ ] Compilar assets: `npm run build`
- [ ] Cachear vistas: `php artisan view:cache`
- [ ] Cachear config: `php artisan config:cache`
- [ ] Cachear rutas: `php artisan route:cache`
- [ ] Verificar permiso de `storage/` y `bootstrap/cache/`
- [ ] Configurar variables de entorno (DB, AWS, MAIL, STRIPE)
- [ ] Ejecutar migraciones: `php artisan migrate --force`
- [ ] Llenar datos iniciales: `php artisan db:seed`
- [ ] Configurar SSL con Let's Encrypt
- [ ] Configurar CORS en `config/cors.php`
- [ ] Setear headers de seguridad (X-Frame-Options, CSP)
- [ ] Configurar cron para `php artisan schedule:run`
- [ ] Probar pagos en Stripe Sandbox antes de producción

## Decisiones de Diseño

### Pseudo-realtime vs WebSockets

Actualmente se usa polling cada 5 segundos. Para migrar a WebSockets:

1. Instalar `beyondcode/laravel-websockets`
2. Reemplazar `setInterval` en `auctionStore.js` con `echo.channel()`
3. Hacer broadcast en `CloseAuctions` command

### Imágenes y S3

- Upload en `POST /api/products` (FormData multipart)
- Redimensionar en job `GenerateThumbnails` (Intervention/Image)
- URLs públicas desde S3 (no signed URLs para lectura)

### Stripe Sandbox

- Test card: `4242 4242 4242 4242`, CVC: `123`, fecha futura
- PaymentIntent creada sin confirmación (cliente confirma en checkout)
- Webhooks configurados en dashboard de Stripe

## Roadmap Futuro

- [ ] WebSockets para pujas en tiempo real
- [ ] Notificaciones push (PWA)
- [ ] Mensajes entre usuarios (chat)
- [ ] Sistema de reputación y reviews
- [ ] Wishlist y saved auctions
- [ ] Búsqueda por imagen (reverse image search)
- [ ] Reportes y analytics para vendedores
- [ ] Subasta en vivo (streaming de video)

## Contacto y Soporte

- **Documentación API**: `/api/docs` (Swagger)
- **Email soporte**: <support@elropero.com>
- **Issues/Bugs**: GitHub Issues

---

Última actualización: 2026-01-31
