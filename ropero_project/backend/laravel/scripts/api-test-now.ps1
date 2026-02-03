Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

Write-Output '=== API test started ==='

$base = 'http://127.0.0.1:8000'

$ts = (Get-Date).ToString('yyyyMMddHHmmss')
$email = "debuguser_${ts}@example.test"
$password = 'Password123!'

Write-Output "Using test email: $email"

try {
    Write-Output '-> POST /api/register'
    $payload = @{ name = 'Debug User'; email = $email; password = $password; password_confirmation = $password }
    $resp = Invoke-RestMethod -Uri "$base/api/register" -Method Post -Body ($payload | ConvertTo-Json -Depth 5) -ContentType 'application/json' -TimeoutSec 15
    Write-Output 'Register response:'
    $resp | ConvertTo-Json -Depth 5 | Write-Output
}
catch {
    Write-Output ('Register failed: {0}' -f $_.Exception.Message)
}

try {
    Write-Output '-> POST /api/login'
    $payload = @{ email = $email; password = $password; device_name = 'test-run' }
    $resp2 = Invoke-RestMethod -Uri "$base/api/login" -Method Post -Body ($payload | ConvertTo-Json -Depth 5) -ContentType 'application/json' -TimeoutSec 15
    Write-Output 'Login response:'
    $resp2 | ConvertTo-Json -Depth 5 | Write-Output
    # Prefer token returned by register; otherwise attempt login
    if ($resp -and $resp.token) {
        $token = $resp.token -replace '"', ''
    }
    else {
        $token = $resp2.token -replace '"', ''
    }
}
catch {
    Write-Output ('Login failed: {0}' -f $_.Exception.Message)
}

if ($token) {
    try {
        Write-Output '-> GET /api/user (auth with Bearer token)'
        $hdr = @{ Authorization = "Bearer $token" }
        $user = Invoke-RestMethod -Uri "$base/api/user" -Method Get -Headers $hdr -TimeoutSec 10
        Write-Output 'User response:'
        $user | ConvertTo-Json -Depth 5 | Write-Output
    }
    catch {
        Write-Output ('GET /api/user failed: {0}' -f $_.Exception.Message)
    }
}
else {
    Write-Output 'No token received; skipping protected endpoint test.'
}

Write-Output '=== API test finished ==='
