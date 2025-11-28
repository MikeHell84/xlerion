Checkpoints tools

Scripts:
- `create_checkpoint.ps1` — crea un checkpoint empaquetando rutas seleccionadas, guarda un diff y añade una línea JSON en `.checkpoints/checkpoints.log` (incluye SHA256 y lista de archivos del ZIP).
- `list_checkpoints.ps1` — lista checkpoints registrados.
- `restore_checkpoint.ps1 -Id <checkpoint-id>` — extrae el ZIP del checkpoint a `.checkpoints/restore-<id>`.
- `precommit-checkpoint.ps1` — wrapper que llama a `create_checkpoint.ps1` (útil para hooks pre-commit).
- `install_precommit_hook.ps1` — instala un hook git `pre-commit` que ejecuta el script anterior.

Usage examples (PowerShell):

```powershell
# Crear checkpoint con mensaje y añadir cambios no confirmados
./tools/create_checkpoint.ps1 -Message "antes de cambios editor" -IncludeUncommitted

# Listar checkpoints
./tools/list_checkpoints.ps1

# Restaurar
./tools/restore_checkpoint.ps1 -Id checkpoint-20251128-103142
```

Notes:
- Los scripts asumen que ejecutas desde el directorio del repo (`LocalAI`).
 - `create_checkpoint.ps1` incluirá por defecto el contenido de `xlerion_cmr` si existe.
 - La entrada en `checkpoints.log` ahora contiene el hash SHA256 del ZIP y la lista de archivos dentro del ZIP para verificación.
