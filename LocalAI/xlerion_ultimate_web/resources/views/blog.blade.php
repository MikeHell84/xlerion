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
            <img src="{{ asset('img/Blog.svg') }}" alt="Blog" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Blog --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <p class="text-left mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                Reflexiones, avances y documentación viva del proceso creativo, técnico y filosófico detrás de Xlerion.
            </p>
            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Entradas Sugeridas</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <a href="{{ url('/blog/el-origen-de-total-darkness') }}" class="block content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden transition hover:border-teal-400 transform hover:-translate-y-1">
                    <img src="{{ asset('images/parallax/blog-bitacora-parallax.jpg') }}" alt="El origen de Total Darkness" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-semibold text-white text-left text-xl mb-2">El origen de Total Darkness</h4>
                        <p class="text-gray-400 text-left">Un recorrido profundo por la génesis de esta obra literaria y su evolución hacia un pelijuego interactivo que combina narrativa inmersiva y filosofía.</p>
                    </div>
                </a>
                <a href="{{ url('/blog/aplicacion-de-la-filosofia-modular-en-videojuegos') }}" class="block content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden transition hover:border-teal-400 transform hover:-translate-y-1">
                    <img src="{{ asset('images/parallax/filosofia-parallax.jpg') }}" alt="Aplicación de la filosofía modular en videojuegos" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-semibold text-white text-left text-xl mb-2">Aplicación de la filosofía modular en videojuegos</h4>
                        <p class="text-gray-400 text-left">Exploramos cómo la modularidad impulsa la innovación técnica y creativa en el desarrollo de videojuegos, facilitando escalabilidad y adaptabilidad.</p>
                    </div>
                </a>
                <a href="{{ url('/blog/documentar-para-empoderar') }}" class="block content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden transition hover:border-teal-400 transform hover:-translate-y-1">
                    <img src="{{ asset('images/parallax/documentacion-parallax.jpg') }}" alt="Documentar para empoderar" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-semibold text-white text-left text-xl mb-2">Documentar para empoderar</h4>
                        <p class="text-gray-400 text-left">La importancia de la documentación rigurosa como herramienta para transferir conocimiento, fomentar la autosuficiencia y fortalecer comunidades técnicas.</p>
                    </div>
                </a>
                <a href="{{ url('/blog/participacion-en-colombia-4-0') }}" class="block content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden transition hover:border-teal-400 transform hover:-translate-y-1">
                    <img src="{{ asset('images/parallax/convocatorias-alianzas-parallax.jpg') }}" alt="Participación en Colombia 4.0" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-semibold text-white text-left text-xl mb-2">Participación en Colombia 4.0</h4>
                        <p class="text-gray-400 text-left">Relato de la experiencia y aprendizajes obtenidos durante la participación en este evento clave para la innovación tecnológica y cultural en Colombia.</p>
                    </div>
                </a>
                <a href="{{ url('/blog/diagnostico-tecnico-como-herramienta-cultural') }}" class="block content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden transition hover:border-teal-400 transform hover:-translate-y-1">
                    <img src="{{ asset('images/parallax/cronograma-progreso-parallax.jpg') }}" alt="Diagnóstico técnico como herramienta cultural" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h4 class="font-semibold text-white text-left text-xl mb-2">Diagnóstico técnico como herramienta cultural</h4>
                        <p class="text-gray-400 text-left">Cómo el diagnóstico técnico se convierte en un medio para entender, preservar y potenciar el patrimonio cultural a través de soluciones tecnológicas.</p>
                    </div>
                </a>
            </div>
        </section>
    </div>
@endsection