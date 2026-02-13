# Validation Script for Roadmap System Integration
# Run this to verify all files are in place

Write-Host "`n🔍 Validando integracion del sistema de roadmaps...`n" -ForegroundColor Cyan

$errors = 0
$warnings = 0
$docsRoot = "docs-md"

function Get-DocsPath {
    param([string]$relativePath)
    $safeName = ($relativePath -replace "[/\\]", "__")
    return Join-Path $docsRoot $safeName
}

# Function to check file exists
function Test-FileExists {
    param($path, $description)
    if (Test-Path $path) {
        Write-Host "✓ $description" -ForegroundColor Green
        return $true
    }
    else {
        Write-Host "✗ $description - NO ENCONTRADO" -ForegroundColor Red
        $script:errors++
        return $false
    }
}

# Function to check file has content
function Test-FileHasContent {
    param($path, $description, $minSize = 100)
    if (Test-Path $path) {
        $size = (Get-Item $path).Length
        if ($size -gt $minSize) {
            Write-Host "✓ $description ($size bytes)" -ForegroundColor Green
            return $true
        }
        else {
            Write-Host "⚠ $description - Archivo muy pequeño ($size bytes)" -ForegroundColor Yellow
            $script:warnings++
            return $false
        }
    }
    else {
        Write-Host "✗ $description - NO ENCONTRADO" -ForegroundColor Red
        $script:errors++
        return $false
    }
}

Write-Host "📁 Backend & API Files:" -ForegroundColor Yellow
Test-FileHasContent "xlerion-site/public/api/roadmaps.php" "roadmaps.php (API endpoints)" 10000
Test-FileExists "xlerion-site/public/api/.env" ".env (variables de entorno)"
Test-FileHasContent "xlerion-site/public/router.php" "router.php (routing actualizado)" 1000

Write-Host "`n📁 Admin Panel:" -ForegroundColor Yellow
Test-FileHasContent "xlerion-site/public/roadmap-admin.html" "roadmap-admin.html" 15000

Write-Host "`n📁 Frontend Components:" -ForegroundColor Yellow
Test-FileHasContent "xlerion-site/src/components/RoadmapModal.jsx" "RoadmapModal.jsx" 5000
Test-FileHasContent "xlerion-site/src/context/LanguageContext.jsx" "LanguageContext.jsx (con i18n)" 50000

Write-Host "`n📁 Data Files:" -ForegroundColor Yellow
Test-FileHasContent "roadmaps.json" "roadmaps.json (plantillas)" 20000
Test-FileHasContent "cases_examples.json" "cases_examples.json" 5000

Write-Host "`n📁 Documentation (local):" -ForegroundColor Yellow
Test-FileHasContent (Get-DocsPath "ui_flow.md") "ui_flow.md" 1000
Test-FileHasContent (Get-DocsPath "endpoints.md") "endpoints.md" 1000
Test-FileHasContent (Get-DocsPath "hours_to_sprints.md") "hours_to_sprints.md" 1000
Test-FileHasContent (Get-DocsPath "ROADMAP_INTEGRATION_GUIDE.md") "ROADMAP_INTEGRATION_GUIDE.md" 5000
Test-FileHasContent (Get-DocsPath "ROADMAP_INTEGRATION_SUMMARY.md") "ROADMAP_INTEGRATION_SUMMARY.md" 3000

Write-Host "`n📁 Summary Docs:" -ForegroundColor Yellow
$summaryDocs = @(
    "summary_docs/web_mobile.md",
    "summary_docs/enterprise_software.md",
    "summary_docs/consulting.md",
    "summary_docs/blockchain.md",
    "summary_docs/design_branding.md",
    "summary_docs/digital_marketing.md",
    "summary_docs/video_games.md",
    "summary_docs/modeling_3d.md"
)

foreach ($doc in $summaryDocs) {
    Test-FileExists (Get-DocsPath $doc) (Split-Path $doc -Leaf)
}

