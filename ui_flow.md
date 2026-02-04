# UI Flow — Cotizador de Roadmaps (ES / EN)

## ES — Flujo y validaciones

**Objetivo**: Selección de servicio → subservicio → plantilla → ajuste de alcance → equipo → generación de roadmap personalizado.

### Pasos

1. **Seleccionar servicio**
2. **Seleccionar subservicio**
3. **Cargar plantilla base**
4. **Completar parámetros obligatorios**
5. **Elegir alcance** (MVP / Estándar / Completo)
6. **Asignar equipo y capacidad** (roles + % dedicación)
7. **Generar roadmap** (sprints, hitos, buffers)
8. **Revisión y edición** (admin no técnico)
9. **Exportar** (JSON / PDF / enlace)

### Preguntas condicionales (ejemplos)

- Web: ¿número de páginas? ¿idiomas? ¿CMS? ¿integraciones?
- E‑commerce: ¿número de productos? ¿pasarelas? ¿sincronización inventario?
- Apps: ¿plataformas? ¿modo offline? ¿integraciones?
- ERP/CRM: ¿módulos? ¿migración legacy? ¿integraciones?
- Blockchain: ¿número de contratos? ¿auditoría? ¿oráculos?
- Videojuegos: ¿multiplayer? ¿número de niveles? ¿plataformas?
- 3D: ¿número de assets? ¿nivel de polígonos? ¿número de animaciones?

### Validaciones obligatorias

- **Discovery obligatorio** si `requirements_complete == false`.
- Todos los sprints deben incluir **≥1 entregable** y **≥1 criterio de aceptación**.
- Dependencias: no se permite un sprint que dependa de entregables no planificados.
- La suma de duraciones de sprints debe coincidir con `typical_duration ± buffer`.

### JSON del flujo (ES/EN)

```json
{
  "steps": [
    {
      "id": "service",
      "label": {"es": "Seleccionar servicio", "en": "Select service"},
      "required": true
    },
    {
      "id": "subservice",
      "label": {"es": "Seleccionar subservicio", "en": "Select subservice"},
      "required": true,
      "depends_on": "service"
    },
    {
      "id": "template",
      "label": {"es": "Cargar plantilla", "en": "Load template"},
      "required": true
    },
    {
      "id": "parameters",
      "label": {"es": "Completar parámetros", "en": "Fill parameters"},
      "required": true,
      "validation": [
        {"rule": "all_required_parameters_present", "message": {"es": "Faltan parámetros obligatorios", "en": "Missing required parameters"}}
      ]
    },
    {
      "id": "scope",
      "label": {"es": "Definir alcance", "en": "Define scope"},
      "options": ["MVP", "Standard", "Complete"],
      "required": true
    },
    {
      "id": "team",
      "label": {"es": "Asignar equipo", "en": "Assign team"},
      "required": true
    },
    {
      "id": "generate",
      "label": {"es": "Generar roadmap", "en": "Generate roadmap"},
      "required": true
    },
    {
      "id": "review",
      "label": {"es": "Revisar y editar", "en": "Review & edit"},
      "required": false
    },
    {
      "id": "export",
      "label": {"es": "Exportar", "en": "Export"},
      "required": false
    }
  ],
  "conditional_questions": [
    {
      "when": "subservice == 'web_ecommerce'",
      "ask": ["num_products", "payment_gateways", "inventory_sync"]
    },
    {
      "when": "subservice == 'web_hybrid_apps'",
      "ask": ["platforms", "offline_mode", "integrations"]
    },
    {
      "when": "subservice == 'smart_contracts'",
      "ask": ["num_contracts", "audit_required"]
    },
    {
      "when": "subservice == 'character_assets_pipeline'",
      "ask": ["num_assets", "poly_level", "num_animations"]
    }
  ],
  "forced_rules": [
    {
      "rule": "if requirements_complete == false then add_sprint('S0')",
      "message": {"es": "Se agregó Sprint 0 (Discovery)", "en": "Sprint 0 (Discovery) added"}
    }
  ]
}
```

---

## EN — Flow and validations

**Goal**: Select service → subservice → template → scope → team → generate personalized roadmap.

### Steps

1. **Select service**
2. **Select subservice**
3. **Load base template**
4. **Complete required parameters**
5. **Choose scope** (MVP / Standard / Complete)
6. **Assign team & capacity** (roles + % allocation)
7. **Generate roadmap** (sprints, milestones, buffers)
8. **Review and edit** (non‑technical admin)
9. **Export** (JSON / PDF / link)

### Conditional questions (examples)

- Web: number of pages? languages? CMS? integrations?
- E‑commerce: product count? gateways? inventory sync?
- Apps: platforms? offline mode? integrations?
- ERP/CRM: modules? legacy migration? integrations?
- Blockchain: contracts? audit? oracles?
- Games: multiplayer? number of levels? platforms?
- 3D: assets? poly level? animations?

### Required validations

- **Discovery required** if `requirements_complete == false`.
- Every sprint must include **≥1 deliverable** and **≥1 acceptance criterion**.
- Dependencies: a sprint cannot depend on a deliverable not planned.
- Sum of sprint durations must match `typical_duration ± buffer`.
