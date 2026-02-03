# 🎯 REDEMTHOR i18n - REMAINING WORK PLAN

## Overview

index.html ✅ is complete and production-ready.
Remaining 5 pages need systematic i18n markup application.

---

## 📋 REMAINING PAGES CHECKLIST

### 1. transmisiones.html (Lyrics/Transmissions Page)

**Priority**: HIGH (Secondary landing page)
**Complexity**: LOW
**Estimated Elements**: 12-15

**Navigation (5 elements)**

- [ ] "Inicio" (Home)
- [ ] "Historia" (History)  
- [ ] "Protocolo" (Protocol)
- [ ] "Transmisiones" (Transmissions) - Current page
- [ ] "Unidades" (Units)

**Footer (7 elements)**

- [ ] "Transmisión Directa" (Direct Transmission)
- [ ] "Nodos de Distribución" (Distribution Nodes)
- [ ] "Protocolo" (Protocol)
- [ ] "Ubicación" (Location)
- [ ] "Estado" (Status)
- [ ] "ACTIVO" (Active)
- [ ] "Clasificación" (Classification)

**Translation Keys Needed**:

- footer_transmision_directa ✓ Already exists
- footer_nodos_distribucion ✓ Already exists
- footer_protocolo ✓ Already exists
- footer_ubicacion ✓ Already exists
- footer_estado ✓ Already exists
- footer_activo ✓ Already exists
- footer_clasificacion ✓ Already exists

**Song Content**:

- NOTE: Lyric toggle appears to be intentionally bilingual per-song
- Should remain as-is or add ES version descriptions if needed

**Time Estimate**: 15-20 minutes

---

### 2. historia-fundacion.html (Foundation History Page)

**Priority**: HIGH (Important historical reference)
**Complexity**: MEDIUM
**Estimated Elements**: 50-60

**Navigation/Breadcrumbs (5 elements)**

- [ ] "Fundación" (Foundation) - Current page
- [ ] "Evolución" (Evolution)
- [ ] "Discografía" (Discography)
- [ ] "Miembros" (Members)

**Section Headings (4 elements)**

- [ ] Page title sections
- [ ] Content subsection headers
- [ ] Timeline markers

**Content Descriptions (40+ elements)**

- [ ] All paragraph text describing foundation history
- [ ] Key dates and events
- [ ] Band member names and roles (first mentions)
- [ ] Album/EP information
- [ ] Festival and venue names

**Navigation Buttons (6 elements)**

- [ ] "Siguiente" (Next)
- [ ] "Inicio" (Home)
- [ ] "Anterior" (Previous)

**Footer (7 elements)**

- [ ] All footer sections (same as transmisiones.html)

**Translation Keys Needed**:

- Most keys already exist from index.html
- May need: historia_fundacion_detail, evento_descripcion_*, festival_*, venue_*

**Time Estimate**: 60-90 minutes

---

### 3. historia-evolucion.html (Evolution History Page)

**Priority**: HIGH (Continuation of history)
**Complexity**: MEDIUM
**Estimated Elements**: 50-60

**Navigation/Breadcrumbs (5 elements)**

- [ ] "Fundación" (Foundation)
- [ ] "Evolución" (Evolution) - Current page
- [ ] "Discografía" (Discography)
- [ ] "Miembros" (Members)

**Section Headings (4 elements)**

- [ ] Timeline sections
- [ ] Event descriptions
- [ ] Key milestones

**Content Descriptions (40+ elements)**

- [ ] Evolution narrative text
- [ ] Period-specific information
- [ ] Formation changes
- [ ] Festival performances
- [ ] Band evolution milestones

**Navigation Buttons (6 elements)**

- [ ] "Siguiente" (Next)
- [ ] "Inicio" (Home)
- [ ] "Anterior" (Previous)

**Footer (7 elements)**

- [ ] All footer sections

**Translation Keys Needed**:

- historia_evolucion_detail, periodo_*, formacion_*, evolution_theme_*

**Time Estimate**: 60-90 minutes

---

### 4. discografia.html (Discography Page)

**Priority**: MEDIUM (Reference page)
**Complexity**: MEDIUM-HIGH (Most text-heavy)
**Estimated Elements**: 60-70

**Navigation/Breadcrumbs (5 elements)**

- [ ] Breadcrumb navigation

**Album Sections (4-5 per album)**

- [ ] Album titles
- [ ] Album labels (EP/Album/Single)
- [ ] Recording information
- [ ] Platform links
- [ ] Album descriptions

**Content Sections (40+ elements)**

