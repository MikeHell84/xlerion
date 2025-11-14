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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Blog</h1>
        </div>
    </div>

    {{-- Main Content for Blog --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400 uppercase font-heading">🧩 Blog / Bitácora</h2>
            <p class="text-center mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                Reflexiones, avances y documentación viva del proceso creativo, técnico y filosófico detrás de Xlerion.
            </p>
            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Entradas Sugeridas</h3>
            <div class="space-y-4">
                <a href="#" class="block bg-gray-800 p-4 rounded-lg shadow-xl border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="font-semibold text-white">El origen de Total Darkness</h4>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg shadow-xl border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="font-semibold text-white">Aplicación de la filosofía modular en videojuegos</h4>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg shadow-xl border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="font-semibold text-white">Documentar para empoderar</h4>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg shadow-xl border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="font-semibold text-white">Participación en Colombia 4.0</h4>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg shadow-xl border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
                    <h4 class="font-semibold text-white">Diagnóstico técnico como herramienta cultural</h4>
                </a>
            </div>
        </section>
    </div>
@endsection