# Check JSON structure
Write-Host "`n🔍 Validando estructura JSON:" -ForegroundColor Yellow
try {
    $roadmaps = Get-Content "roadmaps.json" -Raw | ConvertFrom-Json
    if ($roadmaps.services) {
        $serviceCount = ($roadmaps.services | Get-Member -MemberType NoteProperty).Count
        Write-Host "✓ roadmaps.json valido - $serviceCount servicios encontrados" -ForegroundColor Green
        
        $totalSubservices = 0
        foreach ($service in ($roadmaps.services | Get-Member -MemberType NoteProperty).Name) {
            $subCount = $roadmaps.services.$service.subservices.Count
            $totalSubservices += $subCount
        }
        Write-Host "  → Total de subservicios: $totalSubservices" -ForegroundColor Cyan
    }
    else {
        Write-Host "⚠ roadmaps.json no tiene estructura 'services'" -ForegroundColor Yellow
        $warnings++
    }
}
catch {
    Write-Host "✗ Error al parsear roadmaps.json: $_" -ForegroundColor Red
    $errors++
}

try {
    $cases = Get-Content "cases_examples.json" -Raw | ConvertFrom-Json
    if ($cases.cases) {
        $caseCount = $cases.cases.Count
        Write-Host "✓ cases_examples.json valido - $caseCount casos encontrados" -ForegroundColor Green
    }
    else {
        Write-Host "⚠ cases_examples.json no tiene estructura 'cases'" -ForegroundColor Yellow
        $warnings++
    }
}
catch {
    Write-Host "✗ Error al parsear cases_examples.json: $_" -ForegroundColor Red
    $errors++
}

# Check for required translations
Write-Host "`n🌐 Verificando traducciones i18n:" -ForegroundColor Yellow
$langContext = Get-Content "xlerion-site/src/context/LanguageContext.jsx" -Raw
$requiredKeys = @(
    "roadmap_title",
    "roadmap_subtitle",
    "roadmap_loading",
    "roadmap_error",
    "roadmap_weeks",
    "roadmap_deliverables",
    "roadmap_roles"
)

foreach ($key in $requiredKeys) {
    if ($langContext -match $key) {
        Write-Host "✓ Clave '$key' encontrada" -ForegroundColor Green
    }
    else {
        Write-Host "✗ Clave '$key' NO encontrada en LanguageContext" -ForegroundColor Red
        $errors++
    }
}

# Summary
Write-Host "`n" + ("=" * 60) -ForegroundColor Cyan
Write-Host "📊 RESUMEN DE VALIDACION" -ForegroundColor Cyan
Write-Host ("=" * 60) -ForegroundColor Cyan

if ($errors -eq 0 -and $warnings -eq 0) {
    Write-Host "`n🎉 ¡PERFECTO! Todos los archivos estan en su lugar y son validos.`n" -ForegroundColor Green
    Write-Host "✅ El sistema esta listo para testing." -ForegroundColor Green
    Write-Host "`nProximos pasos:" -ForegroundColor Yellow
    Write-Host "  1. Ejecutar: npm run dev" -ForegroundColor White
    Write-Host "  2. Abrir: http://localhost:5173/roadmap-admin.html" -ForegroundColor White
    Write-Host "  3. Token: xlerion_admin_2026" -ForegroundColor White
    Write-Host "  4. Probar endpoints con Invoke-WebRequest`n" -ForegroundColor White
}
elseif ($errors -eq 0) {
    Write-Host "`n⚠ Validacion completada con $warnings advertencia(s).`n" -ForegroundColor Yellow
    Write-Host "Los archivos criticos estan presentes, pero revisa las advertencias arriba.`n" -ForegroundColor Yellow
}
else {
    Write-Host "`n❌ Validacion FALLIDA: $errors error(es), $warnings advertencia(s).`n" -ForegroundColor Red
    Write-Host "Revisa los archivos faltantes arriba y vuelve a ejecutar este script.`n" -ForegroundColor Red
    exit 1
}

Write-Host "Para mas informacion, consulta:" -ForegroundColor Cyan
Write-Host "  → ROADMAP_INTEGRATION_GUIDE.md" -ForegroundColor White
Write-Host "  → ROADMAP_INTEGRATION_SUMMARY.md`n" -ForegroundColor White
