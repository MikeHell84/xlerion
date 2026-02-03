# 📥 FILES TO DEPLOY - Download Links & Paths

## 🎯 Objetivo

Transferir los 3 archivos críticos a tu servidor de producción para fijar la crisis SEO de `/views`.

---

## 📁 LOCAL PATHS (en tu máquina)

Copiar ESTOS archivos desde tu workspace:

```
✅ PRIORITARIO (Deploy ahora):
1. x:\Programacion\XlerionWeb\xlerion-site\public\.htaccess
2. x:\Programacion\XlerionWeb\xlerion-site\public\robots.txt  
3. x:\Programacion\XlerionWeb\xlerion-site\index.html (o dist/index.html)

📚 OPCIONAL (Para referencia/documenación):
4. x:\Programacion\XlerionWeb\xlerion-site\public\SITEMAP_CLEANUP.txt
5. x:\Programacion\XlerionWeb\xlerion-site\DEPLOYMENT_CHECKLIST_SEO_FIX.md
6. x:\Programacion\XlerionWeb\xlerion-site\SEO_FIX_STATUS_20260114.md
```

---

## 🖥️ SERVER PATHS (en tu hosting)

Copiar A ESTOS locales en tu servidor:

```
✅ PRIORITARIO:
1. /.htaccess                    ← Replace existing
2. /robots.txt                   ← Replace existing
3. /index.html (o dist/)         ← Replace existing (si no está en dist)

📚 OPCIONAL:
4. /public/SITEMAP_CLEANUP.txt   ← Nueva referencia
5. / (root)                      ← Guías de documentación
```

**Nota**: Si tu hosting tiene carpeta `public` o `dist`, coloca los archivos ahí.  
Típicamente es uno de estos:

- `/public/` ← carpeta pública (htaccess, robots aquí)
- `/dist/` ← Vite build output
- `/` ← raíz del sitio

---

## 📋 DEPLOYMENT METHODS

### Opción 1: Via Panel de Control (cPanel/Plesk) - ⭐ MÁS FÁCIL

1. **Acceder a File Manager**
   - Login → cpanel.xlerion.com (o tu dominio)
   - File Manager → Go to Public HTML

2. **Subir .htaccess**
   - Upload → Selecciona: `xlerion-site\public\.htaccess`
   - Dejar en: `/public_html/` o `/`
   - Si ya existe → Replace

3. **Subir robots.txt**
   - Upload → Selecciona: `xlerion-site\public\robots.txt`
   - Dejar en: `/public_html/` o `/`
   - Si ya existe → Replace

4. **Subir index.html** (si es necesario)
   - Upload → Selecciona: `xlerion-site\index.html`
   - Dejar en: `/public_html/dist/` o `/public_html/`
   - Si ya existe → Replace

5. **Verificar permisos**
   - `.htaccess` debe tener permisos: 644
   - `robots.txt` debe tener permisos: 644
   - Right-click → Change Permissions

---

### Opción 2: Via FTP/SFTP - ⭐ MÁS RÁPIDO

```powershell
# En PowerShell (Windows)

# 1. Instalar módulo FTP si no lo tienes
# Install-Module -Name PSFtp

# 2. Conectar a servidor
$ftp = New-FTPConnection -ComputerName "xlerion.com" `
  -Credential (Get-Credential) -UseSSL

# 3. Subir archivos
Set-FTPFile -Path "C:\Users\...path...\public\.htaccess" `
  -RemotePath "/.htaccess" -FTPConnection $ftp

Set-FTPFile -Path "C:\Users\...path...\public\robots.txt" `
  -RemotePath "/robots.txt" -FTPConnection $ftp

Set-FTPFile -Path "C:\Users\...path...\index.html" `
  -RemotePath "/index.html" -FTPConnection $ftp
```

O usar cliente gráfico:

- **WinSCP** (recomendado)
- **FileZilla**
- **CyberDuck**

**Pasos con WinSCP**:

1. Abrir WinSCP
2. Login: xlerion.com + credenciales
3. Navegar a `/public_html/` o `/`
4. Drag-drop `.htaccess`, `robots.txt`, `index.html`

---

### Opción 3: Via SSH/Terminal - ⭐ SCRIPT AUTOMATION

```bash
# En terminal SSH de tu servidor

# 1. Conectar (desde tu máquina)
ssh user@xlerion.com

# 2. Navegar a la carpeta pública
cd /var/www/html
# o
cd /home/username/public_html

# 3. Hacer backup de archivos actuales
cp .htaccess .htaccess.backup.20260114
cp robots.txt robots.txt.backup.20260114
cp index.html index.html.backup.20260114

# 4. Descargar nuevos archivos desde tu almacenamiento
# (Necesitarías una URL pública o usar SCP)

# Alternativa: Copiar contenido y pegar
cat > .htaccess << 'EOF'
[pegar contenido del .htaccess aquí]
EOF

# 5. Verificar permisos
chmod 644 .htaccess
chmod 644 robots.txt
chmod 644 index.html

# 6. Verificar que está bien
head -20 .htaccess
head -20 robots.txt
```

