# 🚀 Instrucciones Rápidas - Sistema SMTP Funcionando

## Estado Actual ✅

- **Servidor PHP:** Corriendo en <http://localhost:8080>
- **Frontend (Vite):** Corriendo en <http://localhost:5173>
- **SMTP:** Configurado con <support@xlerion.com>
- **Base de datos:** SQLite creada automáticamente

---

## 🧪 Probar Ahora Mismo

### Opción 1: Test Visual del SMTP

```
Abre en tu navegador:
http://localhost:5173/total-darkness/test-smtp.html
```

**Pasos:**

1. Ingresa tu email: `admin@xlerion.com`
2. Haz clic en "🚀 Enviar Correo de Test"
3. Revisa tu bandeja (incluyendo spam)
4. Deberías recibir un correo de Total Darkness

---

### Opción 2: Test Completo de Recuperación

```
1. Abre: http://localhost:5173/total-darkness/
2. Haz clic en "¿Olvidaste tu contraseña?"
3. Ingresa: admin@xlerion.com
4. Verifica que recibes el correo
5. Haz clic en el enlace del correo
6. Crea una nueva contraseña
7. Intenta hacer login con la nueva contraseña
```

---

### Opción 3: Tests Automatizados del Backend

```
Abre: http://localhost:5173/total-darkness/test-backend-auth.html

Haz clic en: "▶ Ejecutar Todos los Tests"

Todos deberían pasar ✅
```

---

## 📧 Configuración SMTP Actual

```
Host: mail.xlerion.com
Puerto: 465 (SSL/TLS)
Usuario: support@xlerion.com
Contraseña: Ultimate81720164!1984
```

**¿No recibiste el correo?**

1. **Revisa spam** - A veces va a la carpeta de spam
2. **Espera 5 minutos** - SMTP puede ser lento
3. **Verifica el email** - ¿Escribiste bien tu correo?
4. **Revisa los logs:**

   ```powershell
   # En la terminal del servidor PHP, busca líneas de error
   # Deberías ver: [200]: POST /api/auth.php o similar
   ```

---

## 📝 Archivos Clave

```
total-darkness/
├── api/
│   └── auth.php           ← Backend API con SMTP
├── config/
│   └── smtp-config.php    ← Credenciales SMTP (NO SUBIR A GIT)
├── recovery.html          ← Solicitar recuperación
├── reset-password.html    ← Restablecer contraseña
├── test-smtp.html         ← Test visual de SMTP (⭐ PRUEBA ESTO)
├── test-backend-auth.html ← Tests automatizados
└── SMTP-SETUP.md          ← Documentación completa
```

---

## 🔐 Credenciales para Testing

**Admin por defecto:**

- Email: <admin@xlerion.com>
- Password: TotalDarkness2026!

**Para crear otro admin desde el panel:**

1. Login como <admin@xlerion.com>
2. Haz clic en el ícono 🔧👥 (esquina superior derecha)
3. Tab "Crear Administrador"
4. Llena el formulario

---

## 🐛 Si Algo Falla

### "No se conecta al servidor PHP"

```powershell
# Verifica que el servidor está corriendo
# Abre una terminal y ve a:
cd x:\Programacion\XlerionWeb\xlerion-site\public\total-darkness
php -S localhost:8080 -c php.ini
```

### "Error en tests del backend"

```
1. Abre la consola del navegador (F12)
2. Busca los errores exactos
3. Verifica que:
   - El servidor PHP está corriendo
   - Las URLs son correctas
   - El CORS no está bloqueando
```

### "Correos no llegan"

```
1. Verifica la carpeta de spam
2. Revisa que el email existe
3. Intenta con otro email
4. Confirma credenciales SMTP con tu proveedor
```

---

## 🎯 Próximo Paso: Producción

Cuando estés listo para producción (xlerion.com):

1. **Cambiar la contraseña de admin:**

   ```
   http://localhost:5173/total-darkness/recovery.html
   ```

2. **Actualizar URLs en auth.php:**
   - Ya están dinámicas, se ajustan automáticamente

3. **Crear otros administradores:**
   - Usa el panel de gestión de administradores

4. **Activar HTTPS:**
   - Necesario para producción

5. **Configurar SPF/DKIM:**
   - Para evitar spam en producción

---

## 📊 Resumen del Sistema

| Componente | Estado | Puerto |
|-----------|--------|--------|
| Vite (Frontend) | ✅ Corriendo | 5173 |
| PHP (Backend) | ✅ Corriendo | 8080 |
| SMTP Xlerion | ✅ Configurado | 465 |
| Base de datos | ✅ SQLite | - |
| Recuperación | ✅ Automática | - |
| Admin Multi | ✅ Funcionando | - |

---

## ✨ Lo Que Funciona Ahora

✅ Login con credenciales hasheadas  
✅ Recuperación automática de contraseña por email  
✅ Crear múltiples administradores  
✅ Listar y desactivar administradores  
✅ Tokens de recuperación con expiración  
✅ Correos HTML formateados  
✅ SMTP SSL/TLS seguro  
✅ Base de datos local  
✅ Tests automatizados  

---

**¿Problemas?** Revisa `BACKEND-AUTH-README.md` o `QUICK-START.md` para más detalles.

**¡Listo para usar!** 🎉
