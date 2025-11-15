<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuotationRequest;
use App\Mail\QuotationSubmitted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request; // Aunque no se usa directamente, es buena práctica importarlo

class QuotationController extends Controller
{
    /**
     * Handle the incoming quotation submission.
     */
    public function submit(QuotationRequest $request)
    {
        // Los datos ya están validados por QuotationRequest

        // Enviar el correo electrónico
        Mail::to(config('mail.from.address'))->send(new QuotationSubmitted($request->validated()));

        // Redirigir con un mensaje de éxito
        return redirect()->back()->with('success', '¡Tu solicitud de cotización ha sido enviada con éxito! Pronto nos pondremos en contacto contigo.');
    }

    /**
     * Get the services configuration and multipliers for the quotation form.
     *
     * @return array
     */
    public function getServicesConfig(): array
    {
        $servicesConfig = [
            'Desarrollo Web' => [
                'base_price' => 1000,
                'features' => [
                    'Diseño Responsivo' => 200,
                    'Integración de Base de Datos' => 300,
                    'Panel de Administración' => 500,
                    'SEO Básico' => 150,
                ],
            ],
            'Desarrollo de Aplicaciones Móviles' => [
                'base_price' => 1500,
                'features' => [
                    'Diseño UI/UX' => 400,
                    'Integración API' => 600,
                    'Notificaciones Push' => 350,
                    'Modo Offline' => 500,
                ],
            ],
            'Desarrollo de Videojuegos' => [
                'base_price' => 2000,
                'features' => [
                    'Diseño de Niveles' => 700,
                    'Mecánicas de Juego' => 800,
                    'Multijugador' => 1000,
                    'Integración de Monetización' => 400,
                ],
            ],
            'Inteligencia Artificial' => [
                'base_price' => 2500,
                'features' => [
                    'Análisis de Datos' => 900,
                    'Machine Learning' => 1200,
                    'Procesamiento de Lenguaje Natural' => 1100,
                    'Visión por Computadora' => 1300,
                ],
            ],
        ];

        $effortMultipliers = [
            'Bajo' => 1.0,
            'Medio' => 1.25,
            'Alto' => 1.5,
        ];

        $engineTypeMultipliers = [
            'unity' => 1.0,
            'unreal' => 1.2,
            '3ds_max' => 1.3,
        ];

        return compact('servicesConfig', 'effortMultipliers', 'engineTypeMultipliers');
    }
}