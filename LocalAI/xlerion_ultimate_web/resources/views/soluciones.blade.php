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
            <img src="{{ asset('img/Soluciones.svg') }}" alt="Proyectos" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Soluciones --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section class="mb-12">
            <div class="flex flex-col md:flex-row items-center gap-12 p-8 bg-gray-800/50 rounded-lg border border-gray-700">
                {{-- Columna de Texto --}}
                <div class="md:w-2/3">
                    <p class="text-gray-300 text-lg leading-relaxed text-left">
                        Xlerion desarrolla herramientas técnicas especializadas para entornos de alta exigencia como videojuegos AAA, multimedia avanzada, visión computacional y producción interactiva. Cada solución se diseña bajo principios de modularidad, escalabilidad y autonomía operativa, garantizando que cada componente pueda integrarse fácilmente, adaptarse a diferentes necesidades y operar de manera independiente para maximizar eficiencia y flexibilidad.
                    </p>
                </div>
                {{-- Columna de Imagen --}}
                <div class="md:w-1/3">
                    <img src="{{ asset('images/parallax/soluciones-parallax.jpg') }}" alt="Soluciones Xlerion" class="rounded-lg shadow-xl border border-gray-600 w-full h-auto">
                </div>
            </div>
        </section>

<?php
$services = [
    [
        'title' => 'Toolkits Modulares',
        'image' => 'DroneX.png',
        'short_description' => 'Diseñados para facilitar la interacción intuitiva y la personalización según el contexto de uso, permitiendo una gestión eficiente de funciones complejas.',
        'full_content' => 'Los toolkits de <b>Xlerion</b> son sistemas técnicos inteligentes que integran diagnóstico, automatización y documentación en una arquitectura modular. Cada módulo está pensado para adaptarse a entornos exigentes como videojuegos AAA, multimedia avanzada, visión por computadora y flujos de trabajo colaborativos.
        <p><b>Características clave:</b></p>
        <ul>
            <li><b>Interfaz jerárquica y visual:</b> Íconos personalizados (cerebro, fibras, engranajes) que comunican función y estado.</li>
            <li><b>Comportamiento adaptativo:</b> Los módulos responden al entorno, anticipan errores y recomiendan acciones correctivas.</li>
            <li><b>Configuración contextual:</b> Cada función puede activarse, desactivarse o modificarse según el tipo de proyecto o usuario.</li>
            <li><b>Documentación integrada:</b> Cada módulo incluye guías claras, diagramas y ejemplos para facilitar su implementación y mantenimiento.</li>
            <li><b>Compatibilidad técnica:</b> Diseñados para integrarse con motores como Unreal Engine, Unity, Blender y sistemas Linux.</li>
        </ul>
        <p><b>🧩 Módulos disponibles:</b></p>
        <ul>
            <li><b>Diagnóstico técnico:</b> Identifica cuellos de botella, errores críticos y oportunidades de optimización.</li>
            <li><b>Logging inteligente:</b> Registra eventos en JSON estructurado, facilitando auditoría y análisis.</li>
            <li><b>Comparadores de rendimiento:</b> Evalúan versiones, configuraciones o entornos para tomar decisiones informadas.</li>
            <li><b>Validación automática:</b> Previene fallos antes de la ejecución, protegiendo tiempo y recursos.</li>
        </ul>
        <p><b>🌐 Aplicaciones:</b></p>
        <ul>
            <li>Estudios de videojuegos y multimedia.</li>
            <li>Plataformas educativas y culturales.</li>
            <li>Proyectos de investigación técnica.</li>
            <li>Equipos de desarrollo colaborativo.</li>
        </ul>',
    ],
    [
        'title' => 'Sistemas de Diagnóstico',
        'image' => 'Planos.png',
        'short_description' => 'Herramientas avanzadas que permiten monitorear, registrar y evaluar el comportamiento de sistemas en tiempo real para la detección de fallos y optimización.',
        'full_content' => 'Los sistemas de diagnóstico de Xlerion están diseñados para <b>anticipar errores antes de que ocurran</b>, identificar cuellos de botella y ofrecer recomendaciones automatizadas que mejoran el rendimiento técnico y la experiencia del usuario. Son el núcleo de una filosofía que prioriza la prevención, la transparencia y la autosuficiencia operativa.
        <p><b>🔍 Funcionalidades principales:</b></p>
        <ul>
            <li><b>Monitoreo en tiempo real:</b> Observa el comportamiento del sistema durante la ejecución, detectando anomalías, bloqueos o degradaciones de rendimiento.</li>
            <li><b>Registro estructurado:</b> Captura eventos clave en formatos legibles y reutilizables (como JSON), facilitando auditorías, análisis y mantenimiento.</li>
            <li><b>Alertas inteligentes:</b> Notificaciones automáticas ante condiciones críticas, con sugerencias de solución basadas en patrones previos.</li>
            <li><b>Análisis comparativo:</b> Evalúa versiones, configuraciones o entornos para identificar mejoras o regresiones.</li>
            <li><b>Integración modular:</b> Compatible con motores de juego, entornos de desarrollo y plataformas multimedia.</li>
        </ul>
        <p><b>🧠 Aplicaciones prácticas:</b></p>
        <ul>
            <li>Validación de builds en videojuegos y simuladores.</li>
            <li>Optimización de pipelines creativos y técnicos.</li>
            <li>Diagnóstico de entornos colaborativos o distribuidos.</li>
            <li>Soporte técnico autosuficiente para usuarios avanzados.</li>
        </ul>
        <p><b>📘 Documentación incluida:</b> Cada sistema de diagnóstico viene acompañado de diagramas de flujo, ejemplos de configuración y guías de interpretación, permitiendo que cualquier equipo técnico o creativo pueda integrarlo sin depender de soporte externo.</p>',
    ],
    [
        'title' => 'Branding Técnico-Creativo',
        'image' => 'Xlerion.png',
        'short_description' => 'Desarrollo de identidades visuales y conceptuales que integran elementos técnicos y creativos, reforzando la coherencia y el impacto cultural de cada proyecto.',
        'full_content' => 'En Xlerion, el branding no es solo estética: es <b>arquitectura simbólica</b>. Cada identidad visual se construye desde la lógica funcional del proyecto, integrando íconos, colores, estructuras y narrativas que comunican robustez, modularidad y propósito cultural.
        <p><b>🧠 Principios de diseño:</b></p>
        <ul>
            <li><b>Simbología técnica:</b> Íconos como engranajes, fibras, cerebros y nodos representan funciones internas, estados del sistema y relaciones entre módulos.</li>
            <li><b>Coherencia modular:</b> Cada elemento visual está diseñado para escalar, adaptarse y mantenerse funcional en distintos entornos (interfaces, documentación, presentaciones).</li>
            <li><b>Narrativa integrada:</b> El diseño comunica la filosofía del proyecto: autosuficiencia, diagnóstico, colaboración y legado.</li>
            <li><b>Impacto cultural:</b> Las identidades se adaptan al contexto territorial y social, respetando la diversidad y promoviendo la inclusión creativa.</li>
        </ul>
        <p><b>🧩 Aplicaciones:</b></p>
        <ul>
            <li>Interfaces gráficas de toolkits.</li>
            <li>Portadas de proyectos interactivos.</li>
            <li>Documentación técnica con identidad visual.</li>
            <li>Presentaciones institucionales y convocatorias.</li>
            <li>Material educativo y cultural.</li>
        </ul>
        <p><b>🎯 Ejemplo destacado:</b></p>
        <ul>
            <li><b>Total Darkness – Pelijuego Interactivo:</b> Identidad visual basada en la oscuridad como conciencia, con símbolos que representan tiempo, memoria y decisión.</li>
        </ul>',
    ],
    [
        'title' => 'Documentación Estructurada',
        'image' => 'Planos1.png',
        'short_description' => 'Guías detalladas, diagramas y manuales que aseguran la continuidad operativa y la capacitación efectiva, promoviendo la autosuficiencia y la colaboración.',
        'full_content' => 'En Xlerion, la documentación no es un complemento: es <b>parte esencial del diseño</b>. Cada solución técnica incluye materiales claros, accesibles y modulares que permiten su implementación, mantenimiento y evolución sin depender de soporte externo. Esta filosofía garantiza que el conocimiento se transfiera de forma efectiva entre equipos, territorios y generaciones.
        <p><b>🧩 Componentes clave:</b></p>
        <ul>
            <li><b>Guías paso a paso:</b> Instrucciones detalladas para instalación, configuración, uso y resolución de problemas.</li>
            <li><b>Diagramas modulares:</b> Visualización de arquitectura, flujo de datos y relaciones entre componentes.</li>
            <li><b>Manual técnico por módulo:</b> Especificaciones, funciones, parámetros y casos de uso.</li>
            <li><b>Ejemplos aplicados:</b> Casos reales, simulaciones y buenas prácticas para facilitar la adopción.</li>
            <li><b>Glosario simbólico:</b> Interpretación de íconos, colores y estructuras visuales del sistema.</li>
        </ul>
        <p><b>🎯 Beneficios:</b></p>
        <ul>
            <li><b>Continuidad operativa:</b> Equipos técnicos pueden mantener y escalar soluciones sin depender del creador original.</li>
            <li><b>Capacitación efectiva:</b> Nuevos usuarios pueden aprender e implementar con autonomía.</li>
            <li><b>Colaboración sostenible:</b> La documentación facilita la integración entre perfiles técnicos, creativos y administrativos.</li>
            <li><b>Legado cultural:</b> Cada guía es una herramienta de empoderamiento territorial y profesional.</li>
        </ul>
        <p><b>🌐 Aplicaciones:</b></p>
        <ul>
            <li>Estudios de desarrollo técnico y multimedia.</li>
            <li>Proyectos educativos y de formación cultural.</li>
            <li>Equipos distribuidos o remotos.</li>
            <li>Iniciativas autosuficientes en territorios no centralizados.</li>
        </ul>',
    ],
    [
        'title' => 'Integración Avanzada con Motores Gráficos',
        'image' => 'mecatron.png',
        'short_description' => 'Adaptación y optimización de soluciones para trabajar fluidamente con los principales motores gráficos, facilitando la implementación en proyectos de alto nivel y la interoperabilidad entre plataformas.',
        'full_content' => 'Xlerion desarrolla herramientas y flujos de trabajo que se integran de forma nativa con motores gráficos líderes como <b>Unreal Engine, Unity y 3DS Max</b>, permitiendo a estudios, desarrolladores y creadores implementar soluciones técnicas sin fricciones ni dependencias externas.
        <p><b>🔧 Capacidades técnicas:</b></p>
        <ul>
            <li><b>Adaptación modular:</b> Los toolkits se configuran para responder a las estructuras internas de cada motor, respetando jerarquías, eventos y ciclos de ejecución.</li>
            <li><b>Optimización de rendimiento:</b> Scripts y configuraciones que reducen carga innecesaria, mejoran la eficiencia de renderizado y evitan errores comunes.</li>
            <li><b>Interoperabilidad entre plataformas:</b> Los módulos pueden migrarse entre entornos sin pérdida de funcionalidad, facilitando el trabajo colaborativo y multiplataforma.</li>
            <li><b>Compatibilidad con plugins y extensiones:</b> Integración con sistemas de animación, física, iluminación y lógica de juego.</li>
            <li><b>Soporte para modelado y animación 3D:</b> Conversión fluida entre formatos, retopología, texturizado y rigging.</li>
        </ul>
        <p><b>🧠 Aplicaciones destacadas:</b></p>
        <ul>
            <li>Desarrollo de videojuegos AAA con lógica adaptativa.</li>
            <li>Simuladores técnicos y educativos en tiempo real.</li>
            <li>Proyectos multimedia con narrativa interactiva.</li>
            <li>Prototipado arquitectónico y visualización avanzada.</li>
        </ul>
        <p><b>📘 Documentación incluida:</b> Cada integración incluye guías específicas por motor, ejemplos aplicados, diagramas de flujo y recomendaciones de configuración para garantizar una implementación eficiente y autosuficiente.
        </p>',
    ],
];
?>

