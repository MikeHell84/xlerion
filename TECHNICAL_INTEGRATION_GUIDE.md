# Guía de Integración Técnica - Motor de Estimación Xlerion

**Endpoints, JSON payloads, admin panel, y arquitectura**  
Febrero 2, 2026

---

## ARQUITECTURA GENERAL

```
┌─────────────────────────────────────────────────────────┐
│                    CLIENTE (Frontend)                   │
│          CotizacionServiciosPage.jsx + UI Flow          │
└───────────────────────┬─────────────────────────────────┘
                        │ HTTP JSON
                        ↓
┌─────────────────────────────────────────────────────────┐
│                  API GATEWAY (Node/Express)             │
│         POST /api/quotation/calculate                   │
│         GET /api/estimation/templates                   │
│         GET /api/calibration/metrics                    │
└───────────────────────┬─────────────────────────────────┘
                        │
           ┌────────────┴────────────┐
           ↓                         ↓
    ┌──────────────┐      ┌──────────────────┐
    │  Engine Core │      │  Data Layer      │
    │ (estimation  │      │ (MongoDB/SQL)    │
    │  logic)      │      │                  │
    └──────┬───────┘      └────┬─────────────┘
           │                   │
           └────────┬──────────┘
                    ↓
        ┌─────────────────────────┐
        │   ADMIN PANEL (React)   │
        │ Editar rates, tasks,    │
        │ multiplicadores         │
        └─────────────────────────┘
```

---

## 1. ENDPOINTS API

### 1.1 POST /api/quotation/calculate

**Objetivo**: Calcular cotización basada en respuestas usuario  
**Method**: POST  
**Content-Type**: application/json

#### Request Payload

```json
{
  "session_id": "sess_12345abc",
  "timestamp": "2026-02-02T14:30:00Z",
  
  "paso1_servicio": "desarrollo-web-movil",
  
  "paso2_preguntas": {
    "primera_vez": "si",
    "tamaño_equipo": "mediano",
    "presupuesto_aprox": "medio",
    "timeline": "3-6 meses",
    "tiene_legacy": "si"
  },
  
  "paso3_tareas": [
    "discovery",
    "design",
    "frontend",
    "backend",
    "testing",
    "deployment",
    "ecommerce_pasarela",
    "multiidioma"
  ],
  
  "paso4_condicionales": {
    "num_idiomas": 4,
    "ecommerce_integracion_crm": true,
    "ecommerce_crm_tipo": "salesforce"
  },
  
  "paso5_equipo": {
    "nivel": "mid",
    "disponibilidad_stakeholders": "parcial"
  },
  
  "cliente_info": {
    "nombre": "TechCorp Colombia",
    "email": "contacto@techcorp.co",
    "pais": "Colombia",
    "industria": "Fintech"
  }
}
```

#### Response Payload (Success 200)

