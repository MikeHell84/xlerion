# CHANGELOG - OPTIMIZACIÓN DE CUESTIONARIOS

**Archivo Modificado**: `xlerion-site/src/pages/CotizacionServiciosPage.jsx`  
**Fecha de Cambio**: 2026-02-01  
**Versión**: 2.1.0  
**Status**: ✅ VALIDADO, COMPILADO, FUNCIONANDO

---

## 📝 DETALLE DE CAMBIOS

### CAMBIO 1: Reemplazo del Objeto `questionnaires` (LÍNEAS 44-110)

**Tipo**: ACTUALIZACIÓN MAYOR  
**Impacto**: Todas las preguntas rediseñadas según estándares internacionales

#### Cambios Específicos por Servicio

##### Desarrollo Web y Móvil

```javascript
ANTES:
  'desarrollo-web-movil': [
    { id: 'pages', question: '¿Cuántas páginas/vistas principales necesitas?', type: 'number', factor: 1.15 },
    { id: 'ecommerce', question: '¿Es una plataforma e-commerce con pagos?', type: 'boolean', factor: 1.6 },
    { id: 'responsivo', question: '¿Necesita ser 100% responsive (mobile-first)?', type: 'boolean', factor: 1.2 },
    { id: 'backend', question: '¿Requiere backend/base de datos personalizada?', type: 'boolean', factor: 1.4 },
    { id: 'integraciones', question: '¿Cuántas integraciones de APIs externas?', type: 'number', factor: 1.1 }
  ]

DESPUÉS:
  'desarrollo-web-movil': [
    { id: 'tipo', question: '¿Tipo de proyecto? (1=Sitio corporativo, 2=E-commerce, 3=Aplicación web compleja, 4=App híbrida)', type: 'number', factor: 1.3 },
    { id: 'pages', question: '¿Cuántas páginas/vistas principales?', type: 'number', factor: 1.12 },
    { id: 'backend', question: '¿Requiere backend/base de datos personalizada?', type: 'boolean', factor: 1.4 },
    { id: 'ecommerce', question: '¿Sistema de pago y transacciones?', type: 'boolean', factor: 1.5 },
    { id: 'autenticacion', question: '¿Sistema de autenticación avanzado (SSO, OAuth, 2FA)?', type: 'boolean', factor: 1.35 },
    { id: 'performance', question: '¿Requisitos de SEO y optimización de velocidad (Core Web Vitals)?', type: 'boolean', factor: 1.2 },
    { id: 'integraciones', question: '¿Integraciones de terceros (APIs, webhooks)?', type: 'number', factor: 1.15 },
    { id: 'testing', question: '¿Requiere testing automatizado y cobertura >80%?', type: 'boolean', factor: 1.25 }
  ]

✅ CAMBIOS:
  - Agregado: 'tipo' (classifica proyecto scope)
  - Agregado: 'autenticacion' (ISO 27001 security)
  - Agregado: 'performance' (Web Vitals)
  - Agregado: 'testing' (QA requirement)
  - Eliminado: 'responsivo' (asumido como estándar 2026)
  - Reordenado para claridad lógica
  - Mejoradas descripciones de preguntas
  - Total: 5 → 8 preguntas (+60%)
```

##### Software Empresarial

