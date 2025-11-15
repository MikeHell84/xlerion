import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const parallaxContainers = document.querySelectorAll('.parallax-image-container');

    parallaxContainers.forEach(container => {
        const image = container.querySelector('img');

        if (image) {
            container.addEventListener('mousemove', (e) => {
                const { left, top, width, height } = container.getBoundingClientRect();
                const centerX = left + width / 2;
                const centerY = top + height / 2;

                const mouseX = e.clientX - centerX;
                const mouseY = e.clientY - centerY;

                // Adjust these values to control the intensity of the parallax effect
                const strengthX = 0.05; // Adjust as needed
                const strengthY = 0.05; // Adjust as needed

                const translateX = -mouseX * strengthX;
                const translateY = -mouseY * strengthY;

                // Apply the transform to the image
                // Keep the existing translateZ and scale for the depth effect
                image.style.transform = `translateZ(-1px) scale(1.5) translateX(${translateX}px) translateY(${translateY}px)`;
            });

            container.addEventListener('mouseleave', () => {
                // Reset the image position when the mouse leaves the container
                image.style.transform = `translateZ(-1px) scale(1.5) translateX(0px) translateY(0px)`;
            });
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const parallaxSection = document.getElementById('parallax-js-section-inicio');

    if (parallaxSection) {
        window.addEventListener('scroll', function() {
            let scrolled = window.scrollY;
            // Adjust the '0.4' to control the speed (lower value = slower movement)
            parallaxSection.style.backgroundPositionY = -(scrolled * 0.4) + 'px';
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('solution-modal');
    const openModalBtns = document.querySelectorAll('.open-modal-btn');
    const closeModalBtn = document.querySelector('.close-modal-btn');
    const modalTitle = document.getElementById('modal-title');
    const modalImage = document.getElementById('modal-image');
    const modalDescription = document.getElementById('modal-description');
    const modalExample = document.getElementById('modal-example');

    openModalBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const title = this.dataset.title;
            const image = this.dataset.image;
            const description = this.dataset.description;
            const example = this.dataset.example;

            modalTitle.textContent = title;
            modalImage.src = image;
            modalDescription.textContent = description;
            modalExample.textContent = example;

            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        });
    });

    closeModalBtn.addEventListener('click', function() {
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Restore scrolling
    });

    // Close modal when clicking outside the modal content
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            document.body.style.overflow = ''; // Restore scrolling
        }
    });
});

















import Rellax from 'rellax'; // Importa Rellax

/**
 * Inicializa el efecto parallax usando Rellax.js
 * Busca elementos con la clase 'rellax' y los configura.
 */
function initializeParallax() {
    const rellaxElements = document.querySelectorAll('.rellax');

    if (rellaxElements.length > 0) {
        // Configuración por defecto de Rellax. Puedes ajustar estos valores.
        // Los atributos data-rellax-speed en el HTML sobrescribirán 'speed'.
        new Rellax('.rellax', {
            speed: -2, // Velocidad por defecto
            center: true, // Centra el elemento parallax en el viewport
            wrapper: null, // Usa 'null' para el scroll del body, o un selector CSS para un contenedor específico
            round: true, // Redondea los valores de posición para evitar sub-píxeles
            vertical: true, // Habilita el parallax vertical
            horizontal: false // Deshabilita el parallax horizontal
        });
        console.log(`Rellax.js inicializado para ${rellaxElements.length} elementos.`);
    } else {
        console.log('No se encontraron elementos con la clase .rellax para inicializar Rellax.js.');
    }
}

// Asegúrate de que el DOM esté completamente cargado antes de inicializar Rellax.
// Esto es crucial para que Rellax encuentre los elementos HTML.
document.addEventListener('DOMContentLoaded', initializeParallax);

// Si tu aplicación carga contenido dinámicamente después del DOMContentLoaded,
// podrías necesitar llamar a initializeParallax() de nuevo o a rellax.refresh()
// después de que el nuevo contenido se haya añadido al DOM.