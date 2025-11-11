@extends('layouts.app')

@section('content')
    {{-- Parallax Banner for Filosofia --}}
    <div class="relative h-96 overflow-hidden parallax-banner-container">
        <img src="{{ asset('images/parallax/filosofia-parallax.jpg') }}" alt="Filosofía Parallax Banner" class="absolute top-0 left-0 w-full h-full object-cover parallax-banner-image">
        <div class="absolute inset-0 bg-black/50 z-1"></div> {{-- Overlay --}}
        <div class="relative z-10 flex items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white">Filosofía</h1>
        </div>
    </div>

    {{-- Main Content for Filosofia --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section>
            <h2 class="text-4xl font-bold text-center mb-12 text-teal-400">🧬 Filosofía</h2>
            <div class="grid md:grid-cols-3 gap-8 text-center">
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold text-white mb-2">Misión</h3>
                    <p class="text-gray-400">Potenciar el desarrollo técnico moderno con soluciones modulares que anticipan errores, optimizan procesos y promueven colaboración sostenible.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold text-white mb-2">Visión</h3>
                    <p class="text-gray-400">Ser referente latinoamericano en el diseño de toolkits inteligentes que integren técnica, creatividad, documentación y escalabilidad.</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-2xl font-semibold text-white mb-2">Valores</h3>
                    <ul class="text-gray-400">
                        <li>Empatía técnica</li>
                        <li>Autosuficiencia creativa</li>
                        <li>Documentación como legado</li>
                        <li>Modularidad como principio</li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
@endsection