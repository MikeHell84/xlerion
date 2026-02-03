# EJEMPLOS CALIBRADOS v2.0: ANTES vs DESPUÉS

**Comparativa de estimaciones mejoradas para evitar subestimaciones**  
Febrero 2026

---

## METODOLOGÍA

**Antes (v1.0)**: Cálculo simplificado con multiplicadores débiles y buffers insuficientes  
**Después (v2.0)**: Desglose detallado con subtareas, multiplicadores acumulativos, mínimos obligatorios y buffers inteligentes

---

## CASO 1: LANDING PAGE CORPORATIVA

### ANTES (v1.0)

| Concepto | Valor |
|----------|-------|
| Discovery | 20h |
| Diseño | 35h |
| Frontend | 50h |
| Backend | 30h |
| Testing | 20h |
| Deployment | 15h |
| SEO | 10h |
| **Subtotal horas** | **180h** |
| Tarifa promedio | $23/h |
| Subtotal costo | $4,140 |
| Buffer 20% | +$828 |
| **TOTAL v1.0** | **$4,968** |

**Riesgos no identificados**:

- Sin validación de campos requeridos (¿cuántas páginas?, ¿usuarios concurrentes?)
- Sin multiplicador por complejidad
- Buffer bajo (20%)

---

### DESPUÉS (v2.0)

**Entrada usuario**:

- Número de páginas: **3** (landing + servicios + contacto)
- Usuarios concurrentes: **100**
- Integraciones externas: **1** (Google Analytics + formulario a email)

**Desglose detallado**:

| Tarea | Subtareas | v1.0 | Multiplicadores | v2.0 |
|-------|-----------|------|-----------------|------|
| Discovery | 20h base | 20h | — | 20h |
| Diseño | 3 páginas: 12h base + (3-5)*0.15 = 14h | 35h | +15% (páginas) = 40h | **40h** |
| Frontend | Setup 4h + componentes 15h + CSS 15h + integraciones 15h | 50h | Responsive 1.25x + Analytics 1.1x (acum = 1.375x) | **69h** |
| Backend | Modelado 8h + API 12h + Auth 8h + Email 5h | 30h | 1 integración (email) + 1.1x | **40h** |
| Testing | Unit 10h + E2E 8h + exploratorio 5h | 20h | Crítico no, +30% seguridad | **26h** |
| Deployment | CI/CD 8h + Infra 7h + Docs 5h | 15h | — | **20h** |
| SEO | On-page 5h + perf 8h + sitemap 2h | 10h | — | **15h** |
| **Subtotal horas** | — | **180h** | — | **230h** |
| Buffer automático | — | — | +15% | +34.5h |
| Buffer por incertidumbre | — | — | +10% (discovery) | +23h |
| **Total con buffers** | — | **216h** | — | **287.5h** |
| **Tarifa promedio** | — | $23/h | — | $25/h (mix senior) |
| **TOTAL v2.0 COSTO** | — | **$4,968** | — | **$7,187** |

**Análisis**:

- **Aumento**: +44% respecto v1.0
- **Causa**: Desglose granular, multiplicadores realistas, buffers inteligentes
- **Sanity check**: ¿Landing < 40% de promedio? 230h vs 190h histórico = ✅ Dentro de rango
- **Riego detectado**: Ninguno, cotización robusta

---

## CASO 2: E-COMMERCE CON MULTIIDIOMA

### ANTES (v1.0)

| Concepto | Valor |
|----------|-------|
| Discovery | 35h |
| Diseño | 55h |
| Frontend | 120h |
| Backend | 162h |
| E-commerce | 60h |
| Testing | 50h |
| Deployment | 25h |
| Seguridad | 30h |
| SEO | 20h |
| Multiidioma 1.25x | 696h totales |
| **Total horas con buffer** | **864h** |
| Costo estimado | $19,872 |
| **TOTAL v1.0** | **$19,872** |

**Problemas**:

- Multiplicador multiidioma simplista (1.25x al total)
- Sin detalles sobre pasarelas pago
- Sin validación de usuarios concurrentes
- Buffer insuficiente para complejidad

---

### DESPUÉS (v2.0)

**Entrada usuario**:

- Número de páginas: **8** (catálogo dinámico = múltiples templates)
- Usuarios concurrentes: **500**
- Idiomas: **4** (ES, EN, PT, FR)
- Integraciones: **3** (Stripe, PayU, CRM Salesforce)
- Inventario: **10,000+ SKUs con variantes**
- Seguridad: **PCI compliance requerida**

**Cálculo detallado**:

