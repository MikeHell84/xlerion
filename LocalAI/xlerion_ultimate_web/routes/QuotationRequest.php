<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuotationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'selected_services' => 'required|array',
            'selected_services.*' => 'in:toolkits,diagnostico,branding,documentacion,integracion',
            'effort' => 'required|array',
            'effort.toolkits' => 'required|numeric|min:1',
            'effort.diagnostico' => 'required|numeric|min:1',
            'effort.branding' => 'required|numeric|min:1',
            'effort.documentacion' => 'required|numeric|min:1',
            'effort.integracion' => 'required|numeric|min:1',
            'modulos' => 'required_if:selected_services,toolkits|numeric|min:1|max:2',
            'sistemas_monitoreados' => 'required_if:selected_services,diagnostico|numeric|min:1|max:1.5',
            'piezas_graficas' => 'required_if:selected_services,branding|numeric|min:1|max:1.4',
            'nivel_documentacion' => 'required_if:selected_services,documentacion|in:basico,medio,avanzado',
            'tipo_motor' => 'required_if:selected_services,integracion|in:unity,unreal,3dsmax',
            'email' => 'nullable|email',
        ];
    }

    public function messages()
    {
        return [
            'selected_services.required' => 'Debe seleccionar al menos un servicio.',
            'selected_services.*.in' => 'El servicio seleccionado no es válido.',
            'effort.*.required' => 'Debe seleccionar un nivel de esfuerzo para cada servicio.',
            'modulos.required_if' => 'El número de módulos es requerido para Toolkits Modulares.',
            'sistemas_monitoreados.required_if' => 'El número de sistemas monitoreados es requerido para Sistemas de Diagnóstico.',
            'piezas_graficas.required_if' => 'El número de piezas gráficas es requerido para Branding técnico-creativo.',
        ];
    }
}