```javascript
ANTES:
  'software-empresarial': [
    { id: 'modules', question: '¿Cuántos módulos principales?...', type: 'number', factor: 1.35 },
    { id: 'users', question: '¿Cuántos usuarios concurrentes esperados?', type: 'number', factor: 1.2 },
    { id: 'integration', question: '¿Requiere integración con sistemas legados?', type: 'boolean', factor: 1.5 },
    { id: 'reports', question: '¿Cuántos reportes/dashboards customizados?', type: 'number', factor: 1.25 },
    { id: 'security', question: '¿Requiere seguridad avanzada?', type: 'boolean', factor: 1.4 },
    { id: 'database', question: '¿Necesita migración o restructura de datos?', type: 'boolean', factor: 1.3 }
  ]

DESPUÉS:
  'software-empresarial': [
    { id: 'tipo', question: '¿Tipo de sistema? (1=CRM, 2=ERP, 3=HCM, 4=Análisis/BI, 5=Custom)', type: 'number', factor: 1.4 },
    { id: 'modules', question: '¿Cuántos módulos/funcionalidades principales?', type: 'number', factor: 1.25 },
    { id: 'usuarios', question: '¿Usuarios concurrentes esperados?', type: 'number', factor: 1.2 },
    { id: 'datos', question: '¿Volumen estimado de datos (en GB) y migración requerida?', type: 'number', factor: 1.3 },
    { id: 'integracion', question: '¿Integración con sistemas legados o ERPs existentes?', type: 'boolean', factor: 1.45 },
    { id: 'compliance', question: '¿Requisitos de compliance (GDPR, HIPAA, SOX, ISO)?', type: 'boolean', factor: 1.5 },
    { id: 'reportes', question: '¿Dashboards y reportes customizados (BI)?', type: 'number', factor: 1.2 },
    { id: 'redundancia', question: '¿Alta disponibilidad y disaster recovery requeridos?', type: 'boolean', factor: 1.6 },
    { id: 'soporte', question: '¿Nivel de soporte post-implementación (SLA 24/7)?', type: 'boolean', factor: 1.35 }
  ]

✅ CAMBIOS:
  - Agregado: 'tipo' (CRM/ERP/HCM/BI/Custom) → factor 1.4
  - Agregado: 'compliance' (GDPR/HIPAA/SOX) → factor 1.5 ⭐ CRÍTICO
  - Agregado: 'redundancia' (HA/DR) → factor 1.6 ⭐ CRITICAL
  - Agregado: 'soporte' (SLA 24/7) → factor 1.35
  - Renombrado: 'users' → 'usuarios' (claridad)
  - Renombrado: 'database' → 'datos' (más específico)
  - Renombrado: 'security' → consolidado en compliance
  - Mejora: Ahora cubre 9 dimensiones (era 6)
  - Total: 6 → 9 preguntas (+50%)
```

##### Transformación Digital

```javascript
ANTES:
  'transformacion-digital': [
    { id: 'systems', question: '¿Cuántos sistemas actuales a diagnosticar?', type: 'number', factor: 1.2 },
    { id: 'migration', question: '¿Incluye migración completa a la nube?', type: 'boolean', factor: 1.7 },
    { id: 'training', question: '¿Requiere capacitación intensiva del equipo?', type: 'boolean', factor: 1.35 },
    { id: 'employees', question: '¿Cuántos empleados a entrenar (en decenas)?', type: 'number', factor: 1.1 },
    { id: 'process', question: '¿Cuántos procesos a redefinir/optimizar?', type: 'number', factor: 1.25 },
    { id: 'change_management', question: '¿Requiere gestión integral del cambio?', type: 'boolean', factor: 1.5 }
  ]

DESPUÉS:
  'transformacion-digital': [
    { id: 'alcance', question: '¿Alcance (1=Un área, 2=Departamento, 3=Empresa completa)?', type: 'number', factor: 1.5 },
    { id: 'sistemas', question: '¿Cuántos sistemas/procesos a transformar?', type: 'number', factor: 1.25 },
    { id: 'infraestructura', question: '¿Migración a nube (AWS/Azure/GCP) o modernización on-premise?', type: 'boolean', factor: 1.6 },
    { id: 'stakeholders', question: '¿Cantidad de stakeholders y departamentos involucrados (decenas)?', type: 'number', factor: 1.2 },
    { id: 'cambio', question: '¿Gestión del cambio integral (change management)?', type: 'boolean', factor: 1.45 },
    { id: 'capacitacion', question: '¿Capacitación integral a nivel organizacional?', type: 'boolean', factor: 1.35 },
    { id: 'metodologia', question: '¿Requiere implementación de metodología (Agile, Lean, Six Sigma)?', type: 'boolean', factor: 1.4 },
    { id: 'riesgo', question: '¿Evaluación y gestión de riesgos del cambio?', type: 'boolean', factor: 1.25 }
  ]

✅ CAMBIOS:
  - Agregado: 'alcance' (1=área, 2=depto, 3=empresa) → factor 1.5 ⭐ NEW
  - Agregado: 'metodologia' (Agile/Lean/Six Sigma) → factor 1.4 ⭐ PMBOK
  - Agregado: 'riesgo' (risk management) → factor 1.25 ⭐ PMBOK
  - Renombrado: 'systems' → 'sistemas'
  - Renombrado: 'employees' → 'stakeholders' (más preciso)
  - Renombrado: 'training' → 'capacitacion'
  - Eliminado: 'process' (redundante con 'alcance')
  - Mejor: Ahora cubre PMBOK (scope, risk, methodology)
  - Total: 6 → 8 preguntas (+33%)
```

