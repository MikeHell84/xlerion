# UI Spec: Estación Comunitaria Nocaima

## Demo Project Page & Card Component

**Version:** 1.0  
**Date:** February 4, 2025  
**Status:** Demo  
**Demo Badge:** Visible on all pages

---

## 1. PROJECT CARD (Landing Page - Sección Proyectos)

### 1.1 Card Container Layout

```
┌─────────────────────────────────────┐
│                                     │
│         [Thumbnail Image]           │  ← responsive, 400x300px
│                                     │
├─────────────────────────────────────┤
│ Title: Estación Comunitaria Nocaima │  ← 24px bold
├─────────────────────────────────────┤
│                                     │
│ Short Description (1-2 lines):      │  ← 14px gray
│ "Plataforma de radio comunitaria    │
│ con transmisión en vivo..."         │
│                                     │
├─────────────────────────────────────┤
│ Tags: [radio] [comunidad] [demo]    │  ← inline badges
│                                     │
├─────────────────────────────────────┤
│ Difficulty: Estándar                │  ← enum badge
│ Duration: 8 semanas                 │
│                                     │
├─────────────────────────────────────┤
│    [Ver demo →] [Compartir]         │  ← CTA buttons
└─────────────────────────────────────┘
```

### 1.2 Card States

#### Normal State

- Background: `#0a0a0a` (dark)
- Border: `1px solid rgba(255,255,255,0.1)`
- Text: `#ffffff` (title), `#999999` (description)
- Cursor: pointer

#### Hover State

- Border: `1px solid #00e9fa` (cyan)
- Background: `#0a0a0a` (slight highlight: `rgba(0, 233, 250, 0.05)`)
- Transform: `scale(1.02)` (subtle zoom)
- Thumbnail: brightness increase to `105%`
- Transition: all 300ms ease

#### Focus State (Accessibility)

- Outline: `2px solid #00e9fa`
- Outline-offset: `4px`

### 1.3 Card Interaction

**On Card Click:**

- Open `/projects/radio-nocaima-demo` in new tab
- Track event: `project_card_click` with `project_id: "radio-nocaima-demo"`

**On "Ver demo" Button:**

- Same as card click (prevent double-click issues)

**On Thumbnail Hover:**

- Show preview overlay (see 1.4 below)

### 1.4 Card Preview Overlay (Hover)

```
Appears after 200ms hover:

[Thumbnail with dark overlay]
- Overlay opacity: 0.7
- Overlay color: #000000
- Text overlay (centered):
  • Bold: "Estación Comunitaria Nocaima"
  • Regular: "La voz de nuestra comunidad"
```

### 1.5 Responsive Behavior

**Desktop (1024px+):**

- Grid: 3 columns
- Card width: calc(100% / 3 - 16px gap)

**Tablet (768px - 1023px):**

- Grid: 2 columns
- Card width: calc(100% / 2 - 16px gap)

**Mobile (< 768px):**

- Grid: 1 column (full width with 16px padding)
- Card width: 100%

---

## 2. DEMO PAGE LAYOUT

### 2.1 Hero Section

```
┌─────────────────────────────────────────────┐
│         [Background Image]                  │
│         [Overlay: 0.7 opacity]              │
│                                             │
│    Estación Comunitaria Nocaima             │ ← 64px bold
│                                             │
│    La voz de nuestra comunidad.             │ ← 28px subtitle
│    En vivo, conectados, unidos.             │
│                                             │
│    [🎙 Escuchar en vivo] [Explorar]       │ ← CTA buttons
│                                             │
└─────────────────────────────────────────────┘
Height: 40vh (min 320px)
Parallax: enabled on desktop
```

**Hero CTA Buttons:**

- Primary: `[Escuchar en vivo]` → scroll to player
- Secondary: `[Explorar episodios]` → scroll to episodes
- Background: `#00e9fa` (primary), transparent border (secondary)
- Padding: 12px 32px
- Border radius: 4px
- Font: 12px mono uppercase

### 2.2 About Section (After Hero)