---

## ✅ VERIFICATION AFTER UPLOAD

### Test 1: Redirect working

```powershell
curl -I https://xlerion.com/views
# Debe retornar: HTTP/1.1 301 Moved Permanently
```

### Test 2: Favicon se sirve

```powershell
curl -I https://xlerion.com/favicon.ico
# Debe retornar: HTTP/1.1 200 OK
```

### Test 3: robots.txt contiene bloques

```powershell
curl https://xlerion.com/robots.txt | grep -A 2 "BLOQUER"
# Debe mostrar: Disallow: /views/
```

### Test 4: Index.html tiene favicon refs

```powershell
curl https://xlerion.com/ | findstr /C:"rel=\"icon" /C:"rel=\"shortcut" /C:"rel=\"apple" /C:"rel=\"image_src"
# Debe mostrar 4 líneas diferentes
```

---

## 🚨 COMMON ERRORS & FIXES

| Error | Causa | Solución |
|-------|-------|----------|
| 403 Forbidden en .htaccess | Permisos incorrectos | `chmod 644 .htaccess` |
| 404 en favicon.ico | Archivo no existe | Subir `favicon.ico` a `public/` |
| /views sigue retornando 200 | mod_rewrite no habilitado | Contactar hosting + `a2enmod rewrite` |
| robots.txt retorna 404 | No está en raíz | Mover de `public/robots.txt` a `/robots.txt` |
| Redirect loop | .htaccess con error | Restaurar backup y revisar sintaxis |

---

## 📝 FILE CONTENTS AT A GLANCE

### `.htaccess` - Key sections

```apache
RewriteEngine On
RewriteBase /

# ⚠️ CORRECCIÓN CRÍTICA
RewriteCond %{REQUEST_URI} ^/views/
RewriteRule ^views/(.*)$ / [R=301,L]
RewriteRule ^views/?$ / [R=301,L]

# ... resto de rewrites normales ...
```

### `robots.txt` - Key sections

```
User-agent: *
Allow: /

# ⚠️ BLOQUER URLs ANTIGUAS
Disallow: /views/
Disallow: /views

Sitemap: https://xlerion.com/sitemap.xml
```

### `index.html` - Head section

```html
<head>
  <meta charset="UTF-8" />
  
  <!-- 🔧 FAVICON: Múltiples referencias para máxima compatibilidad -->
  <link rel="icon" type="image/x-icon" href="/favicon.ico" />
  <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
  <link rel="apple-touch-icon" href="/logo-512.png" />
  <link rel="image_src" href="/logo-1200x1200.png" />
  
  <!-- ... resto de meta tags ... -->
</head>
```

---

## 📅 TIMELINE

- **Now**: Descargar archivos de local
- **10 min**: Upload a servidor  
- **30 min**: Validar con curl/tests
- **1-3 days**: Ejecutar Google Search Console cleanup
- **1-2 weeks**: Google re-indexa y consolida

---

## ❓ FAQ

**Q: ¿Perderé ranking si hago redirect 301?**  
A: No, de hecho mejorará. Google consolida autoridad de URLs antiguas a nuevas con 301.

**Q: ¿Qué pasa si subo mal .htaccess?**  
A: Podrías ver error 500. Solución: Restaurar backup o eliminar archivo (vuelve a funcionar normalmente).

**Q: ¿Necesito cambiar el código de la aplicación?**  
A: No, estos cambios son SOLO servidor. React sigue funcionando igual.

**Q: ¿Cuándo veo los cambios en Google?**  
A: Redireccionamiento: inmediato. Index update: 1-2 semanas. Favicon: 3-5 días.

**Q: ¿Que pasa con visitantes antiguos que tenían link a /views?**  
A: Automáticamente redirigidos a `/`. Experiencia de usuario perfecta.

---

## 🎯 RESUMEN RÁPIDO

1. **Descarga** 3 archivos de tu workspace local
2. **Sube** a tu servidor (via panel, FTP, o SSH)
3. **Verifica** con `curl` que todo funciona
4. **Espera** 24-48h
5. **Limpia** en Google Search Console
6. **Monitorea** cobertura en GSC

**Tiempo total**: ~20 minutos (+ 1-2 semanas de espera de Google)

---

**Status**: 🟢 READY FOR UPLOAD  
**Criticidad**: 🔴 CRITICAL (fixa crisis de indexación)  
**Riesgo**: Bajo (solo redirecciones server-side)
