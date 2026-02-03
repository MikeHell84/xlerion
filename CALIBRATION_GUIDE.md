# Guía de Calibración - Motor de Estimación Xlerion

**Mantener precisión de estimados sobre el tiempo**  
Febrero 2, 2026

---

## PROPÓSITO

La **calibración** es el proceso continuo de ajustar nuestro motor de estimación basándose en datos reales de proyectos ejecutados. Evita que las estimaciones se desvíen de la realidad y permite mejorar año a año.

---

## MARCO TEÓRICO: LA CURVA DE APRENDIZAJE

```
Precisión de estimados (%)
│
100├───────────────────────→ Target (±10%)
   │                        
80 │        ╱╲
   │      ╱    ╲
   │    ╱        ╲______→ Estable (con calibración)
60 │  ╱                     (sin calibración: → 40%)
   │
40 │─────────────────────→ Sin calibración (oscilar)
   │
   └────────────────────────────── time (meses)
     0   3    6    12   18   24
```

**Meta**: Alcanzar ±10% de variación (real vs estimado) en 6 meses.

---

## 3 PASOS DE CALIBRACIÓN

### PASO 1: MEDICIÓN (BASELINE)

**Timeframe**: Después de cada proyecto completado  
**Responsable**: Project Manager + Equipo técnico

#### 1.1 Recopilar datos reales

Para cada proyecto ejecutado, completar:

```json
{
  "proyecto_id": "XLR-2026-001",
  "fecha_inicio": "2026-01-15",
  "fecha_fin": "2026-03-20",
  "servicio": "desarrollo-web-movil",
  
  "datos_estimacion_original": {
    "horas_estimadas": 450,
    "costo_estimado": 32563,
    "fecha_estimacion": "2026-01-10",
    "nivel_equipo": "mid",
    "multiplicadores": [
      { "name": "multiidioma_4", "factor": 1.45 },
      { "name": "crm_integration", "factor": 1.20 },
      { "name": "timeline_asap", "factor": 1.15 }
    ]
  },
  
  "datos_reales_ejecucion": {
    "horas_reales": 480,
    "costo_real": 34500,
    "fecha_entrega_actual": "2026-03-20",
    "cambios_scope": [
      {
        "id": 1,
        "descripcion": "Agregar filtros avanzados a búsqueda",
        "horas_adicionales": 30,
        "fecha": "2026-02-15"
      }
    ],
    "causas_desviacion": [
      "Cambio scope mid-proyecto: +30h",
      "Integración CRM más compleja de lo esperado: +15h",
      "Testing extenso descubrió bugs: +10h"
    ]
  },
  
  "analisis": {
    "variacion_horas": 480 / 450,  // 1.067 = +6.7%
    "variacion_costo": 34500 / 32563,  // 1.059 = +5.9%
    "variacion_timeline": "0 days (on-time)",
    "causa_principal": "scope creep",
    "causa_secundaria": "integración más difícil",
    "imprevisto": false
  },
  
  "lecciones_aprendidas": [
    "Integración CRM de terceros requiere +20% tiempo en discovery",
    "Filtros avanzados necesitan 2 rondas de optimización (no 1)",
    "Testing multiplataforma (4 idiomas) requiere +15h de testing"
  ],
  
  "ajustes_propuestos": [
    {
      "tipo": "task",
      "tarea": "crm_integration",
      "ajuste_horas": "+20% (de 45h → 54h)",
      "razon": "Experiencia proyecto actual"
    }
  ]
}
```

#### 1.2 Registrar en base de datos de calibración

**Base de datos CSV / Tabla**:

```
proyecto_id | servicio | horas_est | horas_real | var_% | costo_est | costo_real | var_% | nivel_equipo | scope_change | fecha
XLR-2026-001 | web | 450 | 480 | 6.7% | $32.5k | $34.5k | 5.9% | mid | +30h | 2026-03-20
XLR-2026-002 | blockchain | 370 | 410 | 10.8% | $47.7k | $52.9k | 10.9% | senior | -10h | 2026-03-15
XLR-2026-003 | erp | 785 | 720 | -8.3% | $32.3k | $29.6k | -8.3% | mixed | -50h | 2026-02-28
...
```