```
┌──────────────────────────────────────┐
│  Sobre la Emisora                    │ ← 48px heading
│                                      │
│  Estación Comunitaria Nocaima nace  │ ← body text (18px)
│  como iniciativa de empoderamiento  │
│  local...                            │
│                                      │
│  ┌─────┬─────┬─────┐                │
│  │500+ │50+  │ 12  │                │ ← Stats grid
│  │Oyen │Epis │Prog │                │
│  └─────┴─────┴─────┘                │
│                                      │
│  ┌──────────────────────────────┐   │
│  │ Nuestra Misión               │   │
│  │ Fortalecer lazos comunitarios│   │ ← Mission box
│  │ mediante comunicación...     │   │
│  └──────────────────────────────┘   │
│                                      │
│  Values: [Inclusión] [Transparencia]│ ← Tag-style badges
│          [Participación] [...]      │
└──────────────────────────────────────┘

Layout: max-width 1200px, px 8, py 40
```

### 2.3 Live Player Section

```
┌──────────────────────────────────────┐
│  Transmisión en Vivo                 │ ← Section title
│                                      │
│ ┌────────────────────────────────┐   │
│ │     [PLAYER UI]                │   │
│ │  ► || ◯◯◯◯◯ ⊕ ♪ ≡              │   │ ← Control bar
│ │                                │   │
│ │  Escuchando:                   │   │
│ │  Mañanitas Nocaima             │   │
│ │  María González • 06:00-09:00  │   │
│ │                                │   │
│ │  Oyentes en vivo: 127          │   │
│ │  Pico hoy: 342 | Promedio: 245 │   │
│ └────────────────────────────────┘   │
│                                      │
│ ┌────────────────────────────────┐   │
│ │ Programación de Hoy            │   │
│ │ [Program 1] [Program 2] ...    │   │ ← Grid o carousel
│ └────────────────────────────────┘   │
└──────────────────────────────────────┘

Player width: 100% up to 800px
Controls: play/pause, volume, quality, social
Fallback: Error message with contact info
```

**Player Features:**

- HLS stream primary, MP3 fallback
- Play/Pause buttons (large, accessible)
- Volume slider (0-100%)
- Time display (current / total)
- Quality selector (if multi-bitrate available)
- Share button (social media, link copy)
- Mute button (keyboard accessible)

**Accessibility:**

- `aria-label="Play/Pause"` on buttons
- Tab order: play → volume → quality → share
- Keyboard: Space = play/pause, ← → = seek, ↑ ↓ = volume
- Focus indicators: `outline: 2px solid #00e9fa`

### 2.4 Episodes On-Demand Section

```
┌──────────────────────────────────────┐
│  Episodios On-Demand                 │
│  Accede a nuestro archivo            │
│                                      │
│ ┌────────────┐                       │
│ │ Buscar     │  [Filter ▼]           │ ← Search + filters
│ └────────────┘  [Sort ▼]             │
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ [Thumb] Mañanitas Nocaima       │ │
│ │ Especial Café... | 3:00         │ │
│ │ María González | [♡] [Play]    │ │ ← Episode card
│ │ Tags: [café] [tradición]        │ │
│ │ Reproducido: 145x               │ │
│ │ [Donar] [$5000]                 │ │
│ └──────────────────────────────────┘ │
│                                      │
│ [Episode 2 card]                     │
│ [Episode 3 card]                     │
│                                      │
│ [← Página anterior] [1 2 3] [Siguiente →] │ ← Pagination
└──────────────────────────────────────┘

Grid: 3 columns desktop, 2 tablet, 1 mobile
Each episode card: 100% width of container
```

**Episode Card Components:**

- Thumbnail: 200x150px, rounded corners 4px
- Title: 16px bold, truncate if > 2 lines
- Description: 14px gray, 1-2 lines max
- Host/Category: 12px mono gray
- Duration: right-aligned, 12px mono
- Play button: hover effect, positioned center-right
- Donation button: `[Apodar]` → donation modal

### 2.5 Calendar Events Section

