Sync media files from `media/` into web-ready `public/assets/` folders.

Usage:

1. Install dependencies (if not already):

```powershell
npm install
```

2. Run the sync script:

```powershell
npm run sync-media
```

What it does:

- Copies `media/` → `public/assets/media`
- Copies `media/images/` → `public/assets/images/`
- Copies `media/fonts/` → `public/assets/fonts/`
- Copies `media/icons/` → `public/assets/icons/`

Notes:

- Existing files will be overwritten in the destination.
- The script preserves subfolder structure (e.g., `media/images/parallax/`).
- After running, reference assets from `public/assets/` for production builds or static hosting.
