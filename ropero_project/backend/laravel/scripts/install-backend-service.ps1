<#
Install the `RoperoBackend` Windows service which runs PowerShell and executes
`run-artisan-service.ps1` in the Laravel project. Run this script as Administrator.

Notes:
- Services created as LocalSystem may not see mapped drives (X:). If the project is
  on a mapped network drive, consider running the service as a specific user
  (use `-Credential` with `New-Service`), or use NSSM to run the service.
#>

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

function Ensure-Admin {
    $id = [Security.Principal.WindowsIdentity]::GetCurrent()
    $principal = New-Object Security.Principal.WindowsPrincipal($id)
    if (-not $principal.IsInRole([Security.Principal.WindowsBuiltinRole]::Administrator)) {
        Write-Error 'This installer must be run as Administrator.'
        exit 2
    }
}

Ensure-Admin

$serviceName = 'RoperoBackend'
$scriptPath = 'X:\Programacion\XlerionWeb\ropero_project\backend\laravel\scripts\run-artisan-service.ps1'

if (-not (Test-Path $scriptPath)) { Write-Error "Wrapper script not found: $scriptPath"; exit 1 }

# Locate pwsh or fallback to Windows PowerShell
$pwsh = (Get-Command pwsh -ErrorAction SilentlyContinue).Source
if (-not $pwsh) { $pwsh = "$env:WINDIR\System32\WindowsPowerShell\v1.0\powershell.exe" }

# If service exists, remove it first
if (Get-Service -Name $serviceName -ErrorAction SilentlyContinue) {
    Write-Output "Service '$serviceName' already exists — removing."
    Try { Stop-Service -Name $serviceName -Force -ErrorAction SilentlyContinue } Catch {}
    sc.exe delete $serviceName | Out-Null
    Start-Sleep -Seconds 1
}

$escapedPwsh = '"' + $pwsh + '"'
$escapedScript = '"' + $scriptPath + '"'
$binPath = "$escapedPwsh -NoProfile -ExecutionPolicy Bypass -File $escapedScript"
Write-Output "Creating service '$serviceName' -> $binPath"
New-Service -Name $serviceName -BinaryPathName $binPath -DisplayName 'Ropero Backend (artisan serve)' -StartupType Automatic

# Add a description
sc.exe description $serviceName "Runs Laravel artisan serve in a loop for local development. Created by installer script."

Write-Output 'Starting service...'
Start-Service -Name $serviceName
Start-Sleep -Seconds 2

$s = Get-Service -Name $serviceName
Write-Output "Service status: $($s.Status)"

if ($s.Status -ne 'Running') {
    Write-Output 'Service failed to start. Check the event viewer and the service log file:'
    Write-Output "  X:\Programacion\XlerionWeb\ropero_project\backend\laravel\storage\logs\service-artisan.log"
}
else {
    Write-Output 'Service installed and running. Verifying listening port 8000...'
    Start-Sleep -Seconds 1
    $listening = Get-NetTCPConnection -LocalPort 8000 -ErrorAction SilentlyContinue
    if ($listening) { Write-Output 'Port 8000 is in use; backend should be accessible at http://127.0.0.1:8000' } else { Write-Output 'Port 8000 not observed in Get-NetTCPConnection. Check the service log file.' }
}

Write-Output 'Installer finished.'
