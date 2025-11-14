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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Documentación</h1>
        </div>
    </div>

<section>
    <h2 class="text-4xl font-bold text-center mb-6 text-teal-400">📚 Documentación: El Legado</h2>
    <p class="text-center mb-10 text-gray-400 max-w-3xl mx-auto">
        La documentación es parte esencial del legado de Xlerion. Cada solución incluye guías claras, diagramas modulares y manuales de uso que permiten su mantenimiento, réplica y evolución.
    </p>

    <div class="bg-gray-800 p-8 rounded-xl border border-gray-700">
        <div class="grid md:grid-cols-2 gap-6">
            <ul class="space-y-4">
                <li class="flex items-start space-x-3">
                    <span class="text-teal-400 text-xl font-bold">#</span>
                    <div>
                        <h4 class="font-semibold text-white">Manuales Técnicos por Módulo</h4>
                        <p class="text-sm text-gray-400">Instrucciones detalladas y específicas para cada componente.</p>
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-teal-400 text-xl font-bold">#</span>
                    <div>
                        <h4 class="font-semibold text-white">Diagramas de Flujo y Arquitectura</h4>
                        <p class="text-sm text-gray-400">Representaciones visuales para entender la lógica interna.</p>
                    </div>
                </li>
            </ul>
            <ul class="space-y-4">
                <li class="flex items-start space-x-3">
                    <span class="text-teal-400 text-xl font-bold">#</span>
                    <div>
                        <h4 class="font-semibold text-white">Guías de Instalación y Configuración</h4>
                        <p class="text-sm text-gray-400">Procedimientos optimizados para la puesta en marcha.</p>
                    </div>
                </li>
                <li class="flex items-start space-x-3">
                    <span class="text-teal-400 text-xl font-bold">#</span>
                    <div>
                        <h4 class="font-semibold text-white">Filosofía de Empoderamiento</h4>
                        <p class="text-sm text-gray-400">Documentación pensada como herramienta de réplica y autosuficiencia.</p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>