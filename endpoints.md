# Endpoints sugeridos y payloads / Suggested endpoints and payloads

## ES

### Endpoints

- `GET /api/roadmaps/templates` → lista de plantillas
- `GET /api/roadmaps/templates/{id}` → plantilla específica
- `POST /api/roadmaps/generate` → genera roadmap personalizado
- `POST /api/roadmaps/validate` → valida parámetros + dependencias
- `GET /api/roadmaps/cases` → ejemplos de casos
- `POST /api/roadmaps/admin/update-template` → actualizar plantilla (admin)

### Payloads de ejemplo

**Generate**

```json
{
  "template_id": "web_ecommerce",
  "language": "es",
  "parameters": {
    "num_products": 300,
    "payment_gateways": 1,
    "inventory_sync": true,
    "multi_language": 1,
    "requirements_complete": false
  },
  "scope": "Standard",
  "team": [
    {"role": "PM", "allocation_percent": 20},
    {"role": "Frontend Dev", "allocation_percent": 60},
    {"role": "Backend Dev", "allocation_percent": 40},
    {"role": "QA", "allocation_percent": 30}
  ]
}
```

**Validate**

```json
{
  "template_id": "erp_custom",
  "parameters": {
    "modules": 3,
    "legacy_migration": true,
    "integrations": 2,
    "requirements_complete": false
  }
}
```

**Admin update**

```json
{
  "template_id": "web_landing",
  "patch": {
    "typical_duration": {"small": {"weeks": "2-3"}},
    "buffers": {"change_requests": "20-30%"}
  }
}
```

---

## EN

### Endpoints

- `GET /api/roadmaps/templates` → template list
- `GET /api/roadmaps/templates/{id}` → specific template
- `POST /api/roadmaps/generate` → generate personalized roadmap
- `POST /api/roadmaps/validate` → validate parameters + dependencies
- `GET /api/roadmaps/cases` → example cases
- `POST /api/roadmaps/admin/update-template` → update template (admin)

### Example payloads

**Generate**

```json
{
  "template_id": "web_ecommerce",
  "language": "en",
  "parameters": {
    "num_products": 300,
    "payment_gateways": 1,
    "inventory_sync": true,
    "multi_language": 1,
    "requirements_complete": false
  },
  "scope": "Standard",
  "team": [
    {"role": "PM", "allocation_percent": 20},
    {"role": "Frontend Dev", "allocation_percent": 60},
    {"role": "Backend Dev", "allocation_percent": 40},
    {"role": "QA", "allocation_percent": 30}
  ]
}
```

**Validate**

```json
{
  "template_id": "erp_custom",
  "parameters": {
    "modules": 3,
    "legacy_migration": true,
    "integrations": 2,
    "requirements_complete": false
  }
}
```

**Admin update**

```json
{
  "template_id": "web_landing",
  "patch": {
    "typical_duration": {"small": {"weeks": "2-3"}},
    "buffers": {"change_requests": "20-30%"}
  }
}
```
