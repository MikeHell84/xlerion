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
            <img src="{{ asset('img/Legal.svg') }}" alt="Legal y Privacidad" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Legal --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400 uppercase font-heading">🛡️ Legal y Privacidad</h2>
            <p class="text-left mb-12 text-gray-400 max-w-4xl mx-auto text-lg">
                En esta sección, Xlerion establece las bases legales y las políticas de privacidad que garantizan la protección de los usuarios y la transparencia en el uso de sus servicios y contenidos.
            </p>

            <div class="space-y-8">
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h3 class="text-2xl font-semibold text-white mb-2 text-left">Política de Privacidad de Datos</h3>
                    <p class="text-gray-300 text-left">
                        Xlerion se compromete a proteger la información personal de sus usuarios, asegurando que los datos recopilados se manejen con confidencialidad, seguridad y conforme a las normativas vigentes. Esta política detalla qué datos se recogen, cómo se usan y los derechos de los usuarios sobre su información.
                    </p>
                </div>
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h3 class="text-2xl font-semibold text-white mb-2 text-left">Términos de Uso del Sitio y los Toolkits</h3>
                    <p class="text-gray-300 text-left">
                        Los términos de uso regulan el acceso y la utilización del sitio web y los toolkits ofrecidos por Xlerion. Incluyen las condiciones para el uso adecuado, las responsabilidades de los usuarios y las limitaciones de responsabilidad de la empresa.
                    </p>
                </div>
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h3 class="text-2xl font-semibold text-white mb-2 text-left">Licencias de Software y Contenido</h3>
                    <p class="text-gray-300 text-left">
                        Esta sección especifica las licencias bajo las cuales se distribuyen los softwares y contenidos de Xlerion, promoviendo el respeto por la propiedad intelectual y el uso ético de los recursos.
                    </p>
                </div>
                <div class="content-container p-6 rounded-lg shadow-xl border border-gray-700">
                    <h3 class="text-2xl font-semibold text-white mb-2 text-left">Declaración de Derechos del Consumidor</h3>
                    <p class="text-gray-300 text-left">
                        Xlerion reconoce y respeta los derechos de los consumidores, garantizando transparencia, calidad y mecanismos de reclamación claros para proteger sus intereses.
                    </p>
                </div>
            </div>
        </section>
    </div>
@endsection