#### 1.3 Calcular desviación estándar

```python
# Pseudocódigo en Python

import numpy as np

variaciones_horas = [6.7, 10.8, -8.3, 2.1, 5.5, ...]  # % de cada proyecto
variaciones_costo = [5.9, 10.9, -8.3, 1.8, 4.2, ...]

promedio_desviacion = np.mean(variaciones_horas)  # e.g. 2.5%
desv_estandar = np.std(variaciones_horas)  # e.g. 8.1%

# META: promedio < ±3%, std < 5%
# ACTUAL (mes 1): promedio 2.5%, std 8.1% → Ajustar multiplicadores
```

---

### PASO 2: ANÁLISIS DE VARIANZA

**Timeframe**: Mensual (al cierre de cada mes con ≥3 proyectos completados)  
**Responsable**: CTO + Product Manager

#### 2.1 Estratificar por factor

Agrupar variaciones por:

- **Servicio** (Web, ERP, Blockchain, etc.)
- **Nivel equipo** (Junior, Mid, Senior)
- **Multiplicador aplicado** (Multiidioma sí/no, E-commerce sí/no)
- **Causa raíz** (Scope creep, integración, testing, otro)

**Tabla de análisis**:

```
SERVICIO: Desarrollo Web y Móvil
┌─────────────┬────────┬─────────┬──────────┐
│ Subfactor   │ Casos  │ Var %   │ Tendencia│
├─────────────┼────────┼─────────┼──────────┤
│ Sin E-comm  │   5    │  +2.3%  │ ✓ OK    │
│ Con E-comm  │   7    │  +8.1%  │ ⚠️ Alto  │
│ Multiidioma │   3    │  +12.4% │ ⚠️ Alto  │
│ Sin Multi   │   9    │  +1.5%  │ ✓ OK    │
│ Mid-level   │   8    │  +3.2%  │ ✓ OK    │
│ Senior      │   4    │  +6.8%  │ ⚠️ Mod  │
└─────────────┴────────┴─────────┴──────────┘

SERVICIO: Software Empresarial
┌─────────────┬────────┬─────────┬──────────┐
│ ERP 1 mod   │   2    │  -5.2%  │ ✓ OK    │
│ ERP 2–3 mod │   4    │  +12.1% │ ⚠️ Alto  │
│ ERP 4+ mod  │   2    │  +15.3% │ ⚠️ Alto  │
│ Legacy mig  │   3    │  +22.0% │ ⚠️⚠️ Crítico│
└─────────────┴────────┴─────────┴──────────┘
```

#### 2.2 Identificar patrones

**Preguntas clave**:

- ¿Qué multiplicadores sistemáticamente subestiман?
- ¿Qué servicios tienden a excederse?
- ¿Hay diferencia por nivel equipo?
- ¿Causa principal de desvíos: scope creep, integración, testing, otro?

**Ejemplo de hallazgo**:

```
HALLAZGO: "Web + Multiidioma → +12.4% promedio"

Análisis:
- Tareas base: 450h
- Con multiidioma 1.45x: 652h estimadas
- Real promedio: 728h (+12.4%)

Causa: Testing QA requiere +75h adicionales para validar
todos idiomas. Fórmula multiidioma no cubre testing
multiplicado.

Recomendación: Ajustar multiplicador de 1.45x a 1.55x,
o agregar tarea "testing_multiidioma: +20h"
```

#### 2.3 Calcular índice de precisión

```
Índice de Precisión (IP) = 100% - |promedio de variaciones|

Ejemplo:
Proyectos mes 1: +6.7%, +10.8%, -8.3%, +2.1%
Promedio: (+6.7 + 10.8 - 8.3 + 2.1) / 4 = 2.825%
IP = 100% - 2.8% = 97.2% ✓ EXCELENTE

Target mensuales:
- Mes 1–3: IP ≥ 90% (en proceso)
- Mes 4–6: IP ≥ 93% (bueno)
- Mes 6+: IP ≥ 95% (excelente, <±5%)
```

---

### PASO 3: AJUSTES Y ROLLOUT

