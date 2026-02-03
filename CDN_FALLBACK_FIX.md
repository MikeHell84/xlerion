# Total Darkness - External CDN Dependency Fix

## Issue

The Total Darkness subsite was failing on the production server due to a blocked or unreachable external CDN resource: **vis-network** library (used for the mind map visualization feature).

### Root Cause

The original `index.html` had hardcoded CDN links that might not be accessible from your hosting environment due to:

- Network restrictions or firewalls
- CORS policy blocks
- CDN outages or regional availability issues
- Hosting provider security policies

## Solution Implemented

### 1. Added Local Vendor System

A new `vendor/` folder has been created in both:

- `xlerion-site/public/total-darkness/vendor/`
- `xlerion-site/dist/total-darkness/vendor/`

### 2. Fallback Loading Mechanism

Updated both `index.html` files to use a smart loader that:

1. **First attempts** to load `vis-network.min.js` and `vis-network.min.css` from the local `vendor/` folder
2. **Falls back** to the CDN if local files are missing
3. **Logs progress** to browser console for debugging

### 3. Provided Placeholder Files

- `vendor/vis-network.min.js` - A stub that prevents runtime crashes (console warning included)
- `vendor/vis-network.min.css` - Minimal CSS for layout (non-functional visualization)
- `vendor/README.txt` - Instructions for obtaining the real files

## Next Steps to Fix Mind Map Feature

To restore full mind map visualization functionality, replace the stub files with the **real vis-network library**:

### Option A: Download from CDN (Recommended)

```powershell
# Download the JavaScript file
curl -o "xlerion-site\public\total-darkness\vendor\vis-network.min.js" `
     "https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"

# Download the CSS file
curl -o "xlerion-site\public\total-darkness\vendor\vis-network.min.css" `
     "https://unpkg.com/vis-network/styles/vis-network.min.css"

# After testing locally, copy to dist/ as well
Copy-Item "xlerion-site\public\total-darkness\vendor\*" `
          "xlerion-site\dist\total-darkness\vendor\" -Force
```

### Option B: Manual Download

1. Visit: <https://unpkg.com/vis-network/standalone/umd/vis-network.min.js>
2. Save as: `xlerion-site/public/total-darkness/vendor/vis-network.min.js`
3. Visit: <https://unpkg.com/vis-network/styles/vis-network.min.css>
4. Save as: `xlerion-site/public/total-darkness/vendor/vis-network.min.css`
5. Copy both files to `xlerion-site/dist/total-darkness/vendor/`

### Option C: npm Installation (if building locally)

```powershell
# Install vis-network package
npm install vis-network

# Copy the UMD build to vendor folder
Copy-Item "node_modules\vis-network\standalone\umd\vis-network.min.js" `
          "xlerion-site\public\total-darkness\vendor\"
Copy-Item "node_modules\vis-network\styles\vis-network.min.css" `
          "xlerion-site\public\total-darkness\vendor\"
```

## Testing After Fix

1. **Locally** (before rebuilding):

   ```powershell
   # Start the dev server
   cd xlerion-site
   npm run dev
   
   # Navigate to http://localhost:5173/total-darkness/historia.html
   # Check DevTools console for: "vis-network: loaded local vendor file"
   ```

2. **After rebuild**:

   ```powershell
   # Rebuild the production bundle
   npm run build
   
   # Test from dist/total-darkness/index.html or historia.html
   ```

3. **On production** after upload:
   - Open Total Darkness in browser
   - Check DevTools Network tab for vis-network requests (should show 200 OK or 304 cached)
   - Check Console for success message: `"vis-network: loaded local vendor file"`
   - Try using a mind map feature to confirm visualization loads

## Files Modified

- ✅ `xlerion-site/public/total-darkness/index.html` - Updated with fallback loader
- ✅ `xlerion-site/dist/total-darkness/index.html` - Updated with fallback loader
- ✅ Created `vendor/` directories with placeholder files and README

## What This Doesn't Fix

The current stub implementation will NOT:

- Display interactive mind maps (visual feature disabled)
- Handle network graph interactions
- Render node/edge connections

These features will only work after you replace the stub files with the **real vis-network library** from unpkg or npm.

## Additional Notes

- The fallback system is **non-blocking**: even if both local and CDN fail, the rest of the site continues to work
- No other functionality is affected; only the mind map visualization is affected
- The change is **backwards compatible**: if vis-network is already available (via cache or CDN), it will be used

## See Also

- `vendor/README.txt` - Detailed vendor folder instructions
- vis-network documentation: <https://visjs.github.io/vis-network/>
- vis-network npm package: <https://www.npmjs.com/package/vis-network>

---

**Status**: Temporary fix in place (stub prevents crashes). Real library installation needed for full functionality.