##### Diseño y Branding

```javascript
ANTES:
  'diseño-branding': [
    { id: 'elements', question: '¿Cuántos elementos en la identidad visual?...', type: 'number', factor: 1.2 },
    { id: 'pages', question: '¿Cuántas páginas/mockups a diseñar?', type: 'number', factor: 1.15 },
    { id: 'revisions', question: '¿Cuántas rondas de revisión esperas?', type: 'number', factor: 1.1 },
    { id: 'brandbook', question: '¿Necesitas guía completa de marca?', type: 'boolean', factor: 1.3 },
    { id: 'prototypes', question: '¿Requiere prototipos interactivos?', type: 'boolean', factor: 1.25 }
  ]

DESPUÉS:
  'diseño-branding': [
    { id: 'alcance', question: '¿Alcance (1=Logo, 2=Identidad completa, 3=Sistema completo de marca)?', type: 'number', factor: 1.3 },
    { id: 'elementos', question: '¿Cantidad de elementos visuales (logos variantes, patrones, componentes)?', type: 'number', factor: 1.15 },
    { id: 'aplicaciones', question: '¿Diseño de aplicaciones (digital, print, empaques, ambiental)?', type: 'number', factor: 1.25 },
    { id: 'ux', question: '¿Incluye experiencia de usuario (UX) y wireframing?', type: 'boolean', factor: 1.3 },
    { id: 'brandbook', question: '¿Guía completa de marca (Brand Guidelines) detallada?', type: 'boolean', factor: 1.35 },
    { id: 'prototipo', question: '¿Prototipos interactivos (Figma/Adobe XD)?', type: 'boolean', factor: 1.2 },
    { id: 'rondas', question: '¿Rondas de revisión/iteración?', type: 'number', factor: 1.1 },
    { id: 'investigacion', question: '¿Investigación de mercado y análisis de competencia?', type: 'boolean', factor: 1.25 }
  ]

✅ CAMBIOS:
  - Agregado: 'alcance' (1=logo, 2=identidad, 3=sistema) → factor 1.3 ⭐ NEW
  - Agregado: 'ux' (UX + wireframing) → factor 1.3 ⭐ NEW
  - Agregado: 'investigacion' (market research) → factor 1.25 ⭐ NEW
  - Renombrado: 'elements' → 'elementos'
  - Renombrado: 'pages' → 'aplicaciones' (más claro)
  - Renombrado: 'revisions' → 'rondas'
  - Mejorado: 'brandbook' ahora especifica "Brand Guidelines"
  - Total: 5 → 8 preguntas (+60%)
```

##### Marketing Digital

```javascript
ANTES:
  'marketing-digital': [
    { id: 'platforms', question: '¿Cuántas redes sociales a gestionar?', type: 'number', factor: 1.2 },
    { id: 'campaigns', question: '¿Cuántas campañas publicitarias activas?', type: 'number', factor: 1.35 },
    { id: 'seo', question: '¿Incluye SEO completo?', type: 'boolean', factor: 1.5 },
    { id: 'content', question: '¿Cuántos artículos/contenido al mes?', type: 'number', factor: 1.15 },
    { id: 'analytics', question: '¿Requiere análisis avanzado y reportería?', type: 'boolean', factor: 1.25 }
  ]

DESPUÉS:
  'marketing-digital': [
    { id: 'estrategia', question: '¿Requiere estrategia digital completa (auditoría + roadmap)?', type: 'boolean', factor: 1.4 },
    { id: 'canales', question: '¿Cuántos canales a gestionar (social, email, web, ads)?', type: 'number', factor: 1.2 },
    { id: 'contenido', question: '¿Volumen de contenido (posts/mes, artículos, videos)?', type: 'number', factor: 1.25 },
    { id: 'campañas', question: '¿Campañas publicitarias pagadas activas?', type: 'number', factor: 1.35 },
    { id: 'seo', question: '¿SEO integral (técnico, on-page, link-building, local)?', type: 'boolean', factor: 1.45 },
    { id: 'analytics', question: '¿Análisis avanzado (GA4, atribución, predictivo) y reportería?', type: 'boolean', factor: 1.3 },
    { id: 'crm', question: '¿Integración con CRM y marketing automation?', type: 'boolean', factor: 1.25 },
    { id: 'conversion', question: '¿Optimización de conversión (CRO) y A/B testing?', type: 'boolean', factor: 1.3 }
  ]

✅ CAMBIOS:
  - Agregado: 'estrategia' (audit + roadmap) → factor 1.4 ⭐ NEW
  - Agregado: 'crm' (CRM + automation) → factor 1.25 ⭐ NEW
  - Agregado: 'conversion' (CRO + A/B testing) → factor 1.3 ⭐ NEW
  - Renombrado: 'platforms' → 'canales'
  - Renombrado: 'campaigns' → 'campañas'
  - Renombrado: 'content' → 'contenido'
  - Mejorado: 'seo' ahora detalla componentes (técnico, on-page, link-building)
  - Mejorado: 'analytics' ahora especifica GA4, atribución, predictivo
  - Total: 5 → 8 preguntas (+60%)
```