| Tarea | Subtareas desglosadas | Horas base | Multiplicadores | Total |
|-------|---|---|---|---|
| **Discovery** | Entrevistas (12h) + análisis (8h) + specs (5h) | 25h | — | 25h |
| **Diseño** | Mockups (18h) + prototipo (12h) + design system (15h) | 45h | Páginas múltiples +15% (8 ≠ 5) | **52h** |
| **Frontend** | Setup (6h) + componentes (25h) + CSS (20h) + carrito (18h) + filtros (15h) | 84h | Responsive 1.25x + Animations 1.2x (acum 1.5x) | **126h** |
| **Backend** | Modelado datos (15h) + API endpoints (25h) + carrito (15h) + órdenes (20h) + payment processing (20h) + caching (15h) | 110h | Alto volumen (500 concurrent) 1.4x + 3 integraciones (20h × 3) | **194h** |
| **E-commerce** | Carrito 10h + Stripe/PayU (20h) + Multi-currency (8h) + Inventario SKU complejo (25h) | 63h | Multi-pasarela 1.2x + Inventario 1.25x (acum 1.5x) | **94.5h** |
| **Testing** | Unit (15h) + E2E (18h) + Exploratorio (15h) + Payment testing (15h) + Load testing (10h) | 73h | Crítico seguridad (PCI) 1.4x + Mobile (variantes) 1.3x (acum 1.82x) | **132.9h** |
| **Deployment** | CI/CD (12h) + Infra (15h) + Monitoreo (10h) + Docs (8h) | 45h | Alta disponibilidad 1.5x | **67.5h** |
| **Seguridad** | OWASP (12h) + PCI implementation (20h) + Pen testing (15h) | 47h | PCI compliance 1.5x | **70.5h** |
| **SEO** | On-page (8h) + Schema ecommerce (10h) + Performance (12h) | 30h | — | **30h** |
| **Multiidioma** | Traducción UI (40h) + Testing L10n (25h) + Content management (15h) | 80h | 4 idiomas: base × (1 + (4-1) × 0.2) = × 1.6 | **128h** |
| **SUBTOTAL** | — | 702h | — | **899h** |
| **Buffer automático +15%** | — | — | — | +135h |
| **Buffer incertidumbre +20%** | (PCI, 500 concurrent, 4 idiomas riesgo) | — | — | +228h |
| **TOTAL HORAS** | — | — | — | **1,262h** |
| **Tarifa promedio** | Mix: Junior (5%), Mid (50%), Senior (45%) | — | — | $28/h |
| **TOTAL COSTO** | — | — | — | **$35,336** |

**Análisis**:

- **v1.0**: $19,872 (SUBESTIMADO ❌)
- **v2.0**: $35,336 (Realista, basado en desglose granular) ✅
- **Aumento**: +77.8%
- **Causa**: Complejidad real no capturada (inventario SKU, PCI, 4 idiomas, 500 concurrent)
- **Sanity check**: 899h vs histórico 557h (e-commerce base) = +61% justificado por scope extenso ✅

**Sanity checks ejecutados**:

1. ✅ Estimado no < 40% histórico
2. ✅ Multiplicador acumulativo no > 3.0 (máximo 1.82x)
3. ✅ Integración bancaria (Stripe, PayU) → Aplicado security x1.5
4. ✅ PCI compliance detectada → Buffer +20% adicional
5. ✅ Campos obligatorios completos (páginas, concurrent, idiomas, integraciones)

---

## CASO 3: APP HÍBRIDA MULTIPLATAFORMA

### ANTES (v1.0)

| Concepto | Valor |
|----------|-------|
| Horas base (sin detallar) | 280h |
| Multiplicador multiplataforma | 1.6x |
| Horas con factor | 448h |
| Tarifa | $30/h |
| **TOTAL v1.0** | **$13,440** |

**Problemas**:

- Superficial, sin detallar por tarea
- Sin validar audiencia (¿cuántas pantallas?, ¿sincronización offline?)
- Sin detectar riesgos testing multiplataforma

---

### DESPUÉS (v2.0)

**Entrada usuario**:

- Número de pantallas: **25**
- Usuarios concurrentes: **2,000**
- Plataformas: **iOS + Android + Web** (nativa)
- Offline sync: **Sí** (crítico)
- Integraciones: **2** (Backend propio + AWS S3)

**Desglose**:

