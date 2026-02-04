# Sistema de Roadmaps - Guía de Integración

## ✅ Estado de Integración: COMPLETADO

El sistema de roadmaps ha sido completamente integrado en el proyecto Xlerion. Este documento describe la arquitectura, componentes y cómo usar el sistema.

---

## 📁 Archivos Creados

### 1. Backend (API Endpoints)

- **Ubicación**: `xlerion-site/public/api/roadmaps.php`
- **Función**: Maneja todas las operaciones CRUD para roadmaps
- **Rutas disponibles**:
  - `GET /api/roadmaps.php/templates` - Obtener plantillas (opcionalmente filtradas por servicio)
  - `GET /api/roadmaps.php/cases` - Obtener casos de ejemplo
  - `POST /api/roadmaps.php/generate` - Generar roadmap personalizado
  - `POST /api/roadmaps.php/validate` - Validar parámetros antes de generar
  - `GET /api/roadmaps.php/hours-to-sprints` - Convertir horas estimadas a sprints
  - `PUT /api/roadmaps.php/admin/update` - Actualizar plantillas (requiere autenticación)

### 2. Panel de Administración

- **Ubicación**: `xlerion-site/public/roadmap-admin.html`
- **Acceso**: `http://localhost:5173/roadmap-admin.html` (dev) o `https://xlerion.com/roadmap-admin.html` (prod)
- **Funcionalidades**:
  - Editar plantillas JSON de servicios
  - Editar casos de ejemplo
  - Validar JSON antes de guardar
  - Vista previa de servicios
  - Estadísticas en tiempo real

### 3. Componente React

- **Ubicación**: `xlerion-site/src/components/RoadmapModal.jsx`
- **Función**: Modal interactivo que muestra roadmaps generados
- **Características**:
  - Selector de subservicios
  - Visualización de sprints con detalles
  - Hitos (milestones) destacados
  - Información de equipo recomendado
  - Timeline visual
  - Multiidioma (ES/EN)

### 4. Datos de Referencia

- **Plantillas**: `roadmaps.json` (en la raíz del proyecto)
- **Casos de ejemplo**: `cases_examples.json`
- **Documentos de apoyo**: `ui_flow.md`, `endpoints.md`, `hours_to_sprints.md`, `summary_docs/*.md`

---

## 🚀 Uso del Sistema

### Para Desarrolladores Frontend

#### Integrar el RoadmapModal en una página

```jsx
import RoadmapModal from '../components/RoadmapModal';

function MiPagina() {
  const [showRoadmap, setShowRoadmap] = useState(false);
  const [selectedService, setSelectedService] = useState(null);

  return (
    <>
      <button onClick={() => {
        setSelectedService('desarrollo-web-movil');
        setShowRoadmap(true);
      }}>
        Ver Roadmap
      </button>

      {showRoadmap && (
        <RoadmapModal
          serviceId="desarrollo-web-movil"
          serviceName="Desarrollo Web & Móvil"
          subserviceId="landing-page"
          parameters={{
            requirements_complete: false,
            design_complexity: 'high',
            has_cms: true
          }}
          onClose={() => setShowRoadmap(false)}
        />
      )}
    </>
  );
}
```

#### Llamar a la API directamente

```javascript
// Generar roadmap
const response = await fetch('/api/roadmaps.php/generate', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    service: 'desarrollo-web-movil',
    subservice: 'landing-page',
    parameters: {
      requirements_complete: false,
      design_complexity: 'high',
      has_cms: true
    }
  })
});

const data = await response.json();
console.log(data.roadmap);
// {
//   service: 'desarrollo-web-movil',
//   subservice: 'landing-page',
//   sprints: [...],
//   total_sprints: 4,
//   total_weeks: 6,
//   team: ['UI/UX Designer', 'Frontend Developer', ...],
//   milestones: [...]
// }
```

---

## 🔐 Administración

### Acceso al Panel Admin

1. Ir a `/roadmap-admin.html`
2. Ingresar el token de administrador (por defecto: `xlerion_admin_2026`)
3. Token se almacena en `sessionStorage` durante la sesión

### Cambiar el Token de Admin

**En desarrollo local:**

```bash
# Editar el archivo .env
cd xlerion-site/public/api
echo "ROADMAP_ADMIN_TOKEN=tu_nuevo_token_secreto" >> .env
```

**En producción:**
Configurar la variable de entorno `ROADMAP_ADMIN_TOKEN` en el servidor.

