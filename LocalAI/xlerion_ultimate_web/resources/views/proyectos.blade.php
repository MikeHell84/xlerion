@extends('layouts.app')

@section('content')
    {{-- Parallax Banner for Proyectos --}}
    <div class="relative h-96 overflow-hidden parallax-banner-container">
        <img src="{{ asset('images/parallax/proyectos-parallax.jpg') }}" alt="Proyectos Parallax Banner" class="absolute top-0 left-0 w-full h-full object-cover parallax-banner-image">
        <div class="absolute inset-0 bg-black/50 z-1"></div> {{-- Overlay --}}
        <div class="relative z-10 flex items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white">Proyectos</h1>
        </div>
    </div>

    {{-- Main Content for Proyectos --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section>
            <h2 class="text-4xl font-bold text-center mb-12 text-teal-400">🎮 Proyectos</h2>
            <div class="space-y-12">
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-2">Total Darkness – Pelijuego Interactivo</h3>
                    <p class="text-gray-400">Adaptación de obra literaria original a experiencia narrativa inmersiva con decisiones ramificadas, entornos 3D y cinemáticas filosóficas.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-2">Xlerion Toolkit</h3>
                    <p class="text-gray-400">Conjunto de módulos activos para diagnóstico, logging y rendimiento, diseñado para entornos técnicos complejos.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-2">Participación en Colombia 4.0</h3>
                    <p class="text-gray-400">Presentación institucional y pitch de impacto cultural y técnico.</p>
                </div>
                <div class="bg-gray-800 p-8 rounded-lg shadow-lg">
                    <h3 class="text-2xl font-bold text-white mb-2">Postulación a CoCrea 2025</h3>
                    <p class="text-gray-400">Proyecto cultural con enfoque empírico, neurodivergente y territorial.</p>
                </div>
            </div>
        </section>
    </div>
@endsection