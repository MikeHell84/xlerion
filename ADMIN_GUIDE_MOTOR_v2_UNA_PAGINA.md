# GUÍA DE ADMINISTRADOR - Motor v2.0

**Cómo ajustar estimaciones sin necesidad de programador**

Febrero 2026

---

## 📋 QUICK REFERENCE

| Acción | Dónde | Cómo | Impacto |
|--------|-------|------|--------|
| Cambiar tarifa por hora | `ESTIMATION_ENGINE_v2_IMPROVED.json` → `base_tariff_range` | Editar min/typical/max | Inmediato en todas cotizaciones |
| Cambiar horas tarea | Same JSON → `tasks[].hours_range` | Editar min/typical/max | Tarea específica |
| Agregar multiplicador | Same JSON → `tasks[].multipliers[]` | Insertar objeto nuevo | Aplicable a tarea |
| Cambiar buffer | Same JSON → `buffer_rules` | Editar `automatic_minimum` | Todas cotizaciones |
| Agregar mínimo obligatorio | Same JSON → `tasks[].minimum_hours` | Asignar número | Se fuerza automáticamente |
| Crear sanity check | Same JSON → `sanity_checks[]` | Insertar nueva regla | Detecta anomalías |

---

## 1️⃣ AJUSTAR TARIFAS BASE POR HORA

### Dónde buscar en JSON

```json
{
  "services": [
    {
      "id": "desarrollo-web-movil",
      "base_tariff_range": {
        "junior": { "min": 12, "max": 18, "typical": 15, "currency": "USD/hora" },
        "mid": { "min": 18, "max": 28, "typical": 23, "currency": "USD/hora" },
        "senior": { "min": 28, "max": 45, "typical": 36, "currency": "USD/hora" },
        "architect": { "min": 45, "max": 70, "typical": 57, "currency": "USD/hora" }
      }
    }
  ]
}
```

### Cómo cambiar

**Si tu mercado paga distinto**:

1. Abre `ESTIMATION_ENGINE_v2_IMPROVED.json` en editor (VS Code, Notepad++, etc)
2. Busca servicio (`desarrollo-web-movil`, `desarrollo-erp`, etc)
3. Edita `base_tariff_range`
4. Guarda archivo
5. Reinicia API backend (cambio automático)

### Ejemplo: Si mercado paga 25% más para Senior Web

```json
"senior": { "min": 35, "max": 56.25, "typical": 45, "currency": "USD/hora" }
```

✅ **Impacto**: Todas cotizaciones web senior subirán 25%

---

## 2️⃣ CAMBIAR HORAS ESTIMADAS POR TAREA

### Caso: "El testing siempre toma más de lo estimado"

1. Busca tarea `testing` en servicio web:

```json
"tasks": [
  {
    "id": "testing",
    "name": "Testing (QA Automatizado + Manual)",
    "hours_range": { "min": 20, "max": 80, "typical": 40 }
  }
]
```

1. Si datos reales muestran testing = 50h típico (no 40h):

```json
"hours_range": { "min": 25, "max": 100, "typical": 50 }
```

1. Guarda y reinicia backend

✅ **Impacto**: Todas cotizaciones incluirán +10h testing automáticamente

---

## 3️⃣ AGREGAR O MODIFICAR MULTIPLICADORES

### Caso: "Integraciones son más complejas que lo modelado"

**Ubicación en JSON** (dentro task Backend):

```json
"multipliers": [
  {
    "variable": "num_integrations",
    "label": "Integraciones externas (cada una)",
    "formula": "base + (integrations * 20)",
    "min": 0,
    "max": 10
  }
]
```

### Si en realidad cada integración = +30h (no 20h)

```json
"formula": "base + (integrations * 30)"
```

### Si deseas agregar nuevo multiplicador (ej. "Testing tiempo real")

```json
{
  "variable": "realtime_testing",
  "label": "Testing de sistemas realtime",
  "factor": 1.35,
  "explanation": "Requiere QA especializado en timing crítico"
}
```

✅ **Impacto**: Próximas cotizaciones con feature "realtime" aplicarán x1.35 automáticamente

---

