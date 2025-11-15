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
            <img src="{{ asset('img/Filosofia.svg') }}" alt="Filosofía" class="h-32 md:h-48 w-auto">
        </div>
    </div>

    {{-- Main Content for Filosofia --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 pb-12">
        <section>
            <p class="text-justify mb-12 text-gray-300 max-w-4xl mx-auto text-lg leading-relaxed">
                La filosofía de Xlerion se fundamenta en la convicción de que la innovación técnica y creativa debe estar guiada por principios sólidos que promuevan la autonomía, la colaboración y el impacto cultural sostenible. Creemos que las soluciones modulares no solo optimizan procesos y anticipan fallos, sino que también empoderan a las comunidades y fomentan un ecosistema de aprendizaje continuo y replicabilidad. Esta filosofía impulsa cada proyecto, cada herramienta y cada interacción, buscando transformar la industria creativa desde una perspectiva ética, inclusiva y territorialmente consciente.
            </p>
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Misión Card --}}
                <div class="content-container rounded-lg overflow-hidden flex flex-col"
                     data-title="Misión"
                     data-image="{{ asset('images/parallax/filosofia-parallax.jpg') }}"
                     data-content="Impulsar el desarrollo técnico contemporáneo mediante soluciones modulares que anticipan fallos, optimizan flujos de trabajo y fomentan la colaboración sostenible entre creadores, técnicos y comunidades.">
                    <img src="{{ asset('images/parallax/filosofia-parallax.jpg') }}" alt="Misión" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-2xl font-semibold text-white mb-2 text-left">Misión</h3>
                        <p class="text-gray-400 text-left flex-grow">Impulsar el desarrollo técnico contemporáneo mediante soluciones modulares que anticipan fallos...</p>
                        <div class="mt-4 text-right">
                            <button class="open-filosofia-modal bg-teal-500 text-white py-2 px-4 rounded hover:bg-teal-600 transition">Leer más</button>
                        </div>
                    </div>
                </div>

                {{-- Visión Card --}}
                <div class="content-container rounded-lg overflow-hidden flex flex-col"
                     data-title="Visión"
                     data-image="{{ asset('images/parallax/proyectos-parallax.jpg') }}"
                     data-content="Consolidarse como referente latinoamericano en el diseño de toolkits inteligentes que integren técnica, creatividad, documentación y escalabilidad para sectores culturales, educativos y tecnológicos.">
                    <img src="{{ asset('images/parallax/proyectos-parallax.jpg') }}" alt="Visión" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-2xl font-semibold text-white mb-2 text-left">Visión</h3>
                        <p class="text-gray-400 text-left flex-grow">Consolidarse como referente latinoamericano en el diseño de toolkits inteligentes que integren técnica...</p>
                        <div class="mt-4 text-right">
                            <button class="open-filosofia-modal bg-teal-500 text-white py-2 px-4 rounded hover:bg-teal-600 transition">Leer más</button>
                        </div>
                    </div>
                </div>

                {{-- Valores Card --}}
                <div class="content-container rounded-lg overflow-hidden flex flex-col"
                     data-title="Valores"
                     data-image="{{ asset('images/parallax/servicios-productos-parallax.jpg') }}"
                     data-content="<ul class='text-gray-400 text-left space-y-4'><li><strong>Empatía aplicada a entornos técnicos:</strong> Entendemos que la tecnología es también humana, diseñando soluciones accesibles, inclusivas y respetuosas.</li><li><strong>Autosuficiencia creativa:</strong> Promovemos la independencia técnica y creativa con herramientas que permiten a los usuarios gestionar y adaptar sus proyectos.</li><li><strong>Documentación como legado replicable:</strong> Consideramos la documentación un activo cultural que empodera a comunidades y futuros creadores.</li><li><strong>Modularidad como eje estructural:</strong> La base de nuestras soluciones, facilitando escalabilidad, mantenimiento y personalización.</li><li><strong>Impacto cultural con enfoque territorial:</strong> Buscamos generar un impacto positivo en las comunidades, respetando y potenciando las identidades culturales.</li></ul>">
                    <img src="{{ asset('images/parallax/servicios-productos-parallax.jpg') }}" alt="Valores" class="w-full h-48 object-cover">
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-2xl font-semibold text-white mb-2 text-left">Valores</h3>
                        <p class="text-gray-400 text-left flex-grow">Empatía aplicada a entornos técnicos, autosuficiencia creativa, documentación como legado...</p>
                        <div class="mt-4 text-right">
                            <button class="open-filosofia-modal bg-teal-500 text-white py-2 px-4 rounded hover:bg-teal-600 transition">Leer más</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Filosofia Modal Structure --}}
    <div id="filosofia-modal" class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50 hidden p-4 transition-opacity duration-300">
        <div class="bg-gray-900 rounded-lg shadow-2xl max-w-4xl w-full mx-auto p-8 relative border border-gray-700 transform scale-95 transition-transform duration-300">
            <button class="absolute top-4 right-4 text-gray-400 hover:text-white text-4xl close-filosofia-modal">&times;</button>
            <div id="modal-content-wrapper" class="flex flex-col md:flex-row gap-8">
                <div id="modal-text-content" class="w-full md:w-1/2">
                    <h2 id="modal-title" class="text-3xl font-bold text-teal-400 mb-4 uppercase font-heading"></h2>
                    <div id="modal-body" class="text-gray-300 text-justify leading-relaxed"></div>
                </div>
                <div id="modal-image-content" class="w-full md:w-1/2 flex items-center justify-center">
                    <img id="modal-image" src="" alt="Filosofia Image" class="rounded-lg shadow-xl border border-gray-600 max-h-[70vh] object-contain">
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('filosofia-modal');
    if (!modal) return;

    const openModalBtns = document.querySelectorAll('.open-filosofia-modal');
    const closeModalBtns = document.querySelectorAll('.close-filosofia-modal');
    
    const modalContentWrapper = document.getElementById('modal-content-wrapper');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');
    const modalImage = document.getElementById('modal-image');
    const modalImageContainer = document.getElementById('modal-image-content');
    const modalTextContainer = document.getElementById('modal-text-content');

    const openModal = (card) => {
        const title = card.dataset.title;
        const content = card.dataset.content;
        const image = card.dataset.image;

        modalTitle.textContent = title;
        modalBody.innerHTML = content;
        modalImage.src = image;

        // Randomly assign image position
        if (Math.random() > 0.5) {
            modalContentWrapper.classList.remove('md:flex-row-reverse');
            modalContentWrapper.classList.add('md:flex-row');
        } else {
            modalContentWrapper.classList.remove('md:flex-row');
            modalContentWrapper.classList.add('md:flex-row-reverse');
        }

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.style.opacity = '1';
            modal.querySelector('.transform').style.transform = 'scale(1)';
        }, 10);
    };

    const closeModal = () => {
        modal.style.opacity = '0';
        modal.querySelector('.transform').style.transform = 'scale(0.95)';
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    };

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const card = e.target.closest('.content-container');
            openModal(card);
        });
    });

    closeModalBtns.forEach(btn => {
        btn.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
@endpush