```
┌──────────────────────────────────────┐
│  Calendario de Eventos               │ ← Section header
│  Actividades y transmisiones especiales│
│                                      │
│ ┌──────────────────────────────────┐ │
│ │  Feb 2025  [< >] [Hoy]           │ │ ← Calendar header
│ │ L  M  X  J  V  S  D              │ │
│ │ 27 28 29 30 31  1  2              │ │
│ │  3  4  5  6  7  8  9              │ │
│ │ 10 11 12 13 14 15* 16            │ │ ← 15 is event
│ │ 17 18 19 20 21 22 23              │ │
│ │ 24 25 26 27 28  1  2              │ │
│ └──────────────────────────────────┘ │
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ Festival de Música Comunitaria    │
│ │ 15 de Febrero, 2:00 PM - 10:00 PM│ │ ← Event detail
│ │ Parque Central Nocaima            │
│ │ Bandas locales, DJ, artistas      │
│ │ [Añadir a calendario] [Transmisión en vivo] │
│ │ Asistentes esperados: 450         │
│ └──────────────────────────────────┘ │
│                                      │
│ Próximos eventos: 6                  │
└──────────────────────────────────────┘

Calendar type: month view
Events clickable to show details in modal
Add to calendar: Google Calendar, Outlook, iCal
```

### 2.6 Correspondents Form Section

```
┌──────────────────────────────────────┐
│  Corresponsales Comunitarios         │
│                                      │
│  ¿Tienes una historia que contar?   │ ← Intro text
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ [Name input] [required]          │ │
│ │ [Email input] [required]         │ │
│ │ [Phone input]                    │ │
│ │ [Location input]                 │ │
│ │ [Category select] ▼              │ │
│ │ [Title input]                    │ │
│ │ [Description textarea]           │ │
│ │                                  │ │
│ │ ○ Subir archivo MP3              │ │
│ │ ○ Enviar por WhatsApp            │ │
│ │ ○ Compartir enlace externo       │ │
│ │                                  │ │
│ │ [Upload field - conditional]     │ │
│ │                                  │ │
│ │ ☐ Autorizo reproducción          │ │
│ │ ☐ Acepto privacidad              │ │
│ │                                  │ │
│ │     [Enviar Contenido]           │ │
│ └──────────────────────────────────┘ │
│                                      │
│ O [Enviar por WhatsApp]              │ ← Alternative CTA
└──────────────────────────────────────┘

Form validation:
  - Real-time field validation
  - Error messages in-field (12px red)
  - Success message: green banner
  - Submission: POST /api/correspondents/submit
```

### 2.7 Sound Map Section

```
┌──────────────────────────────────────┐
│  Mapa Sonoro                         │
│  Explora las historias de Nocaima    │
│                                      │
│ ┌──────────────────────────────────┐ │
│ │        [LEAFLET MAP]              │ │ ← Interactive map
│ │  📍 [Click markers to play]       │ │
│ │                                  │ │
│ │   Pin 1: Parque Central          │ │
│ │   Pin 2: Tienda de Caliche       │ │
│ │   ...8 points total              │ │
│ └──────────────────────────────────┘ │
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ Parque Central                   │ │
│ │ Punto de encuentro histórico     │ │ ← Point detail
│ │                                  │ │
│ │ [Thumbnail] [Play] [2:34]        │ │
│ │ Narrador: Don Julio García       │ │
│ │ Categoría: Cultural              │ │
│ └──────────────────────────────────┘ │
└──────────────────────────────────────┘

Map: Leaflet, OpenStreetMap tiles
Responsive: full width on mobile
Zoom: 14, center: Nocaima coordinates
Markers: 8 custom audio points with popups
```

### 2.8 Support/Donation Section

