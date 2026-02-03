# QUICK START - Motor de Estimación

**Cheat sheet para desarrolladores**  
Febrero 2, 2026

---

## 🚀 COMIENZA AQUÍ (5 MINUTOS)

### Qué es

Sistema de cotización dinámico que calcula horas + costo + duración para 8 servicios.

### Flujo usuario (6 pasos)

```
1. Selecciona servicio (1 de 8)
   ↓
2. Contesta 5 preguntas (primeras vez, equipo, presupuesto, timeline, legacy)
   ↓
3. Elige tareas (2-12 checkboxes)
   ↓
4. Responde condicionales (idiomas, integraciones, etc.)
   ↓
5. Define nivel equipo (junior/mid/senior/mixed)
   ↓
6. Ve resultado: estimado + duración + roadmap
```

### Costo típico

- **Pequeño**: $5k–$20k (landing, branding)
- **Mediano**: $20k–$70k (e-commerce, blockchain)
- **Grande**: $30k–$143k (ERP, game multiplayer)

---

## 📁 ARCHIVOS CLAVE

| Archivo | Tamaño | Propósito |
|---------|--------|----------|
| `SERVICES_ESTIMATION_TEMPLATES.json` | 4.5kb | Base datos servicios (editable) |
| `UI_FLOW_DESIGN_DOCUMENT.md` | 3.5kb | Cómo se ve la app (wireframes) |
| `TECHNICAL_INTEGRATION_GUIDE.md` | 3kb | Endpoints API + DB schema |
| `TEST_CASES_12_SCENARIOS.md` | 2kb | Validar contra estos casos |
| `CALIBRATION_GUIDE.md` | 2.5kb | Mejora mensual del motor |

**Abre primero**: `INDICE_MAESTRO_MOTOR_ESTIMACION.md` (guía de lectura)

---

## 🔌 ENDPOINTS API (CÓPIALOS)

### 1. Calcular cotización

```bash
POST /api/quotation/calculate
Content-Type: application/json

{
  "paso1_servicio": "desarrollo-web-movil",
  "paso2_preguntas": {
    "primera_vez": "si",
    "tamaño_equipo": "mediano",
    "presupuesto_aprox": "medio",
    "timeline": "3-6 meses",
    "tiene_legacy": "si"
  },
  "paso3_tareas": ["discovery", "design", "frontend", "backend", "testing"],
  "paso4_condicionales": {
    "num_idiomas": 4,
    "ecommerce_integracion_crm": true
  },
  "paso5_equipo": {
    "nivel": "mid",
    "disponibilidad_stakeholders": "parcial"
  },
  "cliente_info": {
    "nombre": "Mi Empresa",
    "email": "contacto@empresa.com",
    "pais": "Colombia"
  }
}
```

**Respuesta**:

```json
{
  "success": true,
  "quotation_id": "XLR-2026-020-45",
  "resumen": {
    "costo_minimo": 18500,
    "costo_con_buffer": 23125,
    "currency": "USD",
    "horas_totales": 450,
    "sprints_requeridos": 4
  }
}
```

---

### 2. Cargar templates

```bash
GET /api/estimation/templates?servicio=desarrollo-web-movil&version=1.2

# Respuesta: JSON con all tareas, multiplicadores, tarifas
```

---

### 3. Descargar PDF

```bash
POST /api/quotation/XLR-2026-020-45/export

{
  "formato": "pdf",
  "incluir_roadmap": true,
  "email_destinatario": "contacto@empresa.com"
}

# Descarga PDF en browser
```

---

## 📊 ESTRUCTURA JSON TEMPLATE

```json
{
  "id": "desarrollo-web-movil",
  "base_tariff_range": {
    "junior": { "min": 12, "max": 18 },
    "mid": { "min": 18, "max": 28 },
    "senior": { "min": 28, "max": 45 }
  },
  "tasks": [
    {
      "id": "discovery",
      "name": "Discovery & Análisis",
      "hours_range": { "min": 20, "max": 40 },
      "default_level": "mid"
    },
    // ... más tareas
  ],
  "multipliers": [
    {
      "id": "multiidioma",
      "factor": 1.25,
      "applies_to_tasks": ["frontend", "testing"]
    }
    // ... más multiplicadores
  ],
  "buffer_percent": 25
}
```

---

## 💻 COMPONENTES REACT (PSEUDO-CÓDIGO)

### Paso 1: Seleccionar servicio

