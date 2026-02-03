# Sistema de Aprendizaje Adaptativo - Semáforo Inteligente

## Descripción General

He implementado un **sistema de calibración automática** que permite que el algoritmo inteligente **aprenda de los accidentes** y se ajuste en tiempo real para evitarlos en el futuro.

## 🧠 Cómo Funciona el Aprendizaje

### 1. Detección de Accidentes

Cuando dos vehículos perpendiculares colisionan en la intersección, el sistema registra:

- **Dirección 1 y 2** que colisionaron (ej: N-E)
- **Tick actual** del evento
- **Parámetros vigentes** (porcentaje de liberación, max vehículos/tick)
- **Versión del algoritmo** (para tracking)

```javascript
accidentHistory.push({
    tick: currentTick,
    dir1: 'N',          // Primera dirección
    dir2: 'E',          // Segunda dirección
    releasePercentage: 0.5,
    maxVehiclesPerTick: 15,
    version: 1
});
```

### 2. Análisis de Patrones

El sistema examina los últimos 5 accidentes:

- Si hay **3+ colisiones** entre las **mismas direcciones** = **PATRÓN DETECTADO** 🚨
- Si es un accidente aislado = ajuste menor ⚠️

```javascript
// Ejemplo: Si los últimos 5 accidentes fueron:
// N-E, N-E, S-W, N-E, N-E
// → Patrón: 4 colisiones N-E + 1 S-W = PATRÓN N-E detectado
```

### 3. Calibración Automática

#### 🚨 Cuando se detecta un PATRÓN

```javascript
// Reducir velocidad de liberación
releasePercentage: 0.5 → 0.45 (reduce 5%)
    ↓
releasePercentage: 0.45 → 0.40
    ↓
releasePercentage: 0.40 → 0.35 (mínimo permitido: 0.30)

// Reducir vehículos máximos por tick
maxVehiclesPerTick: 15 → 13
    ↓
maxVehiclesPerTick: 13 → 11
    ↓
maxVehiclesPerTick: 11 → 9 (mínimo permitido: 8)

// Incrementar versión del algoritmo
calibrationVersion: 1 → 2 → 3...
```

**Resultado**: Se liberan MENOS vehículos por dirección, MÁS lentamente → menos colisiones

#### ⚠️ Cuando es un accidente ocasional

```javascript
// Ajuste menor (solo -2%)
releasePercentage: 0.5 → 0.48
```

#### ✅ Cuando hay MEJORA (menos colisiones)

```javascript
// Si los últimos 10 accidentes < 70% de los anteriores 10:
releasePercentage: 0.40 → 0.41 (recuperar lentamente)
    ↓
releasePercentage: 0.41 → 0.42
    ↓ (hasta máximo 0.5)
releasePercentage: 0.50
```

## 📊 Estado de Calibración

El sistema mantiene un estado con:

```javascript
calibration: {
    releasePercentage: 0.5,      // Porcentaje dinámico (0.3-0.5)
    maxVehiclesPerTick: 15,      // Max vehículos/tick (8-15)
    baseReleaseFactor: 0.5,      // Factor base para cálculos
    accidentHistory: [           // Últimos 50-100 accidentes
        { tick, dir1, dir2, releasePercentage, maxVehiclesPerTick, version }
    ],
    calibrationVersion: 0,       // Incrementa con cada ajuste importante
    lastCalibrationTick: -1000   // Evita calibración muy frecuente (cada 200 ticks = 10 seg)
}
```

## 🎯 Parámetros Adaptables

### Liberación Progresiva

```
Inicio:  50% de vehículos esperando
↓ (con patrones)
45% → 40% → 35% → 30%
↑ (con mejora)
35% → 40% → 45% → 50%
```

### Velocidad de Liberación

```
Inicio:  15 vehículos/tick máximo
↓ (con patrones)
13 → 11 → 9 → 8
↑ (con mejora)
9 → 11 → 13 → 15
```

## 📈 Cómo se Aplican los Cambios

Cuando se completa la calibración:

1. **Nueva cola de liberación** utiliza el nuevo `releasePercentage`:

   ```javascript
   targetRelease = Math.max(1, Math.floor(count * releasePercentage))
   // Ejemplo: 20 vehículos esperando
   // Con 50%: liberar 10
   // Con 40%: liberar 8
   // Con 30%: liberar 6
   ```

2. **Nuevo máximo por tick** utiliza `maxVehiclesPerTick`:

   ```javascript
   toRelease = Math.min(maxVehiclesPerTick, targetRemaining, waitingCount)
   // Ejemplo: si maxVehiclesPerTick=13
   // Libera máximo 13 vehículos por tick (en lugar de 15)
   ```

