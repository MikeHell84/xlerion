# GreenWave™ Dynamic Threshold System - Implementación

## Descripción General

El sistema **GreenWave™ Dynamic Threshold** ha sido implementado en `ThreeJSIntersection.jsx` para reemplazar el sistema estático de conteo de vehículos. El nuevo sistema utiliza un **umbral dinámico** que se ajusta automáticamente según:

1. **Tráfico total en la intersección** (suma de vehículos en cola en todas las direcciones)
2. **Hora del día** (horas pico, normales o valle)
3. **Lógica de priorización multicriterio**

---

## Componentes Implementados

### 1. **getAdjustmentFactorByHour(hour)**

Calcula el **factor de ajuste (0.8 - 1.2)** según la hora del día.

**Reglas:**

- **Hora pico** (morning y evening según ciudad): `factor = 1.2` → umbral más alto
- **Hora normal** (resto del día): `factor = 1.0`
- **Hora valle** (madrugada 00:00-06:00, mediodía 11:00-14:00): `factor = 0.8` → umbral más bajo

**Ejemplo:**

```javascript
// En Bogotá, 08:00 (hora pico matutina)
getAdjustmentFactorByHour(8) → 1.2

// En Bogotá, 12:00 (hora valle de mediodía)
getAdjustmentFactorByHour(12) → 0.8

// En Bogotá, 15:00 (hora normal)
getAdjustmentFactorByHour(15) → 1.0
```

---

### 2. **calculateDynamicThreshold(waitingCounts, hour)**

Calcula el **umbral dinámico** basado en el tráfico total.

**Fórmula:**

```
Umbral = round( (totalVehículos / 4) * factorAjuste )
Rango: [1, 12] (mínimo 1, máximo 12)
```

**Ejemplos:**

| Total Vehículos | Hora | Factor | Umbral | Interpretation |
|---|---|---|---|---|
| 28 | Pico (8am) | 1.2 | 8 | Cada dirección puede acumular hasta 8 |
| 20 | Normal (3pm) | 1.0 | 5 | Cada dirección puede acumular hasta 5 |
| 16 | Valle (2am) | 0.8 | 3 | Umbral bajo - liberar rápido |
| 0 | Cualquiera | - | 0 | Intersección vacía |

---

### 3. **applyGreenWaveDynamicLogic(waitingCounts, hour)**

Aplica la **lógica de priorización multicriterio** basada en el umbral dinámico.

**Casos de decisión:**

#### **Caso 1: Una dirección supera el umbral y otra está vacía**

- **Acción:** Dar verde inmediato a la dirección congestionada
- **Ejemplo:** N=8, S=2, E=0, W=1, Umbral=5
  - N supera umbral (8 > 5) ✓
  - E está vacío (0) ✓
  - **Resultado:** Verde a N, rojo a S/E/W

#### **Caso 2: Todas las direcciones tienen vehículos**

- **Acción:** Dar verde a la dirección con MENOS vehículos (para que no espere mucho)
- **Ejemplo:** N=6, S=5, E=4, W=5, Umbral=4
  - Todas tienen > 0 ✓
  - **Resultado:** Verde a E (la menor), rojo a N/S/W
  - **Efecto:** Evita "hambre" (starvation) de direcciones con bajo flujo

#### **Caso 3: Todas las direcciones vacías**

- **Acción:** Poner rojo a todo (no hay flujo que procesar)
- **Resultado:** Rojo a todas las direcciones

#### **Caso 4: Solo una dirección tiene vehículos**

- **Acción:** Verde a esa dirección
- **Ejemplo:** N=3, S=0, E=0, W=0
  - **Resultado:** Verde a N, rojo a S/E/W

#### **Caso 5: Lógica por defecto**

- **Acción:** Verde a la dirección con MAYOR cola
- **Ejemplo:** N=4, S=3, E=5, W=2
  - **Resultado:** Verde a E (máximo 5), rojo a N/S/W

---

## Triggers de Entrada/Salida

### **Trigger de Entrada** (trigger zones antes del semáforo)

```javascript
// En src/components/ThreeJSIntersection.jsx, función spawnVehicle()
// Los vehículos son marcados como "queueTriggered" cuando entran en zona de espera
v.userData.queueTriggered = true; // Vehículo está en la cola
v.userData.inEntryLane = true;    // Vehículo está en carril de entrada
```

### **Trigger de Salida** (detecta cuando vehículo cruza línea de parada)

```javascript
// En updateVehicles()
if (v.userData.progress >= STOP_LINE_PROGRESS) {
    // Vehículo ha cruzado el semáforo
    // Se elimina del conteo de colas automáticamente
}
```

### **Validación de Triggers**

- ✅ Los triggers alimentan `vehiclesRef.current[direction][]` (array de vehículos por dirección)
- ✅ `measureWaitingQueues()` cuenta solo vehículos que cumplen:
  - `queueTriggered === true` (en zona de espera)
  - `inEntryLane === true` (en carril de entrada)
  - `progress < STOP_LINE_PROGRESS` (antes de cruzar)

---

## Integración en el Loop Animate

```javascript
// En useEffect, dentro de la función animate():

const waitingCounts = measureWaitingQueues(); // Medir colas en tiempo real

if (effectiveMode !== 'classic') {
    if (accidentRef.current.active) {
        // MODO ACCIDENTE: dar paso al eje contrario
        // ...
    } else {
        // MODO NORMAL: aplicar GreenWave™ dinámico
        applyGreenWaveDynamicLogic(waitingCounts, selectedHour);
    }
}
```

