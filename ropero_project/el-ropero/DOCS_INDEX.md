# 📚 Índice de Documentación - El Ropero Mag&co

Guía completa de navegación de la documentación del proyecto.

## 🚀 Inicio Rápido

### Para Desarrolladores Nuevos

1. **[FRONTEND_README.md](./FRONTEND_README.md)** - **EMPEZAR AQUÍ**
   - Instalación y configuración
   - Estructura del proyecto
   - Comandos de desarrollo
   - API endpoints y ejemplos de respuesta
   - Checklist de despliegue

### Para Testing y QA

1. **[PLAYWRIGHT_TESTS.md](./PLAYWRIGHT_TESTS.md)**
   - Setup de Playwright con configuración completa
   - 5+ ejemplos de tests E2E (Auth, Listing, Detail, Seller, Admin)
   - CI/CD integration con GitHub Actions
   - Comandos de ejecución y debugging

2. **[ACCESSIBILITY_CHECKLIST.md](./ACCESSIBILITY_CHECKLIST.md)**
   - Checklist completo de WCAG 2.1 AA
   - Testing con herramientas automáticas (axe, Lighthouse, WAVE)
   - Testing manual con teclado y screen readers
   - Guías específicas por componente

## 📂 Estructura de Documentos

### 1. Documentación Principal

| Documento | Propósito | Audiencia |
|-----------|-----------|-----------|
| **FRONTEND_README.md** | Documentación central del frontend | Desarrolladores |
| **PLAYWRIGHT_TESTS.md** | Testing E2E completo | QA, Desarrolladores |
| **ACCESSIBILITY_CHECKLIST.md** | Cumplimiento de accesibilidad | QA, Diseñadores, Desarrolladores |

### 2. Stack Tecnológico

**Frontend:**

- Laravel Blade (templates)
- Tailwind CSS 3 (styling)
- Alpine.js 3.13.3 (interactividad)
- Vite 5 (build tool)
- Axios 1.6.4 (HTTP client)

**Testing:**

- Playwright (E2E)
- ESLint 8 (linting)

**Build:**

- PostCSS + Autoprefixer
- laravel-vite-plugin

## 🗺️ Mapa de Navegación

### Si quieres

#### ...configurar el entorno de desarrollo

→ **[FRONTEND_README.md](./FRONTEND_README.md)** - Sección "Instalación"

#### ...entender la estructura de carpetas

→ **[FRONTEND_README.md](./FRONTEND_README.md)** - Sección "Estructura del Proyecto"

#### ...crear nuevos tests E2E

→ **[PLAYWRIGHT_TESTS.md](./PLAYWRIGHT_TESTS.md)** - Ejemplos completos con fixtures

#### ...verificar accesibilidad

→ **[ACCESSIBILITY_CHECKLIST.md](./ACCESSIBILITY_CHECKLIST.md)** - Checklist completo con herramientas

#### ...saber qué endpoints consumir

→ **[FRONTEND_README.md](./FRONTEND_README.md)** - Sección "Integración con Backend"

#### ...desplegar a producción

→ **[FRONTEND_README.md](./FRONTEND_README.md)** - Sección "Checklist de Despliegue"

#### ...entender decisiones de arquitectura

→ **[FRONTEND_README.md](./FRONTEND_README.md)** - Sección "Decisiones de Diseño"

## 📋 Checklists Rápidos

### Pre-commit

- [ ] `npm run lint:fix` pasa sin errores
- [ ] Tests E2E críticos pasan localmente
- [ ] No hay console.log en producción

### Pre-deploy

- [ ] `npm run build` genera assets sin errores
- [ ] Tests E2E completos pasan
- [ ] Lighthouse score >= 90 en Accessibility
- [ ] axe DevTools sin errores críticos
- [ ] Verificado en Chromium, Firefox, Safari
- [ ] Verificado en mobile (Pixel 5 o similar)

### Pre-release