**Timeframe**: Cada 30 días o cuando desviación > ±10% en subfactor  
**Responsable**: CTO (aprobación), Product Manager (implementación)

#### 3.1 Tipos de ajustes

| Tipo | Ejemplo | Impacto |
|------|---------|--------|
| **Task hours** | CRM integration: 45h → 54h (+20%) | Directo en estimado |
| **Multiplicador** | Multiidioma: 1.45x → 1.55x | Cascada a todos proyectos |
| **Buffer** | Web buffer: 25% → 30% | Rango mín-máx se ensancha |
| **Nuevo factor** | Testing multiidioma: +20h | Nueva variable condicional |
| **Descontinuar** | Legacy migration factor | Elimina multiplicador obsoleto |

#### 3.2 Proceso de aprobación

```
PASO 1: CTO propone ajuste
├─ Cambio: "Blockchain audit hours: 60h → 80h"
├─ Justificación: "Últimos 2 audits tomaron 75h promedio"
├─ Impacto: "+$2k por proyecto blockchain"
└─ Riesgo: "Bajo (proyectos blockchain = 1–2/mes)"

PASO 2: Product Manager revisa
├─ ¿Hay suficiente data? (mín. 3 proyectos con factor)
├─ ¿Impacto en ventas / pricing? (¿sube precio?)
└─ ¿Comunicación a stakeholders?

PASO 3: Aprobación
├─ ✓ Aprobado: Implementar inmediatamente
├─ ✓ Aprobado con cambios: Modificar ajuste
└─ ✗ Rechazado: Recopilar más data

PASO 4: Implementar
├─ Actualizar SERVICES_ESTIMATION_TEMPLATES.json
├─ Versionar cambio (v1.0 → v1.1)
├─ Comunicar a equipo ventas
├─ Log en CALIBRATION_HISTORY.md
└─ Notificar clientes activos (si aplica)
```

#### 3.3 Cambios típicos (primera calibración)

**MES 1 (Proyectos iniciales completados)**:

```json
{
  "version": "1.0",
  "ajustes_mes1": [
    {
      "id": "A-001",
      "factor": "desarrollo-web-movil.tareas.crm_integration.horas",
      "cambio": "45h → 54h",
      "razon": "Integración CRM tomó promedio 54h, no 45h",
      "proyectos_referencia": ["XLR-2026-001"],
      "aprobado_por": "CTO",
      "fecha": "2026-03-30",
      "impacto_pricing": "+$207 por proyecto con CRM"
    },
    {
      "id": "A-002",
      "factor": "desarrollo-web-movil.multiplicadores.multiidioma",
      "cambio": "1.45x → 1.55x",
      "razon": "Testing multiidioma agrega 12% horas sin prever",
      "proyectos_referencia": ["XLR-2026-001", "XLR-2026-004"],
      "aprobado_por": "CTO",
      "fecha": "2026-03-30",
      "impacto_pricing": "+$800–$2k por proyecto multiidioma"
    }
  ]
}
```

#### 3.4 Template de cambio (para documentación)

**Archivo**: `CALIBRATION_ADJUSTMENT_LOG.md`

```markdown
# Calibration Adjustment Log

## Ajuste A-003
**Fecha**: 2026-04-15  
**Versión Motor**: 1.1 → 1.2  
**Responsable**: CTO Juan Pérez  

### Hallazgo
Blockchain projects con auditoría externa subestiman tiempo de coordinación
con auditor tercero. Promedio real: 20h coordinación (no incluida en 60h
internal audit).

### Cambio Propuesto
```json
{
  "servicio": "blockchain",
  "tarea": "external_audit_coordination",
  "horas_nuevas": 20,
  "tipo": "addition",
  "aplica_cuando": "tieneExternalAudit === true",
  "multiplicador_relacionado": null,
  "costo_adicional": "$2,000 USD (20h × $100/h auditor)"
}
```

### Impacto

- Proyectos con audit: +20h (+3% en total), +$2k en costo
- Proyectos sin audit: Sin cambio
- Afecta: ~1 proyecto/mes

### Proyectos Referencia

- XLR-2026-006 (Blockchain PoC audit): 370h estimadas → 390h reales
- XLR-2026-009 (Blockchain testnet): Similar desviación

### Aprobación

- ✓ Aprobado por: CTO + PM
- Fecha implementación: 2026-04-20
- Comunicado a: Equipo ventas (email), clientes activos (no)

---

```

