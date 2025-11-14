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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Filosofía</h1>
        </div>
    </div>

    {{-- Main Content for Filosofia --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section>
            <h2 class="text-4xl font-bold text-center mb-12 text-teal-400 uppercase font-heading">🧬 Filosofía</h2>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold text-white mb-2">Misión</h3>
                    <p class="text-gray-400">Impulsar el desarrollo técnico contemporáneo mediante soluciones modulares que anticipan fallos, optimizan flujos de trabajo y fomentan la colaboración sostenible entre creadores, técnicos y comunidades.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold text-white mb-2">Visión</h3>
                    <p class="text-gray-400">Consolidarse como referente latinoamericano en el diseño de toolkits inteligentes que integren técnica, creatividad, documentación y escalabilidad para sectores culturales, educativos y tecnológicos.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold text-white mb-2">Valores</h3>
                    <ul class="text-gray-400 text-left mx-auto w-fit">
                        <li>Empatía aplicada a entornos técnicos</li>
                        <li>Autosuficiencia creativa como principio operativo</li>
                        <li>Documentación como legado replicable</li>
                        <li>Modularidad como eje estructural</li>
                        <li>Impacto cultural con enfoque territorial</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection