# Xlerion — Notas de desarrollo e implementación

Este documento resume los pasos y las correcciones aplicadas para que el proyecto Xlerion funcione tanto en el entorno local como en Railway, incluyendo cambios en la API de .NET, la configuración del cliente (React + Vite), la organización del repositorio y herramientas diversas.

== Resumen ==
El repositorio contiene varias partes:

- Projects/api — API de la tabla de clasificación de Xlerion (.NET 8, EF Core 8, Npgsql)
- Projects/client — Frontend de React + Vite para la tabla de clasificación y las estadísticas de los jugadores
- xlerion-site — Frontend heredado y otros activos del sitio
- Otras herramientas: datos de PowerBI en `PowerBi_Data/`, `LocalAI/` local y varios scripts.

Este archivo documenta los cambios realizados para que el sistema funcione y cómo configurarlo localmente.

## Cambios clave realizados

1. API (Projects/api)

- Se ha cambiado el proveedor EF a PostgreSQL (Npgsql) y se ha añadido el análisis de `DATABASE_URL` utilizado por Railway.

## Tecnologías principales (API)

Aquí se explica brevemente qué son y para qué se usan las tres tecnologías mencionadas en la línea anterior:

- **.NET 8**: Plataforma y runtime de Microsoft para construir aplicaciones (SDK + runtime). En este proyecto se utiliza **ASP.NET Core** (parte de .NET) para implementar la API REST. .NET 8 proporciona el servidor (Kestrel), el modelo de middleware, inyección de dependencias y todo el runtime donde corre la aplicación.

  - Para comprobar la instalación: `dotnet --version`.
  - Ejecución local típica: `dotnet run --project Projects/api/XlerionLeaderboardAPI.csproj`.

- **EF Core 8 (Entity Framework Core 8)**: es el ORM (mapeador objeto-relacional) para .NET. EF Core permite definir entidades C# que se mapean a tablas en la base de datos y gestionar migraciones de esquema desde código.

  - Uso habitual en este repo: configurar el `DbContext`, generar migraciones con `dotnet ef migrations add <Nombre>` y aplicar con `dotnet ef database update` (o dejar que `db.Database.Migrate()` las aplique en tiempo de ejecución).
  - Paquetes relevantes: `Microsoft.EntityFrameworkCore`, `Microsoft.EntityFrameworkCore.Design` y `Microsoft.EntityFrameworkCore.Tools`.

- **Npgsql / Npgsql.EntityFrameworkCore.PostgreSQL**: proveedor ADO.NET y proveedor de EF Core para PostgreSQL. Permite a EF Core hablar con bases de datos PostgreSQL y habilita el método `UseNpgsql(connectionString)` en la configuración del `DbContext`.

  - Se utiliza porque Railway provee bases de datos PostgreSQL y la app necesita un proveedor compatible.
  - Cuando Railway expone la variable `DATABASE_URL` (p.ej. `postgresql://user:pass@host:port/dbname`), el código convierte esa URL al formato de conexión que Npgsql espera (Host=...;Port=...;Database=...;Username=...;Password=...; SSL Mode=Require;Trust Server Certificate=true).
  - Para instalar el proveedor: `dotnet add package Npgsql.EntityFrameworkCore.PostgreSQL --version 8.*` (o la versión que sea compatible con EF Core 8).

Consejos rápidos:

- Asegúrate de que la versión de `Npgsql.EntityFrameworkCore.PostgreSQL` sea compatible con la versión de EF Core que usas (ambas en la misma familia mayor, p.ej. 8.x).
- No comites archivos con credenciales (como `appsettings.Development.json`) — usa `DATABASE_URL` o variables de entorno en local y en plataforma.
- Si usas Railway u otro proveedor que obligue SSL, añade `SSL Mode=Require;Trust Server Certificate=true` en la cadena de conexión o configura correctamente los certificados.

- Se ha habilitado `Swagger` en todos los entornos (no solo en Desarrollo) para permitir el acceso remoto.
- Se ha actualizado la política CORS de `Program.cs` para permitir cualquier puerto `localhost` durante el desarrollo y para aceptar los dominios de producción `xlerion.com` y `*.xlerion.com`.
- Se han añadido opciones JSON a los controladores para ignorar los ciclos de referencia y omitir los valores nulos.
- Se han creado las migraciones EF iniciales y se han aplicado durante el inicio con `db.Database.Migrate()`.
- Se han eliminado los archivos confidenciales `appsettings.json`/`appsettings.Development.json` del repositorio y se ha limpiado el historial (limpieza de force-push/mirror) al encontrar secretos.

1. Cliente (Projects/client)

