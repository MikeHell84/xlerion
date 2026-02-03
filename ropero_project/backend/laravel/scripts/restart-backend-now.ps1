Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

Write-Output '=== Restart backend script started ==='

Write-Output 'Listing php processes whose command line contains artisan/server.php/-S'
$phpProcs = Get-CimInstance Win32_Process -Filter "Name='php.exe'" | Where-Object { $_.CommandLine -match 'artisan|server.php|-S' }
if ($phpProcs) {
    foreach ($p in $phpProcs) {
        Write-Output "PID: $($p.ProcessId)"
        Write-Output "Cmd: $($p.CommandLine)"
    }
}
else {
    Write-Output 'No matching php processes found.'
}

if ($phpProcs) {
    $ids = $phpProcs | Select-Object -ExpandProperty ProcessId
    Write-Output "Stopping php processes: $([string]::Join(', ', $ids))"
    foreach ($id in $ids) {
        try {
            Stop-Process -Id $id -Force -ErrorAction Stop
            Write-Output "Stopped PID $id"
        }
        catch {
            Write-Output ('Failed to stop PID {0}: {1}' -f $id, $_.Exception.Message)
        }
    }
    Start-Sleep -Seconds 1
}
else {
    Write-Output 'Nothing to stop.'
}

Write-Output '--- Starting backend wrapper ---'
$pwshExe = (Get-Command pwsh -ErrorAction SilentlyContinue).Source
if (-not $pwshExe) { $pwshExe = "$env:WINDIR\System32\WindowsPowerShell\v1.0\powershell.exe" }
$wrapper = 'X:\Programacion\XlerionWeb\ropero_project\backend\laravel\scripts\run-artisan-service.ps1'
if (Test-Path $wrapper) {
    $proc = Start-Process -FilePath $pwshExe -ArgumentList '-NoProfile', '-ExecutionPolicy', 'Bypass', '-File', $wrapper -WindowStyle Hidden -PassThru
    Write-Output "Started wrapper (PID $($proc.Id))"
}
else {
    Write-Output "Wrapper not found: $wrapper"
    exit 1
}

Write-Output 'Waiting up to 30s for port 8000 to bind...'
$bound = $false
for ($i = 0; $i -lt 30; $i++) {
    Start-Sleep -Seconds 1
    try { $conn = Get-NetTCPConnection -LocalPort 8000 -ErrorAction Stop } catch { $conn = $null }
    if ($conn) { $bound = $true; break }
}
if ($bound) {
    Write-Output 'Port 8000 is listening.'
    $conn | Select-Object LocalAddress, LocalPort, State, OwningProcess | Format-List
}
else {
    Write-Output 'Timeout waiting for port 8000 to bind.'
}

Write-Output '--- Test HTTP GET / ---'
try {
    $r = Invoke-WebRequest -Uri http://127.0.0.1:8000/ -UseBasicParsing -TimeoutSec 7
    Write-Output "HTTP GET / -> $($r.StatusCode) $($r.StatusDescription)"
}
catch {
    Write-Output ('HTTP request failed: {0}' -f $_.Exception.Message)
}

Write-Output '--- Current php processes ---'
Get-Process -Name php -ErrorAction SilentlyContinue | Select-Object Id, ProcessName, Path, StartTime | Format-Table

Write-Output '=== Restart backend script finished ==='
