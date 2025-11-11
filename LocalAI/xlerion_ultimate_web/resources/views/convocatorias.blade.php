@extends('layouts.app')

@section('content')
    {{-- Parallax Banner for Convocatorias --}}
    <div class="relative h-96 overflow-hidden parallax-banner-container">
        <img src="{{ asset('images/parallax/convocatorias-alianzas-parallax.jpg') }}" alt="Convocatorias Parallax Banner" class="absolute top-0 left-0 w-full h-full object-cover parallax-banner-image">
        <div class="absolute inset-0 bg-black/50 z-1"></div> {{-- Overlay --}}
        <div class="relative z-10 flex items-center justify-center h-full text-center px-4">
            <h1 class="text-5xl md:text-6xl font-extrabold text-white">Convocatorias</h1>
        </div>
    </div>

    {{-- Main Content for Convocatorias --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section>
            <h2 class="text-4xl font-bold text-center mb-12 text-teal-400">🤝 Convocatorias y Alianzas</h2>
            <div class="space-y-8">
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-white">Postulación a CoCrea 2025 (modalidad PAT)</h3>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-white">Participación en Hackathon IA COL4.0</h3>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-white">Invitación a inversionistas culturales</h3>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-white">Carta de intención de aportes descargable</h3>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg">
                    <h3 class="text-xl font-semibold text-white">Espacio para aliados institucionales</h3>
                </div>
            </div>
        </section>
    </div>
@endsection