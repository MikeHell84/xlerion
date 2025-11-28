param(
    [string]$Message = "checkpoint + commit",
    [string]$Files = "tools",
    [switch]$Push,
    [string]$BranchName
)

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$root = Resolve-Path (Join-Path $scriptDir '..')
$root = $root.ProviderPath

# create checkpoint
& (Join-Path $scriptDir 'create_checkpoint.ps1') -Message $Message -IncludeUncommitted

# determine branch name
if (-not $BranchName) { $ts = Get-Date -Format "yyyyMMdd-HHmmss"; $BranchName = "tools/checkpoint-$ts" }

Push-Location $root
try {
    git checkout -b $BranchName 2>$null || git checkout $BranchName
    git add $Files
    git commit -m $Message
    if ($Push) { git push -u origin $BranchName }
    $hash = git rev-parse --short HEAD
    Write-Output ("Committed on branch {0}: {1}" -f $BranchName, $hash)
} finally { Pop-Location }
