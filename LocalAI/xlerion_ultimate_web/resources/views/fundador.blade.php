@extends('layouts.app')

@section('content')
    @php
        // Definimos la ruta de la imagen usando el helper asset() de Laravel
        $founderImage = asset('images/MikeProfile.jpg');
    @endphp

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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading"> Visión y Trayectoria</h1>
        </div>
    </div>

    {{-- Main Content for Fundador --}}
    <div class="content-container py-16 sm:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <section id="fundador-content" class="p-8 rounded-xl shadow-lg border border-gray-700">
                {{-- Diseño Distribuido: Grid responsivo --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start lg:items-center">

                    {{-- COLUMNA 1: FOTO --}}
                                        <div class="lg:col-span-1 flex flex-col items-center order-first lg:order-last">
                                            <div class="w-full max-w-xs sm:max-w-sm p-4 bg-gray-900 rounded-3xl shadow-2xl overflow-hidden border-2 border-indigo-500/30">
                                                <img
                                                                                    src="{{ $founderImage }}"
                                                                                    alt="Foto del Fundador: Miguel Eduardo Rodríguez Martínez (Mike)"
                                                                                    class="w-full h-auto object-cover rounded-2xl grayscale hover:grayscale-0 transform transition-all duration-[3000ms] hover:scale-110"
                                                                                    loading="lazy"
                                                                                >                                            </div>
                                            <div class="mt-6 flex space-x-6">
                                                <a href="https://www.linkedin.com/in/mikerodriguez84/?locale=en_US" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-xlerion-tech-bright-blue transition-colors duration-300">
                                                    <i class="fab fa-linkedin fa-2x"></i>
                                                </a>
                                                <a href="https://github.com/MikeHell84" target="_blank" rel="noopener noreferrer" class="text-gray-400 hover:text-xlerion-tech-bright-blue transition-colors duration-300">
                                                    <i class="fab fa-github fa-2x"></i>
                                                </a>
                                            </div>
                                        </div>
                    {{-- COLUMNA 2: TEXTO Y BIOGRAFÍA --}}
                    <div class="lg:col-span-2 space-y-8 order-last lg:order-first text-gray-300">
                        
                        <h3 class="text-3xl font-bold text-indigo-400 border-l-4 border-indigo-500 pl-4 uppercase font-heading">
                            Sobre el Fundador
                        </h3>
                        
                        <p class="text-lg leading-relaxed text-left">
                            Miguel E. Rodríguez Martínez es un creador autodidacta con enfoque neurodivergente, especializado en arte digital, modelado 3D, scripting técnico y defensa legal. Desde territorios no centralizados, ha desarrollado soluciones técnicas con impacto cultural, integrando modularidad, documentación y autonomía.
                        </p>

                        <blockquote class="text-xl italic font-semibold text-gray-200 border-l-4 border-teal-400 pl-4 text-left">
                            “La frustración técnica y burocrática es mi combustible para crear soluciones que empoderan.”
                        </blockquote>

                        <h4 class="text-2xl font-bold text-white mt-8 mb-4 text-left">Datos Adicionales</h4>
                        <ul class="list-disc list-inside space-y-2 text-gray-300 text-left">
                            <li>Fundador de Xlerion TechLab</li>
                            <li>Autodidacta en entornos técnicos y creativos</li>
                            <li>Defensor de derechos del consumidor y procesos autosuficientes</li>
                            <li>Autor de la obra literaria interactiva Total Darkness</li>
                        </ul>
                    </div>
                    
                </div>
            </section>
        </div>
    </div>
@endsection
