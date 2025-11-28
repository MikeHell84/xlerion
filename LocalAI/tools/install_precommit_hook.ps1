# Instala un hook de git pre-commit que ejecuta tools/precommit-checkpoint.ps1
param(
    [switch]$IncludeUncommitted
)

$scriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
# Determine git repository root using git (more reliable)
try {
    $gitRoot = (git rev-parse --show-toplevel).Trim()
} catch {
    Write-Error "git not found or not a git repository. Run from inside a repo."
    exit 1
}

$hookDir = Join-Path $gitRoot ".git\hooks"
if (-not (Test-Path $hookDir)) { Write-Error "No .git/hooks found at $hookDir"; exit 1 }

$hookFile = Join-Path $hookDir "pre-commit"
$checkpointScript = (Resolve-Path (Join-Path $scriptDir "precommit-checkpoint.ps1")).ProviderPath

# hook content: run PowerShell script (use pwsh if available)
$hookContent = @"
#!/usr/bin/env pwsh
# Auto-generated pre-commit hook to create a checkpoint
pwsh -NoProfile -ExecutionPolicy Bypass -File `"$checkpointScript`" -Message "pre-commit automatic" -IncludeUncommitted
exit 0
"@

Set-Content -Path $hookFile -Value $hookContent -Force
# ensure hook is executable on Unix; on Windows it's fine
try { icacls $hookFile /grant "Everyone:(RX)" | Out-Null } catch {}
Write-Output "Installed pre-commit hook at: $hookFile"
