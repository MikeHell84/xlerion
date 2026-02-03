# SEO Checklist y Recomendaciones para Xlerion Stories

## ✅ Archivos Implementados

### 1. robots.txt

- Ubicación: `/total-darkness/robots.txt`
- Indica a los motores de búsqueda qué pueden indexar
- Bloquea archivos sensibles (data.json, app.js)
- Permite acceso a páginas públicas y recursos

### 2. sitemap.xml

- Ubicación: `/total-darkness/sitemap.xml`
- Lista todas las páginas indexables
- Incluye información de idiomas alternativos (hreflang)
- Indica frecuencia de actualización y prioridad

### 3. Meta Tags SEO

En `index.html`:

- ✅ Meta description optimizada
- ✅ Keywords relevantes
- ✅ Canonical URL
- ✅ Robots directive
- ✅ Open Graph (Facebook)
- ✅ Twitter Cards
- ✅ JSON-LD structured data

## 🎯 Próximos Pasos Recomendados

### 1. Registrar en Google Search Console

```
1. Ir a: https://search.google.com/search-console
2. Agregar propiedad: xlerion.com
3. Verificar propiedad (método recomendado: archivo HTML)
4. Enviar sitemap: https://xlerion.com/total-darkness/sitemap.xml
```

### 2. Registrar en Bing Webmaster Tools

```
1. Ir a: https://www.bing.com/webmasters
2. Agregar sitio
3. Enviar sitemap
```

### 3. Crear Imágenes para Redes Sociales

Necesitas crear:

- `images/og-image.png` (1200x630px) - Para Open Graph
- `images/twitter-card.png` (1200x675px) - Para Twitter

### 4. Optimizaciones Adicionales

#### A. Rendimiento

- [ ] Optimizar imágenes (comprimir, usar WebP)
- [ ] Implementar lazy loading para imágenes
- [ ] Minificar CSS y JS en producción
- [ ] Usar CDN para recursos estáticos

#### B. SEO Técnico

- [ ] Implementar breadcrumbs (migas de pan)
- [ ] Añadir schema.org a páginas de historia
- [ ] Crear página 404 personalizada
- [ ] Implementar AMP (opcional, para móviles)

#### C. Contenido

- [ ] Crear página "Acerca de" o "About"
- [ ] Añadir FAQ (Preguntas Frecuentes)
- [ ] Blog/Noticias sobre actualizaciones
- [ ] Testimonios de usuarios

#### D. Accesibilidad (mejora SEO)

- [ ] Añadir atributos alt a todas las imágenes
- [ ] Mejorar contraste de colores
- [ ] Implementar navegación por teclado
- [ ] Añadir ARIA labels donde sea necesario

### 5. Analytics

Considera añadir:

- Google Analytics 4
- Microsoft Clarity
- Hotjar (heatmaps)

### 6. Configuración del Servidor

#### Para Apache (usar .htaccess)

```apache
# Compresión GZIP
# Cache de recursos estáticos
# Redirecciones 301
# Headers de seguridad
```

#### Para Nginx (nginx.conf)

```nginx
# Compresión gzip
gzip on;
gzip_types text/css application/javascript image/svg+xml;

# Cache
location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

# Redirección HTTPS
if ($scheme != "https") {
    return 301 https://$host$request_uri;
}
```

## 📊 Métricas a Monitorear

1. **Core Web Vitals**
   - LCP (Largest Contentful Paint) < 2.5s
   - FID (First Input Delay) < 100ms
   - CLS (Cumulative Layout Shift) < 0.1

2. **PageSpeed Insights**
   - Objetivo: Score > 90 en móvil y escritorio
   - URL: <https://pagespeed.web.dev/>

3. **Indexación**
   - Monitorear páginas indexadas en Search Console
   - Verificar errores de rastreo
   - Revisar cobertura del sitemap

## 🔗 Enlaces Útiles

- [Google Search Console](https://search.google.com/search-console)
- [Bing Webmaster Tools](https://www.bing.com/webmasters)
- [Schema.org Generator](https://technicalseo.com/tools/schema-markup-generator/)
- [Open Graph Checker](https://www.opengraph.xyz/)
- [Twitter Card Validator](https://cards-dev.twitter.com/validator)
- [PageSpeed Insights](https://pagespeed.web.dev/)

## 🎨 Plantilla para Imágenes Sociales

### Open Graph (og-image.png)

- Dimensiones: 1200 x 630 px
- Incluir: Logo Xlerion + "Stories" + tagline
- Fondo: Negro con elementos cian (#00e9fa)
- Formato: PNG o JPG

### Twitter Card (twitter-card.png)

- Dimensiones: 1200 x 675 px
- Similar al Open Graph pero con proporción 16:9
- Formato: PNG o JPG
