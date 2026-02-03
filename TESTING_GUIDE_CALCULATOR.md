# Guía de Prueba - Calculador de Cotizaciones

## 🎯 Objetivo

Verificar que todas las correcciones de bugs están funcionando correctamente y que el calculador muestra precios correctos (NO $0).

## ✅ Estado Actual

- ✅ Servidor corriendo en: <http://localhost:5174/>
- ✅ Todos los errores ESLint resueltos
- ✅ 4 bugs críticos arreglados en CotizacionServiciosPage.jsx
- ✅ Código compilando sin errores

## 🧪 Plan de Prueba

### Paso 1: Acceder al Calculador

1. Abre <http://localhost:5174> en tu navegador
2. Navega a la sección de "Cotización de Servicios" o "Servicios"
3. Busca la opción "Cotizador en Línea" o similar

### Paso 2: Pruebas Básicas

#### Test Case 1: Web/Mobile - Por Mes

- **Seleccionar servicio**: Desarrollo Web y Móvil
- **Duración**: Por Mes
- **Respuestas sugeridas**:
  - ¿Cuántas páginas?: **5**
  - ¿E-commerce?: **Sí** (marcado como true)
  - ¿Responsive?: **Sí** (true)
  - ¿Backend personalizado?: **Sí** (true)
  - ¿Integraciones API?: **3**
- **Precio esperado**: Aprox. **USD $23,000 - $30,000** (con IVA 19%)
- **Resultado esperado**: ✅ Número mayor a $0

#### Test Case 2: Videojuegos - Por Mes

- **Seleccionar servicio**: Videojuegos
- **Duración**: Por Mes
- **Respuestas sugeridas**:
  - ¿Mecánicas gameplay?: **4**
  - ¿Plataformas?: **3** (PC, Mobile, Console)
  - ¿Fidelidad gráfica?: **3** (AAA)
  - ¿Niveles/mundos?: **10**
  - ¿Música original?: **Sí** (true)
  - ¿Multiplayer?: **Sí** (true)
  - ¿Publicación en stores?: **Sí** (true)
- **Precio esperado**: Aprox. **USD $200,000 - $400,000+** (con IVA)
- **Resultado esperado**: ✅ Número alto y mayor a $0

#### Test Case 3: Cualquier Servicio - Por Hora (Mínimo)

- **Seleccionar servicio**: Cualquiera
- **Duración**: Por Hora
- **Respuestas**: Completar al menos 50%
- **Precio esperado**: **USD $100 - $300** (por hora)
- **Resultado esperado**: ✅ Número mayor a $0 pero bajo

#### Test Case 4: Validación de Respuestas "No"

- **Seleccionar servicio**: Cualquiera
- **Duración**: Por Mes
- **Respuestas**:
  - Responder "No" a preguntas booleanas
  - Dejar números con valores pequeños
- **Esperado**:
  - ✅ Botón "Siguiente" debe habilitarse
  - ✅ Precio debe ser menor que con respuestas "Sí"
  - ✅ No debe ser $0

### Paso 3: Verificar la Consola del Navegador

1. Abre F12 (Developer Tools)
2. Busca la pestaña "Console"
3. Intenta cambiar `isDevelopment` a `true` en el código para ver logs detallados (opcional)
4. Deberías ver los cálculos detallados cuando se genere el resultado

### Paso 4: Verificar Comportamiento UI

#### Botón "Siguiente"

- ✅ Debe estar deshabilitado cuando menos del 50% esté respondido
- ✅ Debe habilitarse cuando alcances 50%+
- ✅ Debe permitir respuestas "No" sin deshabilitarse

#### Botón "Volver Atrás"

- ✅ Debe limpiar el estado correctamente
- ✅ Debes poder seleccionar nuevamente sin valores viejos
- ✅ Seleccionar otra duración no debe conservar respuestas previas

#### Resultado Final

- ✅ Debe mostrar: "USD $XXXXX" (no "USD $0")
- ✅ Debe mostrar desglose o más información
- ✅ Debe tener opción para contactar o ajustar parámetros

## 🐛 Bugs Que Debería Estar Arreglados

1. **Input Number Handler** → Ahora retorna `null` en vez de `0`
2. **Factor Calculation** → Requiere `answer > 0` para aplicar multiplicador
3. **Button Validation** → Permite `false` como respuesta válida
4. **State Cleanup** → Back button limpia `timeUnit` y `calculatorAnswers`

## ⚠️ Posibles Problemas a Buscar

Si el calculador aún muestra $0:

1. Abre DevTools (F12)
2. Busca en Console si hay errores rojos
3. Verifica que el estado en el componente está siendo actualizado
4. Comprueba que los valores llegan al useMemo de `estimatedCost`

## 📊 Checklist de Validación

- [ ] Servidor está corriendo sin errores
- [ ] Puedo acceder al calculador en <http://localhost:5174>
- [ ] Test Case 1 (Web/Mobile) muestra precio > $0
- [ ] Test Case 2 (Videojuegos) muestra precio alto > $0
- [ ] Test Case 3 (Por Hora) muestra precio pequeño pero > $0
- [ ] Test Case 4 (Respuestas "No") funciona correctamente
- [ ] Botón "Siguiente" responde correctamente
- [ ] Botón "Volver Atrás" limpia estado
- [ ] No hay errores en Console (F12)
- [ ] Todas las 7 categorías de servicios funcionan

## 🚀 Siguiente Paso

Si todos los tests pasan:

```bash
npm run lint:fix
npm run build
```

Luego preparar para deploy.

## 📝 Notas

- Los precios incluyen IVA 19% (Colombia)
- Los multiplicadores de duración: Hora=1x, Día=8x, Semana=40x, Mes=160x
- Las respuestas "Sí" aplican factores de 1.1x a 2.2x según servicio
- El cálculo: `basePrice × hourMultiplier × totalFactors × (1 + 0.19 IVA)`