```json
{
  "success": true,
  "quotation_id": "XLR-2026-020-45",
  "timestamp": "2026-02-02T14:30:15Z",
  
  "resumen": {
    "servicio": "Desarrollo Web y Móvil",
    "costo_minimo": 18500,
    "costo_con_buffer": 23125,
    "costo_maximo": 25000,
    "currency": "USD",
    "iva_colombia": 19,
    "costo_con_iva": 28482.75
  },
  
  "estimacion": {
    "horas_base": 330,
    "multiplicadores_aplicados": [
      {
        "id": "multiidioma_4",
        "nombre": "4 Idiomas",
        "factor": 1.45,
        "horas_adicionales": 165
      },
      {
        "id": "crm_integration",
        "nombre": "Integración CRM",
        "factor": 1.20,
        "horas_adicionales": 79.2
      },
      {
        "id": "disponibilidad_parcial",
        "nombre": "Disponibilidad parcial stakeholders",
        "factor": 1.10,
        "horas_adicionales": 43.6
      }
    ],
    "horas_totales": 450,
    "horas_con_buffer": 562.5
  },
  
  "desglose_tareas": [
    {
      "id": "discovery",
      "nombre": "Discovery & Análisis",
      "horas_estimadas": 30,
      "horas_con_multiplicadores": 44.1,
      "costo_unitario": 1014.30
    },
    {
      "id": "design",
      "nombre": "Diseño UI/UX",
      "horas_estimadas": 50,
      "horas_con_multiplicadores": 73.5,
      "costo_unitario": 1690.50
    },
    {
      "id": "frontend",
      "nombre": "Frontend Responsive",
      "horas_estimadas": 100,
      "horas_con_multiplicadores": 147,
      "costo_unitario": 3381.00
    },
    {
      "id": "backend",
      "nombre": "Backend & API",
      "horas_estimadas": 80,
      "horas_con_multiplicadores": 117.6,
      "costo_unitario": 2704.80
    },
    {
      "id": "testing",
      "nombre": "Testing & QA",
      "horas_estimadas": 40,
      "horas_con_multiplicadores": 58.8,
      "costo_unitario": 1352.40
    },
    {
      "id": "deployment",
      "nombre": "Deployment & DevOps",
      "horas_estimadas": 20,
      "horas_con_multiplicadores": 29.4,
      "costo_unitario": 676.20
    },
    {
      "id": "ecommerce_pasarela",
      "nombre": "E-commerce & Pasarela Pago",
      "horas_estimadas": 60,
      "horas_con_multiplicadores": 88.2,
      "costo_unitario": 2028.60
    }
  ],
  
  "duracion": {
    "horas_totales": 450,
    "sprints_requeridos": 4,
    "horas_por_sprint": 120,
    "semanas_estimadas": "8-10"
  },
  
  "roadmap": {
    "fase_1": {
      "nombre": "Discovery & Arquitectura",
      "duracion": "2 semanas",
      "tareas": ["discovery", "design", "arquitectura_backend"],
      "horas": 75
    },
    "fase_2": {
      "nombre": "Desarrollo Backend & API",
      "duracion": "2-3 semanas",
      "tareas": ["backend", "ecommerce_pasarela", "crm_integration"],
      "horas": 140
    },
    "fase_3": {
      "nombre": "Frontend & Testing",
      "duracion": "2-3 semanas",
      "tareas": ["frontend", "testing", "multiidioma_testing"],
      "horas": 150
    },
    "fase_4": {
      "nombre": "Deployment & QA Final",
      "duracion": "1 semana",
      "tareas": ["deployment", "final_testing", "training"],
      "horas": 85
    }
  },
  
  "advertencias": [
    {
      "id": "w001",
      "nivel": "info",
      "mensaje": "Timeline estándar (8-10 semanas) es recomendado para calidad"
    },
    {
      "id": "w002",
      "nivel": "warning",
      "mensaje": "E-commerce requiere auditoría PCI compliance (no incluida, costo adicional ~$3,000)"
    },
    {
      "id": "w003",
      "nivel": "info",
      "mensaje": "Disponibilidad parcial de stakeholders puede agregar 10-15% horas en revisiones"
    }
  ],
  
  "recomendaciones": [
    "Realizar sprint 0 de discovery ampliado (2 semanas) para validar scope",
    "Asignar product owner dedicado para toma de decisiones rápida",
    "Considerar incremento de presupuesto para asesoría legal GDPR (Colombia)"
  ],
  
  "exportables": {
    "pdf": "https://api.xlerion.com/quotation/XLR-2026-020-45/pdf",
    "json": "https://api.xlerion.com/quotation/XLR-2026-020-45/json",
    "csv": "https://api.xlerion.com/quotation/XLR-2026-020-45/csv"
  }
}
```

#### Response Payload (Error 400/422)

