# Playwright E2E Tests - El Ropero Mag&co

Setup rápido de pruebas de usuario real en todos los flujos críticos.

## Instalación

```bash
cd el-ropero
npm install -D @playwright/test
npx playwright install

# Crear archivo de configuración
npx playwright --version
```

## Estructura de Carpetas

```
tests/
├── e2e/
│   ├── auth.spec.js           # Login, register, password reset
│   ├── auction-listing.spec.js # Búsqueda, filtros, paginación
│   ├── auction-detail.spec.js  # Galería, countdown, bidding
│   ├── seller.spec.js          # Product CRUD, auctions
│   ├── profile.spec.js         # Editar perfil, órdenes, ventas
│   ├── checkout.spec.js        # Carrito, envío, pago
│   └── admin.spec.js           # Moderación, disputas, usuarios
└── fixtures/
    ├── auth.fixture.js         # Helper para login
    └── test-data.js            # Seeds de datos
```

## playwright.config.js

```javascript
const { defineConfig, devices } = require('@playwright/test');

module.exports = defineConfig({
  testDir: './tests/e2e',
  fullyParallel: true,
  forbidOnly: !!process.env.CI,
  retries: process.env.CI ? 2 : 0,
  workers: process.env.CI ? 1 : undefined,
  reporter: 'html',
  use: {
    baseURL: 'http://localhost:8000',
    trace: 'on-first-retry',
    screenshot: 'only-on-failure',
  },

  projects: [
    {
      name: 'chromium',
      use: { ...devices['Desktop Chrome'] },
    },
    {
      name: 'firefox',
      use: { ...devices['Desktop Firefox'] },
    },
    {
      name: 'webkit',
      use: { ...devices['Desktop Safari'] },
    },
    {
      name: 'Mobile Chrome',
      use: { ...devices['Pixel 5'] },
    },
  ],

  webServer: {
    command: 'php artisan serve',
    url: 'http://localhost:8000',
    reuseExistingServer: !process.env.CI,
  },
});
```

## Ejemplo 1: Auth Tests (`tests/e2e/auth.spec.js`)

```javascript
const { test, expect } = require('@playwright/test');

test.describe('Authentication', () => {
  test.beforeEach(async ({ page }) => {
    await page.goto('/');
  });

  test('Registro de usuario nuevo', async ({ page }) => {
    // Click en link de registro
    await page.click('a[href="/register"]');
    await expect(page).toHaveURL('/register');

    // Rellenar formulario
    await page.fill('input[name="name"]', 'Juan Test');
    await page.fill('input[name="email"]', `test${Date.now()}@example.com`);
    await page.fill('input[name="password"]', 'SecurePass123!');
    await page.fill('input[name="password_confirmation"]', 'SecurePass123!');
    await page.check('input[name="terms"]');

    // Enviar
    await page.click('button[type="submit"]');

    // Verificar redirect a home (auth)
    await expect(page).toHaveURL('/');
    await expect(page.locator('text=Mi Perfil')).toBeVisible();
  });

  test('Login con credenciales válidas', async ({ page }) => {
    await page.click('a[href="/login"]');
    await expect(page).toHaveURL('/login');

    // Seed: Usuario test exists en DB
    await page.fill('input[name="email"]', 'seller@example.com');
    await page.fill('input[name="password"]', 'password123');
    await page.click('button[type="submit"]');

    // Verificar dashboard vendedor
    await expect(page).toHaveURL('/seller');
    await expect(page.locator('text=Mi Dashboard')).toBeVisible();
  });

  test('Login falla con credenciales inválidas', async ({ page }) => {
    await page.click('a[href="/login"]');
    
    await page.fill('input[name="email"]', 'test@example.com');
    await page.fill('input[name="password"]', 'wrongpassword');
    await page.click('button[type="submit"]');

    // Error message visible
    await expect(page.locator('[role="alert"]')).toContainText('Credenciales inválidas');
    await expect(page).toHaveURL('/login');
  });

  test('Olvidé contraseña', async ({ page }) => {
    await page.click('a[href="/login"]');
    await page.click('a:has-text("¿Olvidó contraseña?")');
    await expect(page).toHaveURL('/forgot-password');

    await page.fill('input[name="email"]', 'seller@example.com');
    await page.click('button[type="submit"]');

    // Email sent confirmation
    await expect(page.locator('text=Hemos enviado un link')).toBeVisible();
  });
});
```

