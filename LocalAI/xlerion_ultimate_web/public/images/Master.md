# Idioma preferido 

Siempre contestar en : **ESPAÑOL**

# Información del Servidor

Aquí se detallan las especificaciones del servidor de hosting:

## Detalles del Servidor
| Elemento | Detalles |
|---|---|
| Paquete de hosting | H1 |
| Nombre del servidor | host11 |
| Versión de cPanel | 130.0 (build 16) |
| Versión de Apache | 2.4.65 |
| Database Version | 10.11.14-MariaDB-cll-lve |
| Arquitectura | x86_64 |
| Sistema operativo | linux |
| Dirección IP compartida | 51.222.104.17 |
| Ruta a Sendmail | /usr/sbin/sendmail |
| Ruta a Perl | /usr/bin/perl |
| Versión de Perl | 5.26.3 |
| Versión del kernel | 4.18.0-553.62.1.lve.el8.x86_64 |

## Información de los Servicios Clave
| Servicio | Detalles | Estado |
|---|---|---|
| apache_php_fpm | up | “apache_php_fpm” es correcto. |
| httpd | 2.4.65 | “httpd” es correcto. |
| mysql | 10.11.14-MariaDB-cll-lve | “mysql” es correcto. |

---

## contestar en ESPAÑOL ##

Siempre contesta en español

El proyecto **Xlerion Ultimate Web** se construirá sobre una pila optimizada para la estabilidad y el rendimiento que su servidor host11 ofrece.

---

## I. Tecnología Sugerida para Xlerion Ultimate Web

Dada la arquitectura estable de su servidor (Apache 2.4.65, PHP FPM disponible, MariaDB 10.11.14), la mejor opción para un desarrollo moderno, escalable y con una excelente curva de aprendizaje es la pila **Laravel**.

| Componente | Tecnología | Justificación basada en el servidor |
| :--- | :--- | :--- |
| **Backend/Core** | **Laravel (PHP Framework)** | Utiliza PHP, que está optimizado a través de `apache_php_fpm`. Permite estructuras MVC robustas y es altamente compatible con entornos cPanel. **Nota:** Asegúrate de que la versión de PHP disponible en tu cPanel (puedes verificarla en "Select PHP Version") sea compatible con la versión de Laravel que planeas usar (ej. Laravel 10 requiere PHP >= 8.1). |
| **Base de Datos** | **MariaDB (v10.11.14)** | Versión moderna de MariaDB, ideal para operaciones SQL complejas y alta disponibilidad. Laravel Eloquent se integra perfectamente. |
| **Frontend/UI Dinámica** | **Blade Templating + Tailwind CSS + Alpine.js + Headless UI** | **Blade Templating:** Renderizado del lado del servidor para SEO y carga inicial. **Tailwind CSS:** Estilizado moderno y personalizable. **Alpine.js + Headless UI:** Para interactividad y componentes dinámicos (botones, modales, etc.) en el lado del cliente, sin necesidad de Node.js en el servidor. **Alternativa para UI dinámica:** Livewire (si se prefiere PHP para la interactividad). |
| **Manejador de Paquetes** | **Composer** | Estándar para la gestión de dependencias de PHP. Es compatible con cPanel y la mayoría de los hosts lo permiten. **Asegúrate de que Composer esté disponible y accesible vía SSH en tu servidor.** |

## II. Arquitectura y Estructura del Proyecto

Implementaremos la estructura estándar de Laravel, asegurando que la configuración de cPanel se adapte al requisito de seguridad de que los archivos de configuración (como `.env`) se mantengan fuera del directorio accesible públicamente.

### 1. Estructura de Directorios (Dentro del Home del Usuario)

Para un proyecto Laravel en un entorno cPanel (donde el directorio web suele ser `public_html`), es fundamental que solo el directorio `public` de Laravel sea accesible externamente.