<section class="mb-12">
    <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Servicios Destacados</h3>
    <div id="services-grid" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($services as $index => $service)
            <div class="content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col cursor-pointer hover:border-xlerion-tech-bright-blue transition-all duration-300">
                <img src="{{ asset('images/' . $service['image']) }}" alt="{{ $service['title'] }}" class="w-full h-48 object-cover">
                <div class="p-6 flex flex-col flex-grow">
                    <h4 class="text-2xl font-semibold text-xlerion-tech-bright-blue mb-2 text-left">{{ $service['title'] }}</h4>
                    <p class="text-gray-300 mb-4 flex-grow text-left">{{ $service['short_description'] }}</p>
                    <button class="mt-auto px-4 py-2 bg-xlerion-deep-blue hover:bg-xlerion-tech-bright-blue text-white rounded-md font-medium transition open-service-modal-btn"
                            data-service-id="service-{{ $index }}"
                            data-title="{{ $service['title'] }}"
                            data-image="{{ asset('images/' . $service['image']) }}"
                            data-full-content="{{ $service['full_content'] }}">Ver más</button>
                </div>
            </div>
        @endforeach
    </div>
</section>

{{-- Modal Structure --}}
<div id="service-modal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center z-50 hidden p-4">
    <div class="bg-gray-900 rounded-lg shadow-2xl max-w-3xl w-full mx-auto p-6 relative border border-gray-700 h-auto max-h-[90vh] overflow-y-auto">
        <button class="absolute top-3 right-3 text-gray-400 hover:text-white text-3xl close-service-modal-btn">&times;</button>
        <h2 id="modal-service-title" class="text-3xl font-bold text-xlerion-tech-bright-blue mb-4 uppercase font-heading"></h2>
        <img id="modal-service-image" src="" alt="Service Image" class="w-full h-64 object-cover rounded-md mb-4">
        <p id="modal-service-full-content" class="text-gray-300 mb-2 text-lg"></p>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const serviceModal = document.getElementById('service-modal');
        const servicesGrid = document.getElementById('services-grid');
        const closeServiceModalBtns = serviceModal.querySelectorAll('.close-service-modal-btn');

        const modalServiceTitle = document.getElementById('modal-service-title');
        const modalServiceImage = document.getElementById('modal-service-image');
        const modalServiceFullContent = document.getElementById('modal-service-full-content');

        function formatServiceContent(text) {
            let formattedText = text;

            // Reemplazar saltos de línea dobles por párrafos
            formattedText = formattedText.replace(/\n\n/g, '</p><p>');
            // Reemplazar saltos de línea simples por <br>
            formattedText = formattedText.replace(/\n/g, '<br>');

            // Formatear listas con guiones
            formattedText = formattedText.replace(/<br>- /g, '<li>');
            formattedText = formattedText.replace(/<li>([^<]+)/g, '<li>$1</li>');
            formattedText = formattedText.replace(/(<li>.*?<\/li>(\s*<li>.*?<\/li>)*)/g, '<ul>$1</ul>');

            // Formatear listas numeradas (ej. 1. )
            formattedText = formattedText.replace(/<br>(\d+\. )/g, '<br><li>$1');
            formattedText = formattedText.replace(/<li>(\d+\. )([^<]+)/g, '<li>$1$2</li>');
            formattedText = formattedText.replace(/(<li>\d+\. .*?<\/li>(\s*<li>\d+\. .*?<\/li>)*)/g, '<ol>$1</ol>');

            // Formatear encabezados de subsección (ej. "Características clave:")
            formattedText = formattedText.replace(/([A-Z][a-zñáéíóúü\s]+:)/g, '<strong>$1</strong>');

            // Asegurarse de que todo esté dentro de un párrafo inicial si no hay ya uno
            if (!formattedText.startsWith('<p>') && !formattedText.startsWith('<ul>') && !formattedText.startsWith('<ol>')) {
                formattedText = '<p>' + formattedText + '</p>';
            }

            return formattedText;
        }

        if (servicesGrid) {
            servicesGrid.addEventListener('click', function(event) {
                const btn = event.target.closest('.open-service-modal-btn');
                if (btn) {
                    const title = btn.dataset.title;
                    const image = btn.dataset.image;
                    const fullContent = btn.dataset.fullContent;

                    modalServiceTitle.textContent = title;
                    modalServiceImage.src = image;
                    modalServiceFullContent.innerHTML = formatServiceContent(fullContent) +
                        '<div class="mt-6 text-center">' +
                        '<a href="{{ url('/contacto#cotizar-servicio') }}" class="px-6 py-3 bg-xlerion-tech-bright-blue hover:bg-xlerion-deep-blue text-white rounded-md font-medium transition duration-300">Cotizar Servicio</a>' +
                        '</div>';

                    serviceModal.classList.remove('hidden');
                }
            });
        }

        closeServiceModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                serviceModal.classList.add('hidden');
            });
        });

        serviceModal.addEventListener('click', (e) => {
            if (e.target === serviceModal) {
                serviceModal.classList.add('hidden');
            }
        });
    });
