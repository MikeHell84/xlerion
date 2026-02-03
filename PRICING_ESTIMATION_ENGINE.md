# Motor de Estimación y Pricing Dinámico para Xlerion

**Versión 1.0 - Febrero 2026**

---

## 1. BENCHMARKS DE MERCADO Y TARIFAS

### Metodología de investigación

- **Fuentes locales (Colombia)**: Encuestas de ASODESARROLLADORES, Computrabajo, LinkedIn Salary, proyectos reales del mercado Bogotá-Medellín.
- **Fuentes globales**: Payscale, Glassdoor, Upwork rates, Clutch.co, Good Firms, reports de Toptal.
- **Normatización**: Convertir salarios anuales a tarifa horaria con factor 1,600–2,000 horas/año según contexto.

---

## 2. TARIFAS POR HORA (RANGOS - USD)

### Desarrollo Web y Móvil

| Nivel | Rango USD/hora | Referencia |
|-------|---|---|
| Junior | $12–18 | Colombia: COP 30k–45k; Global: Similar a mercado Latam |
| Mid | $18–28 | Colombia: COP 45k–70k; Global: Mercado promedio |
| Senior | $28–45 | Colombia: COP 70k–110k; Global: Especialistas |

**Justificación**:

- Colombia (2026): Salario junior ~COP 2.4M–3.6M/mes → ~$15/h; senior ~COP 5.6M–8.8M/mes → $35/h.
- Global: Desarrolladores web en latam (Upwork median) $15–25/h; especialistas full-stack $25–50/h.

**Fuentes**:

- [Payscale - Web Developer Colombia](https://www.payscale.com/research/CO/Job=Web_Developer/Salary)
- [Glassdoor - Developer Salary COL](https://glassdoor.com)
- [Upwork Rate Card 2026](https://www.upwork.com/services/search/all)

---

### Software Empresarial (ERP/CRM/POS)

| Nivel | Rango USD/hora |
|-------|---|
| Junior | $15–22 |
| Mid | $22–35 |
| Senior | $35–60 |

**Justificación**:

- Requiere especialización en arquitecturas complejas, bases de datos, integración.
- Colombia: Developers ERP ~COP 3M–5M/mes (junior); ~COP 6M–12M/mes (senior).
- Global: Consultores SAP/Oracle $40–80/h; desarrolladores ERP custom $25–50/h.

**Fuentes**:

- [Clutch.co - ERP Developers](https://clutch.co/software-development)
- [Toptal ERP Specialists](https://www.toptal.com)

---

### Consultoría en Transformación Digital

| Nivel | Rango USD/hora |
|-------|---|
| Consultante | $40–65 |
| Arquitecto | $65–100 |
| Director/CTO | $100–150 |

**Justificación**:

- Servicios de alto valor; requiere experiencia comprobada.
- Colombia: Consultores digitales ~COP 6M–10M/mes; Arquitectos ~COP 10M–20M/mes.
- Global: McKinsey-style consultancy $100–200/h; boutique firms $50–100/h.

**Fuentes**:

- [McKinsey Digital Reports](https://www.mckinsey.com)
- [LinkedIn Salary - Enterprise Architects COL](https://salary.linkedin.com)

---

### Blockchain y Criptoactivos

| Nivel | Rango USD/hora |
|-------|---|
| Junior | $20–35 |
| Mid | $35–60 |
| Senior/Auditor | $60–120 |

**Justificación**:

- Especialización premium; auditoría de smart contracts muy valorada.
- Colombia: Blockchain devs ~COP 3.5M–7M/mes (escaso).
- Global: Smart contract auditors $80–200/h (OpenZeppelin, Trail of Bits level); devs Ethereum $30–80/h.

**Fuentes**:

- [Consensys - Developer Resources](https://consensys.net/blog/)
- [OpenZeppelin Auditors](https://openzeppelin.com)
- [Trail of Bits Rates](https://www.trailofbits.com)

---

### Diseño Gráfico y Branding

| Nivel | Rango USD/hora |
|-------|---|
| Junior Designer | $10–18 |
| Mid Designer | $18–35 |
| Senior/Creative Dir | $35–70 |

**Justificación**:

- Colombia: Diseñadores junior ~COP 1.8M–2.8M/mes; seniors ~COP 3.5M–6M/mes.
- Global: 99designs/Dribbble entry ~$15–30/h; agencies $30–80/h.

**Fuentes**:

- [99designs Blog - Designer Rates](https://99designs.com/blog/)
- [Dribbble Rates Survey](https://dribbble.com)

---

### Marketing Digital

| Nivel | Rango USD/hora |
|-------|---|
| Junior/Specialist | $12–20 |
| Manager | $20–40 |
| Director/Estratega | $40–75 |

**Justificación**:

- Colombia: Social media manager ~COP 2M–3.5M/mes; PPC specialist ~COP 2.5M–4.5M/mes.
- Global: Digital marketer $15–35/h; Growth specialists $30–60/h.

**Fuentes**:

- [HubSpot - Digital Marketing Salary](https://www.hubspot.com/marketing)
- [SEMrush - Industry Reports](https://www.semrush.com)

---

### Desarrollo de Videojuegos

| Nivel | Rango USD/hora |
|-------|---|
| Programmer | $18–35 |
| Game Designer | $15–30 |
| Tech Lead/Producer | $35–70 |

**Justificación**:

- Colombia: Game devs scarse; ~COP 3M–6M/mes.
- Global: Indie devs $20–50/h; studios/specialists $30–80/h; leads $50–100/h.

**Fuentes**:

- [GameIndustry.biz - Salary Data](https://www.gameindustry.biz/)
- [GDC Salary Survey](https://www.gdconf.com/)

---

### Modelado 3D y Animación

| Nivel | Rango USD/hora |
|-------|---|
| Junior 3D Artist | $12–22 |
| Mid 3D Artist/Rigger | $22–40 |
| Senior/Supervisor | $40–80 |

**Justificación**:

- Colombia: 3D artist ~COP 2M–4M/mes (especializado).
- Global: Freelance 3D ArtStation $20–50/h; studios $30–80/h; supervisors $50–100/h.

**Fuentes**:

- [ArtStation Marketplace](https://www.artstation.com)
- [CGTrader Pricing](https://www.cgtrader.com)

---

## 3. MULTIPLICADORES POR VARIABLE

### Desarrollo Web

| Variable | Factor | Justificación |
|----------|--------|---|
| Multiidioma (2+) | 1.25x | +25% integración traducción, testing |
| E-commerce + pasarela | 1.35x | +35% seguridad, integración Stripe/PayU |
| Responsivo + PWA | 1.2x | +20% testing múltiples dispositivos |
| Integraciones (3+) | 1.3x | Cada API requiere 20–30h extra |
| Accesibilidad WCAG AA | 1.15x | +15% testing, auditoría |
| CMS personalizado | 1.4x | +40% arquitectura flexible |
| Performance crítica (<1s) | 1.2x | Optimización, CDN, caching |

**Tope por proyecto**: 3.5x máximo. Si se alcanza, añadir nota: "Riesgo de complejidad: recomendado presupuesto contingency +20%".

---

### Software Empresarial

| Variable | Factor |
|----------|--------|
| Módulos (por cada adicional >2) | 1.25x |
| Migración de datos (>10k registros) | 1.4x |
| Usuarios concurrentes (>100) | 1.2x |
| Compliance regulatorio (GDPR, ISO) | 1.5x |
| Integración ERP existente | 1.35x |
| Custom workflows | 1.3x |
| Reportería avanzada (BI) | 1.25x |

**Tope**: 4.0x. Nota: "Proyecto enterprise: requiere metodología Agile estricta y governance".

---

### Blockchain

| Variable | Factor |
|----------|--------|
| Auditoría externa (smart contracts) | 1.8x |
| Auditoría interna + external | 2.5x |
| Mainnet deployment (gas optimization) | 1.35x |
| Testnet PoC | 1.0x (baseline) |
| Multi-chain (Ethereum + Polygon + Arbitrum) | 1.6x |
| Tokenomics design (economic model) | 1.25x |
| Auditoría de seguridad tercero | 2.0x |

**Tope**: 5.0x (blockchain es crítico). Nota: "Proyecto blockchain: riesgo regulatorio alto; recomendado asesoría legal".

---

### Videojuegos

| Variable | Factor |
|----------|--------|
| Multiplayer (networking) | 1.5x |
| IA/Pathfinding avanzado | 1.4x |
| Porting a 2+ plataformas | 1.6x |
| Monetización (IAP/ads) | 1.25x |
| Integración online leaderboards | 1.2x |
| Localization (3+ idiomas) | 1.3x |
| Post-launch support (3 meses) | 1.5x |

**Tope**: 4.0x. Nota: "Multiplayer y porting incrementan complejidad QA significativamente".

---

## 4. BUFFERS Y RIESGOS

| Escenario | Buffer |
|-----------|--------|
| Discovery/Requierimientos | +15–25% |
| Cambio de alcance (scope creep) | +20–40% |
| Testing y QA | +15–30% |
| Integración con legacy systems | +30–50% |
| Compliance y seguridad | +25–40% |

**Regla**: Mostrar siempre rango mín (sin buffer) y máx (con buffer). Cliente elige tipo contrato:

- **Fixed-price**: Incluir buffer +25% en cotización.
- **Time & Materials**: Mostrar rango sin buffer; facturar por horas reales.

---

## 5. ESTRUCTURA DE SPRINT Y ROADMAP

- **Sprint**: 2–4 semanas (80–160 horas/dev)
- **Épica**: Grupo de features relacionadas (3–5 sprints)
- **Release**: Conjunto de épicas listas para producción

**Conversión automática**:

```
Total horas estimadas / 120 horas/sprint (default 2.5 weeks) = N sprints
```

---

## 6. FORMATO JSON PARA PLANTILLAS

Estructura de base que permite edición y escalabilidad:

```json
{
  "service": {
    "id": "desarrollo-web-movil",
    "name": "Desarrollo Web y Móvil",
    "description": "Sitios responsivos, e-commerce, apps híbridas",
    "base_tariff_range": {
      "junior": { "min": 12, "max": 18 },
      "mid": { "min": 18, "max": 28 },
      "senior": { "min": 28, "max": 45 }
    },
    "tasks": [
      {
        "id": "discovery",
        "name": "Discovery y Requierimientos",
        "hours_range": { "min": 20, "max": 40 },
        "default_level": "mid",
        "description": "Entrevistas, wireframes, especificaciones"
      },
      {
        "id": "frontend",
        "name": "Desarrollo Frontend",
        "hours_range": { "min": 40, "max": 120 },
        "default_level": "mid",
        "multipliers": [
          { "variable": "num_pages", "formula": "hours * (pages / 5)" },
          { "variable": "responsive", "factor": 1.2 }
        ]
      }
    ],
    "multipliers": [
      { "id": "multiidioma", "factor": 1.25, "description": "Traducción (2+ idiomas)" },
      { "id": "ecommerce", "factor": 1.35, "description": "E-commerce + pasarela" }
    ],
    "dependencies": {
      "ecommerce": ["payment_integration", "inventory_system"],
      "api_integration": ["backend_development"]
    },
    "sprint_guidance": {
      "hours_per_sprint": 120,
      "typical_duration_weeks": 12
    },
    "buffer_percent": 25,
    "sources": [
      "Payscale Web Developer 2026",
      "Upwork Rate Card"
    ]
  }
}
```

---

## 7. PRÓXIMOS PASOS

1. ✅ **Documento actual**: Benchmarks y tarifas investigadas.
2. **JSON Completo**: Plantillas para 8 servicios (entregable 2).
3. **UI Flow**: Pasos, validaciones, reglas condicionales (entregable 3).
4. **12 Casos Prueba**: Landing, e-commerce, app hybrid, ERP, blockchain, etc. (entregable 4).
5. **Calibración**: Plan 3 pasos y métricas (entregable 5).

---

## REFERENCIAS Y FUENTES

### Local (Colombia)

- ASODESARROLLADORES: [www.asodesarrolladores.org](https://www.asodesarrolladores.org) - Encuestas salariales
- Computrabajo: [www.computrabajo.com.co](https://www.computrabajo.com.co) - Ofertas y rangos
- LinkedIn Salary: Colombia data (salarios actualizados)

### Global

- Payscale: [payscale.com](https://www.payscale.com) - Benchmarks internacionales
- Glassdoor: [glassdoor.com](https://www.glassdoor.com) - Salary data
- Clutch.co: [clutch.co](https://clutch.co) - Agency rates
- Toptal: [toptal.com](https://www.toptal.com) - Specialist rates
- Upwork: [upwork.com](https://www.upwork.com) - Freelance rates
- GDC (Game Developers Conference): Salary surveys

---

**Documento creado**: Febrero 2, 2026
**Próxima revisión**: Trimestral (ajustar COP/USD según inflación)
