# GreenWave™ Dynamic Threshold - Guía Rápida de Testing

## 🚀 Inicio Rápido

### 1. Iniciar el Servidor

```powershell
cd x:\Programacion\XlerionWeb\xlerion-site
npm run dev
```

Esperar:

```
✓ VITE v7.3.1 ready in XXX ms
✓ Local: http://localhost:5173/
```

### 2. Abrir en Navegador

```
http://localhost:5173/
```

---

## 🎮 Testing Manual - 5 Escenarios

### Escenario 1: Pico Matutino (Factor 1.2x)

**Pasos:**

1. Mover slider de hora a **8:00**
2. Seleccionar modo: **greenwave**
3. Observar HUD de cada semáforo

**Esperado:**

```
✓ Factor: 1.2x (visible en HUD)
✓ Umbral aumenta (más tolerancia)
✓ Permite más acumulación de vehículos
✓ Verde se mantiene más tiempo en una dirección
```

**Verificación Visual:**

- El campo `Factor: 1.2x` debe aparecer en cada semáforo
- El campo `Umbral:` debe ser el más alto del día

---

### Escenario 2: Hora Valle (Factor 0.8x)

**Pasos:**

1. Mover slider de hora a **2:00** (madrugada)
2. Seleccionar modo: **greenwave**
3. Generar pocos vehículos (spawn 3-4)
4. Observar el comportamiento

**Esperado:**

```
✓ Factor: 0.8x (visible en HUD)
✓ Umbral muy bajo (poca tolerancia)
✓ Libera colas RÁPIDAMENTE
✓ Verde cambia frecuentemente entre direcciones
```

**Verificación Visual:**

- `Factor: 0.8x` en HUD
- `Umbral: 1` o `Umbral: 2` (muy bajo)
- Verde alterna rápidamente

---

### Escenario 3: Congestion en Una Dirección

**Pasos:**

1. Fijar hora en **8:00 AM** (pico)
2. Género múltiples vehículos en **NORTE** (spawn 10+)
3. Mantener otras direcciones vacías
4. Observar decisión de semáforo

**Esperado:**

```
✓ NORTE recibe VERDE inmediatamente
✓ SUR, ESTE, OESTE reciben ROJO
✓ NORTE se mantiene en verde hasta que su cola baje
✓ Decisión basada en umbral dinámico
```

**Verificación:**

```
NORTE:  Verde ●  Cola: 8  (Umbral: 6)  ← Supera umbral
SUR:    Rojo  ●  Cola: 0
ESTE:   Rojo  ●  Cola: 0  ← Vacío, desencadena prioridad
OESTE:  Rojo  ●  Cola: 1
```

---

### Escenario 4: Todas Direcciones Congestionadas

**Pasos:**

1. Fijar hora en **14:00** (hora normal)
2. Generar vehículos en TODAS las direcciones (5+ cada una)
3. Esperar 5-10 segundos
4. Observar rotación

**Esperado:**

```
✓ Sistema da verde a la dirección CON MENOS vehículos
✓ Efecto: Distribuye el flujo equitativamente
✓ Rotación es justa (todas tienen oportunidades)
✓ Ninguna dirección espera demasiado
```

**Verificación:**

```
Frame 1: N=5, S=5, E=4, W=5 → Verde E (mínimo)
Frame 2 (después de liberación): N=5, S=4, E=3, W=5 → Verde E
```

---

### Escenario 5: Accidente Activo

**Pasos:**

1. Fijar modo: **greenwave**
2. Generar vehículos en todas direcciones
3. Activar accidente en **NORTE**
4. Observar cambio de decisión

**Esperado:**

```
✓ NORTE recibe ROJO (bloqueado por accidente)
✓ SUR recibe ROJO (bloqueado por accidente)
✓ ESTE recibe VERDE (eje contrario)
✓ OESTE recibe VERDE (eje contrario)

Después de desactivar accidente:
✓ Regresa a lógica GreenWave™ normal
```

**Verificación:**

```
Con Accidente (N): NORTE=Rojo, SUR=Rojo, ESTE=Verde, OESTE=Verde
Sin Accidente: Regresa al algoritmo dinámico
```

---

## 📊 Casos de Verificación de Umbral

| Hora | Factor | Total Vehículos | Umbral Esperado | Fórmula |
|------|--------|-----------------|-----------------|---------|
| 8:00 | 1.2x | 28 | 8 | (28÷4)×1.2 = 8.4 → 8 |
| 12:00 | 0.8x | 20 | 4 | (20÷4)×0.8 = 4.0 → 4 |
| 15:00 | 1.0x | 24 | 6 | (24÷4)×1.0 = 6.0 → 6 |
| 2:00 | 0.8x | 6 | 1 | (6÷4)×0.8 = 1.2 → 1 |
| 18:00 | 1.2x | 32 | 10 | (32÷4)×1.2 = 9.6 → 10 |