##### Videojuegos

```javascript
ANTES:
  'videojuegos': [
    { id: 'mechanics', question: '¿Cuántas mecánicas de gameplay diferentes?', type: 'number', factor: 1.4 },
    { id: 'platforms', question: '¿En cuántas plataformas?...', type: 'number', factor: 1.6 },
    { id: 'graphics', question: '¿Nivel de fidelidad gráfica?...', type: 'number', factor: 2.2 },
    { id: 'content', question: '¿Cuántos niveles/mundos principales?', type: 'number', factor: 1.3 },
    { id: 'audio', question: '¿Incluye música original y efectos?', type: 'boolean', factor: 1.4 },
    { id: 'multiplayer', question: '¿Requiere funcionalidad multiplayer/online?', type: 'boolean', factor: 1.8 },
    { id: 'publishing', question: '¿Incluye publicación en Steam/App Store?', type: 'boolean', factor: 1.25 }
  ]

DESPUÉS:
  'videojuegos': [
    { id: 'genero', question: '¿Género (1=Casual, 2=Indie, 3=AAA, 4=Simulador, 5=Educativo)?', type: 'number', factor: 1.6 },
    { id: 'plataforma', question: '¿Plataformas de destino (1=Mobile, 2=PC, 3=Consola, 4=Multi)?', type: 'number', factor: 1.5 },
    { id: 'arte', question: '¿Nivel de fidelidad gráfica (1=Pixel/2D, 2=Indie 3D, 3=AAA, 4=Fotorealista)?', type: 'number', factor: 2.0 },
    { id: 'contenido', question: '¿Tamaño de contenido (niveles, mundos, misiones)?', type: 'number', factor: 1.35 },
    { id: 'mecanicas', question: '¿Complejidad de mecánicas (1=Simple, 2=Media, 3=Compleja)?', type: 'number', factor: 1.4 },
    { id: 'audio', question: '¿Música original y diseño sonoro profesional?', type: 'boolean', factor: 1.35 },
    { id: 'multijugador', question: '¿Funcionalidad multijugador y online con servidores?', type: 'boolean', factor: 1.7 },
    { id: 'monetizacion', question: '¿Sistema de monetización (F2P, premium, suscripción, ads)?', type: 'boolean', factor: 1.25 },
    { id: 'publicacion', question: '¿Publicación en tiendas (Steam, Epic, App Store, Play Store)?', type: 'boolean', factor: 1.2 }
  ]

✅ CAMBIOS:
  - Agregado: 'genero' (1=casual, 2=indie, 3=AAA, etc) → factor 1.6 ⭐ NEW
  - Agregado: 'monetizacion' (F2P, premium, suscripción) → factor 1.25 ⭐ NEW BUSINESS MODEL
  - Renombrado: 'mechanics' → 'mecanicas'
  - Renombrado: 'platforms' → 'plataforma'
  - Renombrado: 'graphics' → 'arte' (reinterpretado como fidelidad gráfica)
  - Renombrado: 'content' → 'contenido'
  - Renombrado: 'multiplayer' → 'multijugador'
  - Renombrado: 'publishing' → 'publicacion'
  - Cambio de factor: 'arte' 2.2x → 2.0x (ligeramente menos, pero más específico)
  - Cambio de factor: 'multiplayer' 1.8x → 1.7x (ligeramente menos)
  - Total: 7 → 9 preguntas (+28%)
```

##### Modelado 3D