```jsx
function PasoSeleccionarServicio() {
  const [selectedService, setSelectedService] = useState(null);
  const [templates, setTemplates] = useState([]);
  
  useEffect(() => {
    api.get('/api/estimation/templates').then(setTemplates);
  }, []);
  
  return (
    <div className="services-grid">
      {templates.map(service => (
        <ServiceCard 
          key={service.id}
          service={service}
          selected={selectedService === service.id}
          onClick={() => setSelectedService(service.id)}
        />
      ))}
    </div>
  );
}
```

### Paso 3: Seleccionar tareas (dinámico)

```jsx
function PasoSeleccionarTareas() {
  const { serviceId } = useContext(QuotationContext);
  const service = templates.find(s => s.id === serviceId);
  const [selectedTasks, setSelectedTasks] = useState([]);
  
  return (
    <div>
      {service.tasks.map(task => (
        <TaskCheckbox 
          key={task.id}
          task={task}
          checked={selectedTasks.includes(task.id)}
          onChange={(checked) => {
            if (checked) {
              setSelectedTasks([...selectedTasks, task.id]);
            } else {
              setSelectedTasks(selectedTasks.filter(t => t !== task.id));
            }
          }}
        />
      ))}
    </div>
  );
}
```

### Paso 6: Mostrar resultado

```jsx
function PasoResumen() {
  const [quotation, setQuotation] = useState(null);
  const context = useContext(QuotationContext);
  
  async function calculateQuotation() {
    const payload = {
      paso1_servicio: context.servicio,
      paso2_preguntas: context.paso2,
      paso3_tareas: context.selectedTasks,
      paso4_condicionales: context.paso4,
      paso5_equipo: context.paso5,
      cliente_info: context.clienteInfo
    };
    
    const result = await api.post('/api/quotation/calculate', payload);
    setQuotation(result);
  }
  
  return (
    <div className="resumen">
      <h2>Estimación</h2>
      <p>Costo: ${quotation.resumen.costo_con_buffer} USD</p>
      <p>Duración: {quotation.estimacion.duracion_sprints} sprints</p>
      <button onClick={() => api.post(`/quotation/${quotation.quotation_id}/export`, {formato: 'pdf'})}>
        Descargar PDF
      </button>
    </div>
  );
}
```

---

## 📋 VALIDACIONES (CÓPIALAS)

### Paso 1: Servicio requerido

```javascript
if (!selectedService) {
  showError("Selecciona un servicio para continuar");
  return false;
}
```

### Paso 2: Todas preguntas obligatorias

```javascript
const requiredFields = ['primera_vez', 'tamaño_equipo', 'presupuesto', 'timeline', 'legacy'];
const allAnswered = requiredFields.every(field => paso2[field] !== null);
if (!allAnswered) {
  showError("Contesta todas las preguntas");
  return false;
}
```

### Paso 3: Mínimo 2 tareas

```javascript
if (selectedTasks.length < 2) {
  showError("Selecciona al menos 2 tareas");
  return false;
}
if (selectedTasks.length > 12) {
  showWarning("Proyecto muy grande; reconsidere scope");
}
```

---

## 🧪 TEST CASES (VALIDA CONTRA ESTOS)

### Caso 1: Landing Page

- **Entrada**: Web, discovery + design + frontend + backend + testing
- **Esperado**: ~$5.5k, 2 sprints

### Caso 2: E-commerce

- **Entrada**: Web, + ecommerce + multiidioma (4) + CRM
- **Esperado**: ~$21k, 6 sprints

### Caso 12: Blockchain PoC

- **Entrada**: Blockchain, smart contracts + audit interna + testnet
- **Esperado**: ~$20k, 2 sprints (sin audit externa)

**Abre**: `TEST_CASES_12_SCENARIOS.md` para 12 ejemplos completos

---

## 🗄️ BASE DE DATOS (SCHEMA BÁSICO)

```sql
CREATE TABLE quotations (
  id VARCHAR(20) PRIMARY KEY,
  cliente_email VARCHAR(255),
  servicio_id VARCHAR(50),
  horas_finales INT,
  costo_con_buffer DECIMAL(10, 2),
  fecha_creacion TIMESTAMP,
  estado VARCHAR(20),  -- draft, sent, accepted
  token_publico VARCHAR(64)
);

CREATE TABLE calibration_log (
  id VARCHAR(50) PRIMARY KEY,
  proyecto_id VARCHAR(100),
  servicio_id VARCHAR(50),
  horas_estimadas INT,
  horas_reales INT,
  variacion_horas_percent DECIMAL(5, 2),
  fecha_proyecto_cierre DATE
);

CREATE TABLE estimation_templates (
  id VARCHAR(50) PRIMARY KEY,
  nombre VARCHAR(255),
  template_json JSON,
  version VARCHAR(10),
  fecha_modificacion TIMESTAMP
);
```

---

