# Script Python de GreenWave - Documentación

## 📥 Descarga Disponible

El modal del algoritmo ahora incluye un botón para descargar un **script Python completamente funcional** que implementa el algoritmo de Xlerion GreenWave.

## 🐍 Características del Script Python

### Clases Principales

#### `Direction` (Enum)

Define las 4 direcciones de tráfico en la intersección:

- `NORTH` ('N')
- `SOUTH` ('S')
- `EAST` ('E')
- `WEST` ('W')

#### `Vehicle` (Dataclass)

Representa un vehículo en el sistema:

```python
@dataclass
class Vehicle:
    id: int                      # ID único
    direction: Direction         # Dirección de tráfico
    arrival_tick: int           # Tick de llegada
    departure_tick: int = None  # Tick de salida (cuando se libera)
    
    def wait_time(current_tick) -> int:
        """Calcula tiempo de espera en ticks"""
```

#### `TrafficStats` (Dataclass)

Acumula estadísticas de eficiencia:

```python
@dataclass
class TrafficStats:
    cycles: int                # Ciclos de tráfico
    released: int              # Vehículos liberados
    completed: int             # Vehículos completados
    total_wait_time: int       # Tiempo total espera (ticks)
    wasted_green_time: int     # Verde desperdiciado (ticks)
    total_green_time: int      # Verde total (ticks)
    
    # Métodos:
    # avg_wait_seconds() → float
    # effective_green_usage() → float (porcentaje)
```

#### `IntersectionSimulator` (Dataclass)

Simulador principal que implementa el algoritmo:

```python
@dataclass
class IntersectionSimulator:
    # Tasas de llegada por dirección
    arrival_rates: Dict[Direction, float]
    
    # Estado de simulación
    current_tick: int
    waiting_vehicles: Dict[Direction, List[Vehicle]]
    active_vehicles: List[Vehicle]
    completed_vehicles: List[Vehicle]
    
    # Control inteligente
    current_direction: Direction
    target_to_release: int                 # Cuota de 50
    completed_since_start: int
    served_directions: List[Direction]     # Rotación justa
    
    # Estadísticas separadas
    stats_intelligent: TrafficStats
    stats_traditional: TrafficStats
```

### Métodos Principales

#### `spawn_vehicles(speed: float = 1.0) -> None`

Genera nuevos vehículos según tasas de llegada:

```python
for direction in Direction:
    self.arrival_acc[direction] += self.arrival_rates[direction] * speed
    while self.arrival_acc[direction] >= 1:
        # Crear nuevo vehículo
```

#### `release_vehicles_intelligent() -> None`

**Implementa el algoritmo inteligente completo:**

1. Selecciona dirección más congestionada
2. Aplica rotación justa (`servedDirections`)
3. Libera hasta 50 vehículos máximo
4. Actualiza estadísticas de espera

```python
# Pseudocódigo clave:
available = [d for d in Direction 
             if len(waiting_vehicles[d]) > 0 
             and d not in served_directions]

if not available:
    served_directions = []  # Reset ronda

most_congested = max(available, 
                     key=lambda d: len(waiting_vehicles[d]))

target_to_release = min(50, len(waiting_vehicles[most_congested]))
```

#### `release_vehicles_traditional() -> None`

Implementa sistema tradicional de temporizador fijo:

- Alterna fase cada 60 ticks (3 segundos)
- NS (Norte-Sur) ↔ EO (Este-Oeste)
- Libera sin considerar tráfico real

#### `move_vehicles() -> None`

Mueve vehículos activos:

- Cada vehículo toma 20 ticks para completar
- Registra tiempo de espera al completar

#### `update_metrics(mode: str) -> None`

Calcula métricas de eficiencia:

- Detecta tiempo verde desperdiciado
- Incrementa contador de tiempo verde total

#### `simulate_tick_intelligent() -> None`

Ejecuta un tick (50ms) con modo inteligente:

1. `spawn_vehicles()`
2. `release_vehicles_intelligent()`
3. `move_vehicles()`
4. `update_metrics('intelligent')`

#### `simulate_tick_traditional() -> None`

Ejecuta un tick con modo tradicional (pasos similares)

#### `run_simulation(duration: int, mode: str) -> None`

Ejecuta simulación completa:

