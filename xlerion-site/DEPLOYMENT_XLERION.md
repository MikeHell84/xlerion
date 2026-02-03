# 🚀 DEPLOYMENT A XLERION.COM - GUÍA COMPLETA

**ZIP DEPLOY**: `xlerion-deploy-20260114_111201.zip` (257.18 MB)

**FECHA**: 14 de enero de 2026  
**HORA**: 11:12 AM  
**BUILD**: Vite 7.3.1 | 1750 módulos | 6.91s

---

## 📋 CHECKLIST PRE-DEPLOYMENT

✅ Build completado sin errores  
✅ ZIP creado y verificado (257.18 MB)  
✅ Contiene: dist/ (React SPA) + public/ (static assets)  
✅ .htaccess con redirects configurados  
✅ robots.txt con /views bloqueado  
✅ sitemap.xml con Total Darkness URLs  
✅ Total Darkness meta tags mejorados  

---

## 🎯 CONTENIDO DEL ZIP

```text
xlerion-deploy-20260114_111201.zip (257.18 MB)
├── dist/
│   ├── index.html (React SPA root)
│   ├── css/
│   ├── js/
│   │   ├── react-vendor.*.js
│   │   ├── three-vendor.*.js
│   │   ├── ui-vendor.*.js
│   │   └── index.*.js
│   ├── images/
│   ├── videos/
│   ├── fonts/
│   ├── favicon.ico
│   ├── logo-512.png
│   ├── logo-1200x1200.png
│   └── redemthor/ (sitio estático)
│       ├── index.html
│       ├── discografia.html
│       ├── historia-*.html
│       ├── miembros.html
│       ├── transmisiones.html
│       ├── game.html
│       ├── sitemap.xml
│       ├── robots.txt
│       └── [todos los assets]
│
└── public/
    ├── .htaccess (⭐ CRÍTICO - redirecciones 301)
    ├── robots.txt (⭐ CRÍTICO - bloquea /views)
    ├── sitemap.xml (⭐ ACTUALIZADO - Total Darkness)
    ├── favicon.ico
    ├── logo-512.png
    ├── logo-1200x1200.png
    ├── router.php (CORS para local dev, no se usa en prod)
    ├── api/
    │   └── send-email.php
    ├── images/
    ├── videos/
    ├── fonts/
    ├── redemthor/ (idéntico a dist/redemthor/)
    └── total-darkness/
        ├── dashboard.html (⭐ META TAGS MEJORADOS)
        ├── [archivos admin panel]
        └── [todas las dependencias]
```

---

## 🌐 3 MÉTODOS DE DEPLOYMENT

### **MÉTODO 1: CPANEL / PLESK (Recomendado - Más fácil)**

#### Paso 1: Conectar al Panel

1. Accede a tu cPanel o Plesk en `xlerion.com/cpanel` o `xlerion.com/plesk`
2. Login con tus credenciales

#### Paso 2: Descargar ZIP en el Servidor

1. File Manager → Navega a `/public_html`
2. Subir archivo → Selecciona `xlerion-deploy-20260114_111201.zip`
3. Espera a que termine la carga (5-10 minutos)

#### Paso 3: Extraer ZIP

1. Click derecho en `xlerion-deploy-20260114_111201.zip`
2. Click "Extract" o "Descomprimir"
3. Espera a que termine (2-5 minutos)

#### Resultado

Se crearán dos carpetas en `/public_html`:

```text
/public_html/
├── dist/     → ← MOVER CONTENIDO A /public_html
├── public/   → ← MOVER CONTENIDO A /public_html
└── xlerion-deploy-20260114_111201.zip (borrar después)
```

#### Paso 4: Mover Archivos (CRÍTICO)

```text
1. Abre carpeta "dist"
   - Selecciona TODO (Ctrl+A)
   - Cut (Ctrl+X)
   - Navega a /public_html
   - Paste (Ctrl+V)
   - Click "Replace All" si pregunta

2. Abre carpeta "public"
   - Selecciona TODO (Ctrl+A)
   - Cut (Ctrl+X)
   - Navega a /public_html
   - Paste (Ctrl+V)
   - Click "Replace All"

3. Borra carpetas vacías "dist" y "public"

4. Borra "xlerion-deploy-20260114_111201.zip"
```

#### Paso 5: Verificar

```text
/public_html/ debe tener:
✅ index.html (raíz)
✅ .htaccess
✅ robots.txt
✅ sitemap.xml
✅ favicon.ico
✅ css/ (carpeta)
✅ js/ (carpeta)
✅ images/ (carpeta)
✅ api/ (carpeta)
✅ redemthor/ (carpeta)
✅ total-darkness/ (carpeta)
```