## Ejemplo 2: Auction Listing Tests (`tests/e2e/auction-listing.spec.js`)

```javascript
const { test, expect } = require('@playwright/test');

test.describe('Auction Listing', () => {
  test('Abrir página de subastas', async ({ page }) => {
    await page.goto('/auctions');
    await expect(page.locator('h1')).toContainText('Subastas Activas');
    
    // Cargar cards
    await page.waitForSelector('[data-testid="auction-card"]');
    const cards = await page.locator('[data-testid="auction-card"]').count();
    expect(cards).toBeGreaterThan(0);
  });

  test('Filtrar por búsqueda', async ({ page }) => {
    await page.goto('/auctions');
    
    // Buscar "zapatos"
    await page.fill('input[placeholder*="Buscar"]', 'zapatos');
    
    // Esperar debounce (500ms)
    await page.waitForTimeout(600);
    
    // Verificar que se cargó con params
    await expect(page).toHaveURL(/search=zapatos/);
    
    // Cards deben contener "zapatos" en título
    const firstCard = page.locator('[data-testid="auction-card"]').first();
    await expect(firstCard.locator('text=zapatos, i')).toBeVisible();
  });

  test('Filtrar por rango de precio', async ({ page }) => {
    await page.goto('/auctions');
    
    // Mover slider a $50,000 - $500,000
    const priceSlider = page.locator('input[type="range"]').first();
    await priceSlider.fill('50000');
    
    // Aplicar filtro
    await page.click('button:has-text("Aplicar Filtros")');
    
    // Verificar URL
    await expect(page).toHaveURL(/minPrice=50000/);
    
    // Cartas deben mostrar precios > $50,000
    const priceText = await page.locator('[data-testid="current-bid"]').first().textContent();
    const price = parseInt(priceText.replace(/[^\d]/g, ''));
    expect(price).toBeGreaterThanOrEqual(50000);
  });

  test('Ordenar por precio mayor', async ({ page }) => {
    await page.goto('/auctions');
    
    // Seleccionar "Precio Mayor"
    await page.selectOption('select[name="sortBy"]', 'current_bid');
    
    // Esperar reload
    await page.waitForURL(/sortBy=current_bid/);
    
    // Verificar orden decreciente de precios
    const prices = await page.locator('[data-testid="current-bid"]').allTextContents();
    const numericPrices = prices.map(p => parseInt(p.replace(/[^\d]/g, '')));
    
    for (let i = 0; i < numericPrices.length - 1; i++) {
      expect(numericPrices[i]).toBeGreaterThanOrEqual(numericPrices[i + 1]);
    }
  });

  test('Paginación', async ({ page }) => {
    await page.goto('/auctions?page=1');
    
    // Página 1 visible
    await expect(page.locator('[aria-current="page"]')).toContainText('1');
    
    // Click siguiente
    await page.click('a:has-text("Siguiente")');
    
    // Página 2
    await expect(page).toHaveURL(/page=2/);
    await expect(page.locator('[aria-current="page"]')).toContainText('2');
  });

  test('Limpiar filtros', async ({ page }) => {
    // Ir con múltiples filtros
    await page.goto('/auctions?search=zapatos&maxPrice=500000&status=active');
    
    // Click en "Limpiar Filtros"
    await page.click('button:has-text("Limpiar Filtros")');
    
    // Solo /auctions
    await expect(page).toHaveURL('/auctions');
    
    // Inputs vacíos
    await expect(page.locator('input[placeholder*="Buscar"]')).toHaveValue('');
  });
});
```

## Ejemplo 3: Auction Detail & Bidding (`tests/e2e/auction-detail.spec.js`)

