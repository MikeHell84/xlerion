param(
    [string]$Message = "checkpoint",
    [switch]$IncludeUncommitted,
    # by default include the whole xlerion_cmr folder
    [string]$Paths = "xlerion_cmr"
)

# Resolve repo root (assume tools/ is inside repo root)
$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$root = Resolve-Path (Join-Path $scriptDir '..')
$root = $root.ProviderPath

$checkpointsDir = Join-Path $root ".checkpoints"
if (-not (Test-Path $checkpointsDir)) { New-Item -ItemType Directory -Path $checkpointsDir | Out-Null }

$ts = Get-Date -Format "yyyyMMdd-HHmmss"
$name = "checkpoint-$ts"
$dir = Join-Path $checkpointsDir $name
New-Item -ItemType Directory -Path $dir | Out-Null

# Which files to include
$includeList = @()
foreach ($p in $Paths -split ",") {
    $full = Join-Path $root $p
    if (Test-Path $full) {
        $includeList += $full
    }
}

# always include the git diff for safety
$diffFile = Join-Path $dir "changes.diff"
if (Get-Command git -ErrorAction SilentlyContinue) {
    Push-Location $root
    if ($IncludeUncommitted) {
        git diff > $diffFile
    } else {
        git diff HEAD > $diffFile
    }
    Pop-Location
} else {
    "" | Out-File -FilePath $diffFile
}

# copy important files/directories preserving names
foreach ($p in $includeList) {
    $leaf = Split-Path $p -Leaf
    $dest = Join-Path $dir $leaf
    Copy-Item -Path $p -Destination $dest -Recurse -Force
}

# create a zip
$zipFile = Join-Path $checkpointsDir "$name.zip"
if (Test-Path $zipFile) { Remove-Item $zipFile }
Add-Type -AssemblyName System.IO.Compression.FileSystem
[System.IO.Compression.ZipFile]::CreateFromDirectory($dir, $zipFile)

# compute SHA256 of zip
$sha = ""
try {
    $hashObj = Get-FileHash -Algorithm SHA256 -Path $zipFile -ErrorAction Stop
    $sha = $hashObj.Hash
} catch {
    $sha = ""
}

# list files inside the zip
$filesInZip = @()
try {
    $zf = [System.IO.Compression.ZipFile]::OpenRead($zipFile)
    foreach ($e in $zf.Entries) { $filesInZip += $e.FullName }
    $zf.Dispose()
} catch {
    $filesInZip = @()
}

# append a log entry (JSONL) with sha and file list
$logFile = Join-Path $checkpointsDir "checkpoints.log"
$entry = [PSCustomObject]@{
    id = $name
    timestamp = (Get-Date).ToString("o")
    message = $Message
    zip = (Split-Path $zipFile -Leaf)
    sha256 = $sha
    files = $filesInZip
}
$entryJson = $entry | ConvertTo-Json -Compress
Add-Content -Path $logFile -Value $entryJson

Write-Output "Created checkpoint: $name"
Write-Output "Zip: $zipFile"
Write-Output "SHA256: $sha"
Write-Output "Log: $logFile"
