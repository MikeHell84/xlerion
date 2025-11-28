param(
    [string]$Message = "pre-commit checkpoint",
    [switch]$IncludeUncommitted
)

# run create_checkpoint with default paths
$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$createScript = Join-Path $scriptDir "create_checkpoint.ps1"
if (-not (Test-Path $createScript)) { Write-Error "create_checkpoint.ps1 not found"; exit 1 }

try {
    & $createScript -Message $Message -IncludeUncommitted:$IncludeUncommitted *> $null
} catch {
    # swallow errors; do not block commit
}

# always succeed so commit continues
exit 0