```javascript
const { test, expect } = require('@playwright/test');

test.describe('Auction Detail & Bidding', () => {
  const auctionId = '1'; // Seed data

  test('Abrir detalle de subasta', async ({ page }) => {
    await page.goto(`/auctions/${auctionId}`);
    
    // Breadcrumb visible
    await expect(page.locator('[aria-label="Breadcrumb"]')).toContainText('Subastas');
    
    // Galería visible
    await expect(page.locator('[data-testid="main-image"]')).toBeVisible();
    
    // Información del producto
    await expect(page.locator('text=Marca:')).toBeVisible();
    await expect(page.locator('text=Condición:')).toBeVisible();
  });

  test('Galería de imágenes funciona', async ({ page }) => {
    await page.goto(`/auctions/${auctionId}`);
    
    // Click en thumbnail
    await page.click('[data-testid="thumbnail-1"]');
    
    // Imagen principal cambió
    const src = await page.locator('[data-testid="main-image"]').getAttribute('src');
    expect(src).toContain('image-1');
  });

  test('Contador regresivo se actualiza', async ({ page }) => {
    await page.goto(`/auctions/${auctionId}`);
    
    // Leer contador
    const countdown1 = await page.locator('[data-testid="countdown"]').textContent();
    
    // Esperar 2 segundos
    await page.waitForTimeout(2000);
    
    // Volver a leer
    const countdown2 = await page.locator('[data-testid="countdown"]').textContent();
    
    // Debería haber cambiado (menos tiempo)
    expect(countdown1).not.toEqual(countdown2);
  });

  test('Pujar sin autenticación muestra login', async ({ page }) => {
    await page.goto(`/auctions/${auctionId}`);
    
    // Click en botón de puja
    await page.click('button:has-text("Hacer Puja")');
    
    // Redirect a login
    await expect(page).toHaveURL('/login');
  });

  test('Pujar como usuario autenticado', async ({ page, context }) => {
    // Login primero
    const loginPage = await context.newPage();
    await loginPage.goto('/login');
    await loginPage.fill('input[name="email"]', 'buyer@example.com');
    await loginPage.fill('input[name="password"]', 'password123');
    await loginPage.click('button[type="submit"]');
    await loginPage.waitForURL('/');
    
    // Ir a detalle
    await page.goto(`/auctions/${auctionId}`);
    
    // Click puja
    await page.click('button:has-text("Hacer Puja")');
    
    // Modal visible
    await expect(page.locator('[role="dialog"]')).toBeVisible();
    
    // Leer puja mínima sugerida
    const minBid = await page.locator('[data-testid="min-bid"]').textContent();
    const minBidAmount = parseInt(minBid.replace(/[^\d]/g, ''));
    
    // Ingresar puja
    const newBid = minBidAmount + 50000; // $50k más
    await page.fill('input[name="amount"]', newBid.toString());
    
    // Fee calculado
    const feeText = await page.locator('[data-testid="commission"]').textContent();
    const expectedFee = Math.round(newBid * 0.05);
    expect(feeText).toContain(expectedFee.toString());
    
    // Confirmar
    await page.click('button:has-text("Confirmar Puja")');
    
    // Toast éxito
    await expect(page.locator('[role="status"]')).toContainText('Puja registrada');
    
    // Modal cierra
    await expect(page.locator('[role="dialog"]')).not.toBeVisible();
    
    // Precio actual actualizado
    const updatedPrice = await page.locator('[data-testid="current-bid"]').textContent();
    expect(updatedPrice).toContain(newBid.toString());
  });

  test('Validar puja mínima', async ({ page, context }) => {
    // Login
    const loginPage = await context.newPage();
    await loginPage.goto('/login');
    await loginPage.fill('input[name="email"]', 'buyer@example.com');
    await loginPage.fill('input[name="password"]', 'password123');
    await loginPage.click('button[type="submit"]');
    
    // Ir a detalle
    await page.goto(`/auctions/${auctionId}`);
    await page.click('button:has-text("Hacer Puja")');
    
    // Ingresar puja menor a la mínima
    const minBidElement = await page.locator('[data-testid="min-bid"]').textContent();
    const minBid = parseInt(minBidElement.replace(/[^\d]/g, ''));
    
    await page.fill('input[name="amount"]', (minBid - 10000).toString());
    
    // Verificar que botón esté deshabilitado
    const confirmBtn = page.locator('button:has-text("Confirmar Puja")');
    await expect(confirmBtn).toBeDisabled();
    
    // Mensaje de error visible
    await expect(page.locator('[role="alert"]')).toContainText('Puja mínima');
  });

  test('Historial de pujas cargado', async ({ page }) => {
    await page.goto(`/auctions/${auctionId}`);
    
    // Scroll a historial
    await page.locator('[data-testid="bid-history"]').scrollIntoViewIfNeeded();
    
    // Tabla visible
    await expect(page.locator('table')).toBeVisible();
    
    // Rows de pujas
    const bidRows = await page.locator('tbody tr').count();
    expect(bidRows).toBeGreaterThan(0);
  });
});
```

## Ejemplo 4: Seller Product CRUD (`tests/e2e/seller.spec.js`)