## 4️⃣ CAMBIAR BUFFERS (Márgenes de seguridad)

### Ubicación

```json
"buffer_rules": {
  "automatic_minimum": 0.15,  // +15% siempre
  "explanation": "Buffer mínimo automático +15% en todas las cotizaciones",
  "additional_buffer_if": [
    {
      "condition": "incomplete_requirements",
      "additional_percent": 0.20,
      "explanation": "Si faltan campos requeridos o hay incertidumbre alta"
    }
  ]
}
```

### Si tu equipo pide buffer +20% (no 15%)

```json
"automatic_minimum": 0.20
```

### Si discovery incompleta requiere +30% (no 20%)

```json
{
  "condition": "incomplete_requirements",
  "additional_percent": 0.30
}
```

✅ **Impacto**: Buffer automático se aplicará a todas cotizaciones nuevas

---

## 5️⃣ AGREGAR CAMPOS OBLIGATORIOS

### Caso: "Necesitamos saber número de integraciones ANTES de cotizar"

```json
"required_fields": [
  {
    "field": "num_integrations",
    "label": "Número de integraciones externas (APIs)",
    "validation": "number",
    "min": 0,
    "max": 20,
    "explanation": "Cada integración: análisis + implementación + testing"
  }
]
```

✅ **Impacto**: UI mostrará popup "Por favor, especifique número de integraciones"

---

## 6️⃣ CREAR O MODIFICAR SANITY CHECKS

### Ubicación

```json
"sanity_checks": [
  {
    "name": "Subestimación potencial",
    "rule": "if estimated_hours < 0.4 * historical_average",
    "action": "flag_as_high_risk",
    "message": "Estimado es 40% menor que proyectos similares..."
  }
]
```

### Caso: "Queremos alerta si estimado es < 35% (no 40%) promedio"

```json
"rule": "if estimated_hours < 0.35 * historical_average"
```

### Agregar nuevo check (ej. "Alerta si multiplicador > 2.5")

```json
{
  "name": "Multiplicador muy alto",
  "rule": "if accumulated_multiplier > 2.5",
  "action": "warn_and_recommend_discovery",
  "message": "Multiplicadores acumulativos muy altos. Recomendamos dividir proyecto o hacer discovery profunda antes de comprometer."
}
```

✅ **Impacto**: Sistema mostrará advertencias automáticas en cotizador

---

## 7️⃣ CREAR NUEVAS TAREAS

### Si descubrimos tarea faltante (ej. "Accesibilidad WCAG")

1. Busca sección `tasks` de servicio
2. Inserta nuevo objeto:

```json
{
  "id": "accessibility",
  "name": "Accesibilidad WCAG AA",
  "hours_range": { "min": 15, "max": 40, "typical": 25 },
  "minimum_hours": 10,
  "default_level": "mid",
  "description": "Auditoría WCAG, fixes, testing lector pantalla",
  "subtasks": [
    { "name": "Auditoría WCAG inicial", "hours": "5-10" },
    { "name": "Implementación fixes", "hours": "8-20" },
    { "name": "Testing lector pantalla (NVDA, JAWS)", "hours": "5-10" }
  ],
  "multipliers": [
    {
      "variable": "complex_interactions",
      "label": "Interacciones complejas (mapas, gráficos)",
      "factor": 1.25
    }
  ]
}
```

✅ **Impacto**: Nueva tarea disponible en cotizador para seleccionar

---

## 8️⃣ VERSIONADO Y CONTROL DE CAMBIOS

### Cómo versionar cambios (IMPORTANTE)

1. **Antes de editar**, copia archivo:

```
ESTIMATION_ENGINE_v2_IMPROVED.json 
→ ESTIMATION_ENGINE_v2.1_AJUSTADA_[FECHA].json
```

1. **Cambia versión en JSON**:

```json
{
  "version": "2.1",
  "date": "2026-02-15",
  "changes": [
    "Aumentado buffer testing +5% (experiencia real)",
    "Agregado campo 'num_integraciones' obligatorio",
    "Ajustado multiplicador multiidioma 1.25x → 1.30x"
  ]
}
```

1. **Documenta en Excel** (tracking):

