$scriptRoot = (Get-Location).ProviderPath
$checkpointsDir = Join-Path $scriptRoot ".checkpoints"
if (-not (Test-Path $checkpointsDir)) { Write-Output "No checkpoints found"; exit }

$logFile = Join-Path $checkpointsDir "checkpoints.log"
if (-not (Test-Path $logFile)) {
    Get-ChildItem -Path $checkpointsDir -Filter "checkpoint-*.zip" | Sort-Object LastWriteTime | ForEach-Object {
        Write-Output $_.Name
    }
    exit
}

Get-Content $logFile | ForEach-Object {
    try { $_ | ConvertFrom-Json } catch { return }
} | Sort-Object timestamp | ForEach-Object {
    "{0} {1} {2}" -f $_.id, $_.timestamp, $_.message
}