## 🔐 SEGURIDAD RÁPIDA

```javascript
// 1. Validar input con Joi
const schema = Joi.object({
  paso1_servicio: Joi.string().valid(...validServices).required(),
  paso3_tareas: Joi.array().items(Joi.string()).min(2).max(12).required()
});

// 2. Rate limiting
app.use('/api/quotation/calculate', rateLimit({
  windowMs: 15 * 60 * 1000,
  max: 30  // 30 requests por 15 min
}));

// 3. JWT para admin
app.use('/api/admin/*', authenticateJWT);
```

---

## 📈 CÁLCULO MOTOR (PSEUDOCÓDIGO)

```javascript
function calculate(userInput) {
  // 1. Cargar template servicio
  const service = templates[userInput.servicio];
  
  // 2. Sumar horas tareas seleccionadas
  let horasBase = 0;
  for (const taskId of userInput.tareas) {
    const task = service.tasks.find(t => t.id === taskId);
    horasBase += task.hours_range.default;  // promedio
  }
  
  // 3. Aplicar multiplicadores
  let factor = 1.0;
  for (const multiplier of applicableMultipliers) {
    factor *= multiplier.factor;
  }
  const horasAjustadas = horasBase * factor;
  
  // 4. Calcular costo
  const tarifa = service.base_tariff_range[userInput.nivel].avg;
  const costoSinBuffer = horasAjustadas * tarifa;
  
  // 5. Aplicar buffer
  const costoConBuffer = costoSinBuffer * (1 + service.buffer_percent / 100);
  
  // 6. Calcular duración
  const sprints = Math.ceil(horasAjustadas / 120);
  
  return {
    horas: horasAjustadas,
    costo_sin_buffer: costoSinBuffer,
    costo_con_buffer: costoConBuffer,
    sprints: sprints
  };
}
```

---

## 🚨 ERRORES COMUNES

### Error 1: No cargar templates dinámicamente

❌ **MAL**: Hardcodear tareas en componente
✅ **BIEN**: Cargar desde `/api/estimation/templates`

### Error 2: No validar mínimo 2 tareas

❌ **MAL**: Permitir continuar con 0–1 tareas
✅ **BIEN**: Bloquear si < 2 o > 12

### Error 3: No aplicar multiplicadores acumulativamente

❌ **MAL**: 1.25 × 1.35 = 1.6875 (no 2.6)
✅ **BIEN**: Multiplicadores se aplican secuencialmente

### Error 4: No incluir IVA Colombia

❌ **MAL**: $23,125 USD (final)
✅ **BIEN**: $23,125 USD × 1.19 = $27,518.75 (con IVA)

### Error 5: No mostrar rango mín-máx

❌ **MAL**: "Costo: $23,125"
✅ **BIEN**: "Rango: $18,500–$25,000 (sin–con buffer)"

---

## ✅ CHECKLIST IMPLEMENTACIÓN

- [ ] Cargar `SERVICES_ESTIMATION_TEMPLATES.json`
- [ ] Implementar 6 endpoints API
- [ ] Crear 6 componentes React (pasos)
- [ ] Real-time calculation en sidebar
- [ ] Exportación PDF/JSON
- [ ] Admin panel CRUD
- [ ] Tests contra 12 casos
- [ ] Deploy a staging
- [ ] QA validación
- [ ] Deploy a producción

---

## 📚 REFERENCIAS RÁPIDAS

| Pregunta | Archivo | Sección |
|----------|---------|---------|
| ¿Cuáles son los 8 servicios? | SERVICES_ESTIMATION_TEMPLATES.json | Top level array |
| ¿Cuál es el rango de precios? | TEST_CASES_12_SCENARIOS.md | Resumen comparativo |
| ¿Cuál es el flujo UI? | UI_FLOW_DESIGN_DOCUMENT.md | Paso a paso detallado |
| ¿Qué endpoints implemento? | TECHNICAL_INTEGRATION_GUIDE.md | Sección 1 |
| ¿Cómo valido precisión? | CALIBRATION_GUIDE.md | Paso 2: Análisis |

---

## 🎯 PRÓXIMOS 5 DÍAS

**Día 1**: Léete este archivo + `INDICE_MAESTRO_MOTOR_ESTIMACION.md`

**Día 2**: Implementar endpoints API (POST calculate, GET templates)

**Día 3**: Crear componentes React (Paso 1–6)

**Día 4**: Integración API + real-time calculation

**Día 5**: Testing contra 12 casos + exportación PDF

---

**Quick Start creado**: Febrero 2, 2026  
**Tiempo lectura**: 10 minutos  
**Implementación inicial**: 5 días ✅
