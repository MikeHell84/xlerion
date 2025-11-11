@extends('layouts.app')

@section('content')
    {{-- Parallax Banner for Blog --}}
    <div class="relative h-96 overflow-hidden parallax-banner-container">
        <img src="{{ asset('images/parallax/blog-bitacora-parallax.jpg') }}" alt="Blog Parallax Banner" class="absolute top-0 left-0 w-full h-full object-cover parallax-banner-image">
        <div class="absolute inset-0 bg-black/50 z-1"></div> {{-- Overlay --}}
        <div class="relative z-10 flex items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white">Blog</h1>
        </div>
    </div>

    {{-- Main Content for Blog --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section>
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400">🧩 Blog / Bitácora</h2>
            <p class="text-center mb-10 text-gray-400 max-w-xl mx-auto">
                Reflexiones, avances y documentación viva del proceso creativo y técnico detrás de Xlerion.
            </p>
            <div class="space-y-4">
                <a href="#" class="block bg-gray-800 p-4 rounded-lg hover:bg-gray-700">
                    <h3 class="font-semibold text-white">Cómo nació Total Darkness</h3>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg hover:bg-gray-700">
                    <h3 class="font-semibold text-white">Filosofía modular aplicada a videojuegos</h3>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg hover:bg-gray-700">
                    <h3 class="font-semibold text-white">Documentar para empoderar</h3>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg hover:bg-gray-700">
                    <h3 class="font-semibold text-white">Participación en Colombia 4.0</h3>
                </a>
                <a href="#" class="block bg-gray-800 p-4 rounded-lg hover:bg-gray-700">
                    <h3 class="font-semibold text-white">Diagnóstico técnico como herramienta cultural</h3>
                </a>
            </div>
        </section>
    </div>
@endsection