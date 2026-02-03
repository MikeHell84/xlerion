# PLAN DE CALIBRACIÓN - Motor v2.0

**Proceso mensual para mejorar precisión y eliminar subestimaciones**

Febrero 2026

---

## 📊 VISIÓN GENERAL

El Motor v2.0 lanza con **estimaciones conservadoras** (+44% a +559% vs v1.0).

**Objetivo de calibración**: Ajustar mensualmente para alcanzar **Índice Precisión (IP) ≥95%** en mes 6.

---

## FASE 1: MEDICIÓN (Semana posterior a cierre proyecto)

### Qué recopilar

Para **cada proyecto completado**, registrar:

```csv
proyecto_id, servicio, cliente, fecha_inicio, fecha_cierre, 
discovery_h_est, discovery_h_real, 
design_h_est, design_h_real,
frontend_h_est, frontend_h_real,
backend_h_est, backend_h_real,
testing_h_est, testing_h_real,
deployment_h_est, deployment_h_real,
[otras_tareas...],
horas_totales_est, horas_totales_real,
costo_cotizado, costo_real,
cambios_scope_percent,
equipo_seniority_usado,
integraciones_reales,
notas_desviacion
```

### Plantilla Excel/Google Sheets

**Crear tabla con columnas**:

| proyecto_id | servicio | fecha_cierre | tarea | est_h | real_h | variación_% | causa |
|---|---|---|---|---|---|---|---|
| XLR-2026-001 | web | 2026-02-14 | discovery | 20 | 22 | +10% | Stakeholders múltiples |
| XLR-2026-001 | web | 2026-02-14 | frontend | 80 | 95 | +19% | Responsive más complejo |
| XLR-2026-001 | web | 2026-02-14 | backend | 100 | 105 | +5% | Integración API más simple |
| XLR-2026-001 | web | 2026-02-14 | testing | 40 | 52 | +30% | ❌ DESVIACIÓN ALTA |
| XLR-2026-002 | erp | 2026-02-20 | data_modeling | 55 | 48 | -13% | Modelo legacy claro |
| XLR-2026-002 | erp | 2026-02-20 | migración | 75 | 110 | +47% | ❌ DATOS MÁS COMPLEJOS |

### Entrada de datos

**Responsable**: Project Manager o Tech Lead

**Cadencia**: Dentro de 5 días hábiles post-cierre

**Sistema de entrada**:

- Google Form → Google Sheets (automático)
- O Excel compartido con validaciones

### Validaciones en tiempo real

```
IF real_h < est_h * 0.5 THEN highlight green (subestimado mucho, oportunidad)
IF real_h > est_h * 1.3 THEN highlight red (sobreestimado, necesita ajuste)
IF variación_% > 30% THEN flag para análisis root cause
```

---

## FASE 2: ANÁLISIS (Penúltima semana del mes)

### Paso 1: Calcular Índice Precisión (IP)

**Fórmula**:

```
IP = 100% - (|variación_promedio_ponderada|)

Donde:
variación_promedio = AVERAGE(|real_h - est_h| / est_h) para todos proyectos mes
```

**Ejemplo Mes 1 (4 proyectos)**:

| Proyecto | Servicio | est_h | real_h | variación | |variación| |
|---|---|---|---|---|---|
| XLR-001 | web | 190 | 210 | +10% | 10% |
| XLR-002 | erp | 650 | 745 | +15% | 15% |
| XLR-003 | blockchain | 400 | 380 | -5% | 5% |
| XLR-004 | 3d_assets | 300 | 325 | +8% | 8% |
| **PROMEDIO** | — | — | — | +7% | **9.5%** |

**IP Mes 1** = 100% - 9.5% = **90.5%** ✅ (Meta mes 1: ≥90%)

---

### Paso 2: Análisis por dimensión

**Por servicio**:

```
Servicio       | # proyectos | variación_promedio | IP    | Status
Web/Mobile     | 2           | +8%                | 92%   | ✅ OK
ERP            | 1           | +15%               | 85%   | ⚠️ Revisar
Blockchain     | 1           | -5%                | 105%  | ✅ OK (subestimado bien)
3D Assets      | 1           | +8%                | 92%   | ✅ OK
```

**Por tarea** (consolidado):

