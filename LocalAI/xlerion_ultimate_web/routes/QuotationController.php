<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuotationController extends Controller
{
    public function calculateQuote(QuotationRequest $request)
    {
        $validatedData = $request->validated();
        $servicesConfig = $this->getServicesConfig();
        $totalCost = 0;
        $serviceDetails = [];

        foreach ($validatedData['selected_services'] as $serviceName) {
            $serviceConfig = $servicesConfig[$serviceName];
            $valorBase = $serviceConfig['valor_base'];
            $esfuerzo = $validatedData['effort'][$serviceName];
            $tiempo = $serviceConfig['tiempo'];
            $constanteTecnica = $this->getConstanteTecnica($serviceName, $validatedData);
            $valorEstimado = $valorBase * $esfuerzo * $tiempo * $constanteTecnica;

            $totalCost += $valorEstimado;
            $serviceDetails[$serviceName] = [
                'valor_base' => $valorBase,
                'esfuerzo' => $esfuerzo,
                'tiempo' => $tiempo,
                'constante_tecnica' => $constanteTecnica,
                'valor_estimado' => $valorEstimado,
            ];
        }

        $quotation = Quotation::create([
            'selected_services' => $validatedData['selected_services'],
            'service_details' => $serviceDetails,
            'total_cost' => $totalCost,
            'email' => $validatedData['email'] ?? null, // Opcional
        ]);

        // Envío de correo (opcional)
        // Mail::to($validatedData['email'])->send(new QuotationSummary($quotation));

        return redirect()->back()->with('success', 'Cotización generada con éxito. Revise su correo electrónico.');
    }

    private function getServicesConfig()
    {
        return [
            'toolkits' => [
                'valor_base' => 3500000,
                'tiempo' => 15, // Días
            ],
            'diagnostico' => [
                'valor_base' => 2800000,
                'tiempo' => 10,
            ],
            'branding' => [
                'valor_base' => 2200000,
                'tiempo' => 7,
            ],
            'documentacion' => [
                'valor_base' => 1800000,
                'tiempo' => 5,
            ],
            'integracion' => [
                'valor_base' => 4000000,
                'tiempo' => 20,
            ],
        ];
    }

    private function getConstanteTecnica($serviceName, $data)
    {
        switch ($serviceName) {
            case 'toolkits':
                return $data['modulos']; // Valor entre 1.0 y 2.0
            case 'diagnostico':
                return $data['sistemas_monitoreados']; // Valor entre 1.0 y 1.5
            case 'branding':
                return $data['piezas_graficas']; // Valor entre 1.0 y 1.4
            case 'documentacion':
                $nivel = $data['nivel_documentacion'];
                if ($nivel == 'basico') return 1.0;
                if ($nivel == 'medio') return 1.2;
                return 1.5; // avanzado
            case 'integracion':
                $motor = $data['tipo_motor'];
                if ($motor == 'unity') return 1.0;
                if ($motor == 'unreal') return 1.2;
                return 1.3; // 3DS Max
            default:
                return 1.0;
        }
    }
}