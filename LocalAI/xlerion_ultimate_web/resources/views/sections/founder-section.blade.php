<section class="banner-section">
    <div class="parallax-background rellax" data-rellax-speed="-7">
        <img src="{{ asset('images/parallax/fundador-parallax.jpg') }}" alt="Fondo Parallax Fundador" class="parallax-image">
    </div>
    <div class="banner-content">
        <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">El Fundador: Visión y Trayectoria</h1>
    </div>
</section>

<section id="fundador-content" class="py-16 sm:py-24 bg-gray-50 dark:bg-gray-900 transition duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <h2 class="text-4xl font-extrabold tracking-tight text-center text-gray-900 dark:text-white mb-12 uppercase font-heading">
            El Fundador: Visión y Trayectoria
        </h2>

        {{-- Diseño Distribuido: Grid responsivo --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start lg:items-center">

            {{-- COLUMNA 1: FOTO --}}
            <div class="lg:col-span-1 flex justify-center order-first lg:order-last">
                <div class="w-full max-w-xs sm:max-w-sm p-4 bg-white dark:bg-gray-800 rounded-3xl shadow-2xl transform hover:scale-[1.02] transition duration-300">
                    <img 
                        src="{{ $founderImage }}" 
                        alt="Foto del Fundador: Miguel Eduardo Rodríguez Martínez (Mike)"
                        class="w-full h-auto object-cover rounded-2xl border-4 border-indigo-500/50"
                        loading="lazy"
                    >
                </div>
            </div>

            {{-- COLUMNA 2: TEXTO Y BIOGRAFÍA --}}
            <div class="lg:col-span-2 space-y-8 order-last lg:order-first text-gray-700 dark:text-gray-300">
                
                <h3 class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 border-l-4 border-indigo-500 pl-4 uppercase font-heading">
                    Sobre el Fundador
                </h3>
                
                <p class="text-lg leading-relaxed">
                    Miguel Eduardo Rodríguez Martínez (Mike) es el fundador y motor creativo de Xlerion TechLab. Con una trayectoria autodidacta y un enfoque neurodivergente, Mike combina su experiencia en arte digital, modelado 3D, scripting y defensa legal para desarrollar soluciones técnicas innovadoras con impacto cultural y territorial. Su pasión por la autosuficiencia creativa y la documentación rigurosa lo ha llevado a construir herramientas modulares que empoderan a comunidades y profesionales en entornos no centralizados.
                </p>

                <p class="text-lg leading-relaxed border-t pt-4 border-gray-200 dark:border-gray-700">
                    Conocido por su resiliencia y visión disruptiva, Mike defiende los derechos del consumidor y promueve procesos autosuficientes que desafían la burocracia técnica. Además, es el autor de la obra literaria *Total Darkness*, que refleja su compromiso con la narrativa inmersiva y la exploración filosófica.
                </p>

                <p class="text-lg leading-relaxed font-semibold text-gray-900 dark:text-gray-200">
                    Su liderazgo en Xlerion TechLab es un ejemplo de cómo la innovación empírica y la modularidad pueden transformar la industria creativa y tecnológica.
                </p>
            </div>
            
        </div>
    </div>
</section>
