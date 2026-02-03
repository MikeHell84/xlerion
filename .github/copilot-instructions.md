# AI Agent Instructions for XlerionWeb

Purpose: a compact, actionable reference for AI coding agents to be productive in this repo.

## Quick start (local dev)

- **Start frontend**: `cd xlerion-site` → `npm ci` → `npm run dev` (Vite dev server, default http://localhost:5173).
- **Test PHP endpoints** (local): `cd xlerion-site/public` →
```powershell
php -S localhost:8080 router.php
```
Use `router.php` (adds CORS + correct routing for `/api/*`).

## Primary areas & architecture (big picture)

- `xlerion-site/`: React SPA (React 19 + Vite). Main pieces: `src/components`, `src/pages`, `src/context/LanguageContext.jsx` (central i18n), `public/` (static PHP endpoints + legacy static sites).
- `media/`: design tokens, color system and canonical content (`EstiloWeb.md`, `contenidoWeb.md`). Treat as source-of-truth for styles and copy.
- `public/redemthor/`: static site (vanilla JS + `js/translations.js`) served alongside the SPA via Vite plugin `serve-redemthor-static`.
- `total-darkness/` (under `public/`): PHP admin panel (SQLite DB at `public/total-darkness/data/admins.db`).

## Critical workflows & commands

- Frontend development: `npm run dev` from `xlerion-site/` (hot reload). Install with `npm ci`. Use PowerShell on Windows.
- Lint & format: `npm run lint`, `npm run lint:fix`, `npm run format` (see `xlerion-site/package.json`).
- Build & deploy: `cd xlerion-site` → `npm run build` → `.\deploy.ps1 -Environment "produccion"` (PowerShell script in `xlerion-site/`). The deploy script enforces clean git state and runs lint/build.
- PHP local test: `php -S localhost:8080 router.php` from `xlerion-site/public` (MUST use `router.php` for correct CORS headers).

## Project-specific conventions (do not change without care)

- **i18n**: All visible text should use translation keys via `LanguageContext.jsx` and `useLanguage().t(key)`. Example: `t("mision_page_title")` in components. If a raw string appears, add the key to both ES/EN in `LanguageContext.jsx`.
- **Three.js cleanup**: All three.js components MUST dispose of geometry, materials, textures, and the renderer in the `useEffect` cleanup. See `xlerion-site/src/pages/App.jsx` and `ThreeJSIntersection.jsx` for pattern:
```jsx
return () => {
  geometry?.dispose();
  material?.dispose();
  renderer?.dispose();
  containerRef.current?.removeChild(renderer.domElement);
}
```
- **Vite chunking**: `vite.config.js` contains manual chunk splits (e.g., `'react-vendor'`, `'three-vendor'`). Avoid changing chunking without performance data.
- **Linting**: Repo uses an ESLint flat config (`xlerion-site/eslint.config.js`). Run `npm run lint` before creating PRs.

## Integration points & external deps

- **Contact form**: frontend `xlerion-site/src/components/ContactForm.jsx` → backend PHP `xlerion-site/public/api/send-email.php` → routed by `router.php`. Ensure server has `mail()` configured or switch to SMTP.
- **Static site integration**: `/redemthor` is served as static files under `public/redemthor/`. Translation keys also exist in `public/redemthor/js/translations.js` (sync keys with `LanguageContext.jsx`).
- **Admin panel**: `public/total-darkness/` is a PHP panel that uses `admins.db` (SQLite). Be careful editing DB schema or auth flows.

## Files you should inspect first

- `xlerion-site/src/context/LanguageContext.jsx` — i18n master file (large).
- `xlerion-site/vite.config.js` — build & plugin config (manualChunks + `serve-redemthor-static`).
- `xlerion-site/public/router.php` — PHP router used for local testing and CORS behavior.
- `xlerion-site/public/api/send-email.php` — contact form backend.
- `media/EstiloWeb.md` — design tokens and colors (source of truth).

## AI agent rules / do's and don'ts (repo-specific)

- Do: Preserve translation keys and add new keys to both Spanish & English in `LanguageContext.jsx` when adding text.
- Do: Follow Three.js disposal pattern in all React components that create WebGL resources.
- Do: Avoid modifying `vite.config.js` chunking or `manualChunks` without benchmark data.
- Don't: Replace `router.php` with `php -S` default routing — always use the provided `router.php` when testing PHP endpoints locally.
- Don't: Edit `public/redemthor/js/translations.js` without syncing keys to `LanguageContext.jsx`.

## Example quick tasks for an AI agent

- Add a new page: create `xlerion-site/src/pages/NewPage.jsx`, add translation keys to `LanguageContext.jsx`, register a route in `xlerion-site/src/main.jsx`, run `npm run lint:fix`.
- Fix memory leak: search for three.js usage and ensure a `useEffect` cleanup disposes `geometry`, `material`, `texture`, and `renderer`.

If anything is unclear or you want the file expanded with checklists for PR authors, tell me which sections to expand (build, deploy, three.js tests, or i18n syncing) and I will iterate.
# Xlerion Web - AI Coding Agent Instructions

## Project Overview

**Xlerion** is a Colombian tech company creating modular solutions for creative engineering. This monorepo contains:

## Monorepo Structure

```
XlerionWeb/
├── media/                    # Design system & content (source of truth)
│   ├── EstiloWeb.md         # Colors, fonts, breakpoints, design tokens
│   ├── ANIMACIONES_3D.md    # Three.js disposal patterns & GSAP mappings
│   └── contenidoWeb.md      # Content guidelines
├── xlerion-site/            # React SPA (React 19 + Vite 7 + Tailwind 3)
│   ├── src/
│   │   ├── App.jsx          # Landing page with Three.js initialization
│   │   ├── main.jsx         # Router (41 routes), VideoIntro conditional render
│   │   ├── components/      # 8 components (animations, forms, layout)
│   │   ├── pages/           # 41 route pages (services, projects, docs, etc.)
│   │   ├── context/
│   │   │   └── LanguageContext.jsx  # i18n (1851 lines, ES/EN)
│   │   ├── assets/          # Images, SVGs
│   │   └── index.css        # Global styles + Tailwind directives
│   ├── public/
│   │   ├── api/send-email.php       # Contact form backend (PHP mail)
│   │   ├── router.php               # CORS proxy + routing (local dev)
│   │   ├── redemthor/               # Static HTML site (SEO, i18n, responsive)
│   │   │   ├── js/translations.js   # Vanilla i18n (519 lines, 200+ keys)
│   │   │   ├── js/app.js            # Main app logic
│   │   │   └── css/styles.css       # Styling (no framework)
│   │   ├── total-darkness/          # PHP admin panel (SQLite auth)
│   │   │   ├── api/auth.php         # Login/user management
│   │   │   ├── data/admins.db       # SQLite database
│   │   │   └── dashboard.html       # UI (vanilla JS)
│   │   └── (assets, robots.txt, sitemap.xml, etc.)
│   ├── vite.config.js               # React + Redemthor static serving plugin
│   ├── tailwind.config.cjs          # Colors (primary: #00e9fa, secondary: #333436)
│   ├── eslint.config.js             # Flat config (ESLint 9+)
│   ├── package.json                 # React 19, Three.js, React Router, Lucide
│   └── deploy.ps1                   # PowerShell deploy automation
```

## Critical Developer Workflows

### Development Server (PowerShell)

```powershell
cd X:\Programacion\XlerionWeb\xlerion-site
npm install
npm run dev    # Vite dev server → http://localhost:5173
```

**Important**: Vite plugin `serve-redemthor-static` (in `vite.config.js`) rewrites `/redemthor` → `/redemthor/index.html` to serve static HTML correctly.

### Testing PHP Endpoints Locally

```powershell
cd xlerion-site\public
php -S localhost:8080 router.php  # MUST use router.php for CORS headers
```

### Build & Deploy (PowerShell)

```powershell
cd xlerion-site
npm run lint      # ESLint (flat config: eslint.config.js)
npm run build     # Vite build → dist/
.\deploy.ps1 -Environment "produccion"  # Full validation pipeline
```

Deploy script validation steps:

1. Clean git status (no uncommitted changes)
2. On `main` branch
3. Installs dependencies with `npm ci`
4. Runs linting
5. Builds and creates timestamped backup

## Project-Specific Conventions

### 1. Three.js Memory Management (CRITICAL)

**All Three.js components MUST dispose resources in cleanup** to prevent memory leaks. Pattern from `App.jsx` and `ThreeJSIntersection.jsx`:

```jsx
useEffect(() => {
  // Setup scene, geometry, material, renderer
  return () => {
    geometry?.dispose();
    material?.dispose();
    renderer?.dispose();
    // Dispose textures if used
    containerRef.current?.removeChild(renderer.domElement);
  };
}, []);
```

Incomplete disposal causes cumulative memory waste and performance degradation.

### 2. Internationalization (i18n) - LanguageContext

**All visible text uses translation keys** from `xlerion-site/src/context/LanguageContext.jsx` (1984 lines):

```jsx
// Usage in components
const { t } = useLanguage();
return <h1>{t("mision_page_title")}</h1>;
```

**Key rules:**

### 3. Routing Convention (41 routes)

Add new pages to `xlerion-site/src/pages/`, then register in `xlerion-site/src/main.jsx`:

```jsx
import NewPage from "./pages/NewPage.jsx";
// In <Routes>:
<Route path="/new-path" element={<NewPage />} />;
```

**VideoIntro conditional render:**

### 4. Design System (media/EstiloWeb.md source of truth)

- Primary: `#00e9fa` (cyan, used in buttons, accents)
- Secondary: `#333436` (dark gray)
- Background: `#000000` (black)
- Text: `#FFFFFF` (white)

### 5. Build Optimization (vite.config.js)

**Manual chunk splitting** (do not change without performance data):

```js
manualChunks: {
  'react-vendor': ['react', 'react-dom', 'react-router-dom'],
  'three-vendor': ['three'],
  'ui-vendor': ['lucide-react'],
}
```

Asset organization pattern:

Configuration:

### 6. Linting & Code Quality (eslint.config.js)

## Integration Points

### Contact Form Flow

Frontend → Backend chain:

1. Component: `xlerion-site/src/components/ContactForm.jsx` (React with validation)
2. Backend: `xlerion-site/public/api/send-email.php` (PHP `mail()` or SMTP)
3. Routing: Request goes through `router.php` → `/api/send-email.php`
4. **Deployment**: Server must have `mail()` configured or SMTP env vars set

### Total Darkness Admin Panel

### Redemthor Static Site

- Pattern: `<element data-i18n="translation_key">Default Text</element>`
- Implementation: `js/translations.js` (519 lines, 200+ keys, ES/EN)
- Language toggle: Client-side via lang switcher (localStorage storage)

## Quick Reference - Key Files

**Large context files (understand these deeply):**

**Configuration & Build:**

**Backend & Routing:**

**Static Sites:**

**Documentation:**

## Conservative Defaults (when unsure)

## Development Environment Setup

The repository has a Python virtual environment (`.venv`) at the root:

```powershell
# Activate (PowerShell)
. X:/Programacion/XlerionWeb/.venv/Scripts/Activate.ps1

# Deactivate
deactivate
```

This is separate from the Node.js environment in `xlerion-site/`. Used for Python-based build utilities if present.

## Known Patterns in 41 Routes

Routes are organized by domain:

When adding a new route, place the page in the appropriate directory inside `src/pages/` and ensure translations exist for page title, breadcrumbs, and content.

## npm Scripts Overview

| Command            | Purpose                                    |
| ------------------ | ------------------------------------------ |
| `npm run dev`      | Start Vite dev server with HMR             |
| `npm run build`    | Build for production (optimized, minified) |
| `npm run preview`  | Preview production build locally           |
| `npm run lint`     | Run ESLint checks (flat config)            |
| `npm run lint:fix` | Auto-fix linting issues                    |
| `npm run format`   | Format code with Prettier                  |

## Common Development Tasks

### Adding a New Page

1. Create `src/pages/NewFeaturePage.jsx`
2. Add translations to both `es` and `en` in `LanguageContext.jsx`:
   ```jsx
   new_feature_page_title: 'New Feature',
   new_feature_page_subtitle: '// Subtitle',
   ```
3. Register route in `src/main.jsx` in appropriate section
4. Add breadcrumb navigation using `t()` hook
5. Run `npm run lint:fix` before committing

### Modifying Three.js Scenes

1. Always follow disposal pattern in `useEffect` cleanup
2. Reference `ThreeJSIntersection.jsx` for adaptive quality/fallback patterns
3. Test in browser DevTools memory profiler to verify no leaks
4. Document performance thresholds if using quality adaptation

### Debugging i18n Issues

1. Check both `es` and `en` objects in `LanguageContext.jsx`
2. Search codebase for all `t("key_name")` usages with grep
3. If raw key appears, translation is missing—add to BOTH language objects
4. Redemthor uses separate `translations.js`; sync keys between both i18n systems

### Deploying to Production

1. Ensure all changes committed and pushed
2. Run `npm run lint:fix` and `npm run build` locally
3. Verify build output in `dist/` folder
4. Run `.\deploy.ps1 -Environment "produccion"` from `xlerion-site/` directory
5. Script will validate git status, branch, dependencies, and run linting
