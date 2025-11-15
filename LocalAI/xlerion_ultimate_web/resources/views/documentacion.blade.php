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
            <img src="{{ asset('img/Documentacion.svg') }}" alt="Documentación" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Documentacion --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <p class="text-left mb-12 text-gray-400 max-w-4xl mx-auto text-lg">
                La documentación en Xlerion es un pilar fundamental que asegura la continuidad, replicabilidad y evolución de cada solución técnica. A continuación, profundizamos en los elementos clave que conforman nuestro enfoque documental:
            </p>

            {{-- Key Documentation Elements --}}
            <div class="grid md:grid-cols-2 gap-8 mb-12">
                <div class="content-container p-6 rounded-lg border border-gray-700">
                    <h4 class="text-xl font-bold text-white mb-2 text-left">Manuales Técnicos por Módulo</h4>
                    <p class="text-gray-400 text-left">Cada módulo cuenta con manuales detallados que explican su funcionamiento, configuración y mantenimiento. Están diseñados para ser accesibles tanto para técnicos especializados como para usuarios con conocimientos intermedios, facilitando la autosuficiencia.</p>
                </div>
                <div class="content-container p-6 rounded-lg border border-gray-700">
                    <h4 class="text-xl font-bold text-white mb-2 text-left">Diagramas de Flujo y Arquitectura</h4>
                    <p class="text-gray-400 text-left">Utilizamos diagramas claros y precisos para representar la estructura y el flujo de datos, permitiendo una comprensión visual rápida y efectiva que facilita la integración, el diagnóstico y la mejora continua.</p>
                </div>
                <div class="content-container p-6 rounded-lg border border-gray-700">
                    <h4 class="text-xl font-bold text-white mb-2 text-left">Guías de Instalación y Configuración</h4>
                    <p class="text-gray-400 text-left">Proporcionamos instrucciones paso a paso para la correcta instalación y puesta en marcha de nuestras soluciones, adaptadas a diferentes entornos y plataformas para minimizar errores y optimizar el tiempo.</p>
                </div>
                <div class="content-container p-6 rounded-lg border border-gray-700">
                    <h4 class="text-xl font-bold text-white mb-2 text-left">Filosofía de Documentación como Empoderamiento</h4>
                    <p class="text-gray-400 text-left">Más que un simple soporte, la documentación es una herramienta estratégica para empoderar a usuarios y comunidades, promoviendo una cultura de transparencia, aprendizaje continuo y colaboración.</p>
                </div>
            </div>

            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Servicios de Documentación Estratégica</h3>
            <div class="space-y-8">
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Manualización Técnica Modular</h4>
                    <p class="text-gray-300 mb-2 text-left">Creación de manuales por módulo para facilitar mantenimiento y transferencia de conocimiento.</p>
                    <p class="text-gray-500 text-sm text-left">Ejemplo: Documentación de sistema de captura de movimiento con diagramas, instrucciones y flujos de calibración.</p>
                </div>
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Diagramación de Arquitectura Técnica</h4>
                    <p class="text-gray-300 mb-2 text-left">Diseño de diagramas de flujo y arquitectura para proyectos complejos.</p>
                    <p class="text-gray-500 text-sm text-left">Ejemplo: Mapeo de sistema de logging distribuido para producción multimedia.</p>
                </div>
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Guías de Instalación y Configuración</h4>
                    <p class="text-gray-300 mb-2 text-left">Redacción de guías claras para usuarios técnicos y no técnicos.</p>
                    <p class="text-gray-500 text-sm text-left">Ejemplo: Guía paso a paso para instalar y configurar el Xlerion Toolkit en múltiples sistemas operativos.</p>
                </div>
            </div>
        </section>
    </div>
@endsection