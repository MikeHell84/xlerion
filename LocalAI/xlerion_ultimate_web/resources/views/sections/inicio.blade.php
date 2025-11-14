    <div class="relative h-screen overflow-hidden video-parallax-container">
        <!-- Video de fondo -->
        <video class="absolute top-0 left-0 w-auto min-w-full min-h-full object-cover parallax-video" autoplay loop muted playsinline>
            <source src="{{ asset('videos/intro.mp4') }}" type="video/mp4">
            Tu navegador no soporta el video.
        </video>

        <!-- Capa oscura sobre el video -->
        <div class="absolute inset-0 bg-black/50 z-1"></div>

        <!-- Contenido principal -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-4xl md:text-6xl font-extrabold text-white">
                Xlerion – <span class="text-indigo-400">Soluciones Disruptivas</span>
            </h1>
            <p class="mt-4 max-w-3xl text-gray-200 text-lg md:text-xl">
                Modularidad que transforma. Diagnóstico que empodera.
            </p>
            <p class="mt-2 max-w-3xl text-gray-300 text-base md:text-lg">
                Desde Nocaima, Cundinamarca, nace una propuesta empírica y neurodivergente que redefine la forma en que creamos, automatizamos y documentamos soluciones técnicas para la industria creativa.
            </p>

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                <a href="/proyectos" class="px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md font-medium transition">
                    Ver portafolio
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