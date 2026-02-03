# Revert script for ropero move
# Usage: Run from workspace root PowerShell as Admin if needed.
# This will move `ropero_project\el-ropero` back to `el-ropero` in the repository root
# and (optionally) restore from the backup ZIP if present.

$src = Join-Path $PSScriptRoot 'ropero_project\el-ropero'
$dst = Join-Path $PSScriptRoot 'el-ropero'
$backupDir = Join-Path $PSScriptRoot 'backups'

if (-Not (Test-Path $src)) {
    Write-Error "Source path not found: $src"
    exit 1
}

if (Test-Path $dst) {
    Write-Error "Destination already exists: $dst. Remove or rename it before reverting."
    exit 1
}

Write-Output "Moving $src -> $dst ..."
Move-Item -Path $src -Destination $dst -Force
Write-Output "Move complete."

# If you want to restore from the ZIP backup instead, uncomment below and comment out the Move-Item above
# $zip = Get-ChildItem -Path $backupDir -Filter 'ropero_el-ropero_*.zip' | Sort-Object LastWriteTime -Descending | Select-Object -First 1
# if ($zip) {
#    Write-Output "Restoring from $($zip.FullName) ..."
#    Expand-Archive -Path $zip.FullName -DestinationPath $dst -Force
# }

Write-Output "Reversion complete. Please update any CI or scripts if needed."
