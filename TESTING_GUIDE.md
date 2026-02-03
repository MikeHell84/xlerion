# 🧪 Guía de Testing - Sistema de Aprendizaje Adaptativo

## Cómo Verificar que Funciona

### 1. Abre la Aplicación

```
URL: http://localhost:5174
→ Busca el componente "Semáforo Inteligente"
→ Asegúrate de que esté en modo "INTELIGENTE" (no tradicional)
```

### 2. Abre la Consola del Navegador

```
Windows/Linux: F12
macOS: Cmd + Option + I
→ Ve a la pestaña "Console"
```

### 3. Inicia la Simulación

- Haz clic en el botón **"Iniciar"** o similar
- Debería ver:

  ```
  [INTELIGENT v0] Nueva cola: N:xx S:xx E:xx W:xx, Factor: 50%
  ```

### 4. Observa los Eventos

#### ✅ Sin colisiones (Normal)

```
[T=45] Cola: N:8/17 E:0/6 S:9/14 W:0/4, Actual=0/4, PromWait=32.5
[T=46] Cola: N:8/17 E:0/6 S:9/14 W:0/4, Actual=0/4, PromWait=32.5
```

#### 🚨 Con colisiones (Espera a que ocurran)

```
// Verás un incremento en el contador "Colisiones" de la interfaz
// Y en consola:
⚠️ Accidente ocasional: ajuste menor a 48%
```

#### 🚨🚨 Patrón detectado

```
🚨 PATRÓN DETECTADO: 4 accidentes entre N-E
📉 Reduciendo liberación a 45%
📉 Reduciendo max vehículos/tick a 13
[INTELIGENT v1] Nueva cola: N:31 S:25 E:11 W:7, Factor: 45%
```

### 5. Verifícalo en Interfaz

- **Accidentes**: El contador debe subir cuando hay colisiones
- **Comparación**: Lado a lado con modo "Tradicional" debe tener MENOS accidentes
- **Flow History**: El gráfico debe mostrar liberación progresiva

## 🧬 Pruebas Específicas

### Test 1: Patrón N-E

**Objetivo**: Provocar colisiones N-E repetidas y ver calibración

```bash
1. Inicia modo "Inteligente"
2. Espera ~5 minutos
3. Observa consola
4. Si hay múltiples colisiones N-E:
   → Verás: "🚨 PATRÓN DETECTADO"
   → Verás: "📉 Reduciendo a X%"
   → Versión sube: v0 → v1 → v2
5. Accidentes deberían bajar después
```

**Esperado:**

```
Tick 150-200:  ⚠️ Accidente ocasional (1-2)
Tick 200-300:  🚨 PATRÓN DETECTADO (3-5 accidentes)
Tick 300-400:  📉 Reducción aplicada
Tick 400+:     Menos accidentes que antes
```

### Test 2: Comparación Inteligente vs Tradicional

**Objetivo**: Verificar que Inteligente es MEJOR

```bash
1. Inicia con modo "Inteligente"
2. Deja correr 10 minutos
3. Anota: Colisiones, promedio espera
4. Cambia a modo "Tradicional"
5. Deja correr 10 minutos más
6. Compara:
   - Inteligente: X accidentes
   - Tradicional: X + Y accidentes (Y > 0)
```

**Esperado:**

```
Inteligente:   ~5-10 accidentes (después de calibración)
Tradicional:   ~15-25 accidentes (sin calibración)
Diferencia:    Inteligente 50-70% MEJOR
```

### Test 3: Recuperación Después de Patrón

**Objetivo**: Ver que se recupera cuando mejora

```bash
1. Provoca patrón (Tick ~300)
2. Observa: releasePercentage baja (50% → 45% → 40%)
3. Espera hasta Tick ~1000
4. Observa: Si accidentes bajan → sube lentamente
   ✅ Mejorando: aumentando a 41%
   ✅ Mejorando: aumentando a 42%
```

**Esperado:**

```
Fase 1 (Tick 0-300):   50% → 40% (calibración)
Fase 2 (Tick 300-600): 40% (estable)
Fase 3 (Tick 600-900): 40% → 50% (recuperación)
Fase 4 (Tick 900+):    50% (normal)
```

## 📊 Métricas a Verificar

### En Consola (F12)

```javascript
// Filtra por palabras clave:
// Accidentes:
"🚨 PATRÓN DETECTADO"
"⚠️ Accidente ocasional"

// Calibración:
"📉 Reduciendo"
"✅ Mejorando"
"[INTELIGENT v"

// Estado actual:
"[T=XXX] Cola:"
```

### En Interfaz

