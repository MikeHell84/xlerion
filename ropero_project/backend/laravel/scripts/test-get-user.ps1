Set-StrictMode -Version Latest
$ErrorActionPreference = 'Stop'

# Paste the token here (single quotes avoid parsing issues)
$token = '7|r248BNCU5xPjqrLnC6JA8TEpuWaZGasimnWIaJPG3fb5c9f8'
Write-Output "Using token: $token"
try {
    $hdr = @{ Authorization = "Bearer $token" }
    $r = Invoke-RestMethod -Uri 'http://127.0.0.1:8000/api/user' -Headers $hdr -TimeoutSec 10
    Write-Output 'Request OK:'
    $r | ConvertTo-Json -Depth 5 | Write-Output
}
catch {
    Write-Output ('Request failed: {0}' -f $_.Exception.Message)
}