</script>
@endpush

        <section>
            <h3 class="text-3xl font-bold text-center mb-8 text-white uppercase font-heading">Servicios Técnicos de Alto Impacto</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Card 1: Toolkits Modulares Personalizados --}}
                <div class="content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col open-modal-btn cursor-pointer hover:border-teal-500 transition-all duration-300"
                     data-title="Toolkits Modulares Personalizados"
                     data-image="{{ asset('images/DroneX.png') }}"
                     data-description="Desarrollo de conjuntos de herramientas adaptativas para entornos técnicos complejos."
                     data-example="Ejemplo: Toolkit para estudios de animación con módulos de diagnóstico, logging de errores y visualización de métricas en tiempo real.">
                    <img src="{{ asset('images/DroneX.png') }}" alt="Toolkits Modulares Personalizados" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Toolkits Modulares Personalizados</h4>
                        <p class="text-gray-300 mb-4 flex-grow text-left">Desarrollo de conjuntos de herramientas adaptativas para entornos técnicos complejos.</p>
                    </div>
                </div>

                {{-- Card 2: Sistemas de Diagnóstico y Rendimiento --}}
                <div class="content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col open-modal-btn cursor-pointer hover:border-teal-500 transition-all duration-300"
                     data-title="Sistemas de Diagnóstico y Rendimiento"
                     data-image="{{ asset('images/Planos.png') }}"
                     data-description="Implementación de comparadores de rendimiento y sistemas de logging para proyectos técnicos."
                     data-example="Ejemplo: Sistema de logging en Unreal Engine para detectar cuellos de botella en la carga de assets 3D.">
                    <img src="{{ asset('images/Planos.png') }}" alt="Sistemas de Diagnóstico y Rendimiento" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Sistemas de Diagnóstico y Rendimiento</h4>
                        <p class="text-gray-300 mb-4 flex-grow text-left">Implementación de comparadores de rendimiento y sistemas de logging para proyectos técnicos.</p>
                    </div>
                </div>

                {{-- Card 3: Branding Técnico-Creativo --}}
                <div class="content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col open-modal-btn cursor-pointer hover:border-teal-500 transition-all duration-300"
                     data-title="Branding Técnico-Creativo"
                     data-image="{{ asset('images/Diseño de logotipo X.png') }}"
                     data-description="Diseño de identidad visual con lógica simbólica, modular y funcional."
                     data-example="Ejemplo: Marca para app de neurodivergencia con geometría adaptativa y paleta accesible para procesamiento cognitivo.">
                    <img src="{{ asset('images/Xlerion.png') }}" alt="Branding Técnico-Creativo" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Branding Técnico-Creativo</h4>
                        <p class="text-gray-300 mb-4 flex-grow text-left">Diseño de identidad visual con lógica simbólica, modular y funcional.</p>
                    </div>
                </div>

                {{-- Card 4: Integración con Motores Gráficos --}}
                <div class="content-container rounded-lg shadow-xl border border-gray-700 overflow-hidden flex flex-col open-modal-btn cursor-pointer hover:border-teal-500 transition-all duration-300"
                     data-title="Integración con Motores Gráficos"
                     data-image="{{ asset('images/mecatron.png') }}"
                     data-description="Configuración avanzada y optimización de pipelines en motores gráficos."
                     data-example="Ejemplo: Entorno de producción para cinemáticas interactivas en Unreal Engine con captura de movimiento y lógica de decisiones.">
                    <img src="{{ asset('images/mecatron.png') }}" alt="Integración con Motores Gráficos" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h4 class="text-2xl font-semibold text-teal-400 mb-2 text-left">Integración con Motores Gráficos</h4>
                        <p class="text-gray-300 mb-4 flex-grow text-left">Configuración avanzada y optimización de pipelines en motores gráficos.</p>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('solution-modal');
        const openModalBtns = document.querySelectorAll('.open-modal-btn');
        const closeModalBtns = document.querySelectorAll('.close-modal-btn');

        const modalTitle = document.getElementById('modal-title');
        const modalImage = document.getElementById('modal-image');
        const modalDescription = document.getElementById('modal-description');
        const modalExample = document.getElementById('modal-example');

        openModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                const title = btn.dataset.title;
                const image = btn.dataset.image;
                const description = btn.dataset.description;
                const example = btn.dataset.example;

                modalTitle.textContent = title;
                modalImage.src = image;
                modalDescription.textContent = description;
                modalExample.textContent = example;

                modal.classList.remove('hidden');
            });
        });

        closeModalBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                modal.classList.add('hidden');
            });
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.add('hidden');
            }
        });
    });
</script>
@endpush