```javascript
ANTES:
  'modelado-3d': [
    { id: 'characters', question: '¿Cuántos personajes/criaturas a modelar?', type: 'number', factor: 1.8 },
    { id: 'assets', question: '¿Cuántos assets/props/escenarios?', type: 'number', factor: 1.5 },
    { id: 'animation', question: '¿Requiere animaciones complejas (rigged)?', type: 'boolean', factor: 1.5 },
    { id: 'texture', question: '¿Incluye texturizado y materiales PBR?', type: 'boolean', factor: 1.35 },
    { id: 'optimization', question: '¿Necesita optimización para tiempo real?', type: 'boolean', factor: 1.2 },
    { id: 'fidelity', question: '¿Nivel de detalle?...', type: 'number', factor: 1.9 }
  ]

DESPUÉS:
  'modelado-3d': [
    { id: 'tipo', question: '¿Tipo (1=Game assets, 2=Arquitectónico, 3=Producto, 4=Carácter, 5=VFX)?', type: 'number', factor: 1.45 },
    { id: 'cantidad', question: '¿Cantidad de assets únicos a crear?', type: 'number', factor: 1.5 },
    { id: 'fidelidad', question: '¿Nivel de detalle (1=Low-poly, 2=Mid-poly, 3=High-poly, 4=Fotorealista)?', type: 'number', factor: 1.8 },
    { id: 'rigging', question: '¿Rigging y esqueleto para animación?', type: 'boolean', factor: 1.4 },
    { id: 'animacion', question: '¿Animaciones complejas (ciclos, interacción)?', type: 'boolean', factor: 1.5 },
    { id: 'materiales', question: '¿Texturizado y materiales PBR/Substance?', type: 'boolean', factor: 1.35 },
    { id: 'integracion', question: '¿Integración con motor (Unity, Unreal, Blender)?', type: 'boolean', factor: 1.3 },
    { id: 'optimizacion', question: '¿Optimización para tiempo real (LOD, baking, polycount)?', type: 'boolean', factor: 1.25 }
  ]

✅ CAMBIOS:
  - Agregado: 'tipo' (game assets, architectural, product, character, VFX) → factor 1.45 ⭐ NEW
  - Agregado: 'rigging' (separate from animation) → factor 1.4 ⭐ NEW
  - Agregado: 'integracion' (Unity/Unreal/Blender) → factor 1.3 ⭐ NEW ENGINE-SPECIFIC
  - Renombrado: 'characters' → 'tipo' + 'cantidad' (mejor segmentación)
  - Renombrado: 'assets' → 'cantidad'
  - Renombrado: 'animation' → 'animacion'
  - Renombrado: 'texture' → 'materiales'
  - Renombrado: 'optimization' → 'optimizacion'
  - Renombrado: 'fidelity' → 'fidelidad'
  - Cambio de factor: 'fidelity' 1.9x → 1.8x (ligeramente menos, más específico)
  - Total: 6 → 8 preguntas (+33%)
```

---

### CAMBIO 2: Reemplazo del Objeto `hourBreakdown` (LÍNEAS 284-350)

**Tipo**: ACTUALIZACIÓN IMPORTANTE  
**Impacto**: Distribución de horas de trabajo mejorada

#### Cambios Específicos

