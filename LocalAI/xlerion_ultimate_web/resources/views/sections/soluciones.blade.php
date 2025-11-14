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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Soluciones</h1>
        </div>
    </div>

<section>
    <h2 class="text-4xl font-bold text-center mb-6 text-teal-400">🛠️ Soluciones</h2>
    <p class="text-center mb-12 text-gray-400 max-w-3xl mx-auto">
        Xlerion ofrece herramientas técnicas diseñadas para entornos exigentes como videojuegos AAA, multimedia avanzada y visión por computadora. Cada solución está pensada para ser modular, escalable y autosuficiente.
    </p>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        @php
            $servicios = [
                ['title' => 'Toolkits Modulares', 'icon' => '🧩', 'desc' => 'Interfaces jerárquicas y adaptativas para un control total del pipeline.'],
                ['title' => 'Sistemas de Diagnóstico', 'icon' => '🔬', 'desc' => 'Logging avanzado y comparadores de rendimiento para optimización crítica.'],
                ['title' => 'Branding Técnico-Creativo', 'icon' => '🎨', 'desc' => 'Lógica visual y simbólica aplicada a la identidad técnica.'],
                ['title' => 'Documentación Estructurada', 'icon' => '📄', 'desc' => 'Garantía de mantenimiento y transferencia de conocimiento sin fricción.'],
                ['title' => 'Integración Multi-Motor', 'icon' => '⚙️', 'desc' => 'Soporte e integración fluida con Unreal Engine, Unity y Blender.'],
            ];
        @endphp

        @foreach($servicios as $servicio)
        <div class="bg-gray-800 p-6 rounded-lg shadow-xl border border-gray-700 transition hover:border-teal-400 transform hover:-translate-y-1">
            <div class="text-4xl mb-4">{{ $servicio['icon'] }}</div>
            <h3 class="text-xl font-semibold text-white mb-2">{{ $servicio['title'] }}</h3>
            <p class="text-gray-400">{{ $servicio['desc'] }}</p>
        </div>
        @endforeach

    </div>
</section>