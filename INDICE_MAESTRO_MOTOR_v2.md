# 📑 ÍNDICE MAESTRO - MOTOR DE ESTIMACIÓN v2.0

**Guía de navegación por documento, rol y tema**

Febrero 2, 2026

---

## 🎯 INICIO RÁPIDO (3 MINUTOS)

**¿Qué es Motor v2.0?**  
Sistema mejorado para calcular presupuestos realistas, evitando subestimaciones del 40-1700%.

**¿Por qué?**  
v1.0 causaba:

- Landing $2,200 subestimado
- ERP $133,000 pérdida
- Blockchain $96,000 no capturado
- Assets 3D $384,775 inviable

**v2.0 soluciona**: Desglose granular + multiplicadores reales + buffers inteligentes + calibración mensual

**¿Cuánto cambian los presupuestos?**  

- Landing: +44% ($4,968 → $7,187)
- ERP: +559% ($23,760 → $156,788)
- 3D Assets: +1,711% ($22,500 → $407,275)
- **Promedio**: +537%

**¿Cuánto tiempo implementar?**  
6 semanas para MVP, luego 4-7 horas/mes calibración

---

## 👥 GUÍA POR ROL

### 1️⃣ FOUNDER / C-LEVEL (2 horas)

**¿Quiero entender qué es?**

Lectura recomendada (orden):

1. Este índice (5 min)
2. `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` — Visión, números, timeline (45 min)
3. `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` — 6 casos reales (1 hora)
4. `MOTOR_v2_RESUMEN_ENTREGABLES.md` — Checklist final (15 min)

**Decisiones clave**:

- ✅ Aprobar presupuesto estimado (+44-1711%)
- ✅ Comprometer 6 semanas equipo
- ✅ Asignar 4-7h/mes calibración continua
- ✅ Aceptar que presupuestos subirán pero serán realistas

---

### 2️⃣ PRODUCT MANAGER / SALES (1.5 horas)

**¿Quiero vender con confianza?**

Lectura recomendada:

1. `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` — Entender casos reales (1 hora)
2. `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` (sección "Administrador") — Cómo funciona (20 min)
3. `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` (sección "Ventajas para clientes") — Argumentos (10 min)

**Habilidades clave**:

- Explicar desglose a cliente ("Testing es +30% por multiidioma")
- Justificar aumentos vs v1.0 ("PCI compliance obligatoria")
- Usar rango mín-máx ("$35k-45k, depende scope")
- Documento "supuestos" transparentes

**Responsabilidades**:

- Aprobación cambios a presupuestos (mensual)
- Feedback de clientes post-proyecto
- Insumo para RCA (qué salió diferente)

---

### 3️⃣ CTO / ARCHITECT (5 horas)

**Quiero implementar y validar arquitectura**

Lectura recomendada (orden):

1. `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` — Plan 6 semanas (1 hora)
2. `ESTIMATION_ENGINE_v2_IMPROVED.json` — Especificación JSON (1.5 horas)
3. `PLAN_CALIBRACION_DETALLADO_v2.md` — Proceso mejora (1 hora)
4. `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` — Operaciones (1 hora)
5. `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` — Validación (1 hora)

**Responsabilidades**:

- Liderar implementación backend + DB
- Aprobación cambios versiones
- Auditoría sanity checks
- Validación presupuestos altos

---

### 4️⃣ BACKEND DEVELOPER (3 horas)

**¿Quiero codificar el motor?**

Lectura recomendada:

1. `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` (sección "Plan implementación") (30 min)
2. `ESTIMATION_ENGINE_v2_IMPROVED.json` — Especificación (1.5 horas)
3. `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` — Schema editable (1 hora)

**Tareas Semana 2-3**:

- [ ] DB schema (4 tablas)
- [ ] API 6 endpoints
- [ ] Cargar JSON v2.0
- [ ] Sanity checks

**Preguntas frecuentes**:

- "¿Cómo calculo horas?" → Ver JSON sección `tasks[].hours_range`
- "¿Cómo aplico multiplicadores?" → Ver sección `global_multipliers`
- "¿Qué validaciones?" → Ver sección `sanity_checks`

---

### 5️⃣ FRONTEND DEVELOPER (2.5 horas)

**¿Quiero construir UI cotizador?**

Lectura recomendada:

1. `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` (sección "Plan implementación") (30 min)
2. `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` (sección "Campos obligatorios") (30 min)
3. `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` (para ver flujo esperado) (1 hora)

**Tareas Semana 4-5**:

- [ ] 6 componentes pasos
- [ ] Real-time calculation sidebar
- [ ] Exportación PDF/JSON
- [ ] Validaciones

---

### 6️⃣ QA / DATA ANALYST (2 horas)

**¿Quiero validar y calibrar?**

Lectura recomendada:

1. `PLAN_CALIBRACION_DETALLADO_v2.md` — Proceso 3 fases (1.5 horas)
2. `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` — Casos validación (30 min)