---

## MÉTRICAS DE ÉXITO

### Por Fase de Calibración

| Métrica | Meta Mes 1–3 | Meta Mes 4–6 | Meta Mes 6+ |
|---------|-------------|-------------|-----------|
| **Precisión promedio** | ±8% | ±5% | ±3% |
| **Desviación estándar** | < 12% | < 8% | < 5% |
| **Proyectos on-budget** | 60% | 75% | 85% |
| **Ajustes por mes** | 2–3 | 1–2 | < 1 |
| **IP (Índice Precisión)** | > 90% | > 93% | > 95% |

### Dashboard (Mensual)

```

DASHBOARD DE CALIBRACIÓN - Febrero 2026

┌─────────────────────────────────────┐
│ Proyectos Completados: 4            │
│ Promedio Variación: +2.8%           │
│ Desv. Estándar: 8.1%                │
│ Índice Precisión: 97.2% ✓ BUENO    │
└─────────────────────────────────────┘

POR SERVICIO:
┌──────────────────┬──────┬──────┬─────┐
│ Servicio         │ IP % │ Casos│ Tend│
├──────────────────┼──────┼──────┼─────┤
│ Web              │ 94.1 │  3   │ ↑   │
│ Blockchain       │ 89.2 │  1   │ ✓   │
│ ERP              │ 87.9 │  1   │ ⚠️  │
│ Branding         │ 98.5 │  1   │ ✓   │
└──────────────────┴──────┴──────┴─────┘

AJUSTES PENDIENTES:
□ ERP modules horas (esperando +1 proyecto)
□ Blockchain audit coordination (+20h) → A-003 ✓ Aprobado

```

---

## CASO PRÁCTICO: CALIBRACIÓN MES 1

### Escenario
Después de 4 proyectos completados en enero-febrero:

**Datos reales**:
1. **XLR-2026-001** (Web E-commerce): Est. 450h, Real 480h (+6.7%)
2. **XLR-2026-002** (Blockchain PoC): Est. 370h, Real 410h (+10.8%)
3. **XLR-2026-003** (ERP 3 módulos): Est. 785h, Real 720h (-8.3%)
4. **XLR-2026-004** (Branding): Est. 328h, Real 332h (+1.2%)

### Análisis

**Paso 1: Medición**
```

Variaciones: +6.7%, +10.8%, -8.3%, +1.2%
Promedio: +2.6%
Desv. Estándar: 8.6%
IP: 97.4%

```

**Paso 2: Análisis**

*Por subfactor*:
- **E-commerce** (1 proyecto): +6.7% → Posible
- **Blockchain audit** (1 proyecto): +10.8% → Posible
- **ERP 3 módulos** (1 proyecto): -8.3% → Brecha baja
- **Branding simple** (1 proyecto): +1.2% → Excelente

*Causa raíz*:
- XLR-01: E-commerce → +30h scope creep (cambios cliente)
- XLR-02: Blockchain → Auditoría más exhaustiva (expectativa cliente)
- XLR-03: ERP → Estimación conservadora (buffer ayudó)
- XLR-04: Branding → Estimación precisa ✓

### Paso 3: Recomendaciones

**Ajuste 1**: CRM integration horas (45h → 54h)
- Justificación: XLR-01 necesitó integración CRM más compleja
- Impacto: Web projects con CRM +$207
- Aprobación: ✓ Sí (datos limitados pero tendencia clara)

**Ajuste 2**: No hacer cambios Blockchain aún
- Justificación: Solo 1 proyecto; esperar 2–3 más
- Riesgo: Si siguiente proyecto también +10%, entonces ajustar

**Ajuste 3**: Revisar ERP horas (785 estimado vs 720 real)
- Nota: ¿Por qué fue 8% más corto? ¿Equipo muy eficiente o estimación inflada?
- Acción: Revisar logs proyecto XLR-03, considerar reducción futura
- Esperar: Siguiente ERP project para confirmar patrón