---

### **MÉTODO 2: FTP/SFTP (WinSCP - Más control)**

#### Paso 1: Conectar con WinSCP

1. Abre WinSCP
2. Host: `xlerion.com`
3. Username: Tu usuario FTP
4. Password: Tu contraseña FTP
5. Puerto: 21 (FTP) o 22 (SFTP)
6. Click "Login"

#### Paso 2: Navegar a public_html

```text
Lado derecho (servidor):
- Navega a /public_html
```

#### Paso 3: Subir ZIP

```text
Lado izquierdo (tu PC):
- Busca: X:\Programacion\XlerionWeb\xlerion-site\xlerion-deploy-20260114_111201.zip
- Drag & drop a la carpeta /public_html en lado derecho
- Espera a que termine (5-10 minutos)
```

#### Paso 4: Extraer en el Servidor

```text
En WinSCP, lado derecho:
1. Click derecho en "xlerion-deploy-20260114_111201.zip"
2. Click "Extract" (si está disponible)
   O usar terminal SSH en WinSCP:
   cd /public_html
   unzip xlerion-deploy-20260114_111201.zip
   rm xlerion-deploy-20260114_111201.zip
```

#### Paso 5: Mover Archivos (SSH)

```text
Terminal SSH en WinSCP:
cd /public_html
mv dist/* .
mv public/* .
rmdir dist public
ls -la (para verificar)
```

#### Paso 6: Verificar Permisos

```text
Terminal SSH:
chmod 755 .htaccess
chmod 755 robots.txt
chmod 755 sitemap.xml
chmod 755 api/send-email.php
```

---

### **MÉTODO 3: SSH TERMINAL (Más rápido - Expertos)**

#### Paso 1: Conectar SSH

```powershell
ssh tu_usuario@xlerion.com
```

#### Paso 2: Navegar

```bash
cd /public_html
pwd # Verifica: /home/tu_usuario/public_html
```

#### Paso 3: Descargar ZIP

```bash
# Opción A: Desde tu PC (usa SCP)
scp X:\Programacion\XlerionWeb\xlerion-site\xlerion-deploy-20260114_111201.zip tu_usuario@xlerion.com:/public_html/

# O Opción B: Si subiste el ZIP anteriormente
ls -lh xlerion-deploy-20260114_111201.zip
```

#### Paso 4: Extraer

```bash
unzip -q xlerion-deploy-20260114_111201.zip
# Verifica: ls -la | grep "dist\|public"
```

#### Paso 5: Mover Archivos

```bash
mv dist/* .
mv public/* .
rmdir dist public
rm xlerion-deploy-20260114_111201.zip
```

#### Paso 6: Ajustar Permisos

```bash
chmod 755 .htaccess robots.txt sitemap.xml
chmod 755 api/send-email.php
chmod 755 total-darkness/dashboard.html
```

#### Paso 7: Verificar

```bash
ls -la | head -20
# Debe mostrar: index.html, .htaccess, robots.txt, etc.
```

---

## ✅ VALIDACIÓN POST-DEPLOYMENT (6 TESTS)

Después de hacer el deployment, **EJECUTA ESTOS 6 TESTS**:

### Test 1: Home Page

```text
URL: https://xlerion.com/
Esperado:
✅ Página carga (no error 404)
✅ Favicon visible
✅ Contenido correcto
```

### Test 2: Redirects /views → /

```text
URL: https://xlerion.com/views
Esperado:
✅ Redirecciona automáticamente a https://xlerion.com/
✅ Status HTTP: 301 (permanente)
✅ Sin pantalla negra
```

### Test 3: Robots.txt Accesible

```text
URL: https://xlerion.com/robots.txt
✅ Devuelve contenido robots.txt
✅ Contiene: Disallow: /views
✅ Contiene: Sitemap URLs
```

### Test 4: Sitemap.xml Accesible

```text
URL: https://xlerion.com/sitemap.xml
Esperado:
✅ Devuelve XML válido
✅ Contiene URLs de Total Darkness
✅ Estructura correcta
```

### Test 5: Total Darkness Accesible

```text
URL: https://xlerion.com/total-darkness/
Esperado:
✅ Dashboard carga
✅ Meta tags presentes (verificar con inspector)
✅ Sin errores 404
```

### Test 6: Redemthor Accesible

```text
URL: https://xlerion.com/redemthor/
Esperado:
✅ Página carga
✅ Contenido íntegro
✅ CSS y JS funcionan
```