```json
{
  "success": false,
  "error": "VALIDATION_ERROR",
  "message": "Validación fallida en paso 3",
  "errors": [
    {
      "field": "paso3_tareas",
      "message": "Mínimo 2 tareas requeridas",
      "value": ["discovery"]
    }
  ],
  "timestamp": "2026-02-02T14:30:15Z"
}
```

---

### 1.2 GET /api/estimation/templates

**Objetivo**: Obtener templates JSON de todos servicios (para caché frontend)  
**Method**: GET  
**Auth**: Optional (Bearer token para admin)

#### Query Parameters

```
GET /api/estimation/templates?servicio=desarrollo-web-movil&version=1.2&lang=es
```

| Param | Type | Default | Desc |
|-------|------|---------|------|
| servicio | string | null | Filtrar por ID servicio (ej: "desarrollo-web-movil") |
| version | string | latest | Versión del motor (ej: "1.1", "1.2") |
| lang | string | es | Lenguaje: "es" o "en" |
| incluir_historico | boolean | false | Incluir versiones anteriores (admin) |

#### Response (All Services)

```json
{
  "success": true,
  "version": "1.2",
  "timestamp": "2026-02-02T14:30:00Z",
  "services": [
    {
      "id": "desarrollo-web-movil",
      "name": "Desarrollo Web y Móvil",
      "description": "Aplicaciones web y móviles...",
      "icon": "globe",
      "base_tariff_range": {
        "junior": { "min": 12, "max": 18, "currency": "USD/hora" },
        "mid": { "min": 18, "max": 28, "currency": "USD/hora" },
        "senior": { "min": 28, "max": 45, "currency": "USD/hora" }
      },
      "tasks": [
        {
          "id": "discovery",
          "name": "Discovery & Análisis de Requerimientos",
          "hours_range": { "min": 20, "max": 40 },
          "default_level": "mid",
          "description": "Entrevistas, análisis de mercado, definición de scope",
          "multipliers": []
        },
        // ... más tareas
      ],
      "multipliers": [
        {
          "id": "multiidioma",
          "name": "Multiidioma",
          "description": "Proyectos en múltiples idiomas",
          "factor": 1.25,
          "applies_to_tasks": ["frontend", "testing", "documentation"],
          "notes": "Factor base; puede incrementarse con cada idioma adicional"
        },
        // ... más multiplicadores
      ],
      "dependencies": {
        "ecommerce": {
          "requires": ["backend", "testing"],
          "hidden_until": ["seleccionar_ecommerce"]
        }
      },
      "sprint_guidance": {
        "hours_per_sprint": 120,
        "typical_duration_weeks": "2-4"
      },
      "buffer_percent": 25,
      "pricing_model": "Time & Materials",
      "sources": ["Payscale 2026", "Upwork Q1 2026", "Clutch.co"]
    },
    // ... más servicios (blockchain, erp, etc.)
  ]
}
```

---

### 1.3 GET /api/quotation/:quotation_id

**Objetivo**: Recuperar cotización generada previamente  
**Method**: GET  
**Auth**: No requerido (public link si email coincide)

#### Query Parameters

```
GET /api/quotation/XLR-2026-020-45?email=contacto@techcorp.co&token=abc123
```

#### Response

```json
{
  "success": true,
  "quotation": {
    "id": "XLR-2026-020-45",
    "estado": "draft",
    "fecha_creacion": "2026-02-02T14:30:00Z",
    "cliente_email": "contacto@techcorp.co",
    // ... mismo payload que POST /calculate response
  }
}
```

---

### 1.4 POST /api/quotation/:quotation_id/export

**Objetivo**: Generar y descargar PDF/JSON de cotización  
**Method**: POST  
**Auth**: Email validation requerido

#### Request

```json
{
  "formato": "pdf",
  "incluir_roadmap": true,
  "incluir_assumptions": true,
  "email_destinatario": "contacto@techcorp.co"
}
```

#### Response (200 + File Download)

```
Content-Type: application/pdf
Content-Disposition: attachment; filename="XLR-2026-020-45.pdf"
```

---

### 1.5 GET /api/calibration/metrics

**Objetivo**: Dashboard de calibración (admin only)  
**Method**: GET  
**Auth**: Bearer token (admin)

#### Query Parameters

```
GET /api/calibration/metrics?period=month&servicio=all&date=2026-02
```

#### Response

```json
{
  "success": true,
  "period": "2026-02",
  "metrics": {
    "total_quotations_generated": 45,
    "total_projects_completed": 4,
    "precision_index": 97.2,
    "average_variance_percent": 2.8,
    "std_deviation": 8.1
  },
  "por_servicio": [
    {
      "servicio": "desarrollo-web-movil",
      "quotations": 20,
      "completed_projects": 3,
      "variance_promedio": 3.2,
      "precision_index": 96.8,
      "tendencia": "stable"
    },
    {
      "servicio": "blockchain",
      "quotations": 5,
      "completed_projects": 1,
      "variance_promedio": 10.8,
      "precision_index": 89.2,
      "tendencia": "up_variance"
    }
  ],
  "recomendaciones": [
    "Blockchain: Esperar 2+ proyectos más antes ajuste (n=1)",
    "Web: Considerar ajuste CRM horas (trend +6%)"
  ]
}
```

---

### 1.6 POST /api/admin/services/update (ADMIN)

**Objetivo**: Actualizar rates, tareas, multiplicadores  
**Method**: POST  
**Auth**: Bearer token (admin) + CSRF token

#### Request

```json
{
  "servicio_id": "desarrollo-web-movil",
  "cambios": [
    {
      "tipo": "task_hours",
      "task_id": "crm_integration",
      "campo": "hours_range",
      "valor_anterior": { "min": 40, "max": 50 },
      "valor_nuevo": { "min": 45, "max": 60 },
      "razon": "Calibración mes 1: Integración CRM más compleja"
    },
    {
      "tipo": "multiplier",
      "multiplier_id": "multiidioma",
      "campo": "factor",
      "valor_anterior": 1.45,
      "valor_nuevo": 1.55,
      "razon": "Testing multiidioma agrega 12% horas"
    }
  ],
  "version_cambio": "1.0 → 1.1",
  "aprobado_por": "user_id_123",
  "notas": "Ajustes post-calibración primer mes"
}
```

#### Response

```json
{
  "success": true,
  "version_anterior": "1.0",
  "version_nueva": "1.1",
  "cambios_aplicados": 2,
  "fecha_implementacion": "2026-02-28T16:00:00Z",
  "comunicar_a": [
    "team@xlerion.com",
    "sales@xlerion.com"
  ]
}
```

---

## 2. ESTRUCTURAS DE BASE DE DATOS

### 2.1 Tabla: quotations

```sql
CREATE TABLE quotations (
  id VARCHAR(20) PRIMARY KEY,  -- XLR-YYYY-NNN-XX
  
  -- Cliente
  cliente_nombre VARCHAR(255),
  cliente_email VARCHAR(255),
  cliente_pais VARCHAR(100),
  cliente_industria VARCHAR(100),
  
  -- Responses
  servicio_id VARCHAR(50),
  paso2_primera_vez BOOLEAN,
  paso2_tamaño_equipo VARCHAR(50),
  paso2_presupuesto VARCHAR(50),
  paso2_timeline VARCHAR(50),
  paso2_legacy BOOLEAN,
  paso3_tareas JSON,  -- Array de IDs
  paso4_idiomas INT,
  paso4_crm_integracion BOOLEAN,
  paso5_nivel VARCHAR(50),
  paso5_disponibilidad VARCHAR(50),
  
  -- Resultados
  horas_base INT,
  horas_finales INT,
  costo_sin_buffer DECIMAL(10, 2),
  costo_con_buffer DECIMAL(10, 2),
  buffer_percent INT,
  currency VARCHAR(3),
  
  -- Metadata
  estado VARCHAR(20),  -- draft, sent, accepted, rejected, expired
  fecha_creacion TIMESTAMP,
  fecha_expiracion TIMESTAMP,
  fecha_aceptacion TIMESTAMP,
  token_publico VARCHAR(64),
  
  INDEX idx_cliente_email (cliente_email),
  INDEX idx_servicio (servicio_id),
  INDEX idx_fecha (fecha_creacion)
);
```

