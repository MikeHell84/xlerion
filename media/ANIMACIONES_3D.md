# 🎮 Animaciones del Modelo 3D - Guía de Botones

## Mapa de acciones por botón overlay

Cada botón del overlay (círculos sobre el canvas) desencadena una animación diferente del modelo 3D cuando se presiona:

### 1. **◎ Identidad** - Rotación Suave

- **Acción:** Gira el modelo 360° una vez suavemente
- **Duración:** 2 segundos
- **Efecto:** `power2.inOut` (easing suave)

### 2. **⚡ Misión** - Rotación Automática Toggle

- **Acción:** Activa o desactiva la rotación automática continua
- **Comportamiento:** Al presionar la primera vez activa, la segunda desactiva
- **Velocidad:** 4 revoluciones por segundo cuando está activa

### 3. **★ Visión** - Flotación

- **Acción:** Flota suavemente hacia arriba y hacia abajo
- **Patrón:** Ondulación suave (yoyo)
- **Repeticiones:** 3 ciclos completos
- **Amplitud:** 0.5 unidades en eje Y

### 4. **⚙ Toolkit** - Spin Rápido (5 revoluciones)

- **Acción:** Gira rápidamente sobre eje Z
- **Duraciones:** 5 giros completos en 1.5 segundos
- **Efecto:** `back.out` (rebote de salida)

### 5. **◇ Servicios** - Oscilación Lateral (Wobble)

- **Acción:** Oscila de lado a lado
- **Patrón:** Movimiento de vaivén rápido
- **Repeticiones:** 5 ciclos
- **Eje:** Z (rotación lateral)

### 6. **✦ Diferenciales** - Pulso de Escala

- **Acción:** Crece y encoge como si respirara
- **Escala máxima:** 1.3x su tamaño original
- **Repeticiones:** 3 pulsos
- **Efecto:** `back.out` (rebote)

### 7. **📊 Estado** - Inclinación (Tilt)

- **Acción:** Se inclina hacia adelante y atrás
- **Amplitud:** ±0.3 radianes
- **Eje:** X (inclinación forward/backward)
- **Repeticiones:** 3 ciclos

### 8. **📈 Proyecciones** - Rebote (Bounce)

- **Acción:** Rebota hacia arriba y abajo como una pelota
- **Amplitud:** 1 unidad en eje Y
- **Repeticiones:** 5 rebotes
- **Efecto:** `power1.inOut`

### 9. **📖 Narrativa** - Movimiento Espiral

- **Acción:** Gira mientras sube y baja con movimiento circular
- **Giros:** 4 revoluciones completas
- **Elevación:** 0.8 unidades en eje Y
- **Duración:** 2 segundos para toda la secuencia

### 10. **🎮 Videojuego** - Rotación Ultra Rápida

- **Acción:** Gira muy rápido en múltiples ejes
- **Giros Y:** 4 revoluciones
- **Giros X:** 2 revoluciones
- **Duración:** 1 segundo total
- **Efecto:** `power2.in` (aceleración)

---

## 🛠️ Detalles técnicos

### Requisitos

- **GSAP** cargado en `media/js/gsap.min.js` para animaciones suaves
- **Model** disponible en `window.xlObjects.model` (cargado por `objects.module.js`)
- **Scene & Controls** disponibles en `window.xlThree` (expuesto por `scene.js`)

### Fallback

Si GSAP no está disponible, algunas animaciones aplican cambios instantáneos al modelo.

### Integración

Las animaciones se llaman automáticamente cuando se hace click en un botón, ANTES de que se abra el modal con el contenido de la sección.

---

## 📝 Personalización

Puedes modificar las animaciones editando `total-darkness/overlay-controls.js`:

- Cambiar duraciones (parámetro `duration`)
- Ajustar amplitudes (parámetro de valores finales)
- Modificar efectos de easing (`ease: 'power2.out'`, etc.)
- Añadir nuevas animaciones siguiendo el mismo patrón

Ejemplo: Para hacer un giro más lento, modifica:

```javascript
gsap.to(model.rotation, {
  y: model.rotation.y + Math.PI * 2,
  duration: 5, // ← Cambiar de 2 a 5 segundos
});
```