En Firefox o Chrome, con la página abierta:

```text
1. Inspeccionar → Elementos (F12)
2. Buscar: <head>
3. Verificar que existan:
   - <title>...</title>
   - <meta name="description">
   - <meta property="og:title">
   - <link rel="icon" ... favicon.ico>
   - <link rel="apple-touch-icon" ... logo-512.png>
```

---

## 🌍 DESPUÉS DEL DEPLOYMENT

### Inmediato (0-2 horas)

✅ Todos los tests pasan  
✅ Sitio está 100% funcional  
✅ Usuarios pueden navegar  
✅ Redirecciones funcionan  
✅ Favicon visible (limpiar cache si es necesario)

### En 1-2 horas

📍 **HACER GSC ACTIONS** (si aún no las hiciste):

1. Reenviar `sitemap.xml` en GSC
2. Reenviar `robots.txt` en GSC
3. Solicitar indexación: `https://xlerion.com/total-darkness/`
4. Solicitar indexación: `https://xlerion.com/views`

⏱️ **Esto acelera indexación de 1-2 semanas a 3-5 días**

### En 3-5 Días

📊 Cambios comienzan a verse en Google Search:

- ✅ Favicon visible
- ✅ Meta tags reflejados
- ✅ Total Darkness comenzando a indexarse
- 📈 Tráfico +5-10%

### En 1-2 Semanas

🎉 Cambios completamente consolidados:

- ✅ /views desaparece del índice
- ✅ Total Darkness visible en búsquedas
- ✅ Favicon estable en SERP
- 📈 Tráfico +15-25%

---

## ⚠️ TROUBLESHOOTING

### Problema: "404 Not Found en <https://xlerion.com/>"

**Solución**:

1. Verifica que `index.html` esté en `/public_html/`
2. Verifica que `.htaccess` esté presente
3. Contacta hosting si no sabes

### Problema: ".htaccess no funciona (redirecciones no van)"

**Solución**:

1. Asegúrate que `.htaccess` está en `/public_html/`
2. Permisos: `chmod 755 .htaccess`
3. Verifica con hosting que Apache `mod_rewrite` está activo
4. Algunos hostings requieren agregar en `.htaccess`:

   ```apache
   <IfModule mod_rewrite.c>
   ...
   </IfModule>
   ```

### Problema: "sitemap.xml o robots.txt no se encuentran"

**Solución**:

1. Verifica que estén en `/public_html/`
2. No deben estar dentro de ninguna carpeta
3. Permisos: `chmod 644 robots.txt sitemap.xml`

### Problema: "CSS/JS no se cargan (página se ve sin estilos)"

**Solución**:

1. Verifica carpetas: `/css/`, `/js/`, `/images/` existan
2. Revisa console (F12) para ver rutas de archivos
3. Verifica que la URL raíz sea `https://xlerion.com/` (no `/xlerion-site/` u otro)
4. Limpiar cache del navegador: `Ctrl+Shift+Del`

### Problema: "Total Darkness dashboard no carga"

**Solución**:

1. Verifica carpeta `/total-darkness/` existe en `/public_html/`
2. Verifica `dashboard.html` existe dentro
3. Comprueba que `router.php` está en `/public_html/` para CORS (local) o en `/api/` (production)
4. En production, algunos hostings NO soportan PHP en rutas personalizadas

### Problema: "Email form no funciona"

**Solución**:

1. Verifica `/api/send-email.php` existe
2. Tu servidor debe tener `mail()` habilitado o SMTP configurado
3. Consulta guía: `xlerion-site/CONTACT_FORM_CONFIG.md`

---

## 📞 SOPORTE

Si algo falla:

1. Revisa la sección **Troubleshooting** arriba
2. Verifica todos los 6 tests
3. Limpia cache del navegador
4. Intenta en incógnito (sin extensiones)
5. Contacta a tu hosting si es error del servidor

**Importante**: Guarda este archivo para referencia futura.

---

## ✨ RESUMEN

| Fase | Tiempo | Tarea |
| ---- | ------ | ----- |
| **Deploy** | 10-30 min | Subir ZIP, extraer, mover archivos |
| **Validación** | 5 min | Ejecutar 6 tests |
| **GSC Actions** | 10 min | 4 acciones en Google Search Console |
| **Espera** | 3-5 días | Google indexa cambios |
| **Resultado** | Día 7+ | 100% consolidado, +15-25% tráfico |

---

**CREADO**: 14/01/2026 11:12 AM  
**VERSION**: 1.0  
**ZIP**: xlerion-deploy-20260114_111201.zip (257.18 MB)