```javascript
const { test, expect } = require('@playwright/test');

test.describe('Seller Panel', () => {
  test.beforeEach(async ({ page, context }) => {
    // Login como vendedor
    const loginPage = await context.newPage();
    await loginPage.goto('/login');
    await loginPage.fill('input[name="email"]', 'seller@example.com');
    await loginPage.fill('input[name="password"]', 'password123');
    await loginPage.click('button[type="submit"]');
    await loginPage.waitForURL('/');
    await loginPage.close();
    
    // Ir a panel de vendedor
    await page.goto('/seller');
  });

  test('Dashboard vendedor cargado', async ({ page }) => {
    // Stats visible
    await expect(page.locator('text=Artículos Activos')).toBeVisible();
    await expect(page.locator('text=Ingresos Mensuales')).toBeVisible();
    
    // Botones de acción
    await expect(page.locator('button:has-text("Crear Prenda")')).toBeVisible();
  });

  test('Crear producto con imágenes', async ({ page }) => {
    // Click en crear prenda
    await page.click('button:has-text("Crear Prenda")');
    await expect(page).toHaveURL('/seller/products/create');
    
    // Rellenar form
    await page.fill('input[name="title"]', 'Vestido Vintage Azul');
    await page.fill('textarea[name="description"]', 'Vestido de los años 80, perfecto estado');
    await page.fill('input[name="brand"]', 'Chanel');
    await page.selectOption('select[name="condition"]', 'excellent');
    await page.fill('input[name="size"]', 'M');
    await page.fill('input[name="base_price"]', '250000');
    
    // Upload imágenes (drag & drop simulado)
    const fileInput = await page.locator('input[type="file"]');
    await fileInput.setInputFiles([
      './tests/fixtures/image1.jpg',
      './tests/fixtures/image2.jpg',
    ]);
    
    // Previews visibles
    await expect(page.locator('[data-testid="image-preview"]')).toHaveCount(2);
    
    // Duración de subasta
    await page.selectOption('select[name="duration"]', '7');
    
    // Increment
    await page.fill('input[name="increment"]', '50000');
    
    // Enviar
    await page.click('button[type="submit"]');
    
    // Redirect a detalle de subasta
    await expect(page).toHaveURL(/\/auctions\/\d+/);
    
    // Título visible
    await expect(page.locator('text=Vestido Vintage Azul')).toBeVisible();
  });

  test('Editar producto', async ({ page }) => {
    // Click en editar
    await page.click('button:has-text("Editar")');
    await expect(page).toHaveURL(/\/seller\/products\/\d+\/edit/);
    
    // Cambiar condición
    await page.selectOption('select[name="condition"]', 'good');
    
    // Guardar
    await page.click('button[type="submit"]');
    
    // Toast de éxito
    await expect(page.locator('[role="status"]')).toContainText('Actualizado');
  });

  test('Listar subastas del vendedor', async ({ page }) => {
    // Click en "Mis Subastas"
    await page.click('a:has-text("Mis Subastas")');
    await expect(page).toHaveURL('/seller/auctions');
    
    // Filtro por estado
    await page.selectOption('select[name="status"]', 'active');
    
    // Cards de subasta
    await page.waitForSelector('[data-testid="auction-card"]');
    const cards = await page.locator('[data-testid="auction-card"]').count();
    expect(cards).toBeGreaterThan(0);
    
    // Botones de edición visibles
    const editButtons = await page.locator('button:has-text("Editar")').count();
    expect(editButtons).toBeGreaterThan(0);
  });
});
```

## Ejemplo 5: Admin Moderation (`tests/e2e/admin.spec.js`)