```
┌──────────────────────────────────────┐
│  Apoya la Emisora                    │
│                                      │
│  Diferentes formas de contribuir     │ ← Intro
│                                      │
│ ┌─────────────┬─────────────────────┤
│ │ Membresía   │ $30,000/mes         │ ← Option cards
│ │ Mensual     │ ✓ Contenido + mención
│ │             │ [Seleccionar]       │
│ ├─────────────┼─────────────────────┤
│ │ Donación    │ $10,000             │
│ │ Pequeña     │ [Seleccionar]       │
│ └─────────────┴─────────────────────┘
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ Transparencia de Fondos          │ │
│ │ ┌──────────┬──────────┬──────┐   │ │
│ │ │Infrastr. │Producción│Equipo│   │ │ ← Budget chart
│ │ │   35%    │   30%    │  20% │   │ │
│ │ └──────────┴──────────┴──────┘   │ │
│ │ Próximo reporte: Q1 2025         │ │
│ └──────────────────────────────────┘ │
└──────────────────────────────────────┘

Grid: responsive card layout
Payment methods: Stripe (card), bank transfer, mobile
Stripe integration for donations
```

### 2.9 Education Section

```
┌──────────────────────────────────────┐
│  Educación y Capacitación            │
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ Producción Radiofónica Básica    │ │
│ │ Aprende fundamentos...           │ │
│ │                                  │ │
│ │ 12 horas | 4 sesiones | Básico   │ │
│ │ DJ Carlos Mendoza                │ │
│ │ Sábados 14:00 - 17:00            │ │
│ │ Máx. 20 participantes            │ │
│ │ $50,000 COP                      │ │
│ │                                  │ │
│ │ [Inscribirse]                    │ │
│ └──────────────────────────────────┘ │
│ [Workshop 2 card]                    │
│ [Workshop 3 card]                    │
│                                      │
│ ┌──────────────────────────────────┐ │
│ │ Newsletter: Mantente actualizado │ │
│ │ [Email input] [Suscribirse]      │ │
│ └──────────────────────────────────┘ │
└──────────────────────────────────────┘

Grid: 3 columns desktop, 1 mobile
Workshop cards include: title, instructor, schedule, price
CTA: redirect to enrollment form or external link
```

### 2.10 Footer

```
┌──────────────────────────────────────┐
│  ESTACIÓN COMUNITARIA NOCAIMA        │
│  La voz de nuestra comunidad         │
│                                      │
│  [📱] +57 3001234567 WhatsApp       │
│  [✉] contacto@estacionnocaima.local │
│                                      │
│  [Facebook] [Instagram] [YouTube]    │ ← Social icons
│                                      │
│  ┌──────────┬──────────┬──────────┤ │
│  │ Nav      │ Comunidad│ Legal    │ │ ← Link groups
│  │ Inicio   │ Correspon.│ Privacidad
│  │ En Vivo  │ Mapa     │ Términos │ │
│  │ Episodios│ Educación│ Cookies  │ │
│  │ Eventos  │ Apoya    │          │ │
│  └──────────┴──────────┴──────────┘ │
│                                      │
│  Descargas: 12,450 | Oyentes: 127   │ ← Metrics
│  © 2025 Estación Nocaima             │
└──────────────────────────────────────┘

Layout: 3 columns, stacks to 1 on mobile
Colors: dark background, cyan accents
Accessibility: all links have proper labels
```

---

## 3. INTERACTION & STATES

### 3.1 Form Validations

**Text Input:**

- On blur: validate non-empty
- Error state: red border, error message below
- Success state: green checkmark

**Email Input:**

- Real-time regex validation
- Format: `user@domain.ext`
- Error: "Correo electrónico inválido"

**File Input (Audio):**

- Accepted: MP3, WAV, FLAC (< 50MB)
- Validation: file type + size
- Preview: filename and size display
- Error: "Archivo no permitido" or "Archivo muy grande"

**Checkboxes:**

- Required checkboxes must be checked to submit
- Visual feedback: checkmark, blue background on check
- Accessibility: proper labels

### 3.2 Loading States

**Player Loading:**

- Skeleton: gray bars where content loads
- Status: "Cargando..." message
- Timeout: 10s fallback message

**Episodes List:**

- Grid skeleton: 6 placeholder cards
- Fade-in animation: 300ms once loaded

**Map:**

- Leaflet loading spinner
- Fallback: static image if script fails

### 3.3 Error States

