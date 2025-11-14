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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Filosofía</h1>
        </div>
    </div>

<section>
    <h2 class="text-4xl font-bold text-center mb-12 text-teal-400">🧬 Filosofía</h2>
    <div class="grid md:grid-cols-3 gap-8 text-center">
        <div class="bg-gray-800 p-6 rounded-lg">
            <h3 class="text-2xl font-semibold text-white mb-2">Misión</h3>
            <p class="text-gray-400">Potenciar el desarrollo técnico moderno con soluciones modulares que anticipan errores, optimizan procesos y promueven colaboración sostenible.</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg">
            <h3 class="text-2xl font-semibold text-white mb-2">Visión</h3>
            <p class="text-gray-400">Ser referente latinoamericano en el diseño de toolkits inteligentes que integren técnica, creatividad, documentación y escalabilidad.</p>
        </div>
        <div class="bg-gray-800 p-6 rounded-lg">
            <h3 class="text-2xl font-semibold text-white mb-2">Valores</h3>
            <ul class="text-gray-400">
                <li>Empatía técnica</li>
                <li>Autosuficiencia creativa</li>
                <li>Documentación como legado</li>
                <li>Modularidad como principio</li>
            </ul>
        </div>
    </div>
</section>