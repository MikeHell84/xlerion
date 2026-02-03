# UI Flow - Motor de Estimación Xlerion

**Cotizador Dinámico con Lógica Condicional**  
Febrero 2, 2026

---

## 1. VISIÓN GENERAL DEL FLUJO

```
START
  ↓
PASO 1: Bienvenida + Seleccionar Servicio
  ├─ 8 tarjetas con iconos + descripción breve
  ├─ Validación: Seleccionar 1 servicio (obligatorio)
  ↓
PASO 2: Preguntas Iniciales (5–8 preguntas básicas)
  ├─ ¿Es primera vez implementando solución de este tipo?
  ├─ ¿Qué tamaño de equipo disponible?
  ├─ ¿Presupuesto aproximado?
  ├─ ¿Timeline preferido?
  ├─ ¿Tiene datos/sistemas legacy a integrar?
  ↓
PASO 3: Tareas Dinámicas (por servicio)
  ├─ Checkboxes: Seleccionar tareas deseadas (mínimo 2 de N)
  ├─ Condicional: Si "E-commerce" → mostrar "Integración Pasarela Pago"
  ├─ Condicional: Si "Blockchain" → mostrar "Auditoría Externa" (oblig.)
  ↓
PASO 4: Preguntas Condicionales (según respuestas paso 2 + 3)
  ├─ Si "múltiples idiomas" seleccionado → ¿Cuántos idiomas? (dropdown 2–10)
  ├─ Si "E-commerce" → ¿Integrar CRM? (sí/no)
  ├─ Si "ERP" → ¿Cuántos módulos? (slider 1–5)
  ├─ Si "Blockchain audit" → Avisar: "Esto requiere audit externa (+$20k)"
  ↓
PASO 5: Detalles del Equipo
  ├─ ¿Qué nivel de profesional necesita?
  │  └─ Radio: Junior / Mid / Senior / Mixed
  ├─ ¿Disponibilidad de stakeholders?
  │  └─ Slider: Disponible siempre / Parcial / Limitada
  ↓
PASO 6: Resumen + Cálculo
  ├─ Mostrar estimado (rango: mín–máx)
  ├─ Desglose tareas + horas
  ├─ Multiplicadores aplicados
  ├─ Buffer recomendado
  ├─ Duración en sprints
  ├─ Botones: [Descargar PDF] [JSON] [Enviar a Email]
  ↓
END / RESET
```

---

## 2. PASO A PASO DETALLADO CON WIREFRAMES (ASCII)

### PASO 1: SELECCIONAR SERVICIO

**Objetivo**: Usuario elige 1 de 8 servicios.

```
┌──────────────────────────────────────────────────────────────┐
│  🎯 ¿CUÁL ES TU PROYECTO?                                    │
│  Selecciona el servicio que mejor describe tu necesidad      │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌─────────┐        │
│  │   🌐    │  │  ⚙️     │  │  🔄     │  │  🔗     │        │
│  │  Web &  │  │ Software│  │ Digital │  │Blockchain        │
│  │ Mobile  │  │Empresar.│  │Transform│  │         │        │
│  └────┬────┘  └────┬────┘  └────┬────┘  └────┬────┘        │
│  Desarrollo de   Sistemas ERP   Consultoría   Contratos     │
│  aplicaciones web  y CRM       e Integración  inteligentes   │
│                                                              │
│  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌─────────┐        │
│  │   🎨    │  │  📊     │  │  🎮     │  │  🗿     │        │
│  │ Diseño &│  │Marketing│  │Videojueg│  │  3D &   │        │
│  │Branding │  │  Digital│  │  os     │  │ Animacion       │
│  └────┬────┘  └────┬────┘  └────┬────┘  └────┬────┘        │
│  Identidad visual Marketing en  Juegos      Modelado        │
│  y UX/UI        línea           indie       3D profesional  │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  [← Atrás]  [Selecciona un servicio para continuar →]       │
└──────────────────────────────────────────────────────────────┘
```

**Validaciones**:

