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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">El Fundador</h1>
        </div>
    </div>

<section>
    <h2 class="text-4xl font-bold text-center mb-12 text-teal-400">🧠 Sobre el Fundador</h2>
    
    {{-- Tarjeta de Presentación --}}
    <div class="bg-gray-800 p-8 rounded-xl shadow-2xl border border-gray-700 lg:flex lg:items-center lg:space-x-10">
        
        {{-- Imagen y Título --}}
        <div class="flex-shrink-0 text-center lg:w-1/3">
            {{-- Placeholder para la imagen profesional --}}
            <div class="w-48 h-48 mx-auto bg-gray-700 rounded-full flex items-center justify-center text-5xl text-gray-500 border-4 border-teal-400 mb-4">
                M.E.R.M
            </div>
            <h3 class="text-3xl font-extrabold text-white">Miguel E. Rodríguez Martínez</h3>
            <p class="text-lg text-teal-400 mt-1">Fundador de Xlerion TechLab</p>
        </div>

        {{-- Biografía y Frase --}}
        <div class="mt-6 lg:mt-0 lg:w-2/3">
            <p class="text-gray-300 leading-relaxed">
                Miguel Eduardo Rodríguez Martínez es un creador empírico con enfoque neurodivergente, especializado en arte digital, modelado 3D, scripting y defensa legal. Su trayectoria autodidacta lo ha llevado a construir soluciones técnicas con impacto cultural desde territorios no centralizados.
            </p>

            {{-- Frase destacada (Estilo de cita o pullquote) --}}
            <blockquote class="mt-6 p-4 border-l-4 border-teal-400 bg-gray-700/50 italic text-gray-200">
                “La frustración técnica y burocrática es mi combustible para crear soluciones que empoderan.”
            </blockquote>

            {{-- Datos Adicionales (Tags o Lista) --}}
            <div class="mt-6">
                <h4 class="text-xl font-semibold text-white mb-2">Credenciales:</h4>
                <ul class="flex flex-wrap gap-2">
                    <li class="bg-teal-600/30 text-teal-300 text-sm px-3 py-1 rounded-full">Autodidacta</li>
                    <li class="bg-teal-600/30 text-teal-300 text-sm px-3 py-1 rounded-full">Defensa Legal</li>
                    <li class="bg-teal-600/30 text-teal-300 text-sm px-3 py-1 rounded-full">Total Darkness Creador</li>
                    <li class="bg-teal-600/30 text-teal-300 text-sm px-3 py-1 rounded-full">Neurodivergente</li>
                </ul>
            </div>
        </div>

    </div>
</section>