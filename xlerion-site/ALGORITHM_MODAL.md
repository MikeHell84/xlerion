# Modal del Algoritmo de GreenWave - Documentación

## 📋 Descripción General

Modal interactivo con el algoritmo completo de **Xlerion GreenWave™**. Protección: contraseña compartida con el Documento Técnico (`81720164`). Contenido alineado a la versión patent-pending PCT (control adaptativo de intersecciones, 2026).

## 🔐 Autenticación

- Contraseña: `81720164` (`VITE_TECHNICAL_DOC_PASSWORD` en `.env`).
- Validación en tiempo real, mensajes de error claros y limpieza de campo tras éxito.
- Flujo: Click "💡 Algoritmo" → Modal de autenticación → Modal técnico.

## 📚 Estructura del Contenido

1) **Propósito y alcance**: Controlador de tráfico en tiempo real (edge + nube) con continuidad operacional y fail-open.

2) **Entradas y telemetría**: lazos NTCIP, radar/ToF, cámaras (YOLOv8/DeepStream), V2X (DSRC/ITS-G5/C-V2X), prioridad a emergencias y buses (GTFS-RT), telemetría de salud.

3) **Pipeline de decisión (50-100ms)**:
   - Ingesta/normalización por dirección.
   - Scoring multicriterio (cola, edad, prioridad) + fairness `servedDirections`.
   - Guardia de seguridad: retardo de 1s al entrar a verde antes del primer lote.
   - Liberación en lotes (5-50 veh) y re-evaluación continua.
   - Métricas hacia Prometheus/OpenTelemetry.

4) **Pseudocódigo operativo** (extracto):

```javascript
const sensed = dirs.map(dir => ({
  dir,
  count: waiting[dir],
  age: waitAge[dir],
  priority: emergency[dir] ? 2 : busPriority[dir] ? 1 : 0
}));
let available = sensed.filter(d => d.count > 0 && !served.includes(d.dir));
if (!available.length) { served = []; available = sensed.filter(d => d.count > 0); }
if (!available.length) return holdAllRed();

available.forEach(d => d.score = d.count + d.age * 0.4 + d.priority * 10);
available.sort((a,b) => b.score - a.score);
const target = available[0];

const msGreen = now - (greenStart[target.dir] ?? now);
if (released[target.dir] === 0 && msGreen < 1000) return deferOneTick();

const batch = Math.min(target.count, 50);
release(target.dir, batch);
emitMetrics({ dir: target.dir, batch, wait: target.age });
```

1) **Módulos avanzados**: RL (PPO) offline, predicción de demanda (LSTM/Prophet), fail-open NTCIP/ATC, coordinación de corredores con offsets V2X.

2) **Complejidad y SLA**: O(1) por ciclo; latencia &lt;30ms en borde; disponibilidad &gt;99.95%; compatibilidad NTCIP 1202/1211, SAE J2735 (SPaT/MAP), APIs REST/GraphQL.

## 🎨 Diseño y UX

- Max-height 90vh, header sticky, pseudocódigo scrolleable, esquemas comparativos.
- Paleta indigo y tipografía mono para secciones técnicas.

## ✅ Checklist de funcionamiento

- Autenticación funcionando con `.env` o fallback local.
- Render correcto en mobile/desktop, accesible vía teclado (Enter).
- Cierre por X, cambio de modal o recarga.

## 🔐 Protección Intelectual

- Aviso © 2015-2026 XLERION | Patent Pending (PCT/US/UE/COL).
- Prohibida la distribución no autorizada; acceso sujeto a NDA/licencia.

---

**Última actualización**: Enero 26, 2026  
**Responsable**: XLERION - Ingeniería Creativa Modular