| Tarea | v1.0 | Multiplicadores v2.0 | v2.0 |
|-------|------|---|---|
| Discovery | — | 20h | 20h |
| Diseño | — | 45h × (1 + (25-5) × 0.15) = 93h | **93h** |
| Frontend Web | — | 90h × (responsive 1.25x + offline 1.3x acum 1.625x) | **146h** |
| Frontend iOS | — | 85h × (nativo compl) | **85h** |
| Frontend Android | — | 85h × (nativo compl) | **85h** |
| Backend | — | 120h × (2 integraciones +40h, sync +30h) | **190h** |
| Offline Sync | — | 50h (crítico) | **50h** |
| Testing iOS | — | 35h × (múltiples dispositivos 1.3x) | **46h** |
| Testing Android | — | 35h × (múltiples versiones 1.3x) | **46h** |
| Testing Web | — | 25h | **25h** |
| Deployment 3 plat. | — | 30h × (3 plataformas) | **90h** |
| **Subtotal** | 280h | — | **776h** |
| Multiplicador nativo 3-plat. | 1.6x (no aplica ya desglosado) | — | — |
| **Con buffers +15% auto + 20% incertidumbre** | 448h + | — | **1,032h** |
| Tarifa mix | $30/h | — | $32/h (más senior) |
| **TOTAL v2.0 COSTO** | **$13,440** | — | **$32,960** |

**Análisis**:

- **Aumento**: +145% respecto v1.0
- **Por qué**: Desglose por plataforma nativa, testing multiplicado, offline sync complejas
- **Sanity check**: 776h vs histórico app 280h = +177% (pero scope es 3× más complejo) ✅

---

## CASO 4: ERP 3 MÓDULOS

### ANTES (v1.0)

Suposición simplificada: "ERP base" = 600h, multiplicador x1.1 para 3 módulos = 660h

| Concepto | Valor |
|----------|-------|
| Horas estimadas | 660h |
| Tarifa | $36/h |
| **TOTAL v1.0** | **$23,760** |

---

### DESPUÉS (v2.0)

**Entrada usuario**:

- Módulos: **3** (Ventas, Almacén, Finanzas)
- Usuarios concurrentes: **100**
- Registros esperados: **5 millones** (histórico 5 años)
- Tiene datos legacy: **Sí** (SAP antiguo)
- Compliance: **Auditoría anual requerida**

**Desglose por módulo**:

| Módulo | Análisis (h) | Datos (h) | API (h) | Frontend (h) | Report (h) | Testing (h) | Total/módulo |
|--------|---|---|---|---|---|---|---|
| **Módulo 1: Ventas** | 35 | 45 | 80 | 60 | 40 | 60 | 320h |
| **Módulo 2: Almacén** | 30 | 50 | 70 | 55 | 35 | 50 | 290h |
| **Módulo 3: Finanzas** | 40 | 55 | 85 | 50 | 50 | 65 | 345h |
| **Subtotal módulos** | 105 | 150 | 235 | 165 | 125 | 175 | **955h** |

**Multiplicadores aplicados**:

| Multiplicador | Factor | Aplicado | Justificación |
|---|---|---|---|
| Número de módulos (3) | +25% × 2 | +238h | Cada módulo adicional al tercero +25% |
| Volumen datos (5M reg) | 1.30x | +371h | Indexación, particionamiento, query optimization |
| Migración datos legacy | +50h fijo | +50h | Extracción SAP, transformación, validación |
| Compliance auditoría | 1.40x | +551h | Trazabilidad completa, segregación datos |
| Alta disponibilidad (SLA 99.9%) | 1.50x | +782h | Replicación sincrónica, failover |

**Resumen**:

| Concepto | Valor |
|----------|-------|
| Subtotal 3 módulos | 955h |
| Multiplicadores acumulativos | +1,992h |
| **Total horas sin buffers** | **2,947h** |
| **Buffer +15% automático** | +442h |
| **Buffer +25% incertidumbre** | (legacy, compliance) | +737h |
| **TOTAL HORAS** | **4,126h** |
| **Tarifa promedio** | (Mid 40%, Senior 60%) | $38/h |
| **TOTAL COSTO v2.0** | — | **$156,788** |

**Comparativa**:

- v1.0: $23,760 (❌ SEVERAMENTE SUBESTIMADO)
- v2.0: $156,788 (✅ Realista, captura complejidad real)
- **Diferencia**: +559% (!)

**Por qué diferencia tan grande**:

1. v1.0 no capturó migración datos (legacy SAP)
2. v1.0 no incluye compliance ni auditoría
3. v1.0 no detalló por módulo (cada uno es proyecto separado)
4. v1.0 ignoró arquitectura alta disponibilidad
5. **LECCIÓN**: ERP no es "3 módulos sencillos", es empresa dentro de empresa

---

## CASO 5: BLOCKCHAIN PoC + AUDIT

### ANTES (v1.0)

