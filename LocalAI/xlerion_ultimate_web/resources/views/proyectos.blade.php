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
            <img src="{{ asset('img/Proyectos.svg') }}" alt="Proyectos" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Proyectos --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <p class="text-left mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                Cada proyecto de Xlerion es una manifestación tangible de nuestra filosofía modular, donde la innovación técnica se fusiona con el compromiso cultural y la documentación rigurosa. Nuestros proyectos buscan no solo resolver desafíos técnicos complejos, sino también empoderar a las comunidades y fomentar la replicabilidad y la autosuficiencia.
            </p>

            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Proyectos Destacados</h3>
            <div class="space-y-12 mb-12">
                <div class="content-container p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2 text-left">Total Darkness – Pelijuego Interactivo</h4>
                    <p class="text-gray-400 text-left">Adaptación de obra literaria original a una experiencia narrativa inmersiva que combina decisiones ramificadas, entornos 3D detallados y cinemáticas filosóficas, explorando temas profundos y ofreciendo una interacción significativa.</p>
                </div>
                <div class="content-container p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2 text-left">Xlerion Toolkit</h4>
                    <p class="text-gray-400 text-left">Conjunto modular de herramientas activas para diagnóstico, logging y análisis de rendimiento, diseñado para entornos técnicos complejos y de alta exigencia, facilitando la optimización y el mantenimiento predictivo.</p>
                </div>
                <div class="content-container p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2 text-left">Participación en Colombia 4.0</h4>
                    <p class="text-gray-400 text-left">Presentación institucional y pitch que destacan el impacto cultural y técnico de Xlerion, mostrando nuestra capacidad para integrar innovación y compromiso social en eventos clave del sector.</p>
                </div>
                <div class="content-container p-8 rounded-lg shadow-lg border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="text-2xl font-bold text-white mb-2 text-left">Postulación a CoCrea 2025</h4>
                    <p class="text-gray-400 text-left">Proyecto cultural con un enfoque empírico, neurodivergente y territorial, que busca validar y expandir nuestro modelo modular en contextos culturales y tecnológicos, promoviendo la colaboración sostenible y la autonomía creativa.</p>
                </div>
            </div>
        </section>
    </div>
@endsection