**Tareas Mensual**:

- [ ] Recopilar horas reales (plantilla Excel)
- [ ] Calcular IP
- [ ] RCA desviaciones > 15%
- [ ] Proponer cambios

---

## 📖 GUÍA POR TEMA

### 💰 "¿Cuánto cambian los presupuestos?"

| Pregunta | Respuesta | Documento |
|----------|-----------|-----------|
| Ejemplos con números | 6 casos reales, antes/después | `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` |
| Breakdown detallado landing | Horas, multiplicadores, buffers | Same, Caso 1 |
| Breakdown detallado ERP | Migración datos, compliance | Same, Caso 4 |
| Breakdown 3D assets | Cloth simulation exponencial | Same, Caso 6 |

---

### 🔧 "¿Cómo implemento?"

| Pregunta | Respuesta | Documento |
|----------|-----------|-----------|
| Plan 6 semanas | Semana a semana | `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` sección Plan Implementación |
| Tareas backend | DB + endpoints | Same, sección Semana 2-3 |
| Tareas frontend | UI + integration | Same, sección Semana 4-5 |
| Checklist go-live | Validaciones pre-producción | `MOTOR_v2_RESUMEN_ENTREGABLES.md` sección Checklist |

---

### 📊 "¿Cómo ajusto presupuestos después?"

| Pregunta | Respuesta | Documento |
|----------|-----------|-----------|
| Cambiar tarifa/hora | JSON sección base_tariff_range | `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` sección 1 |
| Cambiar horas tarea | JSON sección tasks.hours_range | Same sección 2 |
| Agregar multiplicador | JSON sección multipliers | Same sección 3 |
| Cambiar buffer | JSON sección buffer_rules | Same sección 4 |
| Agregar campo obligatorio | JSON sección required_fields | Same sección 5 |
| Versionado | Copia + cambiar versión | Same sección 7 |

---

### 📈 "¿Cómo mejoro precisión mes a mes?"

| Pregunta | Respuesta | Documento |
|----------|-----------|-----------|
| Fases calibración | Medición → Análisis → Ajustes | `PLAN_CALIBRACION_DETALLADO_v2.md` |
| Recopilar datos | Plantilla Excel/Google Form | Same sección Fase 1 |
| Calcular Índice Precisión | Fórmula + ejemplo | Same sección Fase 2 |
| Root Cause Analysis | Template RCA | Same sección Fase 2 paso 3 |
| Proponer cambios | Tabla con impacto | Same sección Fase 3 |
| KPIs a monitorear | IP, desviación, aceptación | Same sección Métricas |

---

### ⚠️ "¿Qué riesgos hay?"

| Pregunta | Respuesta | Documento |
|----------|-----------|-----------|
| Clientes rechazan presupuestos altos | Educación, opciones scope | `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` sección Riesgos |
| IP < 85% mes 1 | Volver v1.0, revisar supuestos | Same |
| Cambios no se aplican | Validar JSON syntax | `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` sección Troubleshooting |
| Calibración no realizada | Automatizar, hacer obligatorio | `PLAN_CALIBRACION_DETALLADO_v2.md` sección Cronograma |

---

## 📋 MATRIZ DE DOCUMENTOS

| Documento | Líneas | Audiencia | Tiempo | Propósito |
|-----------|--------|-----------|--------|-----------|
| Este ÍNDICE | 500 | Todos | 5-10 min | Navegación rápida |
| **DOCUMENTO EJECUTIVO** | 900 | Founders, Team leads | 45 min | Visión, plan, KPIs |
| **RESUMEN ENTREGABLES** | 600 | Team leads, Admin | 30 min | Checklist, overview |
| **JSON v2.0 IMPROVED** | 2,847 | Backend, CTO | 2-3h | Especificación técnica |
| **EJEMPLOS CALIBRADOS** | 1,200 | PM, Sales, CTO | 1-2h | Validación 6 casos |
| **ADMIN GUIDE** | 650 | PM, Admin | 30 min | Operaciones diarias |
| **PLAN CALIBRACIÓN** | 1,100 | CTO, Data Analyst | 1.5h | Mejora continua |
| **TOTAL** | **7,697 líneas** | **Integral** | **5-8h total** | **v2.0 Completo** |

---

## 🔍 BÚSQUEDA RÁPIDA

**Busco**: ¿Cómo implemento en 6 semanas?  
→ `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` sección "Plan de Implementación"

**Busco**: Ejemplo detallado landing page  
→ `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` sección "Caso 1"

**Busco**: Cómo cambiar tarifas sin programador  
→ `ADMIN_GUIDE_MOTOR_v2_UNA_PAGINA.md` sección 1

**Busco**: Métricas a monitorear  
→ `PLAN_CALIBRACION_DETALLADO_v2.md` sección "Métricas de Éxito"