- **Contador Accidentes**: Debe estar más bajo en Inteligente
- **Tiempo Espera Promedio**: Más bajo es mejor
- **Gráfico Flow History**: Debe mostrar líneas suaves
- **Versión Algoritmo**: Sube de v0 → v1 → v2

## 🐛 Debugging

### Si NO ves eventos de calibración

```javascript
// Abre consola y ejecuta:
// 1. Busca si hay accidentes
console.log("Accidentes en último minuto:")
// Si ves 0: No hay colisiones (tráfico ligero)
// Si ves >5: Debería haber calibración

// 2. Verifica modo
// Asegúrate de estar en "Inteligente", no "Tradicional"

// 3. Verifica throttling
// Calibración solo ocurre cada 200 ticks (~10 seg)
// Si hace poco que empezó, espera más

// 4. Abre DevTools → Application → LocalStorage
// (Si en futuro se implementa persistencia)
```

### Si ves muchos "⚠️ Accidente ocasional" pero no "🚨 PATRÓN"

```javascript
// Significa que hay accidentes AISLADOS en DIFERENTES DIRECCIONES
// Esto es normal y se ajusta levemente (-2%)
// Espera a que se repita entre las mismas direcciones
// Entonces verás PATRÓN 🚨
```

### Si la versión NO incrementa

```javascript
// Significa que:
// 1. No hay colisiones (tráfico muy ligero)
// 2. Hay colisiones pero en direcciones DIFERENTES (no patrón)
// 3. Caché está viejo (F5 para refrescar)
```

## 📈 Interpretación de Logs

```
[INTELIGENT v0] Nueva cola: N:35 S:28 E:12 W:8, Factor: 50%
└─ Nueva versión del algoritmo
   N=35 vehículos esperando
   Factor de liberación = 50%

[T=450] Cola: N:17/17 E:0/6 S:14/14 W:0/4, Actual=0/4, PromWait=38.50
└─ Tick 450
   N: 17/17 = ya liberó todos 17 asignados
   E: 0/6 = aún sin procesar los 6 asignados
   S: 14/14 = ya liberó los 14
   W: 0/4 = aún sin procesar los 4
   Actual: 0/4 = procesa dirección 0 de 4 (N)
   PromWait: espera promedio = 38.5 ticks

🚨 PATRÓN DETECTADO: 4 accidentes entre N-E
└─ Detectó 4 colisiones N-E consecutivas
   → Dispara calibración agresiva

📉 Reduciendo liberación a 40%
└─ releasePercentage: 45% → 40% (baja 5%)

📉 Reduciendo max vehículos/tick a 11
└─ maxVehiclesPerTick: 13 → 11 (baja 2)

✅ Mejorando: aumentando a 41%
└─ Colisiones bajaron → recuperar lentamente
   releasePercentage: 40% → 41%
```

## 🎮 Interactividad

### Botones a Usar

```
1. "Iniciar/Pausar" - Comienza simulación
2. "Velocidad" - Acelera o ralentiza (default: 1x)
3. Selector de ciudad - Cambia estadísticas de tráfico
4. Selector de intersección - Cambia parámetros locales
5. Toggle "Inteligente" / "Tradicional" - Cambia modo
   (Necesario para testing)
```

### Lo que NO debes hacer

```
❌ Cambiar modo durante simulación (pausa primero)
❌ Resetear velocidad constantemente
❌ Cerrar consola (perderás logs)
❌ Cambiar ciudad muy frecuentemente
```

## ✅ Checklist de Verificación

```
[ ] Consola abierta (F12)
[ ] Modo: Inteligente (verificar UI)
[ ] Simulación iniciada
[ ] Esperar ~30 segundos
[ ] Ver "[INTELIGENT v0]" en logs
[ ] Esperar otro ~5 minutos
[ ] Si hay colisiones: ver "⚠️" o "🚨"
[ ] Si hay patrón: ver versión subir (v0 → v1)
[ ] Si versión subió: ver "[INTELIGENT v1]" con Factor reducido
[ ] Comparar con tradicional en otro tab
[ ] ✅ Sistema de aprendizaje FUNCIONA
```

## 📞 Troubleshooting

| Problema | Causa Probable | Solución |
|----------|---|---|
| No veo logs | Consola cerrada | Abre F12 → Console |
| No veo versión v1 | Tráfico ligero | Aumenta velocidad o espera más |
| Accidentes no bajan | Algoritmo nuevo | Dale más tiempo (~10 minutos) |
| Logs antiguos | Caché del navegador | F5 o Ctrl+Shift+R |
| Modo no cambia | Bug de UI | Recarga página |
| Parámetros no se aplican | Session storage | Abre DevTools → Storage |

---

**Última verificación**: ✅ Sistema operativo
**Fecha**: 2026-01-23