- ⚠️ REQUERIDO: Seleccionar exactamente 1 servicio
- Cuando se selecciona: Tarjeta se resalta (border azul #00e9fa, fondo oscuro)
- Botón [Siguiente] se activa después selección

---

### PASO 2: PREGUNTAS INICIALES

**Objetivo**: Recopilar contexto del proyecto (5–8 preguntas clave).

```
┌──────────────────────────────────────────────────────────────┐
│  📋 CUÉNTANOS SOBRE TU PROYECTO                              │
│  Servicio seleccionado: Desarrollo Web y Móvil ✓             │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  1️⃣  ¿Es la primera vez que implementas solución de este   │
│     tipo en tu organización?                                │
│     ○ Sí (requerirá discovery más exhaustivo)              │
│     ○ No (tenemos experiencia previa)                      │
│                                                              │
│  2️⃣  ¿Qué tamaño de equipo disponible tienes para el      │
│     proyecto?                                               │
│     ○ Sin equipo (nosotros los armamos)                    │
│     ○ Pequeño (2–3 personas)                               │
│     ○ Mediano (4–6 personas)                               │
│     ○ Grande (7+ personas, requiere coordinación)          │
│                                                              │
│  3️⃣  ¿Cuál es tu presupuesto aproximado?                   │
│     ○ Bajo (<$10,000 USD)                                  │
│     ○ Medio ($10k–$50k USD)                                │
│     ○ Alto ($50k–$150k USD)                                │
│     ○ No tenemos límite presupuestario                     │
│                                                              │
│  4️⃣  ¿Cuál es tu timeline preferido?                       │
│     ○ ASAP (< 1 mes)                                       │
│     ○ 1–3 meses (standard)                                 │
│     ○ 3–6 meses (flexible)                                 │
│     ○ 6+ meses (sin prisa)                                 │
│                                                              │
│  5️⃣  ¿Tienes sistemas legacy o datos a integrar?           │
│     ○ No (proyecto greenfield)                             │
│     ○ Sí, tenemos datos a migrar                           │
│     ○ Sí, sistemas legacy a conectar                       │
│                                                              │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  [← Atrás] [Siguiente →]  (valida: todas preguntas ans.)    │
└──────────────────────────────────────────────────────────────┘
```

**Validaciones**:

- ⚠️ REQUERIDO: Todas las 5 preguntas contestadas
- Impacto en cálculo posterior:
  - P1 "Sí" → +15% buffer (requiere discovery extenso)
  - P2 "Sin equipo" → +25% horas reclutamiento
  - P3 "Bajo" → Advertencia si estimado > presupuesto
  - P4 "ASAP" → +30% horas (velocidad premium)
  - P5 "Sí" → +migration tasks automáticas

---

### PASO 3: SELECCIONAR TAREAS

**Objetivo**: Usuario elige tareas deseadas de su servicio. Tareas son condicionales según paso 2.

```
┌──────────────────────────────────────────────────────────────┐
│  ✅ TAREAS INCLUIDAS EN TU PROYECTO                          │
│  Desarrollo Web y Móvil                                      │
│  Mínimo 2 tareas requeridas                                  │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  TAREAS BASE (Todas disponibles):                           │
│                                                              │
│  ☑️  Discovery & Análisis de Requerimientos (20–40h)       │
│  ☑️  Diseño UI/UX (30–60h)                                 │
│  ☐  Frontend (40–150h) — [Necesario para proyecto web]    │
│  ☐  Backend (40–200h) — [Necesario para API/BD]           │
│  ☐  Testing & QA (20–80h)                                 │
│  ☐  Deployment & DevOps (15–40h)                          │
│                                                              │
│  TAREAS CONDICIONALES (según respuestas previas):          │
│                                                              │
│  ☐  E-commerce & Pasarela Pago (60–100h)                  │
│     ├─ Aparece si: Preguntas paso 2 indican tienda         │
│     └─ ⚠️ Nota: Auditoría PCI compliance incluida +$3k    │
│                                                              │
│  ☐  Multiidioma (Agregará 25% a todas tareas)              │
│     └─ ¿Cuántos idiomas? [2] [3] [4] [6] [10]            │
│                                                              │
│  ☐  Seguridad Avanzada (15–50h)                            │
│     └─ Encriptación, autenticación 2FA, auditoría         │
│                                                              │
│  ☐  Accesibilidad WCAG AA (10–30h)                         │
│     └─ Agregará 1.15x a tareas ya seleccionadas           │
│                                                              │
│  ☐  Performance Optimization (20–60h)                      │
│     └─ Caché, CDN, compresión, lazy-loading               │
│                                                              │
│  ☑️  Documentación & Training (10–25h)                     │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│  📊 Horas estimadas hasta ahora: 90h (base)                │
│  💰 Costo estimado (aún sin finales): $2,070 USD          │
│  📈 Este número cambiará al seleccionar más tareas         │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  [← Atrás] [Siguiente →]  (2+ tareas requeridas)            │
└──────────────────────────────────────────────────────────────┘
```

**Lógica Condicional**:

```javascript
// Pseudo-código lógica condicional Paso 3

IF servicio === "desarrollo-web-movil" THEN
  mostrar: discovery, design, frontend, backend, testing, deployment, documentation
  SI respuesta_paso2_P5 === "tiene legacy" THEN
    mostrar: "migration tasks" (20–60h)
  
  SI usuario selecciona "ecommerce" THEN
    mostrar: "pasarela pago" + "auditoría PCI" (obligatoria)
    mostrar: "multiidioma" (opcional) — factor 1.25x
    mostrar: "seguridad" (recomendada) — factor 1.3x
  
  SI usuario selecciona "multiidioma" THEN
    mostrar: "¿Cuántos idiomas?" → dropdown 2–10
    aplicar multiplicador 1.25x a horas base

SI usuario selecciona "accesibilidad" THEN
  mostrar: "Esto incrementará tiempo 15% (WCAG AA)"
  aplicar multiplicador 1.15x

SI respuesta_paso2_P4 === "ASAP" THEN
  mostrar: ⚠️ "Timeline acelerado (< 1 mes) añadirá 30% horas"
  aplicar multiplicador 1.3x a todas tareas

// Similar para otros servicios (Blockchain, ERP, etc.)
```

**Validaciones**:

- ⚠️ MÍNIMO: 2 tareas seleccionadas
- ⚠️ MÁXIMO: Sin límite (pero muestra advertencia si > 8 tareas)
- Auto-selección: Tareas "base" pre-marcadas (descubrimiento, diseño)

---

### PASO 4: PREGUNTAS CONDICIONALES DETALLADAS

**Objetivo**: Refinar multiplicadores basados en selecciones paso 3.

```
┌──────────────────────────────────────────────────────────────┐
│  🎯 PREGUNTAS ESPECÍFICAS                                    │
│  Basadas en tus tareas seleccionadas                         │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  1️⃣  MULTIIDIOMA                                            │
│  Has seleccionado "Multiidioma"                             │
│  ¿Cuántos idiomas necesitas? (factor 1.25x–1.6x según qty)│
│                                                              │
│  ┌──────────────────────────────────────────────┐           │
│  │ [2 idiomas: +25%] [3 idiomas: +35%]         │           │
│  │ [4 idiomas: +45%] [6 idiomas: +55%]         │           │
│  │ [10 idiomas: +70%]                          │           │
│  └──────────────────────────────────────────────┘           │
│  Seleccionado: [4 idiomas: +45%] ✓                          │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  2️⃣  INTEGRACIÓN ECOMMERCE                                 │
│  Has seleccionado "E-commerce & Pasarela Pago"             │
│  ¿Requiere integración con CRM/ERP?                        │
│                                                              │
│  ○ No integración (solo tienda simple)                     │
│  ● Sí, integración con CRM (Salesforce, HubSpot) +40h      │
│  ○ Sí, integración con ERP (SAP, Oracle) +80h +1.3x       │
│                                                              │
│  Seleccionado: CRM integration (factor 1.2x)               │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  3️⃣  TEAM COORDINATION                                     │
│  Tu equipo disponible: "Grande (7+ personas)"               │
│  ⚠️ Requiere +15% horas coordinación (más reuniones)       │
│  Aplicado automáticamente.                                  │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  [← Atrás] [Siguiente →]                                    │
└──────────────────────────────────────────────────────────────┘
```

**Reglas Condicionales por Servicio**:

**Web/Mobile**:

- Si E-commerce → mostrar pasarela pago + CRM integración
- Si Multiidioma → factor 1.25–1.6x según cantidad
- Si Accesibilidad → factor 1.15x
- Si Performance → factor 1.2x
- Si ASAP (P4) → factor 1.3x

**Enterprise ERP**:

- Si "Módulos" seleccionados → número definido por slider (1–5)
- Cada módulo adicional → +150h base
- Si "Legacy migration" → +50h + 1.2x factor
- Si "Compliance" (GDPR, HIPAA) → +1.3x factor

**Blockchain**:

- Si "Smart Contract Audit" → ⚠️ OBLIGATORIO ($20k fixed cost)
- Si "Multi-chain" → factor 1.6x
- Si "Tokenomics" → +50h especializado
- Avisar: Asesoría legal recomendada (no incluida)

**Juegos**:

- Si "Multiplayer networking" → factor 1.5x
- Si "Multi-platform porting" (Android + iOS + PC) → factor 1.6x
- Si "AI enemigos" → +100h
- Si "Monetización IAP" → +30h

**3D Assets**:

- Si "Rigging + Animación" → x1.8x horas modelado
- Si "Texturing PBR" (photo-realistic) → x1.5x vs estándar
- Si "LOD optimization" → +50h

---

### PASO 5: DETALLES DEL EQUIPO Y NIVEL PROFESIONAL

**Objetivo**: Ajustar tarifas según nivel deseado.

```
┌──────────────────────────────────────────────────────────────┐
│  👥 NIVEL PROFESIONAL DEL EQUIPO                             │
│  Esto afectará directamente el costo final                   │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  ¿Qué nivel de profesional deseas para este proyecto?       │
│                                                              │
│  ┌─────────────────────────────────────────────────────┐   │
│  │                                                     │   │
│  │  ○ JUNIOR  ($12–22 USD/h)                          │   │
│  │     Ideal para: Primeros proyectos, MVPs           │   │
│  │     Requiere: Supervisión constante                │   │
│  │     Timeline: +20% más largo                        │   │
│  │                                                     │   │
│  │  ● MID-LEVEL ($18–35 USD/h)  [RECOMENDADO]        │   │
│  │     Ideal para: Mayoría proyectos                  │   │
│  │     Requiere: Supervisión ocasional                │   │
│  │     Timeline: Estándar                             │   │
│  │                                                     │   │
│  │  ○ SENIOR  ($35–70 USD/h)                          │   │
│  │     Ideal para: Arquitectura crítica, leads        │   │
│  │     Requiere: Mínima supervisión                   │   │
│  │     Timeline: –10% más rápido                      │   │
│  │                                                     │   │
│  │  ○ MIXED   (70% Mid + 30% Senior)                  │   │
│  │     Ideal para: Balance costo-velocidad            │   │
│  │     Requiere: Estructura clara de roles            │   │
│  │                                                     │   │
│  └─────────────────────────────────────────────────────┘   │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  📅 Disponibilidad de Stakeholders                          │
│  Esto permite acelerar decisiones y reduce iterations       │
│                                                              │
│  Disponibilidad:                                            │
│  [━━━━━━░░░] Limitada (≤2h/sem)  |  Parcial (4–8h) │ Disponible │
│  (menos reuniones → más iteraciones)                        │
│                                                              │
│  Seleccionado: Parcial (4–8h/semana) ✓                     │
│  → +10% horas reestimación (cambios por falta feedback)    │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  [← Atrás] [Siguiente: Ver Resumen →]                       │
└──────────────────────────────────────────────────────────────┘
```

**Impactos**:

- Junior: factor 0.8x en horas, 1.2x timeline
- Mid: factor 1.0x (base)
- Senior: factor 1.0x en horas, 0.9x timeline
- Mixed: factor 0.95x en horas

**Disponibilidad**:

- Limitada: +15% horas (más iteraciones)
- Parcial: +10% horas
- Disponible: factor 1.0x (base)

---

### PASO 6: RESUMEN Y CÁLCULO FINAL

**Objetivo**: Mostrar estimación completa, desglose, y opciones descarga/envío.

```
┌──────────────────────────────────────────────────────────────┐
│  📊 RESUMEN DE TU COTIZACIÓN                                 │
│  Desarrollo Web y Móvil — E-commerce con CRM               │
├──────────────────────────────────────────────────────────────┤
│                                                              │
│  💰 ESTIMACIÓN TOTAL                                         │
│  ┌─────────────────────────────────────────┐                │
│  │  Mínimo (sin buffer):  $18,500 USD       │                │
│  │  Con buffer (25%):     $23,125 USD       │                │
│  │  Máximo (buffer+riesgos): $25,000 USD   │                │
│  └─────────────────────────────────────────┘                │
│  ✓ Aún hay margen para cambios scope 15–20%               │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  ⏱️  DURACIÓN ESTIMADA                                      │
│  Horas totales: 450h (con todos multiplicadores)           │
│  Sprints (120h/sprint): 3.75 → 4 sprints                  │
│  Timeline: 8–10 semanas (2 sprints en paralelo posible)   │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  📋 DESGLOSE POR TAREA                                      │
│                                                              │
│  Discovery & Análisis               30h × $23 = $690       │
│  Diseño UI/UX                       50h × $23 = $1,150     │
│  Frontend (responsive + 4 idiomas) 100h × $23 = $2,300     │
│  Backend & API                      95h × $36 = $3,420     │
│  E-commerce Pasarela Pago          70h × $23 = $1,610     │
│  CRM Integration                    45h × $36 = $1,620     │
│  Testing & QA                       40h × $23 = $920       │
│  Deployment & DevOps                25h × $23 = $575       │
│  Seguridad & Encriptación          30h × $36 = $1,080     │
│  Documentación & Training           15h × $23 = $345       │
│  ─────────────────────────────────────────────────────     │
│  SUBTOTAL:                                   $13,710        │
│                                                              │
│  📈 MULTIPLICADORES APLICADOS                               │
│  Multiidioma (4 idiomas):           +45% = +$6,170         │
│  CRM Integration:                   +20% = +$2,742         │
│  Timeline acelerado (< 4 sem):      +15% = +$2,057         │
│  Equipo parcialmente disponible:     +10% = +$1,371        │
│  ─────────────────────────────────────────────────────     │
│  SUBTOTAL CON MULTIPLICADORES:                 $26,050      │
│                                                              │
│  🛡️  BUFFER RECOMENDADO (25%)                               │
│  Por scope creep + cambios mid-proyecto:      +$6,513       │
│  ─────────────────────────────────────────────────────     │
│                                                              │
│  ✅ TOTAL COTIZACIÓN:                    $32,563 USD        │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  ⚠️  ADVERTENCIAS & RECOMENDACIONES                         │
│  • Presupuesto disponible: $50,000 ✓ (dentro de rango)    │
│  • Timeline ASAP puede comprometer calidad (reconsidere)   │
│  • Recomendado: Sprint 0 de discovery ampliado (2 semanas) │
│  • Auditoría de seguridad PCI obligatoria para ecommerce   │
│  • Asesoría legal para políticas privacidad (GDPR ready)   │
│                                                              │
│  ────────────────────────────────────────────────────────  │
│                                                              │
│  📅 ROADMAP RECOMENDADO                                     │
│  │                                                          │
│  └─ Sprint 0 (2 sem): Discovery + Arquitectura              │
│     └─ Sprint 1 (2 sem): Backend + BD + API                │
│        └─ Sprint 2 (2 sem): Frontend + E-commerce         │
│           └─ Sprint 3 (1 sem): Testing + Deployment       │
│                                                              │
│  Puede acelerar a 3 sprints parallelizando (requer. 10ppl) │
│                                                              │
├──────────────────────────────────────────────────────────────┤
│  OPCIONES DE EXPORTACIÓN                                    │
│                                                              │
│  [📄 Descargar PDF] [📋 JSON Técnico] [✉️ Enviar Email]    │
│  [💾 Guardar Borrador] [🔄 Modificar] [✖️ Comenzar Nuevo]   │
│                                                              │
└──────────────────────────────────────────────────────────────┘
```

**Exportaciones disponibles**:

1. **PDF Ejecutivo**:
   - Portada con logo Xlerion
   - Resumen 1 página (estimado, duración, riesgos)
   - Tabla desglose tareas
   - Metodología + timeline visual
   - Términos de referencia

2. **JSON Técnico** (para sistemas):

   ```json
   {
     "quotation_id": "XLR-2026-020-45",
     "service": "desarrollo-web-movil",
     "estimated_hours": 450,
     "base_cost": 13710,
     "multipliers": [
       { "name": "multiidioma_4", "factor": 1.45 },
       { "name": "crm_integration", "factor": 1.20 },
       { "name": "timeline_asap", "factor": 1.15 },
       { "name": "team_availability", "factor": 1.10 }
     ],
     "subtotal_after_multipliers": 26050,
     "buffer_percent": 25,
     "total_estimate": 32563,
     "currency": "USD",
     "duration_sprints": 4,
     "duration_weeks": "8-10",
     "assumptions": [...],
     "risks": [...],
     "generated_at": "2026-02-02T15:30:00Z"
   }
   ```

3. **Email Preparado**:
   - Envía a cliente con link descarga
   - Permite preguntas/aclaraciones

---

## 3. LÓGICA DE VALIDACIÓN Y CONDICIONALES

### Validación Paso a Paso

| Paso | Validación | Mensaje Error | Acción |
|------|-----------|---------------|--------|
| 1 | Seleccionar 1 servicio | "Selecciona un servicio para continuar" | Bloquea Siguiente |
| 2 | Todas 5 preguntas contestadas | "Falta responder pregunta #X" | Highlight rojo pregunta |
| 3 | Mínimo 2 tareas | "Selecciona al menos 2 tareas" | Bloquea Siguiente |
| 3 | Máximo 12 tareas | ⚠️ Advertencia: "Esto es un proyecto muy grande, reconsidere scope" | Permite pero aviso |
| 4 | Tareas condicionales (si aplica) | "Debe responder preguntas condicionales" | Bloquea si sin respuesta |
| 5 | Nivel profesional seleccionado | "Elige un nivel de profesional" | Bloquea Siguiente |
| 5 | Disponibilidad seleccionada | "Indica disponibilidad de stakeholders" | Bloquea Siguiente |

---

## 4. CÁLCULO INTERNO (PSEUDOCÓDIGO)

```javascript
function calculateQuotation(userResponses) {
  
  // PASO 1: Cargar tarifas base por nivel
  const rates = {
    junior: 15,
    mid: 25,
    senior: 50,
    director: 125
  };
  
  // PASO 2: Aplicar respuestas Paso 2 como factores
  let buffer = 0.25; // default
  if (respuestas_paso2.primera_vez === "Sí") buffer += 0.15;
  if (respuestas_paso2.team_size === "Sin equipo") buffer += 0.25;
  if (respuestas_paso2.timeline === "ASAP") multiplicador *= 1.3;
  if (respuestas_paso2.legacy === "Sí") tareas_adicionales += 50;
  
  // PASO 3: Sumar horas de tareas seleccionadas
  let horasBase = 0;
  for (let tarea of tareasSeleccionadas) {
    horasBase += tarea.horas_default;
  }
  
  // PASO 4: Aplicar multiplicadores condicionales
  let multiplicador = 1.0;
  
  if (idiomas > 1) multiplicador *= (1 + (idiomas - 1) * 0.15); // 1.15 per idioma extra
  if (tieneEcommerce && tieneIntegracionCRM) multiplicador *= 1.2;
  if (tieneAccesibilidad) multiplicador *= 1.15;
  if (tienePerformance) multiplicador *= 1.2;
  
  let horasAjustadas = horasBase * multiplicador;
  
  // PASO 5: Aplicar nivel profesional
  let costoSinBuffer = 0;
  if (nivelEquipo === "junior") {
    costoSinBuffer = horasAjustadas * rates.junior;
  } else if (nivelEquipo === "mid") {
    costoSinBuffer = horasAjustadas * rates.mid;
  } else if (nivelEquipo === "senior") {
    costoSinBuffer = horasAjustadas * rates.senior;
  } else if (nivelEquipo === "mixed") {
    // 70% mid, 30% senior
    costoSinBuffer = (horasAjustadas * 0.7 * rates.mid) + (horasAjustadas * 0.3 * rates.senior);
  }
  
  // PASO 6: Aplicar buffer
  let costoFinal = costoSinBuffer * (1 + buffer);
  
  // AGREGAR COSTOS FIJOS (blockchain audit, etc.)
  costoFinal += costosFijos;
  
  // CALCULAR DURACIÓN
  let sprintsRequeridos = Math.ceil(horasAjustadas / 120);
  let semanasEstimadas = sprintsRequeridos * 2;
  if (multiplicador > 1.2) semanasEstimadas += 2; // buffer tiempo
  
  return {
    horasBase,
    horasAjustadas,
    costoSinBuffer,
    buffer: costoSinBuffer * buffer,
    costoFinal,
    sprintsRequeridos,
    semanasEstimadas,
    detalles: {
      multiplicadores: [...],
      advertencias: [...]
    }
  };
}
```

---

## 5. FLUJO DE NAVEGACIÓN Y BOTONES

```
┌─────────────────────────────┐
│   INICIO                    │
│  [Bienvenida + Servicio]   │
└────────────┬────────────────┘
             │
             ├─ [Siguiente] → Paso 2
             └─ [← Atrás] → Inicio sitio

┌─────────────────────────────┐
│   PASO 2                    │
│  [5 Preguntas Iniciales]   │
└────────────┬────────────────┘
             │
             ├─ [Siguiente] → Paso 3 (si validación OK)
             └─ [← Atrás] → Paso 1

┌─────────────────────────────┐
│   PASO 3                    │
│  [Seleccionar Tareas]      │
└────────────┬────────────────┘
             │
             ├─ [Siguiente] → Paso 4 (si validación OK)
             ├─ [← Atrás] → Paso 2
             └─ [Cargar ejemplo] → Pre-llena tareas (opcional)

┌─────────────────────────────┐
│   PASO 4                    │
│  [Preguntas Condicionales] │
└────────────┬────────────────┘
             │
             ├─ [Siguiente] → Paso 5 (si validación OK)
             └─ [← Atrás] → Paso 3

┌─────────────────────────────┐
│   PASO 5                    │
│  [Equipo & Nivel]          │
└────────────┬────────────────┘
             │
             ├─ [Ver Resumen] → Paso 6
             └─ [← Atrás] → Paso 4

┌──────────────────────────────┐
│   PASO 6                     │
│  [Resumen + Exportación]    │
└────────────┬─────────────────┘
             │
             ├─ [Descargar PDF] → descarga PDF
             ├─ [JSON Técnico] → descarga JSON
             ├─ [Enviar Email] → abre formulario email
             ├─ [Modificar] → Vuelve a Paso 1 (con datos guardados)
             ├─ [Nuevo Cotizador] → Resetea todo
             └─ [Contactar a Ventas] → CTA a mailto: ventas@xlerion.com
```

---

## 6. CASOS DE USO Y FLUJOS ESPECÍFICOS

### Caso: Usuario selecciona E-commerce

```
PASO 1: Selecciona "Desarrollo Web y Móvil"
  ↓
PASO 2: Contesta 5 preguntas (ej: "Sí" a legacy = tienda actual)
  ↓
PASO 3: Sistema detalla TAREAS AUTOMÁTICAS:
  ✓ Discovery (pre-marcado)
  ✓ Design (pre-marcado)
  ✓ Frontend (pre-marcado)
  ✓ Backend (pre-marcado)
  ✓ Testing (pre-marcado)
  ✓ E-commerce & Pasarela Pago (OBLIGATORIO, aparece)
  ☐ Multiidioma (opcional)
  ☐ Seguridad Avanzada (recomendada)
  
  Aviso: "Has seleccionado E-commerce. Se requiere auditoría PCI compliance (+$3,000)"
  ↓
PASO 4: Preguntas condicionales específicas E-commerce:
  • "¿Integración con CRM?" → Agrega tareas backend
  • "¿Multiidioma?" → Multiplicador
  • "¿Pasarela de pago específica?" → Stripe/Mercado Pago/PayPal → diferente complejidad
  ↓
PASO 5: Seleccionar nivel equipo
  ↓
PASO 6: RESULTADO
  Muestra: Estimado, desglose, ADVERTENCIA "PCI Compliance requerida"
           Roadmap con fases Backend → E-commerce → Testing
```

### Caso: Usuario selecciona Blockchain

```
PASO 1: Selecciona "Blockchain"
  ↓
PASO 2: Contesta preguntas (ej: "Presupuesto alto", "No legacy")
  ↓
PASO 3: TAREAS AUTOMÁTICAS:
  ✓ Tokenomics Design (pre-marcado)
  ✓ Smart Contract Design (pre-marcado)
  ✓ Smart Contract Development (pre-marcado)
  ✓ Internal Audit (pre-marcado)
  ✓ External Audit (OBLIGATORIO, no desactivable)
  ☐ Testnet Deployment
  ☐ Mainnet Deployment
  ☐ Multi-chain Support
  
  ADVERTENCIA: "Auditoría externa obligatoria: +$20,000 (costo fijo, tercero independiente)"
  ↓
PASO 4: Preguntas condicionales Blockchain:
  • "¿Cuántas blockchains?" (Ethereum / Polygon / Arbitrum / etc.) → Multiplicador 1.6x
  • "¿Requiere Auditoría Adicional?" → Adicional lawyer review
  • "¿Tokenomics complexity?" → Slider (simple 1x, moderada 1.3x, compleja 1.6x)
  
  ✅ BANDERA: Asesoría legal recomendada (no incluida)
  ↓
PASO 5: Seleccionar nivel (senior recomendado para blockchain)
  ↓
PASO 6: RESULTADO
  Muestra: $67,755–$91,469 (incluyendo $20k audit fijo)
           "⚠️ Requiere asesoría legal. Recomiende LinkedIn: abogados blockchain Colombia"
           Roadmap de 10–12 semanas
```

---

## 7. ESTADOS VISUALES Y DISEÑO

### Paleta de Colores (De Xlerion)

- **Primario**: #00e9fa (cyan) — Botones activos, bordes selección
- **Secundario**: #333436 (dark gray) — Textos, fondos
- **Fondo**: #000000 (black)
- **Texto**: #FFFFFF (white)
- **Success**: #00FF00 (verde) — Validaciones OK
- **Warning**: #FFA500 (naranja) — Advertencias
- **Error**: #FF0000 (rojo) — Errores validación

### Componentes Reutilizables

- **CardServicio**: Tarjeta seleccionable (8 para paso 1)
- **TareaCheckbox**: Checkbox con descripción + horas + multiplicadores
- **PreguntaRadio**: Radio buttons con descripciones
- **SliderAvailability**: Slider para disponibilidad
- **ResumenCosto**: Widget lado derecho con cálculo real-time
- **AdvertenciaBox**: Alertas y recomendaciones

---

## 8. COMPORTAMIENTO REAL-TIME

Durante Paso 3–6, mientras usuario selecciona tareas y responde preguntas:

**RIGHT SIDEBAR (Siempre visible)**:

```
┌──────────────────┐
│ 📊 ESTIMACIÓN    │
│ EN TIEMPO REAL   │
├──────────────────┤
│ Horas: 450h      │
│ Costo: $32.5k    │
│ Duración: 4 spr. │
│ Buffer: 25%      │
│                  │
│ [Multiplicadores]│
│ · Multiidioma    │
│   +45%           │
│ · CRM            │
│   +20%           │
│ · Timeline       │
│   +15%           │
│                  │
│ Rango: $26–33k   │
└──────────────────┘
```

**Actualiza en VIVO cuando**:

- Usuario agrega/quita tarea
- Selecciona multiplicador condicional (ej: cuántos idiomas)
- Cambia nivel equipo
- Ajusta disponibilidad

---

## 9. ACCESIBILIDAD Y RESPONSIVE

- **Mobile**: Paso a paso en vertical, sidebar oculto (expandible)
- **Tablet**: 2 columnas (tarea + sidebar)
- **Desktop**: 3 columnas (nav left + tareas center + sidebar right)
- **WCAG AA**: Labels explícitos, focus visible, navegación keyboard
- **i18n**: Todo traducible (ES/EN integrado con LanguageContext.jsx)

---

**Documento creado**: Febrero 2, 2026
**Próximo paso**: Implementar componentes React basados en este flow.
