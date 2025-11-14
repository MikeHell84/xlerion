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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Proyectos</h1>
        </div>
    </div>

    {{-- Main Content for Proyectos --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400 uppercase font-heading">🎮 Proyectos</h2>
            <p class="text-center mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                Cada proyecto desarrollado por Xlerion representa una aplicación directa de su filosofía: modularidad, documentación estratégica y empoderamiento técnico. A continuación, se presentan las iniciativas más representativas.
            </p>

            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Proyectos Destacados</h3>
            <div class="space-y-12 mb-12">
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2">Total Darkness – Pelijuego Interactivo</h4>
                    <p class="text-gray-400">Adaptación de obra literaria original a experiencia narrativa inmersiva con decisiones ramificadas, entornos 3D y cinemáticas filosóficas.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2">Xlerion Toolkit</h4>
                    <p class="text-gray-400">Conjunto de módulos activos para diagnóstico, logging y rendimiento, diseñado para entornos técnicos complejos.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2">Colombia 4.0</h4>
                    <p class="text-gray-400">Presentación institucional con enfoque en impacto cultural, técnico y territorial.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2">Postulación CoCrea 2025</h4>
                    <p class="text-gray-400">Proyecto cultural con enfoque empírico, neurodivergente y territorial, orientado a la documentación de saberes locales.</p>
                </div>
            </div>
        </section>
    </div>
@endsection