```python
for _ in range(duration):
    if mode == 'intelligent':
        self.simulate_tick_intelligent()
    else:
        self.simulate_tick_traditional()
```

#### `print_results(mode: str) -> None`

Imprime resultados formateados:

- Ciclos, vehículos liberados/completados
- Tiempo promedio de espera (en segundos)
- Uso efectivo de luz verde (%)
- Detalles de ticks

### Función Principal

#### `compare_modes() -> None`

**Función principal que:**

1. Crea simulador inteligente (500 ticks)
2. Crea simulador tradicional (500 ticks)
3. Compara resultados:
   - Reducción % en tiempo de espera
   - Mejora % en uso de verde

#### Entry Point

```python
if __name__ == '__main__':
    print("🚦 XLERION GREENWAVE - SIMULADOR DE TRÁFICO INTELIGENTE")
    compare_modes()
```

## 📊 Salida Esperada

### Ejemplo de Resultados

```
======================================================================
SIMULACIÓN: Xlerion GreenWave - Modo INTELLIGENT
======================================================================
Duración: 500 ticks (25.0 segundos)

----------------------------------------------------------------------
RESULTADOS - MODO INTELLIGENT
----------------------------------------------------------------------
Ciclos de tráfico: 125
Vehículos liberados: 1250
Vehículos completados: 1180
Tiempo promedio de espera: 6.45 segundos
Uso efectivo de luz verde: 89.34%
...

======================================================================
MEJORA CON GREENWAVE
======================================================================
Reducción en tiempo de espera: 54.3%
  GreenWave: 6.45s | Tradicional: 14.12s
Mejora en uso de verde: 42.8%
  GreenWave: 89.34% | Tradicional: 46.54%
```

## 🚀 Cómo Ejecutar

### Requisitos

- Python 3.7+
- Sin dependencias externas (solo stdlib)

### Ejecución

```bash
python greenwave_algorithm_2026-01-23.py
```

### Salida

- Resultados en consola
- Comparativa de rendimiento
- Métricas de eficiencia

## 🔧 Personalización

### Modificar Tasas de Llegada

```python
sim = IntersectionSimulator()
sim.arrival_rates = {
    Direction.NORTH: 0.8,  # Alta congestión
    Direction.SOUTH: 0.3,
    Direction.EAST: 0.5,
    Direction.WEST: 0.4
}
sim.run_simulation(1000, 'intelligent')
```

### Cambiar Duración

```python
sim.run_simulation(duration=2000, mode='intelligent')  # ~100 segundos
```

### Ajustar Cuota de Liberación

Modificar en `release_vehicles_intelligent()`:

```python
self.target_to_release = min(100, len(...))  # Cambiar de 50 a 100
```

## 📈 Ampliaciones Posibles

1. **Visualización Gráfica**: Usar matplotlib para gráficos
2. **Exportar Datos**: CSV con métricas por ciclo
3. **Múltiples Intersecciones**: Red de intersecciones
4. **Machine Learning**: Predicción de congestión
5. **API REST**: Exponer como servicio web

## 🔐 Protección Intelectual

- Script descargado contiene marca de agua de trazabilidad
- Header con © 2015-2026 XLERION
- Nombre de archivo incluye fecha de descarga
- Distribución no autorizada es violación de derechos

## 📋 Especificaciones Técnicas

- **Líneas de código**: ~450 líneas funcionales
- **Complejidad**: O(1) por tick (4 direcciones constantes)
- **Memoria**: O(n) donde n = vehículos en sistema
- **Idioma**: Python 3 (ES2022 equivalent)
- **Encoding**: UTF-8 con acentos soportados

## ✅ Validación

- ✅ Script completamente funcional
- ✅ Implementa algoritmo exacto de GreenWave
- ✅ Incluye comparativa vs tradicional
- ✅ Genera estadísticas reales
- ✅ Sin dependencias externas
- ✅ Código documentado y comentado

## 🎯 Casos de Uso

1. **Investigación Académica**: Análisis de algoritmos de tráfico
2. **Benchmarking**: Comparar vs otros sistemas
3. **Prototipado**: Base para desarrollo de versiones más complejas
4. **Educación**: Enseñanza de algoritmos adaptativos
5. **Políticas Públicas**: Demostración de efectividad

---

**Última actualización**: Enero 23, 2026
**Responsable**: XLERION - Ingeniería Creativa Modular
