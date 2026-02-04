# Reglas de conversión horas → sprints / Hours → sprints conversion rules

## ES

### Fórmula base

- **Capacidad semanal** por rol: `horas_disponibles = FTE * 40 * disponibilidad`.
- **Capacidad sprint (2–4 semanas)**: `capacidad_sprint = suma(roles) * semanas_sprint`.
- **Sprints requeridos**: `ceil(horas_estimadas / capacidad_sprint)`.

### Heurísticas

- Sprint estándar: **2 semanas** para proyectos pequeños, **3 semanas** para medianos, **4 semanas** para grandes.
- Si hay integraciones críticas, agregar **+1 sprint** de estabilización.
- Si hay más de 3 dependencias externas, usar sprints de **3–4 semanas**.

### Distribución de entregables

1. Priorizar épicas con mayor riesgo al inicio.
2. Respetar dependencias: diseño → desarrollo → integración → QA → deploy.
3. Dividir por vertical slices cuando sea posible.

### Asignación de roles por sprint (ejemplo)

- **S0 Discovery**: PM 30%, BA/UX 50%, Tech Lead 20%.
- **S1 Diseño**: Designer/UX 70%, PM 20%, Tech Lead 10%.
- **S2 Desarrollo**: Devs 70%, QA 20%, PM 10%.
- **S3 Integración/QA**: QA 50%, Devs 30%, DevOps 20%.

---

## EN

### Base formula

- **Weekly capacity** per role: `available_hours = FTE * 40 * availability`.
- **Sprint capacity (2–4 weeks)**: `sprint_capacity = sum(roles) * sprint_weeks`.
- **Required sprints**: `ceil(estimated_hours / sprint_capacity)`.

### Heuristics

- Standard sprint: **2 weeks** for small projects, **3 weeks** for medium, **4 weeks** for large.
- If critical integrations exist, add **+1 stabilization sprint**.
- If there are >3 external dependencies, use **3–4 week** sprints.

### Deliverable distribution

1. Prioritize higher‑risk epics early.
2. Respect dependencies: design → development → integration → QA → deploy.
3. Use vertical slices when possible.

### Role allocation per sprint (example)

- **S0 Discovery**: PM 30%, BA/UX 50%, Tech Lead 20%.
- **S1 Design**: Designer/UX 70%, PM 20%, Tech Lead 10%.
- **S2 Development**: Devs 70%, QA 20%, PM 10%.
- **S3 Integration/QA**: QA 50%, Devs 30%, DevOps 20%.