3. **Versión del algoritmo incrementa**:

   ```
   [INTELIGENT v0] Nueva cola: N:35 S:28 E:12 W:8, Factor: 50%
   [INTELIGENT v1] Nueva cola: N:32 S:26 E:11 W:7, Factor: 45%
   [INTELIGENT v2] Nueva cola: N:28 S:24 E:10 W:6, Factor: 40%
   ```

## 🔍 Monitoreo en Consola

El sistema imprime eventos importantes:

```javascript
// Accidente registrado
🚨 PATRÓN DETECTADO: 4 accidentes entre N-E

// Ajustes de parámetros
📉 Reduciendo liberación a 45%
📉 Reduciendo max vehículos/tick a 13

// Mejora detectada
✅ Mejorando: aumentando a 41%

// Nueva cola con parámetros actualizados
[INTELIGENT v2] Nueva cola: N:32 S:26 E:11 W:7, Factor: 40%
[T=450] Cola: N:8/32 E:0/11 S:5/26 W:0/7, Actual=0/4, PromWait=38.50
```

## 🛡️ Protecciones de Seguridad

### Throttling de Calibración

- Solo se calibra cada **200 ticks** (≈10 segundos)
- Evita ajustes excesivos y permite que cambios anteriores tomen efecto

### Límites de Parámetros

```javascript
releasePercentage: [0.3, 0.5]     // Nunca baja de 30% ni sube de 50%
maxVehiclesPerTick: [8, 15]       // Nunca baja de 8 ni sube de 15
```

### Historial Limitado

- Mantiene últimos 50-100 accidentes (evita memoria infinita)
- Analiza último 5-10 para detectar patrones recientes

## 📊 Ejemplo de Evolución

```
TICK 0:   Inicio
          releasePercentage: 50%
          maxVehiclesPerTick: 15
          accidentes: 0

TICK 100: Colisión N-E detectada
          accidentHistory: [1]
          → Ajuste menor (-2%)
          releasePercentage: 48%

TICK 250: Colisión N-E #2
          accidentHistory: [2]
          → Accidente ocasional
          releasePercentage: 46%

TICK 400: Colisión N-E #3, #4, #5
          accidentHistory: [3,4,5]
          → PATRÓN DETECTADO 🚨
          releasePercentage: 41% (reduce -5%)
          maxVehiclesPerTick: 13

TICK 800: Colisiones bajan a 3 en últimos 10
          (vs 7 en los 10 anteriores)
          → MEJORA DETECTADA ✅
          releasePercentage: 42% (+1%)

TICK 1200: Continúa mejora
          releasePercentage: 43% → 44% → 45%
```

## 🔧 Integración Técnica

### Estado React

```jsx
const [calibration, setCalibration] = useState({
    releasePercentage: 0.5,
    maxVehiclesPerTick: 15,
    baseReleaseFactor: 0.5,
    accidentHistory: [],
    calibrationVersion: 0,
    lastCalibrationTick: -1000
});
```

### Funciones Clave

**1. `calibrateAfterAccident(directionPair, sim)`**

- Registra accidente con contexto
- Detecta patrones
- Ajusta parámetros
- Actualiza `sim` reference

**2. `releaseVehicles()` - Modo Inteligente**

- Lee `calibration.releasePercentage` para calcular `targetRelease`
- Lee `calibration.maxVehiclesPerTick` para limitar liberación
- Crea nuevo queue cada ciclo

**3. `detectCollisions(vehicles)`**

- Detecta colisiones N-S vs E-W
- Llama `calibrateAfterAccident()` en modo inteligente
- Registra stats

## ⚙️ Configuración Recomendada

Para **tráfico ligero**: Mantener 50% (más fluido)
Para **tráfico medio**: Se auto-calibra entre 45-50%
Para **tráfico pesado**: Baja a 35-40% automáticamente

**El sistema NO requiere intervención manual** - aprende y se adapta solo.

## 📝 Limitaciones Actuales

1. **Solo calibra en accidentes**: No hay predicción preventiva
2. **Calibración discreta**: Cambios cada 200 ticks (podría ser continuo)
3. **Análisis simple**: Solo observa últimos 5 accidentes (podría usar ML)
4. **Sin histórico persistente**: Resetea con cada sesión (podría guardar en localStorage)

## 🚀 Mejoras Futuras

1. ✅ **Predicción preventiva**: Reducir antes de que ocurran colisiones
2. ✅ **Historial persistente**: Guardar calibración entre sesiones
3. ✅ **Machine Learning**: Patrón detection + predictive adjustment
4. ✅ **Logging detallado**: Exportar calibración a JSON/CSV
5. ✅ **A/B Testing**: Comparar versiones de calibración

---

**Estado**: ✅ IMPLEMENTADO Y FUNCIONANDO
**Versión**: 1.0
**Última actualización**: 2026-01-23
