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
            <h1 class="text-4xl md:text-6xl font-extrabold text-white font-heading uppercase">
                Xlerion
                <span class="block text-2xl md:text-4xl text-indigo-400 mt-2">Ingeniería Modular para la Cultura y la Tecnología</span>
            </h1>

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="/proyectos" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-medium transition">
                    Explorar portafolio
                </a>
                <a href="/fundador" class="px-8 py-3 bg-white hover:bg-gray-100 text-indigo-600 rounded-md font-medium transition">
                    Contactar al fundador
                </a>
                <a href="#" class="px-8 py-3 bg-white hover:bg-gray-100 text-indigo-600 rounded-md font-medium transition">
                    Descargar dossier institucional
                </a>
            </div>
        </div>
    </div>

    {{-- Welcome Section --}}
    <div class="bg-black py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Soluciones que transforman. Diagnósticos que empoderan.
            </h2>
            <p class="mt-6 max-w-3xl mx-auto text-lg leading-8 text-gray-300">
                Desde Nocaima, Cundinamarca, emerge Xlerion como una iniciativa independiente, empírica y neurodivergente que redefine la creación, automatización y documentación de soluciones técnicas para la industria cultural y tecnológica. Más que una empresa, Xlerion es una filosofía modular orientada al impacto territorial, la autosuficiencia creativa y la transferencia de conocimiento.
            </p>
        </div>
    </div>

    {{-- Another Section to ensure scroll --}}
    <div class="bg-gray-900 py-16 sm:py-24">
        <div class="mx-auto max-w-7xl px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                Explora Más de Xlerion
            </h2>
            <p class="mt-6 max-w-3xl mx-auto text-lg leading-8 text-gray-300">
                Descubre cómo nuestra ingeniería modular está impactando la cultura y la tecnología.
            </p>
        </div>
    </div>
@endsection