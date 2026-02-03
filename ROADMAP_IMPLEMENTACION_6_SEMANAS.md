# ROADMAP DE IMPLEMENTACIÓN

**Motor de Estimación: Plan detallado 6 semanas**  
Febrero 2, 2026

---

## 📅 TIMELINE RESUMIDO

```
SEMANA 1:  Planning + Approval
SEMANA 2–3: Backend + Frontend Setup  
SEMANA 4–5: MVP Development
SEMANA 6:   Testing + Launch
MES 2+:     Calibración Continua
```

**Total**: 6 semanas MVPi + ciclos calibración (continuo)

---

## SEMANA 1: PLANNING & APPROVAL

### Lunes: Distribución documentos

- [ ] **Product Manager**: Lee PRICING_ESTIMATION_ENGINE.md + TEST_CASES_12_SCENARIOS.md
- [ ] **CTO**: Lee TECHNICAL_INTEGRATION_GUIDE.md + UI_FLOW_DESIGN_DOCUMENT.md
- [ ] **Frontend Lead**: Lee UI_FLOW_DESIGN_DOCUMENT.md + QUICK_START_DEVELOPERS.md
- [ ] **Backend Lead**: Lee TECHNICAL_INTEGRATION_GUIDE.md + SERVICES_ESTIMATION_TEMPLATES.json
- [ ] **Founder/CEO**: Lee ENTREGA_RESUMEN_EJECUTIVO.md + MOTOR_ESTIMACION_ENTREGA_FINAL.md

**Tiempo**: 3–4 horas cada persona

---

### Martes: Validación de Pricing

**Responsable**: Product Manager + Sales Lead

**Checklist**:

- [ ] Validar rango precios ($5.5k–$143k) vs competencia
- [ ] Aprobar multiplicadores (multiidioma 1.45x, blockchain 2.5x, etc.)
- [ ] Decidir si tarifas base son competitivas
- [ ] Aprobar margen esperado (precio cliente vs costo real)
- [ ] Revisar 3 casos (landing, e-commerce, blockchain)

**Output**: ✅ Aprobación pricing, o cambios solicitados

**Tiempo**: 2 horas

---

### Miércoles: Aprobación Arquitectura

**Responsable**: CTO + Tech Lead

**Checklist**:

- [ ] Validar 6 endpoints API son suficientes
- [ ] Revisar schema base de datos (4 tablas)
- [ ] Aprobar admin panel (CRUD templates)
- [ ] Definir tech stack (Node.js + React + PostgreSQL / MongoDB)
- [ ] Timeline 5–6 semanas es realista con equipo disponible
- [ ] Seguridad: JWT + rate limiting + input validation

**Output**: ✅ Aprobación arquitectura, o cambios design

**Tiempo**: 2 horas

---

### Jueves: Kick-off Reunión

**Participantes**: Founder, CTO, PM, Frontend Lead, Backend Lead, DevOps

**Agenda**:

1. Visión compartida (5 min): "Cotiador dinámico de 8 servicios"
2. Números (5 min): Rango precios, 87 tareas, 12 casos prueba
3. Plan técnico (15 min): 6 semanas, tech stack, endpoints
4. Roles y responsabilidades (10 min)
5. Hitos y deadlines (5 min)
6. Preguntas (10 min)

**Output**: ✅ Todas alineados, dudas resueltas

**Tiempo**: 1 hora

---

### Viernes: Planning Detallado por Equipo

#### Backend Team (CTO + 2 engineers)

- [ ] Crear base de datos (4 tablas)
- [ ] Setup API boilerplate (Express.js)
- [ ] Implementar autenticación JWT
- [ ] Cargar SERVICES_ESTIMATION_TEMPLATES.json

**Deliverable**: Semana 3 — 6 endpoints + DB listos

#### Frontend Team (Lead + 2 engineers)

- [ ] Setup componentes React (6 pasos)
- [ ] Integración con LanguageContext.jsx
- [ ] Real-time calculation sidebar
- [ ] Modal/form para cliente_info

**Deliverable**: Semana 4 — UI flow completa, sin lógica cálculo

#### DevOps (1 engineer)

- [ ] Setup PostgreSQL / MongoDB (staging)
- [ ] CI/CD pipeline (GitHub Actions)
- [ ] Staging environment
- [ ] Monitoring / logging (opcional pero recomendado)

**Deliverable**: Semana 2 — Infrastructure ready

**Tiempo** (Planning): 3 horas total