| Directorio/Archivo | Propósito | Accesibilidad |
| :--- | :--- | :--- |
| `~/xlerion_ultimate_web/` | **Directorio Raíz del Proyecto (Privado)** | Donde residirán todos los archivos de Laravel (aplicación, configuración, vendor). |
| `~/xlerion_ultimate_web/app/` | Lógica de la aplicación. | Privado |
| `~/xlerion_ultimate_web/vendor/` | Dependencias de Composer. | Privado |
| `~/xlerion_ultimate_web/.env` | Variables de entorno (conexión DB, claves). **CRÍTICO: Debe ser privado.** **¡Nunca subas este archivo a tu repositorio de control de versiones!** | Privado |
| `~/xlerion_ultimate_web/public/` | **Punto de Entrada Web** | Contiene `index.php`, CSS, JS. |

### 2. Configuración de cPanel (Redirección)

Para que el servidor Apache (2.4.65) sepa dónde buscar el archivo `index.php` de Laravel, debemos modificar el Document Root de su dominio.

**Paso de Configuración Necesario:**

1.  **Mover la instalación de Laravel:** Instale el proyecto en un directorio fuera de `public_html` (ej: `~/xlerion_ultimate_web`).
2.  **Configurar el Document Root:** En la configuración de dominios de cPanel, cambie la ruta del Document Root de su dominio principal de:
    *   `public_html`
    *   A: `~/xlerion_ultimate_web/public`

Esto garantiza que la seguridad de Laravel se mantenga y solo los activos estáticos y el punto de entrada sean accesibles.

## V. Checklist de Inicio y Despliegue del Proyecto Xlerion Ultimate Web

Este checklist detalla los pasos necesarios para inicializar, configurar y desplegar tu aplicación Laravel en el servidor cPanel.

### A. Preparación Local (Tu Máquina de Desarrollo)

1.  **Verificar Requisitos de PHP:** Asegúrate de que tu entorno de desarrollo local tenga una versión de PHP compatible con la versión de Laravel que usarás (ej. Laravel 10 requiere PHP >= 8.1).
2.  **Instalar Composer:** Si no lo tienes, instala Composer globalmente.
3.  **Instalar Node.js y npm:** Necesarios para compilar los activos de frontend (Tailwind CSS, Alpine.js).
4.  **Crear el Proyecto Laravel:**
    *   Abre tu terminal local.
    *   Ejecuta: `composer create-project laravel/laravel xlerion_ultimate_web`
    *   Navega al directorio del proyecto: `cd xlerion_ultimate_web`
5.  **Configurar Frontend (Tailwind CSS, Alpine.js, Headless UI):**
    *   Instala las dependencias de Node.js: `npm install`
    *   Configura Tailwind CSS, Alpine.js y Headless UI según su documentación oficial.
    *   Compila los activos de frontend: `npm run build` (Esto generará los archivos CSS/JS finales en `public/build` o `public/css/js` dependiendo de tu configuración de Vite/Mix).
6.  **Configurar Variables de Entorno Local:**
    *   Copia `.env.example` a `.env`: `cp .env.example .env`
    *   Genera la clave de aplicación: `php artisan key:generate`
    *   Configura las credenciales de tu base de datos local en `.env`.
7.  **Ejecutar Migraciones y Seeders (Opcional):**
    *   Crea las tablas de la base de datos: `php artisan migrate`
    *   (Opcional) Rellena la base de datos con datos de prueba: `php artisan db:seed`
8.  **Verificar Funcionamiento Local:** Asegúrate de que la aplicación funciona correctamente en tu entorno de desarrollo local.

### B. Configuración en cPanel (Interfaz Gráfica)

1.  **Crear Base de Datos MariaDB:**
    *   Accede a cPanel -> "Bases de datos MySQL®".
    *   Crea una nueva base de datos (ej. `tu_usuario_db`).
    *   Crea un nuevo usuario de base de datos (ej. `tu_usuario_db_user`).
    *   Asigna el usuario a la base de datos con **TODOS LOS PRIVILEGIOS**.
2.  **Configurar el Document Root del Dominio:**
    *   Accede a cPanel -> "Dominios".
    *   Edita el dominio principal y cambia su "Document Root" de `public_html` a `/home/tu_usuario/xlerion_ultimate_web/public`.
    *   **Importante:** Asegúrate de que la ruta sea correcta y apunte al directorio `public` dentro de tu proyecto Laravel, que estará fuera de `public_html`.