**Stream Unavailable:**

```
⚠️ No disponible en este momento
La transmisión en vivo no está disponible.
Revisa la programación o intenta más tarde.

[Reintenta] [Contacta]
```

**Form Submission Error:**

```
❌ Error al enviar
Hubo un problema. Por favor intenta nuevamente o contacta vía WhatsApp.

[Reintenta] [WhatsApp]
```

### 3.4 Success States

**Form Submitted:**

```
✓ ¡Contenido recibido!
Gracias por tu contribución. Te contactaremos en 2-3 días.

[Aceptar] [Ver más]
```

---

## 4. RESPONSIVE BREAKPOINTS

| Breakpoint | Width | Layout |
|---|---|---|
| Mobile | < 640px | 1 column, full width |
| Tablet | 640px - 1024px | 2 columns, 8px gaps |
| Desktop | 1024px - 1440px | 3 columns, 16px gaps |
| Large | > 1440px | 3 columns, max-width container |

---

## 5. ACCESSIBILITY CHECKLIST

- [x] All images have alt text
- [x] Form labels associated with inputs (`<label for>`)
- [x] Keyboard navigation: Tab order logical
- [x] Color contrast: WCAG AA (4.5:1 min)
- [x] Focus indicators: 2px solid #00e9fa
- [x] ARIA labels on buttons and icons
- [x] Player controls accessible (keyboard)
- [x] Form validation messages clear and descriptive
- [x] Map markers have text alternatives
- [x] Links have descriptive text (not "click here")

---

## 6. ANIMATIONS & TRANSITIONS

**Card Hover:** 300ms ease

- Border color change
- Slight scale (1.02)
- Thumbnail brightness increase

**Section Entrance:** 600ms ease-out (stagger)

- Fade in: opacity 0 → 1
- Translate: transform translateY(20px) → 0

**Player Controls:** 150ms ease

- Volume slider hover
- Button state changes

**Form Submission:**

- Button loading: spinner animation 1s loop
- Success message: slide down 300ms ease

---

## 7. DEMO MODE INDICATORS

**Visible Badge (Top-Right Hero):**

```
┌─────────────────────┐
│ DEMO               │ ← yellow/orange badge
│ Contenido de ejemplo
└─────────────────────┘
```

**Footer Note:**

```
Demo — contenido de ejemplo para propósitos demostrativos
```

---

## 8. THEMING VARIABLES

```css
--primary-color: #00e9fa (cyan)
--secondary-color: #333436 (dark gray)
--background: #000000 (black)
--text-primary: #ffffff
--text-secondary: #999999
--border-light: rgba(255, 255, 255, 0.1)
--error: #ff4444
--success: #44ff44
```

---

## 9. TESTING SCENARIOS

### Desktop (Chrome, Firefox, Safari)

- [ ] Hero parallax works
- [ ] Player controls accessible (mouse + keyboard)
- [ ] Episodes load and pagination works
- [ ] Map renders and markers clickable
- [ ] Forms validate and submit
- [ ] Calendar events display correctly

### Mobile (iOS Safari, Android Chrome)

- [ ] Responsive layout stacks properly
- [ ] Player touch controls work
- [ ] Touchable elements ≥ 44x44px
- [ ] Form inputs accessible
- [ ] Map zoomable and pannable

### Accessibility

- [ ] Tab navigation logical
- [ ] Screen reader announces all sections
- [ ] Color contrast ratios pass WCAG AA
- [ ] Focus indicators visible
- [ ] Links have descriptive text

---

## 10. PERFORMANCE METRICS

- **Hero Load:** < 3s (optimized image)
- **Player Init:** < 1s (stream connection)
- **Episodes List:** < 1.5s (lazy load with pagination)
- **Map Init:** < 2s (Leaflet + data)
- **Full Page:** < 3s (first contentful paint)

**Image Optimization:**

- Hero: WEBP 1920x1080, fallback JPG
- Thumbnails: WEBP 400x300, thumbnail version
- LazyLoad: data-src attribute, IntersectionObserver

---

**End of UI Spec**