- [ ] Toda la documentación actualizada
- [ ] Changelog con cambios importantes
- [ ] Variables de entorno documentadas
- [ ] Migraciones probadas en staging
- [ ] Backups de DB configurados

## 🔧 Comandos Útiles (Quick Reference)

```bash
# Desarrollo
npm run dev              # Vite dev server (HMR)
php artisan serve        # Laravel dev server

# Build
npm run build            # Compilar para producción
npm run preview          # Preview de build local

# Linting
npm run lint             # Ver errores de ESLint
npm run lint:fix         # Autofix

# Testing
npx playwright test              # Todos los tests E2E
npx playwright test --ui         # UI interactivo
npx playwright test --debug      # Modo debug
npx playwright show-report       # Ver último reporte

# Laravel
php artisan view:cache           # Cachear Blade templates
php artisan config:cache         # Cachear config
php artisan route:cache          # Cachear rutas
php artisan migrate --force      # Migraciones en producción
```

## 🎯 Flujos de Trabajo

### Flujo de Desarrollo Normal

1. Pull latest de `main`
2. Crear branch feature: `git checkout -b feature/nueva-funcionalidad`
3. Desarrollar localmente con `npm run dev`
4. Ejecutar `npm run lint:fix`
5. Ejecutar tests E2E relacionados: `npx playwright test tests/e2e/nombre.spec.js`
6. Commit con mensaje descriptivo
7. Push y crear Pull Request
8. CI ejecuta tests automáticamente
9. Code review
10. Merge a `main`

### Flujo de Bug Fix

1. Reproducir bug localmente
2. Crear test E2E que falle (reproduce el bug)
3. Implementar fix
4. Verificar que test ahora pase
5. Ejecutar suite completa de tests
6. Commit + PR

### Flujo de Deployment

1. Verificar que `main` está estable (CI green)
2. Tag de versión: `git tag v1.0.0`
3. Push tag: `git push origin v1.0.0`
4. CI construye assets y genera release
5. Deploy manual a staging
6. QA en staging (tests E2E + accesibilidad)
7. Deploy a producción
8. Smoke tests en producción

## 📞 Contacto y Recursos

### Soporte Interno

- **Lead Developer**: [nombre]
- **QA Lead**: [nombre]
- **DevOps**: [nombre]

### Recursos Externos

- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [Alpine.js Docs](https://alpinejs.dev/start-here)
- [Playwright Docs](https://playwright.dev/)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)
- [Laravel Blade Docs](https://laravel.com/docs/blade)

### Comunidad

- GitHub Issues: [repositorio]/issues
- Slack: #el-ropero-dev
- Wiki: [wiki-url]

## 📝 Convenciones

### Commits

Usar [Conventional Commits](https://www.conventionalcommits.org/):

- `feat: agregar filtro por marca en listado`
- `fix: corregir cálculo de puja mínima`
- `docs: actualizar README con nuevos endpoints`
- `test: agregar test E2E para checkout`
- `refactor: extraer lógica de polling a store`
- `style: formatear código con Prettier`

### Branches

- `main` - Producción
- `develop` - Desarrollo activo
- `feature/*` - Nuevas funcionalidades
- `fix/*` - Bug fixes
- `hotfix/*` - Fixes urgentes de producción

### Pull Requests

Template incluye:

- Descripción del cambio
- Screenshots (si aplica)
- Tests agregados/modificados
- Checklist de accesibilidad (si aplica)
- Breaking changes (si aplica)

## 🔄 Proceso de Actualización de Docs

Cuando actualices documentación:

1. Verificar que todos los links internos funcionen
2. Actualizar fecha de "Última actualización"
3. Agregar entrada en changelog si es cambio mayor
4. Notificar al equipo en Slack #el-ropero-dev

---

**Última actualización:** 2026-01-31  
**Versión del proyecto:** 1.0.0-beta  
**Mantenido por:** Equipo El Ropero Mag&co