| Concepto | Valor |
|----------|-------|
| Smart contracts | 80h |
| Frontend dApp | 60h |
| Testing | 40h |
| Deployment | 20h |
| Subtotal | 200h |
| Tarifa | $70/h (senior) |
| Buffer 25% | +$3,500 |
| **TOTAL v1.0** | **$17,500** |
| External audit | NOT INCLUDED ❌ |

**Error crítico**: No incluye auditoría externa (costo típico $20k-50k)

---

### DESPUÉS (v2.0)

**Entrada usuario**:

- Redes: **2** (Ethereum + Polygon)
- TVL forecast: **$50M**
- Requiere auditoría externa: **Sí** (OpenZeppelin)
- Tokenomics: **Sí, complejo**

**Desglose v2.0**:

| Componente | Estimación |
|---|---|
| **Smart Contract Development** | |
| — Desarrollo código Solidity | 120h |
| — Auditoría interna (OWASP blockchain) | 70h |
| — Optimización gas | 35h |
| **Subtotal Smart Contracts** | **225h** |
| **Tokenomics & Game Design** | |
| — Diseño economía token | 60h |
| — Simulación (Monte Carlo) | 30h |
| **Subtotal Tokenomics** | **90h** |
| **Frontend dApp** | |
| — Setup Web3 (ethers.js) | 12h |
| — UI componentes | 35h |
| — Wallet integration (MetaMask) | 20h |
| — Transacciones y firma | 18h |
| **Subtotal Frontend** | **85h** |
| **Testing Testnet** | |
| — Deploy testnet (Goerli/Sepolia) | 15h |
| — Transaction testing | 25h |
| — Gas optimization validation | 20h |
| **Subtotal Testing** | **60h** |
| **Deployment Mainnet** | |
| — Setup mainnet | 12h |
| — Monitoreo 24/7 (primeras 2 semanas) | 40h |
| **Subtotal Deployment** | **52h** |
| **Multichain (Polygon)** | |
| — Port a Polygon (aprovecha 80% code) | (88h × 0.4 = 35h) | **35h** |
| **TOTAL HORAS DESARROLLO** | **547h** |
| Multiplicador multichain (2 redes) | Base + (networks-1) × 0.4 = base × 1.4 | +153h |
| **HORAS CON MULTICHAIN** | **700h** |
| Buffer +15% automático | +105h |
| Buffer +25% (riesgo regulatorio, nuevas tecnologías) | +175h |
| **TOTAL HORAS** | **980h** |
| Tarifa senior/specialist mix | $75/h |
| **Subtotal horas** | **$73,500** |
| **EXTERNAL AUDIT** | |
| — OpenZeppelin Professional Audit | **$40,000** |
| — (Obligatorio para TVL > $10M) | |
| **TOTAL COSTO v2.0** | **$113,500** |

**Comparativa**:

- v1.0: $17,500 (❌ CRÍTICA SUBESTIMACIÓN)
- v2.0: $113,500 (✅ Realista, incluye audit obligatoria)
- **Diferencia**: +548%

**Sanity checks ejecutados**:

1. ✅ Detectó TVL > $100M → Aplicó seguridad crítica 2.5x
2. ✅ Multichain → Agregó +40% por cada red adicional
3. ✅ Auditoría externa → Fixed cost automático $40k
4. ✅ Compliance → Buffer adicional +25%

**LECCIÓN**: Blockchain no es solo code, es compliance + auditoría + regulación

---

## CASO 6: PACK 10 ASSETS 3D COMPLEX

### ANTES (v1.0)

Suposición: 10 assets × 50h = 500h base, sin multiplicadores significativos

| Concepto | Valor |
|----------|-------|
| Horas | 500h |
| Tarifa promedio artist | $45/h |
| **TOTAL v1.0** | **$22,500** |

**Problemas**:

- Sin detallar por tarea (modeling vs rigging vs animation)
- Sin validar complejidad individual
- Sin multiplicadores por simulaciones avanzadas
- Bulk discount asumido sin justificación

---

### DESPUÉS (v2.0)

**Entrada usuario**:

- Assets: **10 personajes** (humanoides)
- Complejidad: **Complex** (detalles finos, ropaje)
- Animaciones totales: **60** (idle, walk, jump, attack, death, etc)
- Rigging: **Cloth simulation + armadura deformable**
- VFX: **Particulas efectos mágicos**

**Desglose por asset (asumiendo variabilidad)**:

