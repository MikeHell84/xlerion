param(
  [switch]$IncludeNpm
)

Set-StrictMode -Version Latest
$Workspace = Split-Path -Parent $MyInvocation.MyCommand.Path

Write-Host "Workspace: $Workspace"

# Ensure logs dirs
$dirs = @(
  "$Workspace\logs",
  "$Workspace\xlerion_cmr\logs",
  "$Workspace\xlerion_ultimate_web\logs"
)
foreach ($d in $dirs) { if (-not (Test-Path $d)) { New-Item -ItemType Directory -Path $d -Force | Out-Null } }

function Get-PHPExecutable {
  $php = Get-Command php -ErrorAction SilentlyContinue
  if ($php) { return $php.Source }
  $candidates = @("C:\\php\\php.exe","C:\\Program Files\\php\\php.exe")
  foreach ($c in $candidates) { if (Test-Path $c) { return $c } }
  return "php"
}

# Start PHP dev server for xlerion_cmr
$phpExe = Get-PHPExecutable
$pub = Join-Path $Workspace "xlerion_cmr\public"
$phpLog = Join-Path $Workspace "xlerion_cmr\logs\php-server.log"
if (Test-Path $pub) {
  $inner = "`$env:DB_CONNECTION='sqlite'; `"$phpExe`" -S 127.0.0.1:8080 -t `"$pub`" 2>&1 | Out-File -FilePath `"$phpLog`" -Append -Encoding utf8"
  $pwsh = (Get-Command pwsh -ErrorAction SilentlyContinue).Source
  if (-not $pwsh) { $pwsh = (Get-Command powershell -ErrorAction SilentlyContinue).Source }
  Start-Process -FilePath $pwsh -ArgumentList "-NoProfile -WindowStyle Hidden -Command & { $inner }" -WindowStyle Hidden | Out-Null
  Write-Host "PHP dev server starting -> http://127.0.0.1:8080 (log: $phpLog)"
} else {
  Write-Host "Public folder not found: $pub"
}

# Start static Python server (workspace root) port 8000
$pyLog = Join-Path $Workspace "logs\python-server.log"
Start-Process -FilePath "cmd.exe" -ArgumentList "/c python -m http.server 8000 > `"$pyLog`" 2>&1" -WorkingDirectory $Workspace -WindowStyle Hidden | Out-Null
Write-Host "Python static server starting -> http://127.0.0.1:8000 (log: $pyLog)"

# Start Laravel dev server if present
$laravelPath = Join-Path $Workspace "xlerion_ultimate_web"
if (Test-Path (Join-Path $laravelPath "artisan")) {
  $larLog = Join-Path $laravelPath "logs\laravel.log"
  Start-Process -FilePath "cmd.exe" -ArgumentList "/c php artisan serve --host 127.0.0.1 --port 8001 > `"$larLog`" 2>&1" -WorkingDirectory $laravelPath -WindowStyle Hidden | Out-Null
  Write-Host "Laravel dev server starting -> http://127.0.0.1:8001 (log: $larLog)"
}

# Optional: npm dev for xlerion_cmr
if ($IncludeNpm) {
  $npmLog = Join-Path $Workspace "xlerion_cmr\logs\npm-dev.log"
  $npmCwd = Join-Path $Workspace "xlerion_cmr"
  if (Test-Path (Join-Path $npmCwd "package.json")) {
    Start-Process -FilePath "cmd.exe" -ArgumentList "/c npm run dev > `"$npmLog`" 2>&1" -WorkingDirectory $npmCwd -WindowStyle Hidden | Out-Null
    Write-Host "npm run dev started (log: $npmLog)"
  } else {
    Write-Host "package.json not found in $npmCwd, skipping npm."
  }
}

Write-Host "Start commands issued. Use Get-Process or check logs to verify."
Write-Host "To view logs: Get-Content '<path-to-log>' -Wait -Tail 200"
