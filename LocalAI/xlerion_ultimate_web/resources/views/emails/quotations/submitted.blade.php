<!-- resources/views/emails/quotations/submitted.blade.php -->
@component('mail::message')
# Solicitud de Cotización Recibida

Hola {{ $quotation->name }},

Hemos recibido tu solicitud de cotización con los siguientes detalles:

**Información de Contacto:**
*   **Nombre:** {{ $quotation->name }}
*   **Email:** {{ $quotation->email }}
*   **Teléfono:** {{ $quotation->phone ?? 'No especificado' }}

**Servicios Solicitados:**
@foreach ($quotation->selected_services as $service)
*   **{{ $service['service_name'] }}**
    *   Valor Base: ${{ number_format($service['base_value'], 0, ',', '.') }} COP
    *   Multiplicador de Esfuerzo: {{ $service['effort_multiplier'] }}
    *   Tiempo Estimado: {{ $service['time_estimate_days'] }} días
    *   Constante Técnica ({{ $service['technical_constant_type'] }}): {{ $service['technical_constant_value'] }} (Valor usado en cálculo: {{ $service['calculated_technical_constant'] }})
    *   Valor Estimado del Servicio: ${{ number_format($service['estimated_service_value'], 0, ',', '.') }} COP
@endforeach

**Valor Total Estimado:** ${{ number_format($quotation->estimated_total, 0, ',', '.') }} COP

**Notas Adicionales:**
{{ $quotation->notes ?? 'No hay notas adicionales.' }}

Nos pondremos en contacto contigo a la brevedad para discutir los detalles y afinar la cotización.

Gracias por tu interés en Xlerion.

Saludos,
El equipo de Xlerion
@endcomponent