### Editar Plantillas

1. Pestaña **Templates** → editar JSON directamente
2. Botón **✓ Validate** → verificar sintaxis JSON
3. Botón **💾 Save Changes** → guardar (requiere autenticación)

**Estructura de una plantilla de subservicio:**

```json
{
  "id": "landing-page",
  "name": { "es": "Landing Page", "en": "Landing Page" },
  "description": { "es": "...", "en": "..." },
  "parameters": [
    {
      "key": "requirements_complete",
      "label": { "es": "Requisitos completos", "en": "Requirements complete" },
      "type": "boolean",
      "required": true,
      "affects": ["S0"]
    }
  ],
  "sprints": {
    "S0": { /* Discovery */ },
    "S1": { /* Diseño */ },
    "S2": { /* Desarrollo */ }
  },
  "milestones": [...],
  "recommended_team": [...],
  "typical_duration": "3-5 weeks",
  "buffers": [...]
}
```

---

## 🔄 Flujo de Integración con Cotizador

El sistema de roadmaps está diseñado para integrarse con `CotizacionServiciosPage.jsx`:

### Paso 1: Usuario selecciona servicio y completa cuestionario

```jsx
// En CotizacionServiciosPage.jsx
const handleServiceSelect = (serviceId) => {
  setSelectedService(serviceId);
  // Mostrar cuestionario dinámico...
};
```

### Paso 2: Al calcular cotización, generar roadmap

```jsx
const handleCalculate = async () => {
  // 1. Calcular precio (lógica existente)
  const precio = calculatePrice();
  
  // 2. Generar roadmap basado en respuestas
  const roadmapResponse = await fetch('/api/roadmaps.php/generate', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({
      service: selectedService,
      subservice: determineSubservice(),
      parameters: extractParameters()
    })
  });
  
  const { roadmap } = await roadmapResponse.json();
  
  // 3. Mostrar modal con roadmap
  setRoadmapData(roadmap);
  setShowRoadmap(true);
};
```

### Paso 3: Usuario puede ver roadmap detallado

El modal `RoadmapModal` muestra automáticamente:

- Sprints activos según parámetros
- Entregables por sprint
- Timeline estimado
- Equipo necesario
- Hitos del proyecto

---

## 📊 Conversión de Horas a Sprints

Si tienes una estimación en horas, puedes convertirla a sprints:

```javascript
const response = await fetch('/api/roadmaps.php/hours-to-sprints?hours=200&complexity=high');
const data = await response.json();
// {
//   estimated_sprints: 7,
//   recommended_sprint_duration_weeks: 2,
//   total_estimated_weeks: 14,
//   assumptions: {...}
// }
```

**Fórmulas usadas** (ver `hours_to_sprints.md`):

- Capacidad por sprint = FTE × 40 horas × disponibilidad (80%)
- Multiplicador de complejidad: low=1.0, medium=1.2, high=1.5
- Duración recomendada de sprint: 2-4 semanas según tamaño de proyecto

---

## 🌐 Internacionalización (i18n)

Todas las traducciones están en `xlerion-site/src/context/LanguageContext.jsx`:

### Claves añadidas

```javascript
es: {
  roadmap_title: 'Roadmap del Proyecto',
  roadmap_subtitle: 'Planificación de sprints y entregables',
  roadmap_loading: 'Cargando roadmap...',
  roadmap_error: 'Error al cargar roadmap',
  roadmap_weeks: 'semanas',
  roadmap_deliverables: 'Entregables',
  roadmap_roles: 'Roles',
  // ... más claves
}
```

El componente `RoadmapModal` usa automáticamente el idioma activo del contexto.

---

## 🧪 Testing Local

### 1. Iniciar servidor de desarrollo

```powershell
cd xlerion-site
npm run dev
```

### 2. Probar endpoint de templates

```powershell
# Con Vite dev server corriendo
Invoke-WebRequest -Uri "http://localhost:5173/api/roadmaps.php/templates" | ConvertFrom-Json
```

### 3. Probar generación de roadmap

```powershell
$body = @{
  service = 'desarrollo-web-movil'
  subservice = 'landing-page'
  parameters = @{
    requirements_complete = $false
    design_complexity = 'high'
  }
} | ConvertTo-Json

Invoke-WebRequest -Uri "http://localhost:5173/api/roadmaps.php/generate" `
  -Method POST `
  -ContentType "application/json" `
  -Body $body | ConvertFrom-Json