- Se ha creado una aplicación Vite + React y se ha añadido Tailwind CSS mediante `postcss` y `tailwind.config.js`.
- Se ha añadido `src/api/leaderboard.js` con los envoltorios `getLeaderboard`, `getPlayerStats` y `submitScore`.
- Se han implementado las páginas: `Leaderboard.jsx`, `SubmitScore.jsx`, `PlayerStats.jsx` (ahora utiliza una búsqueda basada en la entrada en lugar de un parámetro de URL).
- Creé `Navbar.jsx` con enlaces de navegación (asegurándome de que se utilizara la ruta `/player`).
- Solucioné la incompatibilidad entre ESM y CJS en la configuración de Vite utilizando `vite.config.mjs`.

1. Limpieza del repositorio y Git

- Detecté una contraseña de la base de datos filtrada en `appsettings.json`: la eliminé de HEAD y reescribí el historial para purgar los archivos confidenciales del repositorio.
- Se han añadido entradas a `.gitignore` para los archivos de desarrollo local, `node_modules` y artefactos de gran tamaño (`*.zip`) con el fin de evitar futuras confirmaciones de archivos grandes.
- Se han resuelto las confirmaciones accidentales que incluían `node_modules` y archivos zip de gran tamaño mediante el restablecimiento, el almacenamiento temporal y la confirmación selectiva de solo los archivos seguros.

1. CI / Despliegue

- Se han enviado los cambios de `Projects/` a `https://github.com/MikeHell84/xlerion-leaderboard-api.git` (destino de despliegue de Railway). Railway volverá a desplegar automáticamente cuando se actualice `main`.

## Configuración local

Requisitos:

- SDK de .NET 8
- Node.js 18+ (npm)
- PostgreSQL localmente si quieres ejecutar la base de datos localmente (o utiliza la base de datos remota de Railway a través de la variable de entorno `DATABASE_URL`)
- PowerShell (Windows) o bash

Pasos:

1. Backend (API)

- Si utilizas Railway, configura la variable de entorno `DATABASE_URL`. El formato de Railway es `postgresql://user:password@host:port/database`.
- Ejecuta la API localmente con:

```powershell
$env:ASPNETCORE_ENVIRONMENT='Development'; dotnet run --project Projects/api/XlerionLeaderboardAPI.csproj --urls http://localhost:5000
```

- La aplicación aplicará las migraciones al iniciarse. Si prefieres gestionar las migraciones manualmente, utiliza `dotnet ef migrations add <Nombre>` y `dotnet ef database update`.

1. Frontend (Cliente)

- Instala las dependencias e inicia el servidor de desarrollo (desde la raíz del repositorio):

```powershell
npm --prefix "Projects/client" install
npm --prefix "Projects/client" run dev
```

- Vite puede seleccionar un puerto diferente si `3000`/`3001` están ocupados (por ejemplo, `3002`). El terminal mostrará la URL efectiva.

1. Notas sobre el entorno

- Para realizar pruebas locales con la base de datos Railway, puedes configurar `DATABASE_URL` en tu entorno o en un archivo local `appsettings.Development.json` (NO lo comites).
- Mantén los secretos fuera de Git: utiliza variables de entorno o un gestor de secretos.

## Solución de problemas

- GitHub rechaza envíos de gran tamaño: elimina los archivos grandes (comprime los artefactos) y añade entradas a `.gitignore`; reescribe el historial si es necesario.
- Errores del plugin Vite ESM: asegúrate de que `vite.config.mjs` esté presente y de que se haya eliminado `vite.config.js` para evitar incompatibilidades entre require y ESM.
- Símbolos React duplicados / errores de exportación predeterminada múltiple: asegúrate de que cada archivo exporte un único componente predeterminado y de que no haya importaciones duplicadas.
- Conflictos de stash/fusión: al guardar cambios locales para rebasar, es preferible resolver los conflictos con cuidado y conservar las versiones del árbol de trabajo en las que confías.

## Power BI / Otros

- Los archivos de Power BI se almacenan en `PowerBi_Data/`. Los archivos PBIX de gran tamaño deben mantenerse fuera de Git o gestionarse a través de un servicio de unidad de disco o almacenamiento.

## Notas y próximas acciones

- Recomendado: limpia el repositorio para eliminar los espejos de repositorios incrustados (por ejemplo, `xlerion-leaderboard-api-mirror.git`) y las compilaciones zip de gran tamaño. Utiliza `git rm --cached` o muévelos a un archivo fuera del repositorio.
- Añade Git LFS si realmente necesitas realizar un seguimiento de activos binarios de gran tamaño.
- Considera la posibilidad de añadir un archivo `.gitattributes` y ganchos `pre-commit` para evitar confirmaciones accidentales de secretos o archivos de gran tamaño.

---
Generado por tu asistente como nota de desarrollo consolidada el 18 de marzo de 2026.
