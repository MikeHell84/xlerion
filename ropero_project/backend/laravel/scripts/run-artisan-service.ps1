<#
Run loop wrapper for `php artisan serve`.
This script is intended to be run by a Windows Service that launches PowerShell with this file.
It will change into the Laravel project directory, try to find `php`, and run `artisan serve` in a loop
so the process is restarted automatically if it exits. Output is written to
`storage/logs/service-artisan.log` inside the Laravel project.

Notes:
- Services running as LocalSystem may not have access to mapped network drives (X:).
  If the project path is on a mapped drive, run the service as the user who owns the mapping
  or use an absolute UNC path.
#>

Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

$projectPath = 'X:\Programacion\XlerionWeb\ropero_project\backend\laravel'
if (-not (Test-Path $projectPath)) {
    Write-Error "Project path not found: $projectPath"
    exit 1
}

Push-Location $projectPath

# Log file for the service wrapper
$logFile = Join-Path $projectPath 'storage\logs\service-artisan.log'
if (-not (Test-Path (Split-Path $logFile -Parent))) { New-Item -ItemType Directory -Path (Split-Path $logFile -Parent) -Force | Out-Null }

function Write-Log { param($m) $timestamp = (Get-Date).ToString('yyyy-MM-dd HH:mm:ss'); "$timestamp`t$m" | Out-File -FilePath $logFile -Append }

Write-Log "=== Starting run-artisan-service.ps1 wrapper ==="

# Try to locate php and pwsh
$php = (Get-Command php -ErrorAction SilentlyContinue).Source
if (-not $php) { $php = 'php' }

while ($true) {
    Write-Log "Launching: $php artisan serve --host=127.0.0.1 --port=8000"
    $startInfo = New-Object System.Diagnostics.ProcessStartInfo
    $startInfo.FileName = $php
    $startInfo.Arguments = 'artisan serve --host=127.0.0.1 --port=8000'
    $startInfo.WorkingDirectory = $projectPath
    $startInfo.RedirectStandardOutput = $true
    $startInfo.RedirectStandardError = $true
    $startInfo.UseShellExecute = $false

    $proc = New-Object System.Diagnostics.Process
    $proc.StartInfo = $startInfo
    $proc.Start() | Out-Null

    # Async read of output + error
    $stdOut = $proc.StandardOutput
    $stdErr = $proc.StandardError

    while (-not $proc.HasExited) {
        try {
            if (-not $stdOut.EndOfStream) {
                $line = $stdOut.ReadLine()
                if ($line) { Write-Log "OUT: $line" }
            }
            if (-not $stdErr.EndOfStream) {
                $line = $stdErr.ReadLine()
                if ($line) { Write-Log "ERR: $line" }
            }
        }
        catch {
            Start-Sleep -Milliseconds 200
        }
        Start-Sleep -Milliseconds 200
    }

    $exitCode = $proc.ExitCode
    Write-Log "artisan exited with code $exitCode. Restarting in 5s..."
    Start-Sleep -Seconds 5
}

Pop-Location