### Resultado: Versión 1.1 motor

```json
{
  "version": "1.0 → 1.1",
  "fecha": "2026-03-30",
  "ajustes": [
    {
      "id": "A-001",
      "servicio": "desarrollo-web-movil",
      "cambio": "crm_integration: 45h → 54h",
      "razon": "XLR-2026-001 precisó 54h real"
    }
  ],
  "pendiente": [
    {
      "servicio": "blockchain",
      "motivo": "Esperar n≥2 proyectos antes ajuste"
    },
    {
      "servicio": "software-empresarial",
      "motivo": "Revisar por qué ERP fue -8.3%"
    }
  ]
}
```

---

## HERRAMIENTAS Y AUTOMATIZACIÓN

### 1. Spreadsheet (Simple, inicial)

**Google Sheets / Excel**:

- Columnas: proyecto_id, servicio, horas_est, horas_real, var%, costo_est, costo_real, var%, nivel, scope_change, fecha
- Gráficos: Scatter plot (estimado vs real), Histograma variaciones, Tendencia por servicio
- Fórmulas: STDEV, AVERAGE, VARIANCE

### 2. Dashboard (Mediano plazo)

**Herramienta**: Metabase / Looker / Tableau

- Métrica principal: IP (Índice Precisión)
- Filtros: Por servicio, por mes, por nivel equipo
- Alertas: Si IP < 90% o variación > ±15%

### 3. Pipeline automatizado (Largo plazo)

```
Proyecto completado → 
  PM completa formulario (horas real, scope changes) →
    Sistema calcula variación automáticamente →
      Alertas si > ±10% →
        CTO revisa y propone ajuste →
          Aprobación automática (si data suficiente) →
            JSON template actualizado automáticamente →
              Notificación a equipo
```

---

## COMUNICACIÓN Y CHANGE MANAGEMENT

### A equipo interno

- **Cuándo**: Fin de cada mes o cuando ajuste >= $1k impacto
- **Formato**: Email + actualización changelog
- **Destinatarios**: Equipo ventas, project managers, CTO

### A clientes activos

- **Cuándo**: Solo si precio sube significativamente (≥5%)
- **Formato**: Email personalizado + explicitación mejora
- **Mensaje**: "Basado en aprendizajes, estimación es ahora más precisa"

### A prospectos

- **Cuándo**: Automático (ver página cotizador)
- **Versión**: Siempre versión más reciente del motor

---

## FRECUENCIA Y DUEÑOS

| Actividad | Frecuencia | Responsable | Tiempo |
|-----------|-----------|-------------|--------|
| Recopilar datos proyecto | Cada entrega | PM | 30 min |
| Análisis mensual | Mes | CTO + PM | 2h |
| Proponer ajustes | Mensual (si aplica) | CTO | 1h |
| Aprobación | Mensual (si aplica) | PM + Founder | 30 min |
| Implementar cambios | Inmediato post-aprobación | Dev (JSON update) | 15 min |
| Comunicar | Inmediato post-implementación | PM | 30 min |
| Dashboard review | Trimestral | Leadership | 1h |

---

## RESUMEN: ROADMAP DE CALIBRACIÓN (PRIMEROS 6 MESES)

```
ENERO–FEBRERO
└─ Ejecutar 4–5 proyectos iniciales, recopilar data cruda

MARZO (MES 1)
├─ Análisis primera calibración
├─ Ajustes version 1.1 (2–3 cambios esperados)
└─ IP esperado: 92–95%

ABRIL–MAYO (MESES 2–3)
├─ Ejecutar 6–8 proyectos, continuar recopilación
├─ Análisis mensual refinado
├─ Ajustes version 1.2–1.3 (2–3 cambios/mes)
└─ IP esperado: 93–96%

JUNIO (MES 4+)
├─ Dashboard en producción
├─ Motor estabilizado (IP > 95%)
├─ Revisión trimestral
└─ Optimizaciones por servicio/nivel
```

---

**Documento creado**: Febrero 2, 2026  
**Próxima revisión**: Marzo 30, 2026 (post primer mes datos)
