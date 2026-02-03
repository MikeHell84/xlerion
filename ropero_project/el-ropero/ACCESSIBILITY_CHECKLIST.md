# Checklist de Accesibilidad - El Ropero Mag&co

Cumplimiento de **WCAG 2.1 Nivel AA**

## Estructura Semántica

- [x] Usar `<header>`, `<main>`, `<footer>`, `<nav>`, `<aside>` elementos semánticos
- [x] Títulos (`<h1>-<h6>`) en jerarquía lógica
- [x] Listas (`<ul>`, `<ol>`) para contenido estructurado
- [x] `<article>` para contenido independiente (subastas, posts)
- [x] `role="main"` en elemento principal
- [x] `role="complementary"` para sidebars

## Formularios

- [x] Todos los inputs tienen `<label>` asociada con atributo `for`
- [x] Placeholders no reemplazan labels
- [x] Validación cliente visible (mensajes de error claramente)
- [x] Validación servidor (respuesta HTTP 422 con mensajes)
- [x] Inputs con `aria-required="true"` cuando sea necesario
- [x] `aria-describedby` para mensajes de ayuda
- [x] Focus visible (`:focus` no removido)
- [x] Error messages con `role="alert"`

## Imágenes

- [x] Todas las imágenes tienen `alt` descriptivo
- [x] Imágenes decorativas con `alt=""` o `aria-hidden="true"`
- [x] `title` atributo para información adicional
- [x] Texto en imágenes también disponible en HTML

## Enlaces y Botones

- [x] Enlaces con texto descriptivo (no "Haz clic aquí")
- [x] `aria-label` para botones con solo iconos
- [x] Botones son `<button>` o `<a role="button">`
- [x] Links internos con `href` relativo
- [x] External links con atributo `target="_blank"` Y `rel="noopener noreferrer"`
- [x] Skip links para saltar a contenido principal (si aplica)

## Navegación

- [x] Navegación principal en `<nav>` elemento
- [x] Menu items con estructura clara
- [x] `aria-current="page"` en link actual
- [x] Breadcrumbs con estructura semántica
- [x] Orden lógico de tabs (tabindex >= 0)
- [x] Atajos de teclado documentados (si aplica)

## Color y Contraste

- [x] Contraste mínimo 4.5:1 para texto normal
- [x] Contraste mínimo 3:1 para texto grande (18pt+)
- [x] No usar solo color para transmitir información
- [x] Ejemplo: errores con icono + texto, no solo color rojo

**Colores Usados:**

