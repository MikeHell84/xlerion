<div class="content-container p-8 rounded-xl shadow-lg border border-gray-700">
    <h3 class="text-2xl font-semibold mb-4 text-white">Solicitar Cotización</h3>
    <p class="text-gray-400 mb-4">Describe tu proyecto y te enviaremos una cotización personalizada. Por favor, sé lo más detallado posible.</p>

    <form action="{{ route('quotation.submit') }}" method="POST" class="space-y-4">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <input name="name" type="text" placeholder="Tu Nombre" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
            <input name="email" type="email" placeholder="Tu Correo Electrónico" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
        </div>
        <select name="service_type" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
            <option value="">Selecciona un tipo de servicio</option>
            <option value="toolkit_modular">Toolkits Modulares</option>
            <option value="sistema_diagnostico">Sistemas de Diagnóstico</option>
            <option value="branding_tecnico">Branding Técnico-Creativo</option>
            <option value="documentacion_estructurada">Documentación Estructurada</option>
            <option value="integracion_motores">Integración con Motores Gráficos</option>
            <option value="otro">Otro (especificar en detalles)</option>
        </select>
        <textarea name="project_details" placeholder="Describe tu proyecto y tus necesidades (lo más detallado posible)" rows="7" required class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white"></textarea>
        <input name="time_factor" type="text" placeholder="Factor de tiempo (ej: '3 semanas', '2 meses', 'urgente')" class="w-full p-3 bg-gray-700 border border-gray-600 rounded-lg text-white">
        <button type="submit" class="py-3 px-6 rounded-lg btn-xlerion">Solicitar Cotización</button>
    </form>
</div>