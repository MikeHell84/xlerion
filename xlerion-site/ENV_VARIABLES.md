# Variables de Entorno - Xlerion Web

## Configuración de Seguridad

### Documento Técnico Industrial

El acceso al Documento Técnico Industrial está protegido mediante autenticación de dos niveles:

#### 1. Acceso al Modal del Documento

- **Variable**: `VITE_TECHNICAL_DOC_PASSWORD`
- **Valor actual**: `81720164` (definido en `.env`)
- **Propósito**: Contraseña requerida para acceder al contenido completo del documento técnico
- **Ubicación**: Modal de autenticación previo al documento

#### 2. Descarga del PDF

- **Variable**: `VITE_TECHNICAL_DOC_PASSWORD` (misma contraseña)
- **Propósito**: Contraseña para autorizar la descarga del documento en formato PDF
- **Características**:
  - Genera marca de agua digital única
  - Incluye timestamp y hash de trazabilidad
  - Nombre de archivo con hash único

## Archivos Creados

### `.env`

Archivo con las variables de entorno reales (NO commitear a git):

```env
VITE_TECHNICAL_DOC_PASSWORD=81720164
```

### `.env.example`

Plantilla de ejemplo para otros desarrolladores (SÍ commitear a git):

```env
VITE_TECHNICAL_DOC_PASSWORD=your_password_here
```

## Uso en Componentes

Las variables de entorno se acceden usando `import.meta.env.VARIABLE_NAME`:

```javascript
const correctPassword = import.meta.env.VITE_TECHNICAL_DOC_PASSWORD || '81720164';
```

**Nota**: El fallback `|| '81720164'` se mantiene para desarrollo local si no existe el `.env`.

## Seguridad

1. ✅ El archivo `.env` está en `.gitignore` (NO se sube a repositorios)
2. ✅ Se incluye `.env.example` como plantilla
3. ✅ Las variables con prefijo `VITE_` son inyectadas en tiempo de build
4. ✅ Doble autenticación: acceso al modal + descarga PDF

## Flujo de Autenticación

```
Usuario → Click "🔒 Doc Técnico" 
  ↓
Modal de Autenticación (contraseña: 81720164)
  ↓
Acceso al Documento Técnico Completo
  ↓
Sección de Descarga PDF (misma contraseña)
  ↓
Descarga con marca de agua única
```

## Mantenimiento

Para cambiar la contraseña:

1. Editar el archivo `.env`:

   ```env
   VITE_TECHNICAL_DOC_PASSWORD=nueva_contraseña
   ```

2. Reiniciar el servidor de desarrollo:

   ```powershell
   npm run dev
   ```

3. Para producción, reconstruir:

   ```powershell
   npm run build
   ```

## Contacto para Acceso

Usuarios sin credenciales deben contactar:

- 📧 <contacto@xlerion.com>
- 🌐 <https://xlerion.com>

---

**Última actualización**: Enero 23, 2026
**Responsable**: XLERION - Ingeniería Creativa Modular