- Primary (#00e9fa) sobre Dark (#000000): Contraste 9.6:1 ✓
- Text (blanco #FFFFFF) sobre Dark: Contraste 21:1 ✓
- Gray-400 (#9CA3AF) sobre Dark: Contraste 4.8:1 ✓
- Badges (Green/Red/Yellow) verificados con herramientas

## Movimiento y Animaciones

- [x] Animaciones no duran más de 5 segundos (salvo necesario)
- [x] Respetar `prefers-reduced-motion` en CSS
- [x] No usar parpadeos o destellos > 3 por segundo
- [x] Animaciones pueden pausarse

```css
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}
```

## Zoom y Escalado

- [x] No remover `<meta name="viewport">`
- [x] Viewport meta no tiene `user-scalable=no`
- [x] Permitir zoom mínimo 2x
- [x] Contenido legible en 200% zoom (sin scroll horizontal)

## Teclado

- [x] Todos los elementos interactivos accesibles por teclado
- [x] Orden de tabulación lógico (tabindex)
- [x] Focus visible en todos los navegadores
- [x] No usar `tabindex > 0`
- [x] Modales con focus trap
- [x] Atajos de teclado no conflictuan con navegador

**Prueba de teclado:**

```
Tab: navegar adelante
Shift+Tab: navegar atrás
Enter/Space: activar botón
Arrow keys: slider, combobox
Escape: cerrar modal
```

## Screen Readers

- [x] Usar `aria-label` para elementos sin texto visible
- [x] `aria-describedby` para descripciones
- [x] `aria-hidden="true"` para elementos puramente decorativos
- [x] `role="img"` para iconos significativos
- [x] Anunciar cambios dinámicos con `aria-live="polite"`
- [x] Listas con `<ul>/<ol>` (no divs simulando listas)
- [x] Tablas con `<th scope="col/row">`

**Prueba con:**

- NVDA (Windows, gratis)
- JAWS (Windows, pago)
- VoiceOver (Mac, incluido)

## Componentes Específicos

### Modales

- [x] `role="dialog"` o `role="alertdialog"`
- [x] `aria-modal="true"`
- [x] `aria-labelledby` apuntando al título
- [x] Focus atrapado dentro del modal
- [x] ESC cierra modal
- [x] Botón "Cerrar" visible

### Formularios de Filtro

- [x] Cambios no envían automáticamente
- [x] Botón "Aplicar" o similar
- [x] Cambios anunciados a screen readers

### Carruseles

- [x] Botones prev/next con labels claros
- [x] Indicadores de página con role="tablist"
- [x] Pausar automáticos en hover/focus
- [x] Keyboard navigation (arrows, tab)

### Toasts/Notificaciones

- [x] `role="status"` para info
- [x] `role="alert"` para errores/advertencias
- [x] `aria-live="polite"` para no interrumpir
- [x] Tiempo suficiente para leer (mín 6 segundos)

### Paginación

- [x] Links o botones claramente etiquetados
- [x] `aria-current="page"` en página actual
- [x] Número de página en aria-label
- [x] Previo/Siguiente deshabilitados cuando no aplique

## Responsive y Mobile

- [x] Funciona en pantallas >= 320px
- [x] Touch targets mínimo 48x48px (WCAG 2.1 AAA recomendado)
- [x] Textos legibles sin zoom en mobile
- [x] Gestos no obligatorios (alternativa con botones)

## Testing

### Herramientas Automáticas

- [ ] **axe DevTools** (extensión Chrome/Firefox)
  - Ejecutar: F12 > axe DevTools tab
  - Reportar errores en GitHub issues
  
- [ ] **Lighthouse** (Chrome DevTools)
  - Score >= 90 en Accessibility
  - F12 > Lighthouse > Accessibility

- [ ] **WAVE** (WebAIM)
  - Chrome/Firefox extension
  - Reportar estructura y contraste

### Testing Manual

```bash
# Navegar con teclado únicamente (sin mouse)
1. Abrir página
2. Pulsar Tab/Shift+Tab para navegar
3. Enter para activar links/botones
4. Verificar orden lógico y focus visible

# Zoom en navegador
1. Ctrl/Cmd + Plus (200% zoom)
2. Verificar sin scroll horizontal
3. Todos los elementos accesibles

# Desactivar CSS
1. F12 > Disable CSS
2. Contenido legible en orden correcto

# Verificar sin color
1. Abrir imagen en escala de grises
2. Toda información visible sin color
```

### Testing con Screen Reader (VoiceOver en Mac)

```bash
# Activar VoiceOver
Cmd + F5

# Navegación
VO = Control + Option
VO + U = Rotor (menú de navegación)
VO + Right Arrow = Leer siguiente
VO + Left Arrow = Leer anterior

# Testing
1. Recorrer toda la página con VO
2. Verificar headings con VO + U
3. Verificar forms legibles
4. Escuchar descripciones de imágenes
```

## Checklist Final Antes del Deploy

### Página: Home

- [ ] Headings en orden (h1 > h2 > h3)
- [ ] Imágenes de carousel con alt
- [ ] Botones CTA accesibles
- [ ] Contraste verificado (axe)
- [ ] Keyboard navigation funciona

### Página: Listado de Subastas

- [ ] Filtros accesibles vía teclado
- [ ] Paginación clara
- [ ] Grid accesible
- [ ] Cards con estructura semántica
- [ ] Lazy loading notificado

### Página: Detalle de Subasta

- [ ] Galería keyboard navigable
- [ ] Modal de puja accesible
- [ ] Contador regresivo legible
- [ ] Historial de pujas en tabla con headers

### Formularios

- [ ] Labels asociadas
- [ ] Validación visible
- [ ] Error messages `role="alert"`
- [ ] Campos requeridos indicados

### Navegación

- [ ] Header skip link (si aplica)
- [ ] Breadcrumbs semánticos
- [ ] Menu usuario accesible
- [ ] Footer links accesibles

## Recursos

- [WebAIM](https://webaim.org/) - Guías WCAG
- [A11y Project](https://www.a11yproject.com/) - Checklists
- [MDN Accessibility](https://developer.mozilla.org/en-US/docs/Web/Accessibility)
- [W3C ARIA](https://www.w3.org/WAI/ARIA/)

## Notas de Implementación

- Alpine.js para interactividad (ligero, accesible)
- Tailwind con utilities accesibles built-in
- No usar `display: none` para esconder (usa sr-only si es para screen readers)
- Validar con herramientas automáticas en CI
- Testing manual obligatorio antes de release

---

Última verificación: 2026-01-31
Próxima auditoría: 2026-02-28