**Busco**: Especificación técnica completa  
→ `ESTIMATION_ENGINE_v2_IMPROVED.json` (léer todo)

**Busco**: Desviación 3D assets, por qué +1,711%?  
→ `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` sección "Caso 6"

**Busco**: Riesgos implementación  
→ `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` sección "Riesgos y Mitigaciones"

**Busco**: Cómo aprobar cambios de presupuesto  
→ `PLAN_CALIBRACION_DETALLADO_v2.md` sección "Paso 2: Aprobación"

---

## 📅 CRONOGRAMA RECOMENDADO

### ESTA SEMANA (Feb 2-6, 2026)

| Día | Actividad | Dueño |
|-----|-----------|-------|
| Lun | Distribuir todos 7 documentos a teams | Product |
| Lun-Mar | Lectura individual según rol (2-5h) | Each |
| Mié | Aprobación pricing + arquitectura (1h) | PM + CTO |
| Jue | Kick-off reunión (1h) | Founder + Team |
| Vie | Planning detallado (3h) | Team leads |

**Output**: Teams alineados, versión aprobada

### SEMANA 2-3 (Feb 9-20)

Backend + Database setup (ver `MOTOR_v2_DOCUMENTO_EJECUTIVO.md` Semana 2-3)

### SEMANA 4-5 (Feb 23-Mar 5)

Frontend + Integration (ver same Semana 4-5)

### SEMANA 6 (Mar 8-12)

QA + Production Launch (ver same Semana 6)

---

## 🎓 CAPACITACIÓN (TOTAL 8 HORAS)

| Rol | Duración | Contenido |
|-----|----------|----------|
| Founder | 2h | Documento ejecutivo, ejemplos, impacto |
| Product Manager | 1.5h | Ejemplos, admin guide, ventas |
| CTO | 5h | Todo (arquitectura + calibración) |
| Backend | 3h | JSON + endpoints + DB |
| Frontend | 2.5h | JSON fields + UI flow |
| QA | 2h | Calibración + plantilla datos |

**Total equipo**: 16-18 horas (spread across 1 semana)

---

## ✅ VALIDACIÓN PRE-LANZAMIENTO

**Antes de producción**, validar:

- [ ] JSON v2.0 pasa 6 casos prueba (±5%)
- [ ] API endpoints compilando
- [ ] DB schema creado
- [ ] Sanity checks ejecutando
- [ ] Admin panel CRUD funcional
- [ ] UI flow 6 pasos completa
- [ ] Equipo capacitado
- [ ] Dashboard monitoreo setup
- [ ] 5 cotizaciones piloto con cliente

---

## 📞 SOPORTE

**Dudas técnicas**: Contactar CTO  
**Dudas operativas**: Contactar Product Manager  
**Dudas calibración**: Contactar Data Analyst

---

## 📚 LECTURAS ADICIONALES (OPCIONAL)

Si quieres profundizar:

- Estudio de caso ERP: `EJEMPLOS_CALIBRADOS_v2_ANTES_DESPUES.md` Caso 4 (1h)
- Proceso RCA: `PLAN_CALIBRACION_DETALLADO_v2.md` sección Fase 2 (1h)
- Historia cambios 6 meses: `PLAN_CALIBRACION_DETALLADO_v2.md` sección "Cronograma Mes 1-6" (1h)

---

## 🏁 HOJA DE RUTA (6 MESES)

| Período | Hito | IP esperada |
|---------|------|---|
| **Feb 2** | Versión v2.0 lista | — |
| **Feb 6** | Aprobación, kick-off | — |
| **Mar 12** | MVP en producción | — |
| **Mar 31** | Mes 1 calibración (v2.1) | ≥90% |
| **Apr 30** | Mes 2 calibración (v2.2) | ≥91% |
| **May 31** | Mes 3 calibración (v2.3) | ≥92% |
| **Jun 30** | Mes 4 calibración (v2.4) | ≥93% |
| **Jul 31** | Mes 5 calibración (v2.5) | ≥94% |
| **Sep 01** | Motor maduro, v3.0 eval | ≥95% |

---

## 📞 CONTACTOS CLAVE

| Rol | Responsable | Email | Función |
|-----|-------------|-------|---------|
| Líder Proyecto | CTO | — | Arquitectura, validación |
| Operaciones | Product Manager | — | Aprobación cambios, feedback |
| Calibración | Data Analyst | — | Recopilación, análisis IP |
| Desarrollo | Backend Lead | — | Implementación, versiones |
| Frontend | FE Lead | — | UI, integración API |

---

**Documento actualizado**: Febrero 2, 2026  
**Versión**: 2.0  
**Estado**: PUBLICADO PARA IMPLEMENTACIÓN

---

🎯 **PRÓXIMO PASO**: Distribuir este índice + documentos a teams, ejecutar lectura según rol, kick-off Jue Feb 6