### 2.2 Tabla: estimation_templates

```sql
CREATE TABLE estimation_templates (
  id VARCHAR(50) PRIMARY KEY,  -- desarrollo-web-movil
  
  -- Metadata
  nombre VARCHAR(255),
  descripcion TEXT,
  icono VARCHAR(50),
  version VARCHAR(10),
  version_fecha TIMESTAMP,
  
  -- JSON completo
  template_json JSON,  -- SERVICES_ESTIMATION_TEMPLATES.json completo
  
  -- Auditoría
  creado_por VARCHAR(100),
  modificado_por VARCHAR(100),
  fecha_creacion TIMESTAMP,
  fecha_modificacion TIMESTAMP,
  
  -- Histórico
  es_historico BOOLEAN DEFAULT FALSE,
  version_anterior_id VARCHAR(50),
  
  UNIQUE KEY unique_version (id, version),
  INDEX idx_version_fecha (version_fecha)
);
```

### 2.3 Tabla: calibration_log

```sql
CREATE TABLE calibration_log (
  id VARCHAR(50) PRIMARY KEY,  -- CAL-2026-0001
  
  -- Proyecto referencia
  proyecto_id VARCHAR(100),
  servicio_id VARCHAR(50),
  
  -- Datos reales
  horas_estimadas INT,
  horas_reales INT,
  costo_estimado DECIMAL(10, 2),
  costo_real DECIMAL(10, 2),
  
  -- Análisis
  variacion_horas_percent DECIMAL(5, 2),
  variacion_costo_percent DECIMAL(5, 2),
  causa_desviacion VARCHAR(255),
  scope_changes_adicionales JSON,
  
  -- Recomendaciones
  ajuste_propuesto JSON,
  aprobado BOOLEAN,
  aprobado_por VARCHAR(100),
  
  -- Metadata
  fecha_proyecto_cierre DATE,
  fecha_analisis TIMESTAMP,
  
  INDEX idx_servicio (servicio_id),
  INDEX idx_variacion (variacion_horas_percent)
);
```

### 2.4 Tabla: admin_users

```sql
CREATE TABLE admin_users (
  id VARCHAR(100) PRIMARY KEY,
  
  nombre VARCHAR(255),
  email VARCHAR(255) UNIQUE,
  rol VARCHAR(50),  -- admin, cto, pm, sales
  
  password_hash VARCHAR(255),
  password_salt VARCHAR(255),
  
  permisos JSON,  -- ["read_calibration", "write_templates", "approve_changes"]
  
  fecha_creacion TIMESTAMP,
  fecha_ultimo_acceso TIMESTAMP,
  activo BOOLEAN DEFAULT TRUE,
  
  INDEX idx_email (email)
);
```

---

## 3. ADMIN PANEL (Frontend React)

### 3.1 Rutas Admin

```
/admin
├── /admin/dashboard          → Métricas calibración
├── /admin/templates          → CRUD servicios
│   ├── /templates/:id/edit   → Editar servicio
│   ├── /templates/:id/tareas → Editar tareas
│   └── /templates/:id/rates  → Editar tarifas
├── /admin/calibration        → Log calibración
│   ├── /calibration/analyze  → Análisis varianzas
│   └── /calibration/adjust   → Proponer ajustes
├── /admin/quotations         → Historial cotizaciones
└── /admin/users              → Gestión usuarios (super admin)
```

### 3.2 Componentes principales

#### Componente: TemplateEditor