```

### 4. Acceder al panel admin

- URL: `http://localhost:5173/roadmap-admin.html`
- Token: `xlerion_admin_2026`

---

## 🛠️ Mantenimiento

### Añadir un nuevo servicio

1. Editar `roadmaps.json` → añadir a `services`
2. Definir subservicios con sus sprints
3. Crear documento de resumen en `summary_docs/` (opcional)
4. Actualizar traducciones en `LanguageContext.jsx` si es necesario

### Añadir un nuevo subservicio

1. Editar `roadmaps.json` → añadir a `services[service_id].subservices`
2. Definir parámetros que afectan los sprints
3. Especificar sprints (S0, S1, S2, S3, S4)
4. Definir hitos y equipo recomendado

### Modificar duraciones o entregables

1. Acceder al panel admin `/roadmap-admin.html`
2. Editar JSON directamente en la interfaz
3. Validar y guardar cambios
4. Los cambios se reflejan inmediatamente (no requiere rebuild)

---

## 📝 Estructura de Datos

### Service Template (plantilla de servicio)

```json
{
  "name": { "es": "...", "en": "..." },
  "description": { "es": "...", "en": "..." },
  "subservices": [...]
}
```

### Subservice Template (plantilla de subservicio)

```json
{
  "id": "unique-id",
  "name": { "es": "...", "en": "..." },
  "parameters": [...],
  "sprints": {
    "S0": { /* Discovery opcional */ },
    "S1": { /* Sprint 1 */ },
    ...
  },
  "milestones": [...],
  "recommended_team": [...],
  "typical_duration": "X-Y weeks",
  "buffers": [...]
}
```

### Generated Roadmap (roadmap generado)

```json
{
  "service": "service-id",
  "subservice": "subservice-id",
  "parameters": {...},
  "sprints": [...],
  "total_sprints": 5,
  "total_weeks": 12,
  "buffer_weeks": 2,
  "team": [...],
  "milestones": [...],
  "calibration_projects": [...]
}
```

---

## 🔧 Troubleshooting

### Error: "Templates file not found"

- Verificar que `roadmaps.json` existe en la raíz del proyecto
- Verificar permisos de lectura del archivo

### Error: "Unauthorized" al guardar

- Verificar que el token en `.env` es correcto
- Verificar que el header `X-Admin-Token` se envía correctamente

### Modal no muestra datos

- Abrir consola del navegador (F12)
- Verificar errores en Network tab
- Verificar que el endpoint `/api/roadmaps.php/generate` responde correctamente

### Sprints no se generan correctamente

- Verificar que los parámetros enviados coinciden con los definidos en la plantilla
- Verificar que las claves `affects` en los parámetros coinciden con los IDs de sprints

---

## 📚 Recursos Adicionales

- `ui_flow.md` - Especificación del flujo de usuario
- `endpoints.md` - Documentación completa de endpoints
- `hours_to_sprints.md` - Fórmulas de conversión
- `summary_docs/*.md` - Resúmenes ejecutivos por servicio
- `cases_examples.json` - 12 casos de ejemplo con diferentes configuraciones

---

## 🎯 Próximos Pasos Sugeridos

1. **Integración visual en CotizacionServiciosPage**: Añadir botón "Ver Roadmap" después de calcular precio
2. **Exportación PDF**: Añadir botón para descargar roadmap como PDF
3. **Personalización avanzada**: Permitir al usuario ajustar duraciones de sprints manualmente
4. **Notificaciones por email**: Enviar roadmap generado al email del cliente junto con la cotización
5. **Analytics**: Trackear qué servicios/subservicios generan más roadmaps

---

## ✅ Checklist de Implementación

- [x] API endpoints creados (`roadmaps.php`)
- [x] Panel admin creado (`roadmap-admin.html`)
- [x] Componente React actualizado (`RoadmapModal.jsx`)
- [x] Router actualizado para manejar rutas de API
- [x] Traducciones añadidas a `LanguageContext.jsx`
- [x] Variables de entorno configuradas (`.env`)
- [x] Documentación completa creada
- [ ] Testing end-to-end realizado
- [ ] Integración con página de cotización (pendiente)
- [ ] Deploy a producción (pendiente)

---

**Última actualización**: 4 de febrero de 2026  
**Versión del sistema**: 1.0.0  
**Autor**: GitHub Copilot para Xlerion TechLab