**Cómo verificar:**

1. Cambiar hora en slider
2. Observar `Factor: Xx` en HUD
3. Cambiar cantidad de vehículos
4. Observar `Umbral: Y` cambia
5. Comparar con fórmula

---

## 🔍 Verificación de Triggers

### Entrada (Queue Entry)

```
✓ Vehículo aparece en simulador
✓ Se mueve hacia línea de parada
✓ `queueTriggered = true` cuando está esperando
✓ Aparece en `Cola: N` del HUD
```

### Salida (Queue Exit)

```
✓ Semáforo está en verde
✓ Vehículo cruza línea de parada
✓ `progress >= STOP_LINE_PROGRESS` se activa
✓ Desaparece del `Cola: N` en siguiente frame
```

**Verificar:**

```
Cola aumenta conforme llegan vehículos ✓
Cola disminuye conforme cruzan ✓
Contador es preciso ✓
```

---

## 💡 Tips de Testing Avanzado

### 1. Captura de Umbral por Hora

```
Crear tabla con valores para cada hora:
2am (0.8x) → Umbral bajo
8am (1.2x) → Umbral alto
14pm (1.0x) → Umbral medio
18pm (1.2x) → Umbral alto
```

### 2. Stress Test

```
Generar 50+ vehículos
Verificar que umbral sigue siendo válido
Sistema no debe fallar
```

### 3. Performance Check

```
Abrir DevTools (F12)
Performance tab → Record
Verificar FPS = 60
Verificar no hay memory leaks
```

### 4. HUD Verification

```
Cada semáforo debe mostrar:
✓ GreenWave™ | Umbral: X | Factor: Y.Zx
✓ Cola: N
✓ Estado (Verde/Rojo)
```

---

## 🐛 Debugging

Si algo no funciona correctamente:

### Compilación falla

```bash
npm run lint:fix
npm run dev
```

### HUD no muestra valores dinámicos

```
Verificar:
✓ selectedHour está siendo pasado a applyGreenWaveDynamicLogic
✓ calculateDynamicThreshold está siendo llamado
✓ Variables están definidas correctamente
```

### Semáforos no cambian de estado

```
Verificar:
✓ updateTrafficLights() está siendo llamado
✓ Modo GreenWave™ está seleccionado
✓ No hay accidente activo (bloquea lógica)
```

### Triggers no funcionan

```
Verificar:
✓ queueTriggered está siendo seteado en spawnVehicle()
✓ inEntryLane está siendo seteado correctamente
✓ progress se está calculando bien en updateVehicles()
```

---

## 📋 Checklist Final

Antes de considerar el testing como completado:

- [ ] ✅ Compilación exitosa (`npm run dev`)
- [ ] ✅ HUD muestra Factor dinámico (0.8, 1.0, 1.2)
- [ ] ✅ HUD muestra Umbral dinámico (1-12)
- [ ] ✅ Umbral cambia cuando varía la hora
- [ ] ✅ Semáforos dan verde a dirección congestionada
- [ ] ✅ Semáforos dan rojo a dirección vacía
- [ ] ✅ Accidente bloquea dirección afectada
- [ ] ✅ Accidente desactivado regresa a normal
- [ ] ✅ Cola aumenta/disminuye con vehículos
- [ ] ✅ No hay crashes o errores en console
- [ ] ✅ Performance = 60 fps
- [ ] ✅ Build de producción exitoso (`npm run build`)

---

## 🎓 Resumen de Funcionalidades

**GreenWave™ Dynamic Threshold implementa:**

1. **Medición en tiempo real** de vehículos por dirección
2. **Cálculo dinámico** de umbral (1-12) cada frame
3. **Adaptación horaria** con factor 0.8-1.2x
4. **Priorización multicriterio** con 5 casos
5. **HUD mejorado** mostrando umbral y factor
6. **Triggers validados** para entrada/salida
7. **Compatibilidad** con modo clásico
8. **Manejo de accidentes** con eje contrario

---

**¡Testing listo!** Cualquier duda, revisar documentación en:

- `GREENWAVE_DYNAMIC_THRESHOLD.md`
- `GREENWAVE_RESUMEN.md`
- `GREENWAVE_VALIDACION.md`
- `GREENWAVE_IMPLEMENTATION_COMPLETE.md`