---

## SEMANA 2–3: BACKEND + FRONTEND SETUP

### Semana 2: Infrastructure & Boilerplate

#### Backend (DevOps + Backend Lead)

**Día 1–2: Database Setup**

```sql
-- Crear 4 tablas
CREATE TABLE quotations (...)
CREATE TABLE estimation_templates (...)
CREATE TABLE calibration_log (...)
CREATE TABLE admin_users (...)

-- Insertar SERVICES_ESTIMATION_TEMPLATES.json
INSERT INTO estimation_templates VALUES (...)
```

**Checklist**:

- [ ] PostgreSQL running (local + staging)
- [ ] Migrations versionadas en Git
- [ ] Seed data cargado
- [ ] Backups configurados

**Deliverable**: DB ready, migrations reversibles

---

**Día 3–4: API Boilerplate**

```bash
# Setup proyecto Node.js
npm init -y
npm install express cors dotenv joi express-jwt
npm install nodemon --save-dev

# Estructura básica
src/
├── server.js
├── middleware/
│   ├── auth.js
│   ├── validation.js
│   └── rateLimit.js
├── routes/
│   ├── quotation.js
│   ├── templates.js
│   ├── calibration.js
│   └── admin.js
├── controllers/
│   └── quotationController.js
├── models/
│   └── Quotation.js
└── config/
    └── db.js
```

**Checklist**:

- [ ] Server starts on localhost:3000
- [ ] Hot reload working (nodemon)
- [ ] Logging configured
- [ ] Error handling middleware
- [ ] CORS configured

**Deliverable**: API server boilerplate, ready for endpoints

---

**Día 5: Admin Setup**

- [ ] User registration (POST /admin/users)
- [ ] JWT token generation
- [ ] Password hashing (bcrypt)
- [ ] Auth middleware working

**Deliverable**: Admin authentication working

---

#### Frontend (React Lead)

**Día 1–2: Components Setup**

```bash
# Crear componentes por paso
src/pages/
├── CotizacionServiciosPage.jsx (ACTUALIZAR)
└── steps/
    ├── PasoSeleccionarServicio.jsx
    ├── PasoPreguntas.jsx
    ├── PasoTareas.jsx
    ├── PasoCondicionales.jsx
    ├── PasoEquipo.jsx
    └── PasoResumen.jsx

src/components/
├── ResumenBox.jsx (real-time calculation)
├── ServiceCard.jsx
├── TaskCheckbox.jsx
└── ExportModal.jsx
```

**Checklist**:

- [ ] 6 pasos creados (sin lógica aún)
- [ ] Navegación entre pasos (botones siguiente/atrás)
- [ ] Context para mantener estado entre pasos
- [ ] i18n integrado (useLanguage hook)

**Deliverable**: UI structure, componentes vacíos

---

**Día 3–4: Context & State**

```jsx
// src/context/QuotationContext.jsx
const QuotationContext = createContext();

export function QuotationProvider({ children }) {
  const [paso1_servicio, setPaso1Servicio] = useState(null);
  const [paso2_preguntas, setPaso2Preguntas] = useState({});
  const [paso3_tareas, setPaso3Tareas] = useState([]);
  const [paso4_condicionales, setPaso4Condicionales] = useState({});
  const [paso5_equipo, setPaso5Equipo] = useState({});
  const [cliente_info, setClienteInfo] = useState({});
  const [quotation, setQuotation] = useState(null);
  
  return (
    <QuotationContext.Provider value={{ ... }}>
      {children}
    </QuotationContext.Provider>
  );
}
```

**Checklist**:

- [ ] Context creado y wrappeado en App.jsx
- [ ] Datos persistentes entre pasos (localStorage opcional)
- [ ] Reset functionality

**Deliverable**: State management working

---

**Día 5: Styling & Responsive**