```
Tarea          | est_h_total | real_h_total | variación | causa probable
Discovery      | 120 | 130 | +8% | Stakeholder interviews más extensas
Design         | 95  | 105 | +11% | Design iterations
Frontend       | 180 | 210 | +17% | ⚠️ INVESTIGAR
Backend        | 250 | 260 | +4%  | OK
Testing        | 120 | 175 | +46% | ❌ CRÍTICA - Testing subestimado
Deployment     | 40  | 42  | +5%  | OK
```

**Por equipo usado**:

```
Level          | est_h | real_h | variación | observación
Junior         | 50    | 48     | -4%       | Produjeron más rápido
Mid            | 200   | 210    | +5%       | Normal
Senior         | 300   | 320    | +7%       | Lideraron complejos
```

---

### Paso 3: Root Cause Analysis (RCA)

Para **cada desviación > 15%**, investigar:

**Template RCA**:

```
DESVIACIÓN: Testing +46% (120h est → 175h real)

SÍNTOMAS:
- 1 proyecto: XLR-002 (ERP 3 módulos)
- Testing planeado 40h, real 65h (+63%)
- Todos otros tests normales

CAUSAS RAÍCES (investigar con QA Lead):
1. ❌ No estimamos testing de integración ERP-legacy (25h no previstos)
2. ❌ Regresión manual en 3 módulos requiere validación exhaustiva
3. ❌ Datos de prueba complejos (5M registros) = setup testing lento

EVIDENCIA:
- Chat Slack: "Legacy data setup fue 10h más de lo planeado"
- Test report: 65h en testing (40h planeados)

RECOMENDACIÓN:
→ Agregar "Testing datos legacy" como subtarea en ERP
→ Multiplicador +1.3x si integración legacy
→ Minimum_hours testing ERP: 50h (no 40h)

IMPACT FORECAST:
→ Próximos ERP: +7h testing automático
→ IP mejorará a 91-93% cuando aplicado
```

---

### Paso 4: Varianza por servicio (análisis estad)

**Calcular desviación estándar**:

```
Servicio | # datos | promedio | σ (desv std) | coeff var | Estabilidad
Web      | 5       | +8%      | 3%           | 38%       | ✅ Estable
ERP      | 2       | +12%     | 5%           | 42%       | ⚠️ Media
3D       | 3       | +15%     | 8%           | 53%       | 🔴 Inestable
```

**Interpretación**:

- σ < 5% = Estimaciones muy precisas
- σ 5-10% = Precisión normal
- σ > 10% = Varianza alta, necesita revisión

---

## FASE 3: AJUSTES (Primera semana del mes siguiente)

### Paso 1: Proponer cambios

**Para cada desviación significativa** (>15%), llenar tabla:

| Origen problema | Cambio propuesto | Aplicar a | Versión | Impacto estimado |
|---|---|---|---|---|
| Testing +46% | Aumentar testing horas base 40→50h | Tarea testing Web | 2.1 | +2.5% cotizaciones |
| Testing +46% | Agregar multiplier "legacy_testing" x1.3 | Tarea testing ERP | 2.1 | +3% cotizaciones ERP |
| Frontend +17% | Aumentar frontend 80→95h base | Tarea frontend Web | 2.1 | +1.8% cotizaciones |
| Multiidioma incierto | Aumentar multiplicador 1.25→1.30 | Global multiplier | 2.1 | +4% cotizaciones multiidioma |

### Paso 2: Aprobación

**Requerida aprobación de**:

- ✅ CTO (cambios técnicos)
- ✅ Product Manager (impacto competitivo)
- ✅ Sales Lead (repercusión precio cliente)

**Criterios aprobación**:

1. Cambio basado en ≥3 proyectos reales (no anecdótico)
2. Impacto < 10% en precio promedio (evitar shocks)
3. Nueva estimación realista (not conservative overcorrection)

### Paso 3: Implementar cambios

1. **Crear nueva versión JSON**:

```json
{
  "version": "2.1",
  "date": "2026-03-01",
  "changes_from_v2.0": [
    {
      "id": "testing_hours_increase",
      "service": "desarrollo-web-movil",
      "task": "testing",
      "change": "hours_range.typical: 40 → 50",
      "reason": "Real data shows +30% variance in testing, adding buffer",
      "impact_percent": 2.5
    },
    {
      "id": "legacy_testing_multiplier",
      "service": "desarrollo-erp",
      "change": "Add multiplier legacy_testing factor 1.3",
      "reason": "Testing legacy data systems 46% higher than estimated",
      "impact_percent": 3.0
    }
  ]
}
```

1. **Comunicar a equipos**:

