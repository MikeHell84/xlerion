// Importar el inicializador de la animación de Three.js
import { initAnimation } from './animation.js';

// --- Lógica Principal de la Página (para modales, menú, etc.) ---
function initializePage() {
    let currentLang = 'es';
    
    // Referencias a elementos del DOM
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const langEsButton = document.getElementById('lang-es');
    const langEnButton = document.getElementById('lang-en');
    const langEsButtonMobile = document.getElementById('lang-es-mobile');
    const langEnButtonMobile = document.getElementById('lang-en-mobile');
    
    // Lógica del menú móvil
    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Función para establecer el idioma
    const setLanguage = (lang) => {
        if (typeof translations === 'undefined' || !translations[lang]) {
            console.error(`Language "${lang}" not found in translations.`);
            return;
        }
        currentLang = lang;
        document.documentElement.lang = lang;

        // Actualizar estilos de botones de idioma
        langEsButton.classList.toggle('font-semibold', lang === 'es');
        langEsButton.classList.toggle('text-sky-400', lang === 'es');
        langEsButton.classList.toggle('text-gray-400', lang !== 'es');
        langEnButton.classList.toggle('font-semibold', lang === 'en');
        langEnButton.classList.toggle('text-sky-400', lang === 'en');
        langEnButton.classList.toggle('text-gray-400', lang !== 'en');

        langEsButtonMobile.classList.toggle('font-semibold', lang === 'es');
        langEsButtonMobile.classList.toggle('text-sky-400', lang === 'es');
        langEsButtonMobile.classList.toggle('text-gray-400', lang !== 'es');
        langEnButtonMobile.classList.toggle('font-semibold', lang === 'en');
        langEnButtonMobile.classList.toggle('text-sky-400', lang === 'en');
        langEnButtonMobile.classList.toggle('text-gray-400', lang !== 'en');
        
        // Aplicar traducciones
        const elementsToTranslate = document.querySelectorAll('[data-translate]');
        elementsToTranslate.forEach(el => {
            const key = el.dataset.translate;
            if (translations[lang] && translations[lang][key]) {
                el.innerHTML = translations[lang][key];
            }
        });

        // Actualizar el contenido de los modales si uno está abierto
        const activeModalKey = document.body.dataset.activeModal;
        if (activeModalKey) {
            updateModalContent(activeModalKey, lang);
        }
    };
    
    // --- Lógica del Modal ---
    const modal = document.getElementById('modal');
    const modalPanel = document.getElementById('modal-panel');
    const closeButton = document.getElementById('modal-close-button');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const modalDetailsContainer = document.getElementById('modal-details-container');
    const modalReelTitle = document.getElementById('modal-reel-title');
    const modalReel = document.getElementById('modal-reel');

    const openModal = (dataKey) => {
        const modalData = modalContent[dataKey];
        if (!modalData) {
            console.error(`No modal data found for key: ${dataKey}`);
            return;
        }
        
        document.body.classList.add('modal-open');
        document.body.dataset.activeModal = dataKey; // Guardar la clave activa

        updateModalContent(dataKey, currentLang);
        
        modal.classList.remove('opacity-0', 'pointer-events-none');
        modal.classList.add('opacity-100');
        modalPanel.classList.remove('scale-95');
        modalPanel.classList.add('scale-100');
    };

    const updateModalContent = (dataKey, lang) => {
        const modalData = modalContent[dataKey];
        
        // Traducir y actualizar el título y la descripción
        modalTitle.textContent = translations[lang][modalData.titleKey] || '';
        modalDescription.textContent = translations[lang][modalData.descriptionKey] || '';
        
        // Actualizar los detalles
        modalDetailsContainer.innerHTML = '';
        if (modalData.detailsKey) {
            const detailsList = translations[lang][modalData.detailsKey] || [];
            detailsList.forEach(detail => {
                const p = document.createElement('p');
                p.className = 'text-gray-400';
                p.textContent = `• ${detail}`;
                modalDetailsContainer.appendChild(p);
            });
        }
        
        // Actualizar el "reel" de imágenes/enlaces
        modalReel.innerHTML = '';
        if (modalData.reelTitleKey) {
            modalReelTitle.textContent = translations[lang][modalData.reelTitleKey] || '';
            modalData.reelContent.forEach(item => {
                const div = document.createElement('div');
                div.className = 'rounded-xl overflow-hidden group';
                
                if (item.type === 'image') {
                    div.innerHTML = `
                        <img src="${item.src}" alt="${translations[lang][item.textKey] || ''}" class="w-full h-40 object-cover transform group-hover:scale-105 transition-transform">
                        <div class="p-2 bg-gray-800 text-center text-sm font-semibold text-gray-300">${translations[lang][item.textKey] || ''}</div>
                    `;
                } else if (item.type === 'link') {
                     div.innerHTML = `
                        <a href="${item.url}" class="block p-4 bg-gray-800 border border-gray-700 rounded-xl text-center font-semibold text-sky-400 hover:bg-sky-400 hover:text-black transition-colors">
                            ${translations[lang][item.textKey] || ''}
                        </a>
                    `;
                }
                modalReel.appendChild(div);
            });
            document.getElementById('modal-reel-container').classList.remove('hidden');
        } else {
            document.getElementById('modal-reel-container').classList.add('hidden');
        }

    }

    const closeModal = () => {
        document.body.classList.remove('modal-open');
        modalPanel.classList.remove('scale-100');
        modalPanel.classList.add('scale-95');
        modal.classList.add('opacity-0');
        
        setTimeout(() => {
            modal.classList.add('pointer-events-none');
            document.body.removeAttribute('data-active-modal');
        }, 300);
    };
    
    // Asignar eventos
    const interactiveElements = document.querySelectorAll('[data-service], [data-feature]');
    interactiveElements.forEach(element => {
        element.addEventListener('click', () => {
            const dataKey = element.dataset.service || element.dataset.feature;
            openModal(dataKey);
        });
    });

    closeButton.addEventListener('click', closeModal);
    modal.addEventListener('click', (e) => {
        if (e.target === modal) closeModal();
    });

    langEsButton.addEventListener('click', () => setLanguage('es'));
    langEnButton.addEventListener('click', () => setLanguage('en'));
    langEsButtonMobile.addEventListener('click', () => setLanguage('es'));
    langEnButtonMobile.addEventListener('click', () => setLanguage('en'));

    // --- Lógica de la Línea de Tiempo ---
    const timelineItems = document.querySelectorAll('.timeline-item');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.3 });
    timelineItems.forEach(item => observer.observe(item));

    // Establecer idioma inicial
    setLanguage('es');
}

// --- Inicializar todo cuando la página esté lista ---
document.addEventListener('DOMContentLoaded', () => {
    initializePage();
    // Iniciar la animación de Three.js
    initAnimation();
});