- [ ] CSS framework (Tailwind, Styled-components)
- [ ] Responsive breakpoints (mobile, tablet, desktop)
- [ ] Colors de Xlerion (#00e9fa, #333436)
- [ ] Wireframes ASCII convertidas a componentes

**Deliverable**: UI visually polished

---

### Semana 3: API Endpoints Implementation

#### 1️⃣ GET /api/estimation/templates

**Implementar**:

```javascript
// routes/templates.js
router.get('/estimation/templates', (req, res) => {
  // Cargar SERVICES_ESTIMATION_TEMPLATES.json
  // Filtrar por servicio si parámetro lo indica
  // Retornar JSON
});
```

**Testing**:

```bash
curl http://localhost:3000/api/estimation/templates
# Debe retornar array de 8 servicios con todas tareas/multiplicadores
```

**Checklist**:

- [ ] Retorna todos 8 servicios
- [ ] Estructura JSON correcta
- [ ] Query params funcionan (filtro servicio)

**Deliverable**: Endpoint funcional

---

#### 2️⃣ POST /api/quotation/calculate

**Implementar** (pseudocódigo):

```javascript
router.post('/quotation/calculate', validateInput, (req, res) => {
  const payload = req.body;
  
  // 1. Cargar template servicio
  const service = templates.find(s => s.id === payload.paso1_servicio);
  
  // 2. Calcular horas base
  let horasBase = 0;
  for (const taskId of payload.paso3_tareas) {
    const task = service.tasks.find(t => t.id === taskId);
    horasBase += task.hours_range.default;
  }
  
  // 3. Aplicar multiplicadores
  let factor = 1.0;
  if (payload.paso4_condicionales.num_idiomas) {
    factor *= (1 + (payload.paso4_condicionales.num_idiomas - 1) * 0.15);
  }
  const horasAjustadas = horasBase * factor;
  
  // 4. Calcular costo
  const tarifa = service.base_tariff_range[payload.paso5_equipo.nivel].avg;
  const costoSinBuffer = horasAjustadas * tarifa;
  const costoConBuffer = costoSinBuffer * (1 + service.buffer_percent / 100);
  
  // 5. Guardar en BD
  const quotation = await Quotation.create({
    cliente_email: payload.cliente_info.email,
    servicio_id: payload.paso1_servicio,
    horas_finales: horasAjustadas,
    costo_con_buffer: costoConBuffer,
    estado: 'draft'
  });
  
  // 6. Retornar
  res.json({
    success: true,
    quotation_id: quotation.id,
    resumen: { ... }
  });
});
```

**Testing** (contra 3 casos):

```bash
# Caso 1: Landing (simple)
curl -X POST http://localhost:3000/api/quotation/calculate \
  -H "Content-Type: application/json" \
  -d '{ paso1_servicio: "web", paso3_tareas: ["discovery", "design"], ... }'
# Esperado: ~$5.5k

# Caso 2: E-commerce (multiidioma 4)
# Esperado: ~$21k

# Caso 6: Blockchain (con audit)
# Esperado: ~$91k (incluye $20k audit)
```

**Checklist**:

- [ ] Validación input (Joi schema)
- [ ] Cálculo correcto (vs TEST_CASES_12_SCENARIOS.md)
- [ ] Almacena en BD
- [ ] Retorna estructura correcta

**Deliverable**: Lógica cálculo funcional

---

#### 3️⃣ GET /api/quotation/:id

**Implementar**:

```javascript
router.get('/quotation/:id', async (req, res) => {
  const quotation = await Quotation.findOne({ id: req.params.id });
  if (!quotation) return res.status(404).json({ error: 'Not found' });
  res.json({ success: true, quotation });
});
```

**Testing**:

```bash
curl http://localhost:3000/api/quotation/XLR-2026-020-45
# Debe retornar misma estructura que POST /calculate
```

---

#### 4️⃣ POST /api/quotation/:id/export

**Implementar**:

```javascript
router.post('/quotation/:id/export', async (req, res) => {
  const quotation = await Quotation.findOne({ id: req.params.id });
  
  if (req.body.formato === 'pdf') {
    // Generar PDF (usar puppeteer o similar)
    const pdfBuffer = await generatePDF(quotation);
    res.set('Content-Type', 'application/pdf');
    res.send(pdfBuffer);
  } else if (req.body.formato === 'json') {
    res.json(quotation);
  }
});
```

**Checklist**:

- [ ] PDF genera correctamente
- [ ] Incluye logo Xlerion, tareas, costo, duración
- [ ] JSON export funciona

---

#### 5️⃣ GET /api/calibration/metrics (ADMIN)

**Implementar**:

```javascript
router.get('/admin/calibration/metrics', authenticateAdmin, (req, res) => {
  const period = req.query.period || 'month';  // month, quarter, year
  const logs = await CalibrationLog.findByPeriod(period);
  
  const metrics = {
    total_projects: logs.length,
    precision_index: calculatePI(logs),
    variance_percent: calculateVariance(logs),
    por_servicio: groupByService(logs)
  };
  
  res.json(metrics);
});
```

---

#### 6️⃣ POST /api/admin/services/update (ADMIN)

**Implementar**:

```javascript
router.post('/admin/services/update', authenticateAdmin, (req, res) => {
  const { servicio_id, cambios } = req.body;
  
  // Validar cambios
  // Actualizar JSON template
  // Crear nueva versión (v1.0 → v1.1)
  // Guardar en BD
  // Retornar confirmación
  
  res.json({ success: true, version_nueva: '1.1' });
});
```

---

## SEMANA 4–5: MVP DEVELOPMENT

### Semana 4: Frontend Integration

#### Día 1–2: Conectar API a componentes

```jsx
// PasoSeleccionarServicio.jsx
function PasoSeleccionarServicio() {
  const [templates, setTemplates] = useState([]);
  const { paso1_servicio, setPaso1Servicio } = useContext(QuotationContext);
  
  useEffect(() => {
    // Llamar GET /api/estimation/templates
    fetch('/api/estimation/templates')
      .then(res => res.json())
      .then(data => setTemplates(data.services));
  }, []);
  
  return (
    <div>
      {templates.map(service => (
        <ServiceCard 
          key={service.id}
          service={service}
          selected={paso1_servicio === service.id}
          onClick={() => setPaso1Servicio(service.id)}
        />
      ))}
    </div>
  );
}
```

#### Día 3–4: ResumenBox (real-time calculation)

```jsx
// Mostrar en sidebar derecho, actualizar en vivo mientras usuario selecciona

function ResumenBox() {
  const context = useContext(QuotationContext);
  const [estimacion, setEstimacion] = useState(null);
  
  useEffect(() => {
    // Cada vez que cambio contexto, recalcular
    if (context.paso1_servicio && context.paso3_tareas.length > 0) {
      // Hacer cálculo local (no llamar API aún)
      const est = calcularLocally(context);
      setEstimacion(est);
    }
  }, [context]);
  
  return (
    <div className="resumen-sidebar">
      <h3>Estimación</h3>
      <p>Horas: {estimacion?.horas}</p>
      <p>Costo: ${estimacion?.costo_con_buffer}</p>
      <p>Duración: {estimacion?.sprints} sprints</p>
    </div>
  );
}
```

#### Día 5: Botones navegación

- [ ] "Siguiente" bota a paso siguiente (si validación OK)
- [ ] "Atrás" regresa (sin perder datos)
- [ ] "Cancelar" resetea todo (con confirmación)

**Deliverable**: UI completa, conectada a API templates

---

### Semana 5: Completar cálculo + Exportación

#### Día 1–2: Paso 6 - Calcular y mostrar resultado

```jsx
function PasoResumen() {
  const context = useContext(QuotationContext);
  const [quotation, setQuotation] = useState(null);
  const [loading, setLoading] = useState(false);
  
  async function handleCalculate() {
    setLoading(true);
    try {
      const payload = {
        paso1_servicio: context.paso1_servicio,
        paso2_preguntas: context.paso2_preguntas,
        paso3_tareas: context.paso3_tareas,
        paso4_condicionales: context.paso4_condicionales,
        paso5_equipo: context.paso5_equipo,
        cliente_info: context.cliente_info
      };
      
      const response = await fetch('/api/quotation/calculate', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(payload)
      });
      
      const data = await response.json();
      if (data.success) {
        setQuotation(data);
      } else {
        showError(data.error);
      }
    } finally {
      setLoading(false);
    }
  }
  
  return (
    <div>
      <h2>Tu Cotización</h2>
      {quotation && (
        <>
          <p>ID: {quotation.quotation_id}</p>
          <p>Estimado: ${quotation.resumen.costo_con_buffer}</p>
          <p>Duración: {quotation.estimacion.duracion_sprints} sprints</p>
          
          <button onClick={handleExportPDF}>Descargar PDF</button>
          <button onClick={handleExportJSON}>Descargar JSON</button>
          <button onClick={handleSendEmail}>Enviar por Email</button>
        </>
      )}
    </div>
  );
}
```

#### Día 3–4: Exportación PDF + JSON

**PDF** (usar librería como puppeteer o pdfkit):

- Logo Xlerion
- Datos cliente
- Desglose tareas
- Costo + duración
- Roadmap (fases)
- Advertencias y recomendaciones

**JSON**: Exportar objeto completo quotation

#### Día 5: Testing contra 12 casos

**Ejecutar cada caso**, validar:

- [ ] Caso 1 (landing): ~$5.5k, 2 sprints
- [ ] Caso 2 (e-commerce): ~$21k, 6 sprints
- [ ] ... Caso 12

**Checklist**:

- [ ] Todos 12 casos con variación ±5%
- [ ] UI responsive (mobile, tablet, desktop)
- [ ] PDF genera correcto
- [ ] No hay errores en consola

**Deliverable**: MVP funcional, probado contra 12 casos

---

## SEMANA 6: TESTING & LAUNCH

### Día 1–2: QA Full

**Testing checklist**:

- [ ] Todos 6 pasos funcionan
- [ ] Validaciones funcionan (error messages)
- [ ] Real-time calculation actualiza
- [ ] Exportación PDF/JSON
- [ ] Admin panel CRUD (editar servicios)
- [ ] Autenticación admin

**Performance**:

- [ ] POST /calculate < 200ms
- [ ] GET /templates < 100ms
- [ ] PDF genera < 5s

**Security**:

- [ ] JWT validación en admin endpoints
- [ ] Input validation (Joi)
- [ ] Rate limiting activo
- [ ] CORS configurado

---

### Día 3–4: Staging deployment

```bash
# Deploy a staging environment
npm run build
npm run deploy:staging

# Validar en staging
curl https://staging-api.xlerion.com/api/estimation/templates
# Debe retornar datos
```

**Checklist**:

- [ ] API running en staging
- [ ] BD conectada
- [ ] SSL certificate
- [ ] Monitoring activo
- [ ] Backups automáticos

---

### Día 5: Production deployment + Monitoring

```bash
npm run deploy:production

# Validar
curl https://api.xlerion.com/api/estimation/templates
# Deploy exitoso ✓
```

**Post-deploy**:

- [ ] Monitoreo activo (Sentry, New Relic)
- [ ] Logs funcionales
- [ ] Alertas configuradas
- [ ] Backups automáticos

---

## MES 2+: CALIBRACIÓN CONTINUA

### Después de cada proyecto completado

1. **Recopilar datos** (horas real, costo real, cambios scope)
2. **Calcular variación** (% desviación vs estimado)
3. **Registrar en BD** (calibration_log tabla)

### Mensualmente

1. **Análisis** (GROUP BY servicio, multiplicador, etc.)
2. **Índice Precisión** (IP = 100% - |variación promedio|)
3. **Recomendaciones** (si desviación > ±10%, proponer ajuste)

### Si necesario

1. **Aprobar cambio** (CTO + PM)
2. **Actualizar JSON** (SERVICES_ESTIMATION_TEMPLATES.json)
3. **Versión nueva** (v1.0 → v1.1)
4. **Deploy** (cambios automáticos en cotizador)

**Meta**:

- Mes 1: IP ≥ 90%
- Mes 4: IP ≥ 93%
- Mes 6: IP ≥ 95%

---

## 📋 HITOS FINALES

| Semana | Hito | Responsable | Status |
|--------|------|-------------|--------|
| 1 | ✅ Aprobaciones (pricing, arquitectura, proyecto) | PM, CTO, Founder | Start |
| 2 | ✅ DB + API boilerplate | Backend | 40% |
| 3 | ✅ 6 endpoints API | Backend | 40% |
| 3 | ✅ UI components + context | Frontend | 40% |
| 4 | ✅ API integration + real-time calc | Frontend | 80% |
| 5 | ✅ Exportación PDF + JSON | Backend | 80% |
| 5 | ✅ Testing 12 casos | QA | 80% |
| 6 | ✅ Staging deployment | DevOps | 90% |
| 6 | ✅ Production deployment | DevOps | 100% |

---

## 🎯 SUCCESS METRICS

**Semana 6**:

- ✅ MVP running en producción
- ✅ 0 errores críticos
- ✅ Todos 12 casos pasan (±5% variación)

**Mes 1**:

- ✅ 20+ cotizaciones generadas
- ✅ IP ≥ 90%
- ✅ Usuarios descargando PDFs

**Mes 6**:

- ✅ 100+ cotizaciones, 10+ proyectos completados
- ✅ IP ≥ 95%
- ✅ Tasa aceptación > 40%

---

**Roadmap creado**: Febrero 2, 2026  
**Duración**: 6 semanas MVP + mejora continua  
**Próximo paso**: Semana 1, lunes — Distribución documentos