```
ESTIMACIÓN ENGINE v2.1 DISPONIBLE

Cambios realizados (basados en 4 proyectos reales, mes 1):
✅ Testing horas aumentadas +10h (experiencia real)
✅ Nuevo multiplicador para testing legacy (x1.3)
✅ Buffer automático mantenido +15%

Impacto precio promedio: +2.7%

Vigente desde: 2026-03-01
```

1. **Deploy a producción**:

```bash
# Backend: cargar nueva versión JSON
cp ESTIMATION_ENGINE_v2.1.json data/templates/latest.json

# API recargar templates
curl -X POST http://api.xlerion.com/admin/reload-templates

# Validación
curl http://api.xlerion.com/api/templates | grep "version"
# Respuesta: "version": "2.1" ✅
```

1. **Archivar versión anterior**:

```
ESTIMATION_ENGINE_v2.0_ARCHIVED_2026-03-01.json
```

---

## CRONOGRAMA MENSUAL

| Fase | Semana | Tarea | Dueño | Duración |
|------|--------|-------|-------|----------|
| **MEDICIÓN** | Sem 1 | Recopilar horas reales proyectos | PM/Tech Lead | Continuo |
| | Sem 2 | Consolidar datos en sheet | PM | 1h |
| **ANÁLISIS** | Sem 3 | Calcular IP, análisis por dimensión | Data Analyst | 2h |
| | Sem 3 | Root cause analysis desviaciones > 15% | CTO/Tech Lead | 2h |
| | Sem 4 | Reunión calibración (revisar hallazgos) | CTO + PM + Sales | 1h |
| **AJUSTES** | Sem 1 (mes+1) | Proponer cambios, aprobación | CTO + PM | 1h |
| | Sem 1 (mes+1) | Implementar versión nueva JSON | Backend Dev | 1h |
| | Sem 2 (mes+1) | Deploy a producción | DevOps | 30m |
| | Sem 2 (mes+1) | Comunicar cambios a equipo ventas | Product | 30m |
| | Sem 3 (mes+1) | Validar cambios con 3 cotizaciones test | PM | 1h |

**Total dedicación mensual**: 9.5 horas ≈ 1 día

---

## MÉTRICAS DE ÉXITO

### Índice Precisión (IP) - Meta principal

| Periodo | Meta | Cómo se calcula | Consecuencia si falla |
|---------|------|---|---|
| Mes 1-3 | IP ≥ 90% | 100% - \|variación promedio\| | Aumentar buffers |
| Mes 4-6 | IP ≥ 93% | Same formula | Revisar multiplicadores |
| Mes 6+ | IP ≥ 95% | Same formula | Considerar motor v3 |

### Métricas secundarias

| Métrica | Fórmula | Meta | Acción si falla |
|---------|---------|------|---|
| % Proyectos subestimados | # (real > est × 1.2) / total | < 20% | Aumentar buffers +5% |
| % Proyectos sobreestimados | # (real < est × 0.8) / total | < 20% | Reducir multiplicadores |
| Coefficient of variation (σ) | std dev / mean | < 10% | Revisar tarea específica |
| Ratio presupuestos aceptados | # ganados / # presentados | > 35% | Revisar competitividad |
| Lead time estimación | Días promedio propuesta → cliente | < 2 días | Revisar proceso cotización |

---

## EJEMPLOS DE CAMBIOS ESPERADOS

### Mes 1 → Mes 2 (Ajustes v2.0 → v2.1)

**Desviaciones detectadas**:

- Testing +46% (ERP)
- Frontend +17% (Web con animaciones complejas)
- Multiidioma +25% (no 20%)

**Cambios propuestos**:

```
Tarea testing:
  - Horas base: 40h → 50h (+25%)
  
Multiplicador legacy_testing:
  - Nuevo: factor 1.3
  - Aplica si: integración legacy
  
Multiplicador multiidioma:
  - Antes: 1.25x (1.2x por idioma)
  - Después: 1.30x (1.25x por idioma)
```

**Resultado IP**:

- Mes 1: 90.5% (✅ pasó meta 90%)
- Mes 2: 91.8% (con v2.1, +1.3 puntos)

---

### Mes 3 → Mes 4 (Ajustes v2.1 → v2.2)

**Desviaciones detectadas**:

- Blockchain auditoría externa +$20k (no previsto en v2.0)
- 3D rigging cloth simulation +100% vs estimado
- ERP migración datos +50% vs estimado

**Cambios propuestos**:

```
Servicio blockchain:
  - Fixed cost: Auditoría +$25k (promedio)
  
Tarea rigging:
  - Multiplicador cloth_simulation: 2.0x (no 1.5x)
  
Servicio ERP:
  - Tarea data_migration: horas base 75h → 100h
  - Multiplicador data_complexity: 1.6x (no 1.5x)
```

**Resultado IP**:

- Mes 3: 91.2%
- Mes 4: 93.5% (✅ pasó meta 93%)

---

### Mes 6+ (Estabilización v2.2 → v2.3)

**Desviaciones detectadas**:

- Pocas (IP ≥ 93%)
- Fine-tuning solo en tareas específicas

**Cambios propuestos**:

- Ajustes incrementales (<5%)
- Revisión anual de multiplicadores globales

**Resultado IP**:

- Mes 6: 94.8%
- Mes 12: 96.2% (✅ pasó meta 95%)

---

## HERRAMIENTAS RECOMENDADAS

| Herramienta | Función | Costo |
|---|---|---|
| Google Sheets | Entrada datos, análisis básico | Gratis |
| Google Data Studio | Dashboard IP, gráficos | Gratis |
| Tableau / Looker | Dashboard avanzado (opcional) | $70-150/mes |
| Jira / Azure DevOps | Tracking horas reales | Existente |

### Setup recomendado

1. **Google Form** (entrada de datos fácil)
   - Preguntas: proyecto_id, servicio, tarea, est_h, real_h, causa desviación
   - Auto-populate Google Sheets

2. **Google Sheets** (análisis y cálculos)
   - Columnas: todas las del form + variación % + IP

3. **Google Data Studio** (dashboard)
   - Gráfico IP mensual (línea)
   - Gráfico varianza por servicio (barra)
   - Tabla desviaciones > 15%

---

## COMUNICACIÓN MENSUAL

### Reunión calibración (última semana mes, 1 hora)

**Participantes**: CTO, Product Manager, Sales Lead, Data Analyst

**Agenda**:

1. IP mes actual vs meta (5 min)
2. Desviaciones top 3 (15 min)
3. Root causes (10 min)
4. Cambios propuestos para próximo mes (20 min)
5. Aprobaciones y next steps (10 min)

**Documento de salida**: Tabla cambios aprobados, versión nueva JSON

### Comunicación a equipos (inicio mes siguiente)

**Email a ventas + PM**:

```
Asunto: Motor Estimación v2.1 - Cambios Mes 1

Equipos,

Basados en 4 proyectos reales (mes 1), hemos calibrado Motor v2.0 → v2.1.

CAMBIOS:
✅ Testing horas +10h (experiencia real)
✅ Multiplicador legacy_testing x1.3 (para ERP con datos antiguos)
✅ Multiidioma 1.25x → 1.30x (4 idiomas más realista)

IMPACTO PRECIO:
- Web promedio: +2.5%
- ERP promedio: +4.2%
- Blockchain: sin cambio
- Overalll: +2.7%

Vigente desde: 2026-03-01

Preguntas: @cto_lead

—Equipo Estimación
```

---

## PLAN A LARGO PLAZO

| Hito | Fecha | Meta IP | Acciones |
|------|-------|---------|----------|
| v2.0 Launch | 2026-02-02 | — | Baseline |
| v2.1 (Mes 1) | 2026-03-01 | 90%+ | Testing, legacy, multiidioma |
| v2.2 (Mes 2) | 2026-04-01 | 91%+ | Blockchain audit, 3D rigging |
| v2.3 (Mes 3) | 2026-05-01 | 92%+ | Fine-tuning |
| v2.4 (Mes 4) | 2026-06-01 | 93%+ | Evaluación estabilidad |
| v2.5 (Mes 5) | 2026-07-01 | 94%+ | Anticipación v3 |
| v3.0 (Mes 6+) | 2026-09-01 | 95%+ | Revisión completa, nuevas tareas |

---

## RECOMENDACIÓN FINAL

✅ **Implementar ahora**:

1. Crear Google Form entrada datos
2. Configurar Google Sheets template
3. Reunión kickoff con equipos (explicar proceso)

⚠️ **Evitar**:

- Cambios sin data (decisiones anecdóticas)
- Actualizaciones > 10% impacto precio sin aprobación
- Ignorar IP si es < 85% (señal de alerta roja)

📊 **Monitorear activamente**:

- IP semanal (trending)
- Desviaciones por tarea (monthly)
- Feedback cliente (post-proyecto)
