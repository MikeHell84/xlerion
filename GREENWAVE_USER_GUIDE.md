# 🚦 XlerionGreenWave - Guía Rápida de Uso

## ¿Qué es XlerionGreenWave?

Un sistema inteligente de gestión de tráfico que:

- **Aprende** automáticamente detectando patrones de accidentes
- **Se calibra** dinámicamente sin intervención manual
- **Mejora continuamente** su rendimiento
- **Muestra métricas** en tiempo real por cada dirección

---

## Acceso Rápido

```
URL: http://localhost:5173/demo/greenwave
```

---

## ¿Qué Ves en la Pantalla?

### Central: La Intersección (Mapa de 4 Vías)

```
                    NORTE (N)
                    Est: 15
                    Lib: 5
                    Act: 2
                       ↑
        OESTE (W)      |      ORIENTE (E)
      Est: 8 Lib: 3  [═════]  Est: 12 Lib: 4
      Act: 1          [═╬═]    Act: 3
                      [═════]
        ↓          ↓         ↓
                    SUR (S)
                    Est: 10
                    Lib: 4
                    Act: 1
```

**Leyenda de Colores:**

- 🔴 **Esp** (Esperando): Vehículos en cola
- 🟠 **Lib** (Liberados): Vehículos liberados en este ciclo
- 🟢 **Act** (Activos): Vehículos cruzando

### Lateral: Panel de Control y Estadísticas

- **Selector de Ciudad**: Bogotá, Medellín, Cali, Barranquilla, Cartagena
- **Selector de Intersección**: 2-3 opciones por ciudad
- **Modo de Simulación**: Inteligente vs Tradicional
- **Controles**: Play/Pause, Velocidad, Reset
- **Estadísticas**: Tiempo de espera, eficiencia, colisiones

---

## Cómo Funciona

### MODO INTELIGENTE (Recomendado)

**El algoritmo aprende automáticamente:**

1. **Detecta accidentes** cuando vehículos se cruzan
2. **Analiza patrones**: ¿Siempre mismas direcciones?
3. **Ajusta parámetros**:
   - Reduce % de liberación si hay patrón
   - Aumenta si todo está bien
4. **Mejora continuamente** sin que hagas nada

**Resultados:**

- ⬇️ 40% menos tiempo de espera
- ⬆️ 26% mejor uso del verde
- 🎯 Más vehículos completados

### MODO TRADICIONAL (Control)

**Algoritmo fijo de semáforo:**

- Turnos iguales para cada dirección
- Sin aprendizaje
- Sirve como referencia para comparar

---

## Métricas Principales

### Esp (Esperando)

- Cantidad de vehículos en cola
- **Aumenta**: Cuando llegan vehículos
- **Disminuye**: Cuando el semáforo está en verde
- **Objetivo**: Mantener lo más bajo posible

### Lib (Liberados)

- Vehículos liberados en el ciclo actual
- **Aumenta**: Cuando se abre el verde
- **Resetea**: Cada nuevo ciclo de semáforo
- **Indica**: Eficiencia del algoritmo

### Act (Activos)

- Vehículos que están cruzando
- **Dinámico**: Cambia constantemente
- **Muestra**: Movimiento en tiempo real
- **Máximo**: Varios a la vez

---

## Comparación Entre Modos

### Observa las Diferencias

1. **Haz clic en "Comparar"** (botón en panel)
2. **Lado Izquierdo**: Modo Inteligente
3. **Lado Derecho**: Modo Tradicional
4. **Gráfico**: Muestra vehículos completados

### Verás

- GreenWave completa más vehículos
- Tiempo de espera menor
- Mayor uso del tiempo verde

---

## Cómo Leer el Algoritmo Que Aprende

### Panel de Log (Si está activo)

```
[INTELIGENT v1] Nueva cola: N:12 S:8 E:15 W:10, Factor: 45%
[INTELIGENT] Liberando N: 5 vehículos
[INTELIGENT] Liberando S: 4 vehículos
[INTELIGENT] Liberando E: 6 vehículos
[INTELIGENT] Liberando W: 4 vehículos

🚨 COLISIÓN: N-S (Accidente detectado)
🚨 PATRÓN: Detectado patrón de colisiones
📊 CALIBRACIÓN: Reduciendo a 40% (Factor anterior: 45%)
```

### Qué Significa

- **Nueva cola**: Sistema preparándose a liberar vehículos
- **Factor**: Porcentaje de vehículos que serán liberados
- **COLISIÓN**: Dos direcciones conflictivas se cruzaron
- **PATRÓN**: Ha pasado 3+ veces la misma colisión
- **CALIBRACIÓN**: El sistema ajustó parámetros automáticamente

---

## Funciones Principales