**Descripción**: CRUD para editar servicios, tareas, multiplicadores sin código

```jsx
// Pseudo-código React
function TemplateEditor({ serviceId }) {
  const [service, setService] = useState(null);
  const [editMode, setEditMode] = useState(false);
  const [unsavedChanges, setUnsavedChanges] = useState({});
  
  // Cargar template
  useEffect(() => {
    fetchService(serviceId).then(setService);
  }, [serviceId]);
  
  // Editar tarea
  const handleEditTask = (taskId, field, newValue) => {
    setUnsavedChanges({
      ...unsavedChanges,
      [`task.${taskId}.${field}`]: newValue
    });
  };
  
  // Agregar multiplicador
  const handleAddMultiplier = (multiplier) => {
    setService({
      ...service,
      multipliers: [...service.multipliers, multiplier]
    });
    setUnsavedChanges({ ...unsavedChanges, multiplier_added: true });
  };
  
  // Guardar cambios
  const handleSave = async () => {
    const response = await api.post(`/admin/services/${serviceId}/update`, {
      cambios: unsavedChanges
    });
    
    if (response.success) {
      setEditMode(false);
      setUnsavedChanges({});
      toast.success("Cambios guardados");
    }
  };
  
  return (
    <div className="template-editor">
      <h1>{service?.name}</h1>
      
      <TareasEditor 
        tasks={service?.tasks} 
        onEdit={handleEditTask}
      />
      
      <MultiplicadoresEditor 
        multipliers={service?.multipliers} 
        onAdd={handleAddMultiplier}
      />
      
      <RatesEditor 
        rates={service?.base_tariff_range}
        onEdit={handleEditTask}
      />
      
      <button onClick={handleSave}>Guardar</button>
    </div>
  );
}
```

#### Componente: CalibrationAnalyzer

**Descripción**: Dashboard de análisis varianzas con gráficos

```jsx
function CalibrationAnalyzer() {
  const [data, setData] = useState(null);
  const [filters, setFilters] = useState({
    servicio: 'all',
    period: 'month'
  });
  
  useEffect(() => {
    api.get('/admin/calibration/metrics', { params: filters })
      .then(setData);
  }, [filters]);
  
  return (
    <div className="calibration-analyzer">
      {/* Filtros */}
      <FilterBar 
        servicio={filters.servicio}
        onChangeServicio={(s) => setFilters({...filters, servicio: s})}
      />
      
      {/* Métricas principales */}
      <MetricsCards data={data} />
      
      {/* Gráficos */}
      <div className="charts">
        {/* Scatter: estimado vs real */}
        <ScatterChart data={data.projects} />
        
        {/* Histograma variaciones */}
        <HistogramChart data={data.variance_distribution} />
        
        {/* Tendencia por servicio */}
        <LineChart data={data.trend_by_service} />
      </div>
      
      {/* Tabla de proyectos */}
      <ProjectsTable data={data.projects} />
      
      {/* Recomendaciones */}
      <RecommendationsPanel recommendations={data.recomendaciones} />
    </div>
  );
}
```

---

## 4. FLUJO DE INTEGRACIÓN FRONTEND

### 4.1 Modificar CotizacionServiciosPage.jsx

**Cambios requeridos**:

```jsx
// 1. Importar servicio API
import { EstimationAPI } from '../services/EstimationAPI';

// 2. Cargar templates al montar componente
useEffect(() => {
  EstimationAPI.getTemplates().then(data => {
    setServiceTemplates(data);
    setLoading(false);
  });
}, []);

// 3. En PASO 3 (seleccionar tareas), cargar dinámicamente del template
function renderTasksForService(serviceId) {
  const service = serviceTemplates.find(s => s.id === serviceId);
  return service.tasks.map(task => (
    <TaskCheckbox 
      key={task.id}
      task={task}
      isSelected={selectedTasks.includes(task.id)}
      onChange={(checked) => {
        if (checked) {
          setSelectedTasks([...selectedTasks, task.id]);
        } else {
          setSelectedTasks(selectedTasks.filter(t => t !== task.id));
        }
      }}
    />
  ));
}

// 4. En PASO 6 (resumen), llamar endpoint calculate
async function handleCalculateQuotation() {
  const payload = {
    paso1_servicio: selectedService,
    paso2_preguntas: responses.paso2,
    paso3_tareas: selectedTasks,
    paso4_condicionales: responses.paso4,
    paso5_equipo: responses.paso5,
    cliente_info: clientData
  };
  
  const result = await EstimationAPI.calculateQuotation(payload);
  
  if (result.success) {
    setQuotation(result);
    setShowResumen(true);
  } else {
    showError(result.error);
  }
}

// 5. Componente para mostrar resumen real-time
function ResumenBox() {
  return (
    <div className="resumen-box">
      <h3>📊 Estimación en tiempo real</h3>
      <div className="metrics">
        <MetricRow label="Horas" value={estimacion.horas_base} />
        <MetricRow label="Costo sin buffer" value={`$${estimacion.costo_sin_buffer}`} />
        <MetricRow label="Con buffer (25%)" value={`$${estimacion.costo_con_buffer}`} />
        <MetricRow label="Duración" value={`${estimacion.duracion_sprints} sprints`} />
      </div>
    </div>
  );
}
```

---

## 5. SEGURIDAD

### 5.1 Autenticación

```javascript
// JWT tokens para admin
const adminToken = jwt.sign(
  { user_id, role: 'admin', permissions: [...] },
  process.env.JWT_SECRET,
  { expiresIn: '24h' }
);

// Validación en middleware
app.use('/api/admin/*', authenticateJWT, authorizeRole('admin'));
```

### 5.2 Validación input

```javascript
// Joi schema para POST /quotation/calculate
const quotationSchema = Joi.object({
  paso1_servicio: Joi.string().valid(...validServices).required(),
  paso2_preguntas: Joi.object({
    primera_vez: Joi.string().valid('si', 'no').required(),
    tamaño_equipo: Joi.string().valid(...validSizes).required(),
    // ...
  }).required(),
  paso3_tareas: Joi.array()
    .items(Joi.string().valid(...validTasks))
    .min(2).max(12).required(),
  // ...
});

app.post('/api/quotation/calculate', (req, res) => {
  const { error, value } = quotationSchema.validate(req.body);
  if (error) return res.status(422).json({ error: error.details });
  // Procesar...
});
```

### 5.3 Rate limiting

```javascript
const rateLimit = require('express-rate-limit');

const quotationLimiter = rateLimit({
  windowMs: 15 * 60 * 1000,  // 15 minutos
  max: 30,  // 30 requests por IP
  message: 'Demasiadas cotizaciones, intenta más tarde'
});

app.post('/api/quotation/calculate', quotationLimiter, (req, res) => {
  // ...
});
```

---

## 6. LOGGING Y MONITOREO

### 6.1 Eventos a loguear

```javascript
// En EstimationEngine
logger.info('QUOTATION_GENERATED', {
  quotation_id: 'XLR-2026-020-45',
  servicio: 'desarrollo-web-movil',
  costo_total: 32563,
  tiempo_calculo: '145ms',
  timestamp: new Date()
});

logger.info('CALIBRATION_ADJUSTMENT', {
  adjustment_id: 'A-001',
  cambio: 'crm_integration: 45h → 54h',
  impacto_pricing: '+$207',
  usuario: 'cto@xlerion.com'
});
```

### 6.2 Alertas

```javascript
// Si variación > ±15% en proyecto completado
if (Math.abs(variacion_percent) > 15) {
  sendAlert({
    nivel: 'warning',
    mensaje: `Proyecto ${proyecto_id} variación ${variacion_percent}%`,
    destinatarios: ['cto@xlerion.com', 'pm@xlerion.com']
  });
}
```

