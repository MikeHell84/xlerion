# Roadmap — Software Empresarial (ERP / CRM / Sistemas a medida)

Service: Software Empresarial
Sprint duration: 3 semanas (recomendado)
Project types: Módulo, Multi‑módulo, ERP completo, Integraciones legado

## Cómo leer este roadmap

- Cada sprint incluye Objetivos, Entregables y Criterios de Aceptación (medibles).
- Añade fechas por sprint cuando el cliente defina la fecha de inicio.

---

## Mediano — Sistema multi‑módulo (ejemplo: 6 sprints de 3 semanas)

Sprint 1 — Descubrimiento y Arquitectura

- Objetivos: Recolección de requisitos, modelado de datos, plan de migración.
- Entregables: Documento de alcance, ERD, backlog priorizado.
- Aceptación: Aprobación por stakeholders; backlog con stories estimadas y aceptadas.

Sprint 2 — Autenticación y Core Data Models

- Objetivos: Implementar auth, users/roles, CRUD core.
- Entregables: Endpoints auth, esquema DB inicial, tests unitarios.
- Aceptación: Login/logout con roles funcionales; tests unitarios > 40% en módulos core.

Sprint 3 — Módulo A (p.ej. Ventas)

- Objetivos: Funcionalidades CRUD, UI básica, validation.
- Entregables: Módulo en staging, documentación API.
- Aceptación: Historias completadas con pruebas e2e básicas.

Sprint 4 — Módulo B (p.ej. Inventario)

- Objetivos: Integraciones con Módulo A, reglas de negocio.
- Entregables: Flujos transaccionales, pruebas de integración.
- Aceptación: Transacciones entre módulos sin errores críticos en test.

Sprint 5 — Integraciones y Migración de Datos

- Objetivos: Jobs de ETL, adaptadores a sistemas legados.
- Entregables: Scripts de migración y pruebas en staging.
- Aceptación: Migración de muestra (ej. 10% datos) con verificación de integridad.

Sprint 6 — QA, Performance y Despliegue

- Objetivos: Pruebas de carga, hardening, despliegue a producción.
- Entregables: Release candidate, runbook de despliegue, acuerdos SLA.
- Aceptación: Test de carga dentro de SLA, plan de rollback documentado.

---

## Grande — ERP Completo (8–10 sprints)

- Añadir sprints para auditoría, compliance y documentación técnica.
- Incluir sprint de formación y cambio (train‑the‑trainer).

## Variables de esfuerzo

- Usuarios concurrentes: afecta arquitectura y +sprints de performance.
- GB a migrar: +1 sprint por cada 100GB significativos a migrar con transformación.
- Número de integraciones: +0.5–1 sprint por integración compleja.
- Requisitos regulatorios: +1–2 sprints según alcance.

---

## Medición y gobernanza

- Cada sprint termina con un Sprint Review con métricas: historias completas, bugs críticos, lead time.
- KPI ejemplo: % historias completadas >= 85%, tiempo medio de resolución incidents < 48h.
- Usar pipelines CI/CD con métricas (build success rate, test coverage).
