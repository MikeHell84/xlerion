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
            <h1 class="text-5xl md:text-6xl font-extrabold text-white uppercase font-heading">Soluciones</h1>
        </div>
    </div>

    {{-- Main Content for Soluciones --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <h2 class="text-4xl font-bold text-center mb-6 text-teal-400 uppercase font-heading">🛠️ Soluciones</h2>
            <p class="text-center mb-12 text-gray-400 max-w-3xl mx-auto text-lg">
                Xlerion desarrolla herramientas técnicas especializadas para entornos de alta exigencia como videojuegos AAA, multimedia avanzada, visión computacional y producción interactiva. Cada solución se diseña bajo principios de modularidad, escalabilidad y autonomía operativa, garantizando que cada componente pueda integrarse fácilmente, adaptarse a diferentes necesidades y operar de manera independiente para maximizar eficiencia y flexibilidad.
            </p>

            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Servicios Técnicos de Alto Impacto</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Card 1: Toolkits Modulares Personalizados --}}
                <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col">
                    <img src="{{ asset('images/solution-placeholder-1.jpg') }}" alt="Toolkits Modulares Personalizados" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2">Toolkits Modulares Personalizados</h4>
                        <p class="text-gray-300 mb-4 flex-grow">Desarrollo de conjuntos de herramientas adaptativas para entornos técnicos complejos.</p>
                        <button class="mt-auto bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 open-modal-btn"
                                data-title="Toolkits Modulares Personalizados"
                                data-image="{{ asset('images/solution-placeholder-1.jpg') }}"
                                data-description="Desarrollo de conjuntos de herramientas adaptativas para entornos técnicos complejos."
                                data-example="Ejemplo: Toolkit para estudios de animación con módulos de diagnóstico, logging de errores y visualización de métricas en tiempo real.">
                            Ver más
                        </button>
                    </div>
                </div>

                {{-- Card 2: Sistemas de Diagnóstico y Rendimiento --}}
                <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col">
                    <img src="{{ asset('images/solution-placeholder-2.jpg') }}" alt="Sistemas de Diagnóstico y Rendimiento" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2">Sistemas de Diagnóstico y Rendimiento</h4>
                        <p class="text-gray-300 mb-4 flex-grow">Implementación de comparadores de rendimiento y sistemas de logging para proyectos técnicos.</p>
                        <button class="mt-auto bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 open-modal-btn"
                                data-title="Sistemas de Diagnóstico y Rendimiento"
                                data-image="{{ asset('images/solution-placeholder-2.jpg') }}"
                                data-description="Implementación de comparadores de rendimiento y sistemas de logging para proyectos técnicos."
                                data-example="Ejemplo: Sistema de logging en Unreal Engine para detectar cuellos de botella en la carga de assets 3D.">
                            Ver más
                        </button>
                    </div>
                </div>

                {{-- Card 3: Branding Técnico-Creativo --}}
                <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col">
                    <img src="{{ asset('images/solution-placeholder-3.jpg') }}" alt="Branding Técnico-Creativo" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2">Branding Técnico-Creativo</h4>
                        <p class="text-gray-300 mb-4 flex-grow">Diseño de identidad visual con lógica simbólica, modular y funcional.</p>
                        <button class="mt-auto bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 open-modal-btn"
                                data-title="Branding Técnico-Creativo"
                                data-image="{{ asset('images/solution-placeholder-3.jpg') }}"
                                data-description="Diseño de identidad visual con lógica simbólica, modular y funcional."
                                data-example="Ejemplo: Marca para app de neurodivergencia con geometría adaptativa y paleta accesible para procesamiento cognitivo.">
                            Ver más
                        </button>
                    </div>
                </div>

                {{-- Card 4: Integración con Motores Gráficos --}}
                <div class="bg-gray-800 rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col">
                    <img src="{{ asset('images/solution-placeholder-4.jpg') }}" alt="Integración con Motores Gráficos" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2">Integración con Motores Gráficos</h4>
                        <p class="text-gray-300 mb-4 flex-grow">Configuración avanzada y optimización de pipelines en motores gráficos.</p>
                        <button class="mt-auto bg-teal-600 hover:bg-teal-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 open-modal-btn"
                                data-title="Integración con Motores Gráficos"
                                data-image="{{ asset('images/solution-placeholder-4.jpg') }}"
                                data-description="Configuración avanzada y optimización de pipelines en motores gráficos."
                                data-example="Ejemplo: Entorno de producción para cinemáticas interactivas en Unreal Engine con captura de movimiento y lógica de decisiones.">
                            Ver más
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Modal Structure --}}
    <div id="solution-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden p-4">
        <div class="bg-gray-900 rounded-lg shadow-2xl max-w-3xl w-full mx-auto p-6 relative border border-gray-700">
            <button class="absolute top-3 right-3 text-gray-400 hover:text-white text-3xl close-modal-btn">&times;</button>
            <h2 id="modal-title" class="text-3xl font-bold text-teal-400 mb-4 uppercase font-heading"></h2>
            <img id="modal-image" src="" alt="Solution Image" class="w-full h-64 object-cover rounded-md mb-4">
            <p id="modal-description" class="text-gray-300 mb-2 text-lg"></p>
            <p id="modal-example" class="text-gray-400 text-base italic"></p>
        </div>
    </div>
@endsection