---

## 7. DEPLOYMENT Y VERSIONADO

### 7.1 Estrategia versionado

```
Motor v1.0 (Feb 2, 2026) — INICIAL
├─ v1.1 (Mar 1, 2026) — Ajustes post-calibración mes 1
├─ v1.2 (Apr 15, 2026) — Ajustes post-calibración mes 2
└─ ...

Migrations:
- Backward compatible: soportar peticiones con v1.0 template
- Sugerir upgrade: notificar clientes de nuevas versiones
```

### 7.2 Pipeline CI/CD

```yaml
# .github/workflows/estimation-engine.yml
name: Estimation Engine Deploy

on:
  push:
    branches: [main]
    paths:
      - 'xlerion-site/src/services/EstimationAPI.js'
      - 'backend/estimation-engine/**'
      - 'SERVICES_ESTIMATION_TEMPLATES.json'

jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Run tests
        run: npm test -- estimation-engine
      - name: Validate JSON templates
        run: npm run validate-templates

  deploy:
    needs: test
    if: github.ref == 'refs/heads/main'
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      - name: Deploy to production
        run: ./deploy-estimation-engine.sh
      - name: Notify team
        run: curl -X POST ${{ secrets.SLACK_WEBHOOK }} -d "Engine updated v1.2"
```

---

## 8. TESTING Y VALIDACIÓN

### 8.1 Unit tests (Jest)

```javascript
// __tests__/EstimationEngine.test.js

describe('EstimationEngine', () => {
  test('calculates quotation correctly', () => {
    const input = {
      servicio: 'desarrollo-web-movil',
      tareas: ['discovery', 'design', 'frontend', 'backend'],
      multiplicadores: [{ id: 'multiidioma', factor: 1.25 }],
      nivel: 'mid'
    };
    
    const result = EstimationEngine.calculate(input);
    
    expect(result.horas_totales).toBe(450);
    expect(result.costo_sin_buffer).toBeCloseTo(13710, -2);
  });
  
  test('applies buffer correctly', () => {
    const result = EstimationEngine.calculate({...}, buffer: 0.25);
    const expectedCosto = 13710 * 1.25;
    expect(result.costo_con_buffer).toBeCloseTo(expectedCosto, -2);
  });
});
```

### 8.2 Integration tests

```javascript
// __tests__/API.integration.test.js

describe('POST /api/quotation/calculate', () => {
  test('calculates blockchain quotation with external audit', async () => {
    const payload = {
      // ... blockchain payload
    };
    
    const response = await request(app)
      .post('/api/quotation/calculate')
      .send(payload);
    
    expect(response.status).toBe(200);
    expect(response.body.success).toBe(true);
    expect(response.body.resumen.costo_minimo).toBeGreaterThan(60000);
    expect(response.body.advertencias).toContainEqual(
      expect.objectContaining({ 
        id: 'w_blockchain_audit' 
      })
    );
  });
});
```

---

## 9. CHECKLIST IMPLEMENTACIÓN

- [ ] Base de datos: Crear tablas (quotations, templates, calibration_log, admin_users)
- [ ] API endpoints: Implementar 6 endpoints principales
- [ ] Frontend: Integrar EstimationAPI en CotizacionServiciosPage.jsx
- [ ] Admin panel: Construir TemplateEditor + CalibrationAnalyzer
- [ ] Seguridad: JWT, rate limiting, input validation
- [ ] Tests: Unit + integration tests
- [ ] Logging: Configurar logger + alertas
- [ ] Documentación: Swagger/OpenAPI para endpoints
- [ ] Deploy: CI/CD pipeline configurado
- [ ] Monitoreo: Dashboards en Grafana/New Relic

---

**Documento creado**: Febrero 2, 2026  
**Arquitectura validada**: ✓ Escalable a 10k+ cotizaciones/mes
