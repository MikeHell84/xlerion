<x-mail::message>
# Nueva Solicitud de Cotización

Has recibido una nueva solicitud de cotización a través del sitio web de Xlerion.

**Detalles de la Solicitud:**

*   **Nombre:** {{ $name }}
*   **Correo Electrónico:** {{ $email }}
*   **Tipo de Servicio:** {{ $service_type }}
*   **Detalles del Proyecto:**
    {{ $project_details }}
*   **Factor de Tiempo:** {{ $time_factor }}

Gracias,
{{ config('app.name') }}
</x-mail::message>
