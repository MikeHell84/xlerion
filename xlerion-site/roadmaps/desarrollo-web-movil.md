# Roadmap — Desarrollo Web y Móvil

Service: Desarrollo Web y Móvil
Sprint duration: 2 semanas (recomendado, puede ajustarse a 3)
Project types: Landing, Corporativa, E-commerce, App híbrida, Marketplace

## Cómo leer este roadmap

- Cada sprint incluye: Objetivos, Entregables y Criterios de Aceptación (medibles).
- Variables de esfuerzo están en la sección final; úsalas para ajustar # de sprints.

---

## Pequeño — Landing / Página Corporativa (1–2 sprints)

- # Sprints: 1 (rápido) o 2 (con refinamiento + QA)

Sprint 1 (2 semanas)

- Objetivos:
  - Kickoff y definición de alcance mínimo viable (MVP).
  - Diseño de 2–3 pantallas clave en Figma + aprobación del cliente.
  - Implementación de la versión responsive básica (Home, Contacto).
- Entregables:
  - Documento de alcance (1 página), prototipos Figma, código frontend (staging).
- Criterios de aceptación (medibles):
  - Stakeholder sign‑off del prototipo (e-mail o JIRA) ✅
  - Páginas cargan < 2.5s en Lighthouse (mobile) o se acuerda plan para optimizar ✅
  - Tests unitarios básicos: cobertura mínima 30% (componentes críticos)

Sprint 2 (opcional — 2 semanas)

- Objetivos: QA, accesibilidad, ajustes SEO básicos, despliegue.
- Entregables: Release candidate, checklist de lanzamiento, manual de entrega.
- Criterios de aceptación:
  - 0 blockers en testing de aceptación (UAT) ✅
  - URL en staging accesible y validada por cliente ✅

---

## Mediano — E‑commerce pequeño (3–5 sprints) — ejemplo 4 sprints

- # Sprints: 4 (2 semanas cada uno)

Sprint 1 — Descubrimiento & Diseño

- Objetivos: Requisitos, arquitectura de información, wireframes de 5 pantallas.
- Entregables: Backlog priorizado, prototipos de alta fidelidad (Figma).
- Aceptación: Stakeholder approval de prototipos; backlog con historias estimadas.

Sprint 2 — Implementación Frontend

- Objetivos: Componentes de catálogo, fichas de producto, navegación.
- Entregables: Catálogo navegable con filtros, componentes documentados.
- Aceptación: Catálogo con pruebas e2e que cubran búsquedas básicas.

Sprint 3 — Carrito y Pagos (Backend)

- Objetivos: Checkout, integración con al menos 1 pasarela (Stripe/PayU), APIs.
- Entregables: Flujo de checkout completo en staging, endpoints documentados.
- Aceptación: Transacción de prueba exitosa en sandbox; logs de pago OK.

Sprint 4 — QA, SEO, Lanzamiento

- Objetivos: Tests, optimización, despliegue y handoff.
- Entregables: Release candidate, runbook de despliegue, plan de monitoreo.
- Aceptación: Tests automatizados y manuales pasados; checklist de lanzamiento completado.

---

## Grande — Marketplace / App compleja (6–8 sprints)

- Planear tracks paralelos: Frontend, Backend, Integraciones, QA.
- Introducir sprints de integración cada 2–3 sprints.
- Incluir sprint de estabilización y sprint de soporte post‑lanzamiento (hypercare).

---

## Variables de esfuerzo (para ajustar sprints)

- Número de páginas/vistas: +0.5 sprint por cada 5 páginas adicionales.
- Integraciones externas: +0.5–1 sprint por integración crítica.
- Requisitos de seguridad/compliance: +1 sprint si requiere 2FA/SSO.
- Localización: +0.5 sprint por cada idioma adicional.
- QA intensivo: +1 sprint para cobertura y pruebas automatizadas.

---

## Notas de medición y transparencia

- Cada historia debe incluir Definition of Done (DoD) con criterios claros: acceptance tests, performance threshold, documentación y sign‑off.
- Recomendado usar herramientas: JIRA/GitHub Issues para trazabilidad; Lighthouse y Playwright para métricas y e2e.
