# Redemthor i18n Translation Completion Plan

## Status: IN PROGRESS

Last Update: Current Session
Goal: Ensure NO Spanish text remains when switching to English

---

## ✅ COMPLETED - index.html (Main Page)

- ✅ Hero section: Colombia, Classification
- ✅ Formation labels: 2004-2006, 2008-2011
- ✅ Member roles: Guitarra Líder, Batería, Voz, Bajo, Guitarra Rítmica, Voz/Batería
- ✅ Footer headers: Transmisión Directa, Nodos de Distribución, Protocolo
- ✅ Footer labels: Ubicación, Estado, ACTIVO, Clasificación
- ✅ Archive labels: Grabado en Syntelia Sound Records, Single 2024
- ✅ Footer metadata: Archivos recuperados
- ✅ Translation dictionary expanded to 275+ keys

---

## 🔄 PENDING - Other Pages (80% of work remains)

### transmisiones.html (Lyrics Page - CRITICAL)

- [ ] Navigation: Inicio, Historia, Protocolo, Transmisiones, Unidades, Miembros
- [ ] Footer sections: Transmisión Directa, Nodos de Distribución, Protocolo
- [ ] Footer metadata: Estado, ACTIVO, Ubicación, Clasificación
- [ ] Song titles (already in EN, need ES version)
- [ ] UI buttons: Español, Inglés

**Estimated effort**: 30 data-i18n attributes

### historia-fundacion.html (Foundation History)

- [ ] Page title and navigation breadcrumbs
- [ ] All section headings (Información, Canciones Principales, Descripción, etc.)
- [ ] Content text describing band formation and history
- [ ] Footer sections: Transmisión Directa, Nodos de Distribución, Protocolo
- [ ] Navigation buttons: Siguiente, Inicio, Anterior
- [ ] Member names and descriptions

**Estimated effort**: 50+ data-i18n attributes

### historia-evolucion.html (Evolution History)

- [ ] Page title and breadcrumbs
- [ ] All section headings and descriptions
- [ ] Timeline content describing band evolution
- [ ] Footer sections: Transmisión Directa, Nodos de Distribución, Protocolo
- [ ] Navigation buttons
- [ ] Festival and event names

**Estimated effort**: 50+ data-i18n attributes

### discografia.html (Discography)

- [ ] Page title and breadcrumbs
- [ ] Album information sections: Información, Canciones Principales, Descripción
- [ ] Release information: Estudio, Ingeniero, Formato, Plataformas
- [ ] Album titles: "The Red Tormenthor Project", "A Glimmer of Hope", "A Hope in the Dark"
- [ ] Song lists and material descriptions
- [ ] Footer sections: Transmisión Directa, Nodos de Distribución, Protocolo
- [ ] Navigation buttons

**Estimated effort**: 60+ data-i18n attributes

### miembros.html (Members Page)

- [ ] Page title and breadcrumbs
- [ ] All member information sections
- [ ] Member names and descriptions
- [ ] Formation period labels
- [ ] Footer sections
- [ ] Navigation buttons

**Estimated effort**: 40+ data-i18n attributes

---

## Translation Dictionary Status

**Current Keys**: 275+

**Keys Added This Session**:

- archivos_recuperados
- autoconciencia_artificial
- ultimate_metal
- evolucion_reciente
- elementos_death_metal
- produccion_pulida
- single_2024_label
- ep_2008_label
- full_album_2015_label

**Still Needed**:

- Page-specific UI terms
- Navigation and breadcrumb terms
- Album/release information terms
- Member role descriptions
- Festival and event names
- Technical/contextual terms

---

## Action Items

### Phase 1: Complete index.html (TODAY) ✅

- [x] Expand translation dictionary with common terms
- [x] Mark all visible Spanish text with data-i18n
- [x] Test language toggle on main page

### Phase 2: Update transmisiones.html

- [ ] Add data-i18n to navigation and footer
- [ ] Test language toggle

### Phase 3: Update all history pages

- [ ] historia-fundacion.html
- [ ] historia-evolucion.html

### Phase 4: Update discografia.html and miembros.html

- [ ] Complete markup

### Phase 5: Final Testing

- [ ] Test all pages in both languages
- [ ] Verify localStorage persistence
- [ ] Check for any remaining Spanish text

---

## Notes

- Lyric content in transmisiones.html appears to be intentionally bilingual (per-song toggle)
- Some content like band member names may not need translation
- Footer sections are repeated on multiple pages - standardize translations
- Test should verify: No Spanish text visible when EN is selected, All buttons/UI translated

---

## Test Checklist

- [ ] Switch to English on index.html - verify NO Spanish text visible
- [ ] Switch back to Spanish - verify all Spanish text shows correctly
- [ ] Test localStorage persistence - refresh page with EN selected, should stay EN
- [ ] Repeat test for each other page as completed
- [ ] Test on mobile breakpoints
- [ ] Test lang attribute on <html> tag updates correctly
