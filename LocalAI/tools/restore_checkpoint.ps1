param(
    [Parameter(Mandatory=$true)][string]$Id,
    [switch]$Force
)

$scriptRoot = (Get-Location).ProviderPath
$checkpointsDir = Join-Path $scriptRoot ".checkpoints"
if (-not (Test-Path $checkpointsDir)) { Write-Error "No checkpoints directory"; exit }

$zip = Join-Path $checkpointsDir ("$Id.zip")
if (-not (Test-Path $zip)) { Write-Error "Checkpoint not found: $zip"; exit }

# read log entry for id
$logFile = Join-Path $checkpointsDir "checkpoints.log"
$expectedSha = $null
if (Test-Path $logFile) {
    Get-Content $logFile | ForEach-Object {
        try { $obj = $_ | ConvertFrom-Json } catch { return }
        if ($obj.id -eq $Id) { $expectedSha = $obj.sha256 }
    }
}

# compute actual sha
$actualSha = $null
try { $actualSha = (Get-FileHash -Algorithm SHA256 -Path $zip).Hash } catch {}

if ($expectedSha -and $actualSha -and ($expectedSha -ne $actualSha)) {
    if (-not $Force) {
        Write-Error "SHA mismatch: expected $expectedSha but zip has $actualSha. Use -Force to override."
        exit 1
    } else {
        Write-Warning "SHA mismatch but -Force provided; proceeding."
    }
}

$target = Join-Path $checkpointsDir ("restore-$Id")
if (Test-Path $target) { Remove-Item $target -Recurse -Force }

Add-Type -AssemblyName System.IO.Compression.FileSystem
[System.IO.Compression.ZipFile]::ExtractToDirectory($zip, $target)
Write-Output "Restored to: $target"