- [ ] "Información" (Information) headings
- [ ] "Canciones Principales" (Main Songs)
- [ ] "Descripción" (Description)
- [ ] "Plataformas" (Platforms)
- [ ] Technical information (Studio, Engineer, Format)
- [ ] Song lists
- [ ] Material descriptions

**Navigation Buttons (6 elements)**

- [ ] "Siguiente" (Next)
- [ ] "Inicio" (Home)
- [ ] "Anterior" (Previous)

**Footer (7 elements)**

- [ ] All footer sections

**Translation Keys Needed**:

- album_info_*, song_*, discografia_*, studio_*, engineer_*

**Time Estimate**: 90-120 minutes

---

### 5. miembros.html (Members/Units Page)

**Priority**: MEDIUM (Band information)
**Complexity**: MEDIUM
**Estimated Elements**: 40-50

**Navigation/Breadcrumbs (5 elements)**

- [ ] Breadcrumb navigation

**Formation Sections (10-15 elements per formation)**

- [ ] Formation period labels
- [ ] Member names and roles
- [ ] Formation descriptions
- [ ] Timeline information

**Content Descriptions (30+ elements)**

- [ ] Member biographies
- [ ] Role descriptions
- [ ] Formation information
- [ ] Musical contributions

**Navigation Buttons (6 elements)**

- [ ] Section navigation

**Footer (7 elements)**

- [ ] All footer sections

**Translation Keys Needed**:

- members_*, formacion_*, timeline_*, biography_*

**Time Estimate**: 60-90 minutes

---

## 📊 SUMMARY STATISTICS

| Page | Elements | Keys Needed | Time Est. | Status |
|------|----------|------------|-----------|--------|
| transmisiones.html | 12-15 | 0 (all exist) | 15-20 min | ⏳ PENDING |
| historia-fundacion.html | 50-60 | 10-15 new | 60-90 min | ⏳ PENDING |
| historia-evolucion.html | 50-60 | 10-15 new | 60-90 min | ⏳ PENDING |
| discografia.html | 60-70 | 15-20 new | 90-120 min | ⏳ PENDING |
| miembros.html | 40-50 | 10-15 new | 60-90 min | ⏳ PENDING |
| **TOTALS** | **212-255** | **45-75 new keys** | **4.5-6.5 hrs** | - |

---

## 🔄 RECOMMENDED WORKFLOW

For each page, follow this systematic approach:

1. **Read Page Content** (10 min)
   - Understand structure
   - Identify all Spanish text sections

2. **Plan Translations** (5 min)
   - List all unique terms to translate
   - Check what already exists in dictionary
   - List new keys needed

3. **Add Translation Keys** (5-10 min)
   - Add new keys to translations.js (ES + EN pairs)
   - Use consistent naming convention

4. **Mark HTML Elements** (30-60 min)
   - Use grep_search to find all Spanish text
   - Add data-i18n attributes systematically
   - Use multi_replace_string_in_file for batch operations

5. **Verify Completeness** (5 min)
   - Final grep search for unmarked Spanish text
   - Confirm all critical elements marked
   - Documentation update

---

## 💡 TIPS FOR EFFICIENCY

1. **Batch Replacements**: Use multi_replace_string_in_file instead of single replacements
2. **Template Commands**: Use same footer pattern for all pages (copy translations)
3. **Search Strategy**: Use regex patterns to find all Spanish text efficiently
4. **Group By Section**: Process navigation, then content, then footer for consistency
5. **Track Progress**: Update checklist after each page

---

## 🎓 PATTERN REFERENCE

### Navigation Pattern (same on all pages)

```javascript
// Keys already exist:
nav_inicio, nav_historia, nav_protocolo, 
nav_transmisiones, nav_archivos, nav_unidades
```

### Footer Pattern (same on all pages)

```javascript
// Keys already exist:
footer_transmision_directa, footer_nodos_distribucion, 
footer_protocolo, footer_ubicacion, footer_estado, 
footer_activo, footer_clasificacion
```

### Member Role Pattern (exists)

```javascript
// Keys already exist:
unidades_guitarra_lider, unidades_bateria, unidades_voz,
unidades_bajo, unidades_guitarra_ritmica, unidades_voz_bateria
```

---

## ✅ DONE

- ✅ index.html - 63 elements, 24 new keys
- ✅ translations.js - 330+ keys total

## ⏳ TODO (In Order of Priority)

1. transmisiones.html (15 min)
2. historia-fundacion.html (90 min)
3. historia-evolucion.html (90 min)
4. discografia.html (120 min)
5. miembros.html (90 min)

---

*Estimated Total Remaining Work: 4.5-6.5 hours for complete site coverage*