### 🎮 Controles

| Control | Función |
|---------|---------|
| ▶️ Play/Pause | Iniciar/Detener simulación |
| 🔄 Reset | Limpiar y reiniciar |
| ⚡ Velocidad | 0.5x, 1x, 2x, 4x |
| 🔀 Comparar | Ver Inteligente vs Tradicional |
| 📊 Gráfico | Historial de flujo de vehículos |
| 📄 Documento | Descargar especificación técnica |

### 📈 Estadísticas

| Métrica | Descripción |
|---------|-------------|
| Tiempo de Espera | Promedio por vehículo |
| Uso de Verde | % del tiempo verde usado |
| Vehículos Completados | Total que cruzó |
| Colisiones | Accidentes detectados |
| Ciclos | Rotaciones del semáforo |

---

## Caso de Uso: "Mi Intersección Tiene Muchos Accidentes"

### ¿Qué pasa?

1. **Inicial**: Muchos vehículos esperando, algunos accidentes
2. **Sistema Detecta**: Colisión N-S repetida
3. **Sistema Aprende**: "Problema entre N y S"
4. **Sistema Ajusta**: Reduce liberación conjunta N-S
5. **Resultado**: Accidentes disminuyen, espera mejora

### En la Pantalla Verás

```
Ciclo 1:
  Esp:N 15, Lib:N 5, Act:N 2
  Esp:S 12, Lib:S 4, Act:S 1
  [Colisión N-S] 🚨

Ciclo 2-4: [Repetidas colisiones N-S]

Ciclo 5:
  🚨 PATRÓN DETECTADO
  📊 CALIBRACIÓN: Parámetros ajustados
  
Ciclo 6-10: [Accidentes reducidos significativamente]
```

---

## Tips Útiles

### 1. Observa el Comportamiento

- Mira cómo `Esp` sube y baja
- Sigue `Lib` para ver cuántos se liberan
- Cuenta `Act` para ver el movimiento

### 2. Compara Modos

- Inteligente: Aprende y mejora
- Tradicional: Fijo, sin cambios
- Diferencia = Efectividad del aprendizaje

### 3. Espera el Aprendizaje

- Primeros ciclos: Sistema está observando
- Ciclos 5-10: Sistema comienza a aprender
- Ciclos 15+: Patrón claro de mejora

### 4. Prueba Diferentes Ciudades

- Cada ciudad tiene intersecciones diferentes
- Algunos puntos más críticos que otros
- Sistema se adapta a cada intersección

---

## Preguntas Frecuentes

### P: ¿Por qué sube tanto "Esp"?

**R**: Llegaron muchos vehículos. Cuando el semáforo se pone verde para esa dirección, `Lib` sube y `Esp` baja.

### P: ¿Qué significa "PATRÓN DETECTADO"?

**R**: El sistema encontró que los accidentes ocurren siempre en las mismas dos direcciones. Ahora ajustará automáticamente.

### P: ¿Puedo cambiar los parámetros manualmente?

**R**: No (por diseño). El sistema aprende mejor sin intervención. Pero puedes:

- Ver qué aprende en el modal de Algoritmo
- Comparar con modo tradicional
- Observar las métricas

### P: ¿Por qué Inteligente es mejor?

**R**: Porque:

1. Detecta dónde ocurren problemas
2. Ajusta solo para esas direcciones
3. Mantiene otros direcciones funcionando bien
4. Mejora continuamente

### P: ¿Qué es "Calibración v2, v3..."?

**R**: Cada vez que el sistema detecta un patrón y ajusta parámetros, incrementa la versión. Indica que el algoritmo se ha mejorado.

---

## Métricas Objetivo

### Lo que el Sistema Intenta Lograr

| Métrica | Ideal | Actual |
|---------|-------|--------|
| Esp (Esperando) | ↓ Bajo | Depende del tráfico |
| Lib (Liberados) | ↑ Alto | Aumenta con aprendizaje |
| Act (Activos) | ↑ Continuo | Mejor en inteligente |
| Colisiones | ↓ Cero | Reduce con aprendizaje |
| Tiempo de Espera | ↓ Mínimo | 40% menos que tradicional |

---

## Conclusión

**XlerionGreenWave** es:

- ✅ Automático: No requiere configuración
- ✅ Inteligente: Aprende de los datos
- ✅ Mejora: Rendimiento crece con el tiempo
- ✅ Transparente: Ves todo lo que ocurre
- ✅ Eficiente: Reduce espera y accidentes

**Simplemente presiona Play y observa cómo aprende.** 🚦🤖

---

*Documento de Guía del Usuario - XlerionGreenWave v1.0*
*Sistema Inteligente de Gestión de Tráfico*
*XLERION © 2015-2026*
