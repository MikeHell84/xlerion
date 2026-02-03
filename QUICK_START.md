# 🚀 Quick Start - Sistema de Aprendizaje Adaptativo

## Inicio Rápido (5 minutos)

### 1. Abre la aplicación

```
http://localhost:5174
```

### 2. Abre consola (F12 → Console)

### 3. Ve al componente "Semáforo Inteligente"

### 4. Selecciona modo: **INTELIGENTE** (no Tradicional)

### 5. Haz clic en **INICIAR**

### 6. Observa la consola durante 10 minutos

**Esperado:**

```javascript
[INTELIGENT v0] Nueva cola: N:35 S:28 E:12 W:8, Factor: 50%
[T=45] Cola: N:17/17 E:0/6 S:14/14 W:0/4, Actual=0/4, PromWait=32.5
...
🚨 PATRÓN DETECTADO: 4 accidentes entre N-E
📉 Reduciendo liberación a 45%
📉 Reduciendo max vehículos/tick a 13
[INTELIGENT v1] Nueva cola: N:31 S:25 E:11 W:7, Factor: 45%
```

## 📊 Verificación Rápida

### Filtro 1: Busca "INTELIGENT"

Deberías ver múltiples versiones a lo largo del tiempo

```
v0 → v1 → v2 → v3
```

### Filtro 2: Busca "PATRÓN"

Si hay colisiones repetidas, verás:

```
🚨 PATRÓN DETECTADO
```

### Filtro 3: Busca "Reduciendo"

El algoritmo redujo parámetros:

```
📉 Reduciendo liberación a 45%
📉 Reduciendo max vehículos/tick a 13
```

### Filtro 4: Busca "Mejorando"

El algoritmo se recuperó:

```
✅ Mejorando: aumentando a 42%
```

## 📈 Comparación: Inteligente vs Tradicional

### En tab 1

- Modo: **INTELIGENTE**
- Espera 5 minutos
- Anota: Accidentes, promedio espera

### En tab 2

- Misma intersección
- Modo: **TRADICIONAL**
- Espera 5 minutos
- Anota: Accidentes, promedio espera

### Resultado Esperado

```
Inteligente:   8 accidentes   ← MEJOR
Tradicional:   18 accidentes  ← PEOR
Diferencia:    55% menos ✅
```

## 🧪 Pruebas Específicas

### Test 1: Patrón N-E (10 minutos)

```bash
1. Modo: INTELIGENTE
2. Intersección: av-caracas-72 (Bogotá)
3. Velocidad: 1x
4. Espera 10 minutos

Esperado:
✓ Ver múltiples "N-E" en accidentes
✓ Versión sube (v0 → v1 → v2)
✓ Factor liberación baja (50% → 45% → 40%)
✓ Accidentes bajan después
```

### Test 2: Diferentes Ciudades (15 minutos)

```bash
1. Prueba: Bogotá
2. Prueba: Medellín
3. Prueba: Cali
4. Prueba: Barranquilla

Esperado:
✓ Cada ciudad calibra diferente
✓ Responde a patrones locales
```

### Test 3: Recuperación (20 minutos)

```bash
1. Modo: INTELIGENTE
2. Observa: Patrón detectado (Tick ~300)
3. Observa: Versión sube (v0 → v1)
4. Observa: Factor baja (50% → 40%)
5. Tick ~600-1000: Recuperación
6. Factor sube lentamente (40% → 45%)

Esperado:
✓ Ciclo completo: Reducción → Estabilidad → Recuperación
```

## 🔍 Debugging Commands

### En consola del navegador

```javascript
// Ver versión actual
console.log(calibration.calibrationVersion)

// Ver todos los accidentes registrados
console.log(calibration.accidentHistory)

// Ver parámetros vigentes
console.log({
  release: calibration.releasePercentage,
  maxVeh: calibration.maxVehiclesPerTick
})

// Filtrar solo "PATRÓN"
// [en consola, clickea "Filter" y escribe: PATRÓN]
```

## 📊 KPIs a Monitorear

### Métrica 1: Colisiones

```
Inteligente inicial: ~20
Inteligente después: ~8
Mejora: 60% ✅
```

### Métrica 2: Versión del Algoritmo

```
v0 (inicial) → v1 (1er patrón) → v2 (2do patrón) → v3 (3er patrón)
Mayor número = más aprendizaje ✅
```

### Métrica 3: Factor de Liberación

```
Inicial: 50%
Mínimo: 30%
Punto óptimo: 40-45%
Pico final: 48-50% (recuperado)
```

### Métrica 4: Espera Promedio

```
Alto con 50%: ~40 ticks
Bajo con 40%: ~25 ticks
Menos tiempo esperando = mejor ✅
```

## 💡 Consejos

### Para ver más eventos

- Aumenta velocidad (2x o 3x)
- Usa "rush hour" (Bogotá av-caracas-72)
- Espera más tiempo

### Para ver menos noise

- Usa velocidad 1x
- Intersección con tráfico moderado
- Primeros 5 minutos (varias colas)

### Para debugging

- Abre DevTools (F12)
- Console → Busca por palabra clave
- Filtra: "INTELIGENT", "PATRÓN", "Reduciendo", "Mejorando"

## 📁 Documentación Relacionada

```
IMPLEMENTATION_SUMMARY.md     ← Empiza aquí (resumen ejecutivo)
ADAPTIVE_LEARNING_SYSTEM.md   ← Detalles técnicos
LEARNING_SYSTEM_GUIDE.md      ← Ejemplos y casos de uso
TECHNICAL_ARCHITECTURE.md     ← Código y fórmulas
TESTING_GUIDE.md              ← Cómo verificar que funciona
```

## ✅ Checklist Final

Antes de considerar completado:

```
[ ] Código compila sin errores
[ ] Dev server corre en http://localhost:5174
[ ] Componente "Semáforo Inteligente" disponible
[ ] Modo "INTELIGENTE" seleccionable
[ ] Console muestra "[INTELIGENT v0]"
[ ] Esperar 5-10 minutos
[ ] Ver "PATRÓN DETECTADO" o "Reduciendo"
[ ] Versión sube (v0 → v1)
[ ] Accidentes bajan vs inicial
[ ] Comparar con "TRADICIONAL"
[ ] Inteligente tiene MENOS accidentes
[ ] ✅ LISTO PARA PRODUCCIÓN
```

## 🎯 Métricas de Éxito

### Objetivo 1: Aprendizaje ✅

- [ ] Sistema detecta patrones
- [ ] Versión incrementa
- [ ] Parámetros cambian

### Objetivo 2: Mejora ✅

- [ ] Accidentes bajan 50%+
- [ ] Espera promedio baja
- [ ] Throughput aumenta

### Objetivo 3: Adaptación ✅

- [ ] Se calibra en ~5 minutos
- [ ] Se recupera en ~10 minutos
- [ ] Responde a cambios de tráfico

### Objetivo 4: Autonomía ✅

- [ ] NO requiere intervención manual
- [ ] Trabaja sin configuración
- [ ] Se auto-equilibra

---

**Ready to test?** 🚀

1. Abre: <http://localhost:5174>
2. F12 para consola
3. Modo: INTELIGENTE
4. Clic: INICIAR
5. Espera: 10 minutos
6. Observa: Los logs en consola

**¡El sistema aprende mientras observas!** 👀📊