---

## Visualización en HUD

El HUD de cada semáforo ahora muestra:

```
═══════════════════════════════════════════════════════════════════
                            NORTE (N)
═══════════════════════════════════════════════════════════════════
GreenWave™ | Umbral: 8 | Factor: 1.2x
Cola: 5
Verde
───────────────────────────────────────────────────────────────────
```

**Campos del HUD:**

- **Umbral:** Umbral dinámico actual (calculado en tiempo real)
- **Factor:** Factor de ajuste por hora (0.8, 1.0, 1.2)
- **Cola:** Número de vehículos en espera

---

## Ejemplos de Comportamiento

### **Ejemplo 1: Hora Pica Matutina en Bogotá (08:00)**

- Hora: 8:00 AM → **Factor = 1.2x** (pico matutino)
- Vehículos en cola: N=7, S=6, E=4, W=5 → Total=22
- **Umbral = round((22/4) * 1.2) = round(6.6) = 7**
- **Decisión:**
  - N supera umbral (7 ≥ 7) ✓
  - E no supera (4 < 7)
  - **Resultado:** Verde a N, rojo a S/E/W
  - **Justificación:** Hora pica → tolera más acumulación

### **Ejemplo 2: Madrugada (03:00)**

- Hora: 3:00 AM → **Factor = 0.8x** (hora valle)
- Vehículos en cola: N=2, S=1, E=0, W=3 → Total=6
- **Umbral = round((6/4) * 0.8) = round(1.2) = 1**
- **Decisión:**
  - W supera umbral (3 > 1) ✓
  - E está vacío (0) ✓
  - **Resultado:** Verde a W inmediatamente
  - **Justificación:** Madrugada → muy bajo umbral, liberar rápido

### **Ejemplo 3: Hora Normal (15:00)**

- Hora: 3:00 PM → **Factor = 1.0x** (hora normal)
- Vehículos en cola: N=4, S=4, E=4, W=4 → Total=16
- **Umbral = round((16/4) * 1.0) = 4**
- **Decisión:**
  - Todas tienen la misma cantidad (4 = 4 = 4 = 4)
  - **Resultado:** Verde a E (primera en orden de reducción), rojo a N/S/W
  - **Efecto:** Rotación equilibrada sin favoritismo

---

## Adaptación a Condiciones de Tráfico

| Condición | Factor | Umbral | Efecto |
|---|---|---|---|
| Hora pica (6-9am, 4-7pm) | 1.2x | +20% | Tolera más acumulación, más eficiente en flujo masivo |
| Hora normal (9am-11am, 2-4pm) | 1.0x | Base | Balance entre eficiencia y espera |
| Hora valle (madrugada, mediodía) | 0.8x | -20% | Libera colas rápidamente, bajo flujo |

---

## Diferencias vs Sistema Anterior

| Aspecto | Sistema Anterior | GreenWave™ Dinámico |
|---|---|---|
| **Umbral** | Fijo (hardcoded) | Dinámico, recalculado cada frame |
| **Adaptación Horaria** | Ninguna | Factor 0.8-1.2 según hora |
| **Priorización** | Solo máximo por eje | Multicriterio (congestion, vacíos, mínimo) |
| **Trigger Validation** | Básica | Validación completa entrada/salida |
| **HUD** | Modo simple | Muestra umbral y factor dinámico |
| **Eficiencia** | Fija para todas las horas | Optimizada por hora del día |

---

## Testing & Validación

### **Pruebas Recomendadas:**

1. **Hora Pica (8:00 AM en Bogotá)**
   - Spawn múltiples vehículos en una dirección
   - Verificar que tolera más acumulación antes de cambiar de fase
   - Observar factor 1.2x en HUD

2. **Hora Valle (2:00 AM)**
   - Spawn pocos vehículos
   - Verificar que libera colas muy rápidamente
   - Observar factor 0.8x en HUD

3. **Congestion en Una Dirección**
   - Hacer que N acumule 10+ vehículos
   - S/E/W vacíos
   - Verificar que N recibe verde inmediatamente

4. **Todas Direcciones Congestionadas**
   - Acumular 5+ vehículos en todas direcciones
   - Verificar que rota entre direcciones de forma equilibrada

5. **Accidente Activo**
   - Activar accidente en N
   - Verificar que E/W reciben verde (eje contrario)
   - Desactivar accidente y ver retorno a lógica normal

---

## Notas Técnicas

- **Actualización:** Cada frame del loop `animate()` (60 fps)
- **Cálculo del umbral:** O(n) donde n=4 (constante, 4 direcciones)
- **Memory:** Sin overhead adicional (no almacena estado)
- **Thread-Safe:** Sí (cálculos puros, sin race conditions)

---

## Próximas Mejoras Sugeridas

1. **Machine Learning:** Entrenar modelo con datos históricos para predicción de congestión
2. **Penalización de espera:** Factores adicionales por tiempo en cola
3. **Detección de patrones:** Identificar si hay congestión sistemática en una dirección
4. **Integración GPS:** Datos reales de tráfico para ajustar dinámicamente
5. **Prioridad de emergencia:** Detectar ambulancias/bomberos y abrir carril