3.  **Configurar Tarea Programada (CRON Job):**
    *   Accede a cPanel -> "Tareas de Cron".
    *   Añade un nuevo Cron Job para ejecutar el scheduler de Laravel cada minuto:
        ```bash
        /usr/bin/php /home/tu_usuario/xlerion_ultimate_web/artisan schedule:run >> /dev/null 2>&1
        ```
    *   Reemplaza `tu_usuario` con tu nombre de usuario real de cPanel.

## VI. Comandos de Instalación y Ejecución

Estos son los comandos necesarios para instalar las dependencias y ejecutar el proyecto en un entorno de desarrollo local.

1.  **Instalar dependencias de PHP:**
    ```bash
    composer install
    ```
2.  **Instalar dependencias de JavaScript:**
    ```bash
    npm install
    ```
3.  **Compilar assets de frontend:**
    ```bash
    npm run build
    ```
4.  **Generar la clave de la aplicación:**
    ```bash
    php artisan key:generate
    ```
5.  **Ejecutar las migraciones y los seeders de la base de datos:**
    ```bash
    php artisan migrate --seed
    ```
6.  **Iniciar el servidor de desarrollo:**
    ```bash
    php artisan serve
    ```

### C. Despliegue y Configuración en el Servidor (Vía SSH/Administrador de Archivos)

1.  **Subir el Proyecto Laravel:**
    *   **Opción A (Recomendada - SSH/Git):**
        *   Inicializa un repositorio Git en tu proyecto local.
        *   Sube tu proyecto a un repositorio privado (GitHub, GitLab, Bitbucket).
        *   Conéctate a tu servidor cPanel vía SSH.
        *   Navega a tu directorio principal (ej. `/home/tu_usuario/`).
        *   Clona tu repositorio Git en el directorio `xlerion_ultimate_web` (fuera de `public_html`):
            `git clone tu_repositorio_git.git xlerion_ultimate_web`
    *   **Opción B (Administrador de Archivos):**
        *   Comprime todo tu proyecto Laravel (excepto `node_modules` y `vendor`) en un archivo `.zip` en tu máquina local.
        *   Sube el `.zip` al directorio `/home/tu_usuario/` (fuera de `public_html`) usando el Administrador de Archivos de cPanel.
        *   Extrae el `.zip` en una carpeta llamada `xlerion_ultimate_web`.
2.  **Instalar Dependencias de Composer en el Servidor:**
    *   Conéctate a tu servidor cPanel vía SSH.
    *   Navega al directorio del proyecto: `cd /home/tu_usuario/xlerion_ultimate_web`
    *   Instala las dependencias de PHP: `composer install --no-dev --optimize-autoloader`
3.  **Configurar Variables de Entorno en el Servidor:**
    *   Copia `.env.example` a `.env` en el servidor: `cp .env.example .env`
    *   Edita el archivo `.env` en el servidor (puedes usar el Administrador de Archivos de cPanel o un editor SSH como `nano` o `vim`).
    *   Configura `APP_ENV=production`.
    *   Configura `APP_DEBUG=false`.
    *   Genera la clave de aplicación: `php artisan key:generate`
    *   Configura las credenciales de la base de datos que creaste en cPanel.
    *   Configura el mail driver si es necesario (ej. `MAIL_MAILER=sendmail`).
4.  **Ejecutar Migraciones en el Servidor:**
    *   Desde el directorio del proyecto vía SSH: `php artisan migrate --force` (el `--force` es para producción).
5.  **Optimizar Laravel para Producción:**
    *   Desde el directorio del proyecto vía SSH:
        ```bash
        php artisan config:cache
        php artisan route:cache
        php artisan view:cache
        ```
6.  **Configurar Permisos de Archivos:**
    *   Asegúrate de que los directorios `storage` y `bootstrap/cache` tengan permisos de escritura para el usuario del servidor web. Esto a menudo se logra con:
        ```bash
        chmod -R 775 storage
        chmod -R 775 bootstrap/cache
        ```
    *   (Opcional, si hay problemas) `chown -R tu_usuario:nobody storage bootstrap/cache` (reemplaza `tu_usuario` con tu usuario de cPanel).
7.  **Verificar Despliegue:**
    *   Abre tu navegador y accede a la URL de tu dominio.
    *   Verifica que la aplicación Laravel se carga correctamente y que todas las funcionalidades dinámicas funcionan.