**Desarrollo Web y Móvil** (40h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Análisis de requisitos y diseño (UX/UI)', hours: 8, percentage: 20 },
    { name: 'Desarrollo frontend (HTML/CSS/JS/React)', hours: 16, percentage: 40 },
    { name: 'Desarrollo backend (APIs, bases de datos)', hours: 10, percentage: 25 },
    { name: 'Testing y QA (automatizado y manual)', hours: 4, percentage: 10 },
    { name: 'Despliegue y documentación', hours: 2, percentage: 5 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Arquitectura y Planning', hours: 6, percentage: 15 },
    { name: 'Desarrollo Frontend', hours: 14, percentage: 35 },
    { name: 'Desarrollo Backend', hours: 12, percentage: 30 },
    { name: 'Integración y APIs', hours: 4, percentage: 10 },
    { name: 'Testing y QA', hours: 4, percentage: 10 }
  ]

✅ CAMBIOS:
  - Renombrado: UX/UI → Arquitectura y Planning (más precisión)
  - Renombrado: Frontend → Desarrollo Frontend (claridad)
  - Renombrado: Backend → Desarrollo Backend (claridad)
  - Renombrado: Despliegue → Integración y APIs (mejor enfoque)
  - Reajustado: Horas a 15/35/30/10/10 (suma 100%)
  - Eliminado: Despliegue (ahora incluido en Integración)
```

**Software Empresarial** (80h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Análisis de procesos y diseño arquitectónico', hours: 16, percentage: 20 },
    { name: 'Desarrollo de módulos principales', hours: 40, percentage: 50 },
    { name: 'Integración e implementación', hours: 16, percentage: 20 },
    { name: 'Testing, seguridad y optimización', hours: 8, percentage: 10 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Análisis de Requerimientos', hours: 12, percentage: 15 },
    { name: 'Diseño de Arquitectura', hours: 16, percentage: 20 },
    { name: 'Desarrollo de Módulos', hours: 32, percentage: 40 },
    { name: 'Testing e Implementación', hours: 12, percentage: 15 },
    { name: 'Documentación y Soporte', hours: 8, percentage: 10 }
  ]

✅ CAMBIOS:
  - Separado: "Análisis de procesos" → "Análisis de Requerimientos" (15%)
  - Separado: "Diseño arquitectónico" → "Diseño de Arquitectura" (20%)
  - Consolidado: "Desarrollo de módulos" → "Desarrollo de Módulos" (40%)
  - Reorganizado: "Testing, seguridad y opt" → "Testing e Implementación" (15%)
  - Agregado: "Documentación y Soporte" (10%) ⭐ NEW (ITIL requirement)
  - Total: 4 tareas → 5 tareas
```

**Transformación Digital** (120h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Diagnóstico y auditoría tecnológica', hours: 24, percentage: 20 },
    { name: 'Planificación estratégica y diseño', hours: 36, percentage: 30 },
    { name: 'Implementación y migración', hours: 40, percentage: 33 },
    { name: 'Capacitación y gestión del cambio', hours: 20, percentage: 17 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Auditoría y Diagnóstico', hours: 24, percentage: 20 },
    { name: 'Diseño de Transformación', hours: 30, percentage: 25 },
    { name: 'Implementación', hours: 42, percentage: 35 },
    { name: 'Capacitación y Change Mgmt', hours: 18, percentage: 15 },
    { name: 'Seguimiento y Optimización', hours: 6, percentage: 5 }
  ]

✅ CAMBIOS:
  - Renombrado para claridad y orden lógico
  - Agregado: "Seguimiento y Optimización" (5%) ⭐ NEW
  - Ajustados porcentajes para sumar 100%
  - Total: 4 tareas → 5 tareas
```

**Diseño y Branding** (32h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Investigación y concepto (estrategia)', hours: 8, percentage: 25 },
    { name: 'Desarrollo de identidad visual', hours: 12, percentage: 37.5 },
    { name: 'Diseño de materiales complementarios', hours: 8, percentage: 25 },
    { name: 'Guía de marca y entrega final', hours: 4, percentage: 12.5 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Research y Estrategia', hours: 6.4, percentage: 20 },
    { name: 'Conceptualización', hours: 8, percentage: 25 },
    { name: 'Diseño Ejecutivo', hours: 11.2, percentage: 35 },
    { name: 'Iteraciones y Refinamiento', hours: 4.8, percentage: 15 },
    { name: 'Documentación de Marca', hours: 1.6, percentage: 5 }
  ]

✅ CAMBIOS:
  - Reordenado para flujo lógico
  - Expandido: De 4 a 5 tareas
  - Renombrado: "Desarrollo de identidad" → "Diseño Ejecutivo"
  - Renombrado: "Materiales complementarios" → "Iteraciones y Refinamiento"
  - Separado: Ahora incluye "Documentación de Marca"
  - Reajustados porcentajes: 20/25/35/15/5
```

**Marketing Digital** (48h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Estrategia y planificación de campaña', hours: 8, percentage: 17 },
    { name: 'Gestión de redes sociales y contenido', hours: 16, percentage: 33 },
    { name: 'SEO, SEM y publicidad digital', hours: 16, percentage: 33 },
    { name: 'Análisis, reportes y optimización', hours: 8, percentage: 17 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Auditoría y Estrategia', hours: 9.6, percentage: 20 },
    { name: 'Creación de Contenido', hours: 14.4, percentage: 30 },
    { name: 'Gestión de Campañas', hours: 12, percentage: 25 },
    { name: 'Analytics y Reporting', hours: 7.2, percentage: 15 },
    { name: 'Optimización Continua', hours: 4.8, percentage: 10 }
  ]

✅ CAMBIOS:
  - Expandido: De 4 a 5 tareas
  - Renombrado para claridad y separación de responsabilidades
  - Nuevas proporciones: 20/30/25/15/10
  - Agregado: "Optimización Continua" (10%) ⭐ NEW DATA-DRIVEN
```

**Videojuegos** (160h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Game Design y conceptualización', hours: 32, percentage: 20 },
    { name: 'Desarrollo de gameplay y mecánicas', hours: 64, percentage: 40 },
    { name: 'Arte, gráficos y animaciones', hours: 40, percentage: 25 },
    { name: 'Audio, testing y publicación', hours: 24, percentage: 15 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Concepto y Game Design', hours: 24, percentage: 15 },
    { name: 'Programación (Core/Systems)', hours: 56, percentage: 35 },
    { name: 'Arte y Animación', hours: 40, percentage: 25 },
    { name: 'Audio y Música', hours: 16, percentage: 10 },
    { name: 'QA, Testing y Publicación', hours: 24, percentage: 15 }
  ]

✅ CAMBIOS:
  - Expandido: De 4 a 5 tareas (separación de preocupaciones)
  - Separado: "Audio y Música" como tarea propia
  - Separado: "Audio, testing, publicación" → "Audio" + "QA/Testing/Publicación"
  - Renombrado: "Game Design" → "Concepto y Game Design"
  - Renombrado: "Gameplay" → "Programación (Core/Systems)"
  - Renombrado: "Arte, gráficos, anim" → "Arte y Animación"
  - Nuevas proporciones: 15/35/25/10/15
```

**Modelado 3D** (56h estándar)

```javascript
ANTES:
  tasks: [
    { name: 'Conceptualización y referencias', hours: 8, percentage: 14 },
    { name: 'Modelado y escultura 3D', hours: 24, percentage: 43 },
    { name: 'Texturizado y materiales', hours: 16, percentage: 28.5 },
    { name: 'Rigging, animaciones y optimización', hours: 8, percentage: 14.5 }
  ]

DESPUÉS:
  tasks: [
    { name: 'Concepto y Sculpting', hours: 8.4, percentage: 15 },
    { name: 'Modelado High-Poly', hours: 16.8, percentage: 30 },
    { name: 'Retopología y Rigging', hours: 11.2, percentage: 20 },
    { name: 'Texturizado y Shaders', hours: 11.2, percentage: 20 },
    { name: 'Optimización e Integración', hours: 8.4, percentage: 15 }
  ]

✅ CAMBIOS:
  - Expandido: De 4 a 5 tareas
  - Separado: "Modelado" → "High-Poly" (30%)
  - Separado: "Rigging, anim, opt" → "Rigging" (20%) + "Optimización" (15%)
  - Agregado: "Texturizado y Shaders" (20%) ⭐ EXPLICIT
  - Reajustados porcentajes: 15/30/20/20/15 (suma 100%)
```

---

## 🔍 VALIDACIÓN DE CAMBIOS

### Compilación

```
✅ SIN ERRORES DE COMPILACIÓN
✅ Hot reload detectado automáticamente
✅ Linting: PASS (CotizacionServiciosPage.jsx)
```

### Integridad de Datos

```
✅ Todas las preguntas tienen factor de complejidad
✅ Todos los desglose de horas suman 100%
✅ Todos los servicios tienen ≥5 tareas
```

### Factores de Complejidad

```
Rango validado: 1.1x - 2.0x
Promedio por servicio: 1.25x - 1.5x (razonable)
Factor máximo: 2.0x (videojuegos, gráficos AAA)
```

---

## 📊 RESUMEN ESTADÍSTICO

| Métrica | Antes | Después | Δ |
|---------|-------|---------|---|
| Total Preguntas | 40 | 58 | +45% |
| Preguntas Nuevas | - | +18 | - |
| Preguntas Eliminadas | - | -1 | - |
| Promedio Factor | 1.38x | 1.36x | -1.5% |
| Servicios Mejorados | - | 7/7 | 100% |

---

## 🚀 PRÓXIMOS PASOS

- [ ] Comunicar cambios al equipo
- [ ] Actualizar documentación de ventas
- [ ] Entrenar BDRs con nuevas preguntas
- [ ] Monitorear win rate con nuevos cuestionarios

---

**CHANGELOG GENERADO**: 2026-02-01  
**ESTADO**: ✅ VALIDADO Y LISTO  
**ÚLTIMA ACTUALIZACIÓN**: CotizacionServiciosPage.jsx

---

*Por favor, mantenga este changelog actualizado para futuras auditorías.*