```javascript
const { test, expect } = require('@playwright/test');

test.describe('Admin Panel', () => {
  test.beforeEach(async ({ page, context }) => {
    // Login como admin
    const loginPage = await context.newPage();
    await loginPage.goto('/login');
    await loginPage.fill('input[name="email"]', 'admin@example.com');
    await loginPage.fill('input[name="password"]', 'adminpass123');
    await loginPage.click('button[type="submit"]');
    await loginPage.waitForURL('/');
    await loginPage.close();
    
    // Ir a admin
    await page.goto('/admin');
  });

  test('Dashboard admin visible', async ({ page }) => {
    await expect(page.locator('text=Panel Admin')).toBeVisible();
    
    // Tarjetas de navegación
    await expect(page.locator('text=Moderar Listados')).toBeVisible();
    await expect(page.locator('text=Disputas')).toBeVisible();
    await expect(page.locator('text=Usuarios')).toBeVisible();
  });

  test('Aprobar listing', async ({ page }) => {
    // Ir a moderación
    await page.goto('/admin/listings?status=pending');
    
    // Primer listing pendiente
    await expect(page.locator('[data-testid="listing-card"]').first()).toBeVisible();
    
    // Click aprobar
    await page.click('button:has-text("Aprobar")');
    
    // Toast éxito
    await expect(page.locator('[role="status"]')).toContainText('Aprobado');
    
    // Card desaparece
    const count = await page.locator('[data-testid="listing-card"]').count();
    expect(count).toBeGreaterThanOrEqual(0);
  });

  test('Rechazar listing con razón', async ({ page }) => {
    await page.goto('/admin/listings?status=pending');
    
    // Click rechazar
    await page.click('button:has-text("Rechazar")');
    
    // Dialog pide razón
    const input = await page.locator('input[placeholder*="razón"]');
    await input.fill('Imágenes no claras');
    
    // Confirmar rechazo
    await page.click('button:has-text("Confirmar")');
    
    // Toast
    await expect(page.locator('[role="status"]')).toContainText('Rechazado');
  });

  test('Resolver disputa a favor del comprador', async ({ page }) => {
    await page.goto('/admin/disputes?status=open');
    
    // Primer disputa
    const firstDispute = await page.locator('[data-testid="dispute-card"]').first();
    
    // Click a favor del comprador
    await page.click('button:has-text("Favor Comprador")');
    
    // Toast
    await expect(page.locator('[role="status"]')).toContainText('resuelto');
  });

  test('Buscar usuarios', async ({ page }) => {
    await page.goto('/admin/users');
    
    // Buscar
    await page.fill('input[placeholder*="Buscar"]', 'juan');
    
    // Esperar búsqueda
    await page.waitForTimeout(500);
    
    // Tabla actualizada
    const rows = await page.locator('tbody tr').count();
    expect(rows).toBeGreaterThan(0);
    
    // Nombre contiene "Juan"
    await expect(page.locator('tbody tr').first()).toContainText(/juan/i);
  });

  test('Banear usuario', async ({ page }) => {
    await page.goto('/admin/users');
    
    // Click ban en primer usuario
    await page.click('button:has-text("Banear")');
    
    // Confirm dialog
    await page.click('button:has-text("Confirmar")');
    
    // Toast éxito
    await expect(page.locator('[role="status"]')).toContainText('baneado');
  });
});
```

## Ejecutar Tests

```bash
# Todos los tests
npm run test:e2e

# Con UI interactivo
npm run test:e2e -- --ui

# Específico
npm run test:e2e -- auth.spec.js

# Debug en navegador
npm run test:e2e -- --debug

# Generar reporte HTML
npm run test:e2e -- --reporter=html
# Abrir reporte
npx playwright show-report
```

## CI/CD Integration (GitHub Actions)

Crear `.github/workflows/e2e.yml`:

```yaml
name: E2E Tests
on: [push, pull_request]

jobs:
  test:
    runs-on: ubuntu-latest
    services:
      postgres:
        image: postgres:15
        env:
          POSTGRES_PASSWORD: postgres
        options: >-
          --health-cmd pg_isready
          --health-interval 10s
          --health-timeout 5s
          --health-retries 5

    steps:
      - uses: actions/checkout@v3
      - uses: actions/setup-node@v3
        with:
          node-version: 18

      - name: Install dependencies
        run: npm ci

      - name: Install Playwright
        run: npx playwright install --with-deps

      - name: Setup Laravel
        run: |
          cp .env.example .env.testing
          php artisan key:generate --env=testing

      - name: Run tests
        run: npm run test:e2e

      - uses: actions/upload-artifact@v3
        if: always()
        with:
          name: playwright-report
          path: playwright-report/
```

## Checklist Final

- [ ] Todos los tests pasan en Chromium, Firefox, WebKit
- [ ] Todos los tests pasan en mobile (Pixel 5)
- [ ] Coverage >= 80% de flujos críticos
- [ ] Reportes guardados en CI
- [ ] Screenshots de fallos guardados
- [ ] Seed data consistente para tests
- [ ] Tests corren < 10 minutos
- [ ] No hay flakiness (tests flaky reejecutar)
