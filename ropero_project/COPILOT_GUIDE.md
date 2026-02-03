**Project Overview**

- **Purpose:** Breve guía para que GitHub Copilot (o un agente similar) trabaje en este repositorio `X:/Programacion/XlerionWeb`.
- **Scope:** Frontend estático en `ropero_project/el-ropero/public`, backend Laravel en `ropero_project/backend/laravel`.

**Quick Start**

- **Backend (Laravel):**
  - Path: `ropero_project/backend/laravel`
  - Start dev server (PowerShell):

    ```powershell
    & 'X:\Programacion\XlerionWeb\ropero_project\backend\laravel\scripts\run-artisan-service.ps1'
    # or for a clean restart:
    & 'X:\Programacion\XlerionWeb\ropero_project\backend\laravel\scripts\restart-backend-now.ps1'
    ```

  - Health check: `http://127.0.0.1:8000` (debe devolver la página de bienvenida)
  - DB: SQLite at `database/database.sqlite`
  - Env: revisa `.env` para `MAIL_MAILER=log` y `QUEUE_CONNECTION=sync` en dev

- **Frontend (static):**
  - Path: `ropero_project/el-ropero/public`
  - Start static server (PowerShell):

    ```powershell
    Push-Location 'X:\Programacion\XlerionWeb\ropero_project\el-ropero\public'
    python -m http.server 5174
    Pop-Location
    ```

  - Open: `http://127.0.0.1:5174/`

**Auth & Tokens**

- Auth endpoints live in `routes/api.php` and `app/Http/Controllers/AuthController.php`.
- API tokens use Laravel Sanctum (personal access tokens). Returned token format is `id|plain` — pass entire string as `Authorization: Bearer <token>`.
- Debug routes (temporary): `/api/debug-headers`, `/api/debug-verify-token` — useful para ver encabezados y verificar tokens (quitar cuando no se necesiten).

**Common Scripts**

- `run-artisan-service.ps1`: wrapper que mantiene `php artisan serve` en loop y loguea.
- `restart-backend-now.ps1`: detiene procesos `php.exe` duplicados y arranca el wrapper.
- `api-test-now.ps1`: secuencia automatizada que hace register → login → GET /api/user y muestra resultados.
- `test-get-user.ps1`: llamada simple a `/api/user` con token.
- `list_tokens.php`: inspecciona `personal_access_tokens` en SQLite.

**CORS / Credentials**

- `config/cors.php` default in this workspace: `allowed_origins` = `['*']`, `supports_credentials` = `false`.
- Nota: No usar `credentials: 'include'` desde el frontend si `allowed_origins` = `*`. Para usar cookies/sessions: setear `supports_credentials => true` y especificar orígenes concretos.

**Debugging Checklist**

- If frontend requests fail:
  - Reproduce request in PowerShell `Invoke-RestMethod` to separate browser CORS issues from backend problems.
  - Check `storage/logs/laravel.log` for exceptions.
  - Verify `personal_access_tokens` table using `scripts/list_tokens.php`.
- If `/api/user` devuelve 401:
  - Call `/api/debug-verify-token` with the Bearer token to confirm `PersonalAccessToken::findToken()` finds a row.
  - Confirm `auth` middleware mapping in `app/Http/Kernel.php` uses `\Illuminate\Auth\Middleware\Authenticate::class` (so `auth:sanctum` works).

**Conventions & Notes for Copilot**

- Be surgical: make minimal, focused edits consistent with existing style.
- Avoid changing large configs (like `vite.config.js` or linting presets) unless performance/security issue is proven.
- When adding routes or pages:
  - Frontend pages go in `ropero_project/el-ropero/public` (static) or `xlerion-site/src/pages/` for the React site.
  - Backend API routes: `routes/api.php` and controllers in `app/Http/Controllers/`.
- Three.js components in `xlerion-site` must follow disposal patterns in `media/ANIMACIONES_3D.md`.

**Testing & Verification**

- Use `api-test-now.ps1` for quick token-based auth smoke tests.
- Use browser DevTools (Network/Console) when debugging frontend behavior.
- Tailor tests to avoid throttle middleware (login route has `throttle:5,1`). Use registration token or clear cache (`php artisan cache:clear`) between attempts.

**Cleanup**

- Remove temporary debug routes when bug is resolved:
  - `routes/api.php` entries for `/api/debug-headers` and `/api/debug-verify-token`.
- Consider converting long-running wrapper to a scheduled task or NSSM service if you need it to survive reboots.

**Where to look for important files**

- Backend root: `ropero_project/backend/laravel`
  - Main controller: `app/Http/Controllers/AuthController.php`
  - Kernel: `app/Http/Kernel.php`
  - Env: `.env`
  - Scripts: `scripts/*.ps1`, `scripts/*.php`
- Frontend static: `ropero_project/el-ropero/public`
  - Auth logic: `auth.js`
  - Index: `index.html`

**If you need help**

- When opening an issue or asking for changes, include:
  - Exact failing request (method, URL, headers, body)
  - Error messages from browser console and `storage/logs/laravel.log`
  - Steps you executed to reproduce

---
_File generado automáticamente: `COPILOT_GUIDE.md` — Úsalo como referencia para aportes y debugging._
