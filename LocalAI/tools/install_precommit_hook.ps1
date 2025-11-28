# Instala un hook de git pre-commit que ejecuta tools/precommit-checkpoint.ps1
param(
    [switch]$RequireEnableFile  # if set, the hook will run only when .enable-local-hooks exists
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

# Build hook content. Improvements over previous version:
# - Skip in CI and common CI env vars
# - Optional opt-in via .enable-local-hooks file or FORCE_LOCAL_HOOKS env var
# - Invoke the checkpoint wrapper directly with pwsh -File (so the hook itself is not treated as a .ps1)
$hookContent = @"
#!/usr/bin/env pwsh
# Auto-generated pre-commit hook to create a checkpoint (opt-in + CI-safe)
# Exit silently in CI
if ($env:CI -or $env:GITHUB_ACTIONS -or $env:GITLAB_CI -or $env:CI_COMMIT_SHA) {
    exit 0
}

# Determine repo root; if git not available, skip
try {
    $gitRoot = (git rev-parse --show-toplevel).Trim()
} catch {
    exit 0
}

# Opt-in: run only if .enable-local-hooks exists or FORCE_LOCAL_HOOKS env var is set
$enableFile = Join-Path $gitRoot ".enable-local-hooks"
if (-not (Test-Path $enableFile) -and -not $env:FORCE_LOCAL_HOOKS) {
    exit 0
}

# Path to the checkpoint wrapper (absolute), injected at install time
$checkpointScript = "__CHECKPOINT_SCRIPT_PATH__"

try {
    # run the wrapper quietly, discard output and never fail the commit
    pwsh -NoProfile -ExecutionPolicy Bypass -File "$checkpointScript" -Message "pre-commit automatic" -IncludeUncommitted *> $null 2>&1
} catch {
    # ignore any errors to avoid blocking commits
}
exit 0
"@

# Replace placeholder with resolved provider path and write hook
$hookContent = $hookContent -replace "__CHECKPOINT_SCRIPT_PATH__", ($checkpointScript -replace "\\","/" )
Set-Content -Path $hookFile -Value $hookContent -Force -Encoding UTF8
# ensure hook is executable on Unix; on Windows set permissive ACL if possible
try { icacls $hookFile /grant "Everyone:(RX)" | Out-Null } catch {}
Write-Output "Installed pre-commit hook at: $hookFile"
