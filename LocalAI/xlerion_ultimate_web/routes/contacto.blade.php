<!-- resources/views/contacto.blade.php -->

@extends('layouts.app') {{-- Asumiendo que tienes un layout base --}}

@section('content')
    <h1>Contáctanos y Cotiza tu Servicio</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('quotation.calculate') }}" method="POST">
        @csrf

        <div>
            <label>Seleccione los servicios:</label><br>
            <input type="checkbox" id="toolkits" name="selected_services[]" value="toolkits">
            <label for="toolkits">Toolkits Modulares</label><br>

            <input type="checkbox" id="diagnostico" name="selected_services[]" value="diagnostico">
            <label for="diagnostico">Sistemas de Diagnóstico</label><br>

            <input type="checkbox" id="branding" name="selected_services[]" value="branding">
            <label for="branding">Branding técnico-creativo</label><br>

            <input type="checkbox" id="documentacion" name="selected_services[]" value="documentacion">
            <label for="documentacion">Documentación estructurada</label><br>

            <input type="checkbox" id="integracion" name="selected_services[]" value="integracion">
            <label for="integracion">Integración con motores gráficos</label><br>
        </div>

        {{-- Campos dinámicos según servicio --}}
        <div id="dynamic-fields">

            {{-- Esfuerzo --}}
            <div>
                <label>Nivel de Esfuerzo:</label><br>
                @foreach(['toolkits', 'diagnostico', 'branding', 'documentacion', 'integracion'] as $service)
                    <div id="effort-{{ $service }}" style="display:none;">
                        <label for="effort-{{ $service }}-bajo">{{ ucfirst($service) }}:</label>
                        <select name="effort[{{ $service }}]">
                            <option value="1.0">Bajo</option>
                            <option value="1.25">Medio</option>
                            <option value="1.5">Alto</option>
                        </select>
                    </div>
                @endforeach
            </div>

            {{-- Toolkits Modulares --}}
            <div id="toolkits-fields" style="display:none;">
                <label for="modulos">Número de módulos:</label>
                <input type="number" name="modulos" min="1" max="2">
            </div>

            {{-- Sistemas de Diagnóstico --}}
            <div id="diagnostico-fields" style="display:none;">
                <label for="sistemas_monitoreados">Sistemas monitoreados:</label>
                <input type="number" name="sistemas_monitoreados" min="1" max="1.5" step="0.1">
            </div>

            {{-- Branding técnico-creativo --}}
            <div id="branding-fields" style="display:none;">
                <label for="piezas_graficas">Número de piezas gráficas:</label>
                <input type="number" name="piezas_graficas" min="1" max="1.4" step="0.1">
            </div>

            {{-- Documentación estructurada --}}
            <div id="documentacion-fields" style="display:none;">
                <label for="nivel_documentacion">Nivel de profundidad:</label>
                <select name="nivel_documentacion">
                    <option value="basico">Básico</option>
                    <option value="medio">Medio</option>
                    <option value="avanzado">Avanzado</option>
                </select>
            </div>

            {{-- Integración con motores gráficos --}}
            <div id="integracion-fields" style="display:none;">
                <label for="tipo_motor">Tipo de motor:</label>
                <select name="tipo_motor">
                    <option value="unity">Unity</option>
                    <option value="unreal">Unreal Engine</option>
                    <option value="3dsmax">3DS Max</option>
                </select>
            </div>
        </div>

        <div>
            <label for="email">Correo electrónico (opcional):</label>
            <input type="email" name="email">
        </div>

        <button type="submit">Obtener Cotización</button>
    </form>

    <script>
        // Aquí iría el JavaScript para mostrar/ocultar campos dinámicos
    </script>
@endsection