| Asset | Modeling (h) | Texturing (h) | Rigging (h) | Animation (h) | VFX (h) | Optimization (h) | Subtotal |
|---|---|---|---|---|---|---|---|
| 1-4: Guerreros (4×) | 60 | 40 | 15 | 30 | 15 | 8 | 168h × 4 = 672h |
| 5-7: Magos (3×) | 70 | 50 | 20 | 35 | 25 | 10 | 210h × 3 = 630h |
| 8-10: Bestias (3×) | 80 | 45 | 25 | 40 | 30 | 12 | 232h × 3 = 696h |
| **SUBTOTAL** | — | — | — | — | — | — | **1,998h** |

**Multiplicadores aplicados**:

| Multiplicador | Factor | Justificación |
|---|---|---|
| Complex geometry | +40% | High poly detalles, baking necesario |
| Cloth simulation | +100% | Rigging + simulation = tiempo exponencial |
| 60 animaciones (vs 20 típicas) | +80% | 3× animaciones normales |
| Bulk production (10 assets) | -10% | Eficiencia de producción en lote |

**Cálculo**:

| Concepto | Valor |
|----------|-------|
| Subtotal assets | 1,998h |
| Complex geometry (+40%) | +799h |
| Cloth simulation (+100%) | +1,998h |
| Extra animaciones (+80%) | +1,598h |
| Bulk discount (-10%) | -696h |
| **TOTAL HORAS SIN BUFFERS** | **5,697h** |
| Buffer +15% automático | +854h |
| Buffer +15% (riesgo técnico, nuevas simulaciones) | +854h |
| **TOTAL HORAS** | **7,405h** |
| Tarifa artist/animator specialist mix | $55/h (senior/specialist) |
| **TOTAL COSTO v2.0** | **$407,275** |

**Comparativa**:

- v1.0: $22,500 (❌ SUBESTIMADO 1,711%)
- v2.0: $407,275 (✅ Realista para complejidad)
- **Diferencia**: +1,711%

**Por qué diferencia monumental**:

1. v1.0 no detalló: cloth simulation es 2× tiempo (exponencial)
2. v1.0 no capturó: 60 animaciones = 3× cantidad típica
3. v1.0 ignoró: Complex geometry requiere baking especializado
4. v1.0 asumió: Producción rápida en lote (realidad: lotes de 4 max)

---

## RESUMEN COMPARATIVO: ANTES vs DESPUÉS

| Caso | v1.0 | v2.0 | Diferencia | % Cambio |
|------|------|------|-----------|----------|
| 1. Landing | $4,968 | $7,187 | +$2,219 | +44% |
| 2. E-commerce | $19,872 | $35,336 | +$15,464 | +78% |
| 3. App Híbrida | $13,440 | $32,960 | +$19,520 | +145% |
| 4. ERP 3 módulos | $23,760 | $156,788 | +$133,028 | +559% |
| 5. Blockchain PoC | $17,500 | $113,500 | +$96,000 | +548% |
| 6. Assets 3D | $22,500 | $407,275 | +$384,775 | +1,711% |
| **TOTAL 6 casos** | **$102,040** | **$753,046** | **+$650,806** | **+537%** |

**Insights clave**:

✅ **Landing & App Híbrida**: Aumentos moderados (44-145%) por desglose granular  
⚠️ **E-commerce**: Aumento +78% por multiidioma + PCI compliance  
🚨 **ERP**: Aumento +559% por migración datos + compliance + HA  
🚨 **Blockchain**: Aumento +548% por auditoría obligatoria no capturada  
🚨🚨 **3D Assets**: Aumento +1,711% por cloth simulation (exponencial) + animaciones  

**Lecciones aprendidas**:

1. **Subestimaciones ocurren donde hay complejidad oculta**:
   - Migraciones datos (ERP)
   - Auditorías compliance (Blockchain, PCI)
   - Simulaciones físicas (3D)

2. **Desglose granular es crítico**: Cada subtarea revelada cambio estimado de forma significativa

3. **Multiplicadores acumulativos capturan complejidad combinada**: Multiidioma + alta concurrencia + seguridad = exponencial

4. **Buffers inteligentes son esenciales**: +15% automático + 15-25% por incertidumbre

5. **Sanity checks previenen cotizaciones irracionales**: "¿Este estimado es < 40% del histórico?"

---

## RECOMENDACIÓN OPERATIVA

**✅ Implementar Motor v2.0 inmediatamente**:

- Archivos JSON importados a DB
- Validaciones de campos obligatorios en UI
- Sanity checks automáticos antes de mostrar cotización
- Buffers inteligentes según condición proyecto

**⚠️ Usar v1.0 SOLO para:**

- Estimaciones internas de no usar con clientes
- Benchmarking para identificar gaps

**📊 Monitorear desviación real vs estimado**:

- Mes 1-3: Calibrar v2.0 con datos reales
- Mes 4+: Fine-tune multiplicadores y mínimos