| Versión | Fecha | Cambio | Razón | Quién | Impacto % |
|---------|-------|--------|-------|-------|-----------|
| 2.0 | 2026-02-02 | Versión inicial mejorada | Reducir subestimaciones | Equipo | — |
| 2.1 | 2026-02-15 | Buffer testing +5% | Datos reales muestran +5% necesario | QA Lead | +2% promedio cotizaciones |
| 2.2 | 2026-03-01 | Multiidioma 1.30x | 4 idiomas reales toma 30% (no 25%) | Product | +3% promedio |

✅ **Ventaja**: Puedes rollback a versión anterior si cambio crea problema

---

## 9️⃣ DASHBOARD DE MONITOREO

**Métricas a trackear mensualmente**:

| Métrica | Cálculo | Meta v2.0 | Acción si falla |
|---------|---------|-----------|-----------------|
| Precision Index (PI) | 100% - \|variación promedio\| | ≥90% mes 1, ≥95% mes 6 | Ajustar multiplicadores |
| % Proyectos subestimados | # proyectos reales > estimado / total | <20% | Aumentar buffers/mínimos |
| % Proyectos sobreestimados | # proyectos reales < estimado / total | <20% | Reducir multiplicadores |
| Horas por rol (análisis) | Agrupar horas reales por rol | Benchmarking | Validar desglose por rol |
| Tasa cotizaciones aceptadas | # presupuestos ganados / # presentados | >35% | Revisar competitividad |
| Tiempo medio por tarea | Suma horas reales / # tareas completadas | Validar | Fine-tune horas base |

---

## 🔟 TROUBLESHOOTING RÁPIDO

| Problema | Síntoma | Solución |
|----------|---------|----------|
| Cotizaciones demasiado bajas | Cliente rechaza presupuesto | Aumentar buffer (+5%), revisar multiplicadores |
| Cotizaciones demasiado altas | Perdemos licitaciones | Reducir buffer (-5%), eliminar multiplicadores redundantes |
| Tarifa inconsistente | Mismo servicio, precios diferentes | Revisar `base_tariff_range` tiene errores de tipeo |
| Tarea no aparece en cotizador | Usuario no puede seleccionar | Verificar `tasks[].id` sea único, JSON bien formado |
| Multiplicador no aplica | Feature seleccionada pero sin aumento | Confirmar `applies_if` condición sea verdadera en contexto |
| Sanity check no funciona | No alerta cuando debería | Validar `rule` sintaxis, `historical_average` cargado |

---

## 1️⃣1️⃣ PROCESO MENSUAL RECOMENDADO

**1. Recopilación (1 semana después proyecto finalizado)**:

- Horas reales por tarea
- Tamaño equipo usado (junior/mid/senior)
- Cambios scope (si aplica)
- Desviación estimado vs real

**2. Análisis (último viernes del mes, 2h)**:

- Calcular Precision Index
- Agrupar por servicio/tarea
- Identificar patrones

**3. Ajuste (inicio mes siguiente, 1h)**:

- Cambios necesarios en JSON
- Crear versión nueva
- Comunicar a equipo ventas

**4. Validación (1 semana)**:

- Ejecutar 3 cotizaciones de prueba
- Confirmar cambios aplicados
- Monitorear feedback clientes

---

## 🎯 RECOMENDACIONES OPERATIVAS

✅ **HACER**:

- Editar JSON directamente (cambios operativos rápidos)
- Versionar cambios (control de cambios)
- Documentar razón de cada ajuste
- Revisar Precision Index mensualmente
- Comunicar cambios a equipo ventas

❌ **NO HACER**:

- Cambiar multiplicador sin evidencia (datos reales)
- Borrar tareas existentes sin análisis
- Ignorar sanity checks (son canarios)
- Aplicar buffers arbitrarios sin documentación
- Mantener versión obsoleta en producción

---

**Próximos pasos**:

1. Copia `ESTIMATION_ENGINE_v2_IMPROVED.json` a sistema de admins
2. Abre acceso de lectura-escritura a Product Manager + CTO
3. Setup dashboard de monitoreo (Google Sheets / Tableau)
4. Realiza primera ronda calibración en mes 1
