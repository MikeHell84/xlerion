@extends('layouts.app')

@section('content')
    {{-- Hero Section with Parallax Video --}}
    <div class="relative overflow-hidden video-parallax-container">
        <!-- Video de fondo -->
        <video class="parallax-video filter-subtle" autoplay loop muted playsinline>
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            Tu navegador no soporta el video.
        </video>

        <!-- Capa oscura sobre el video -->
        <div class="absolute inset-0 bg-black/50 z-0"></div>

        <!-- Contenido principal del Hero -->
        <div class="relative z-1 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Documentación</h1>
        </div>
    </div>

    {{-- Main Content for Documentacion --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400 uppercase font-heading">📚 Documentación</h2>
            <p class="text-center mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                La documentación es un componente esencial del legado de Xlerion. Cada solución incluye manuales modulares, diagramas técnicos y guías operativas que garantizan su mantenimiento, réplica y evolución.
            </p>

            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Servicios de Documentación Estratégica</h3>
            <div class="space-y-8">
                <div class="bg-gray-800 p-6 rounded-lg shadow-xl border border-gray-700">
                    <h4 class="text-2xl font-semibold text-teal-400 mb-2">8. Manualización Técnica Modular</h4>
                    <p class="text-gray-300 mb-2">Creación de manuales por módulo para facilitar mantenimiento y transferencia de conocimiento.</p>
                    <p class="text-gray-500 text-sm">Ejemplo: Documentación de sistema de captura de movimiento con diagramas, instrucciones y flujos de calibración.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-xl border border-gray-700">
                    <h4 class="text-2xl font-semibold text-teal-400 mb-2">9. Diagramación de Arquitectura Técnica</h4>
                    <p class="text-gray-300 mb-2">Diseño de diagramas de flujo y arquitectura para proyectos complejos.</p>
                    <p class="text-gray-500 text-sm">Ejemplo: Mapeo de sistema de logging distribuido para producción multimedia.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-xl border border-gray-700">
                    <h4 class="text-2xl font-semibold text-teal-400 mb-2">10. Guías de Instalación y Configuración</h4>
                    <p class="text-gray-300 mb-2">Redacción de guías claras para usuarios técnicos y no técnicos.</p>
                    <p class="text-gray-500 text-sm">Ejemplo: Guía paso a paso para instalar y configurar el Xlerion Toolkit en múltiples sistemas operativos.</p>
                </div>
            </div>
        </section>
    </div>
@endsection