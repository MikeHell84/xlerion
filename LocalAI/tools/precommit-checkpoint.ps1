param(
    [string]$Message = "pre-commit checkpoint",
    [switch]$IncludeUncommitted
)

# run create_checkpoint with default paths
$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$createScript = Join-Path $scriptDir "create_checkpoint.ps1"
if (-not (Test-Path $createScript)) { Write-Error "create_checkpoint.ps1 not found"; exit 1 }

& $createScript -Message $Message -IncludeUncommitted:$IncludeUncommitted

# return success (0) so commit proceeds; if you want to block the commit on failure, return non-zero
exit 0
