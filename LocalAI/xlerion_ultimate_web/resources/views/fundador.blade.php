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
            <img src="{{ asset('img/Equipo.svg') }}" alt="Visión y Trayectoria" class="h-32 md:h-48 w-auto">
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
                        
                        <h3 class="text-3xl font-bold text-xlerion-tech-bright-blue border-l-4 border-xlerion-tech-bright-blue pl-4 uppercase font-heading">
                            Acerca del Creador
                        </h3>
                        
                        <p class="text-lg leading-relaxed text-left">
                            Miguel Eduardo Rodríguez Martínez es un desarrollador autodidacta con enfoque neurodivergente, especializado en videojuegos, software inteligente y soluciones web. Fundador de Xlerion TechLab, ha construido una trayectoria diversa en programación, modelado 3D, inteligencia artificial y blockchain, integrando herramientas como Unity, Unreal Engine, Python, ReactJS y Docker en proyectos de alto impacto.
                            Desde Nocaima, Cundinamarca, ha liderado iniciativas técnicas para instituciones públicas, empresas tecnológicas y plataformas culturales, siempre con una filosofía modular, autosuficiente y profundamente documentada. Su obra literaria Total Darkness reflejan su compromiso con la innovación cultural y la inclusión creativa.
                            Miguel transforma la frustración técnica en soluciones que empoderan, combinando arte, ingeniería y narrativa para crear herramientas que anticipan errores, optimizan procesos y promueven la colaboración sostenible.
                        </p>

                        <h4 class="text-2xl font-bold text-white mt-8 mb-4 text-left">Habilidades Clave</h4>
                        <div class="flex flex-wrap gap-2 mb-8">
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Desarrollo de Videojuegos</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Software Inteligente</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Soluciones Web</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Programación</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Modelado 3D</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Inteligencia Artificial</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Blockchain</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Liderazgo Técnico</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Innovación Cultural</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Inclusión Creativa</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Arte Digital</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Ingeniería de Software</span>
                            <span class="bg-xlerion-deep-blue text-white px-3 py-1 rounded-full text-sm font-medium">Narrativa Interactiva</span>
                        </div>

                        <h4 class="text-2xl font-bold text-white mt-8 mb-4 text-left">Tecnologías y Herramientas</h4>
                        <div class="flex flex-wrap gap-2">
                            <span class="bg-xlerion-tech-bright-blue text-white px-3 py-1 rounded-full text-sm font-medium">Unity</span>
                            <span class="bg-xlerion-tech-bright-blue text-white px-3 py-1 rounded-full text-sm font-medium">Unreal Engine</span>
                            <span class="bg-xlerion-tech-bright-blue text-white px-3 py-1 rounded-full text-sm font-medium">Python</span>
                            <span class="bg-xlerion-tech-bright-blue text-white px-3 py-1 rounded-full text-sm font-medium">ReactJS</span>
                            <span class="bg-xlerion-tech-bright-blue text-white px-3 py-1 rounded-full text-sm font-medium">Docker</span>
                        </div>
                    </div>
                    
                </div>
            </section>
        </div>
    </div>
@endsection
