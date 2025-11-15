// script.js

document.addEventListener('DOMContentLoaded', () => {
    // 1. Selecciona todos los enlaces que apuntan a una sección (usando el #)
    const navLinks = document.querySelectorAll('a[href^="#"]');

    navLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            // Previene el comportamiento de salto instantáneo predeterminado del navegador
            e.preventDefault();

            // Obtiene el ID del destino (ej: #servicios)
            const targetId = this.getAttribute('href');
            
            // Si el ID es solo "#", saltamos, si no, encontramos el elemento
            if (targetId === '#') return;

            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                // Utiliza el método scrollIntoView con comportamiento 'smooth'
                // Esto maneja la animación de manera nativa y eficiente.
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start' // Alinea la parte superior del elemento en la parte superior de la ventana
                });
            }
        });
    });

    const video = document.querySelector('.parallax-video');

    if (!video) return;

    // Función que calcula la nueva posición
    function parallaxScroll() {
        // Obtenemos el desplazamiento vertical actual
        const scrollPos = window.scrollY;

        // Factor de Parallax: determina qué tan rápido se moverá el video.
        // Un valor más bajo (e.g., 0.3) da un efecto más sutil.
        const parallaxFactor = 0.4;

        // Calculamos el desplazamiento vertical para el video
        // (Asegúrate de que este desplazamiento sea sutil y contrario al scroll)
        const yOffset = scrollPos * parallaxFactor;

        // Aplicamos la transformación. Usamos translate3d para forzar la aceleración por hardware (GPU)
        video.style.transform = `translate(-50%, calc(-50% + ${yOffset}px))`;
    }

    // Función para el efecto parallax con el mouse en imágenes
    function setupMouseParallax() {
        const parallaxContainers = document.querySelectorAll('.parallax-image-container');

        parallaxContainers.forEach(container => {
            const image = container.querySelector('img'); // Asume que la imagen está dentro del contenedor

            if (!image) return;

            container.addEventListener('mousemove', (e) => {
                const { left, top, width, height } = container.getBoundingClientRect();
                const xAxis = (e.clientX - (left + width / 2)) / width;
                const yAxis = (e.clientY - (top + height / 2)) / height;

                // Ajusta estos valores para controlar la intensidad del efecto
                const moveX = xAxis * 20; // Mueve la imagen 20px en X
                const moveY = yAxis * 20; // Mueve la imagen 20px en Y

                image.style.transform = `translate3d(${moveX}px, ${moveY}px, 0)`;
            });

            container.addEventListener('mouseleave', () => {
                // Vuelve la imagen a su posición original cuando el mouse sale
                image.style.transform = `translate3d(0, 0, 0)`;
            });
        });
    }

    // Usamos requestAnimationFrame para optimizar el rendimiento de la animación
    function loop() {
        parallaxScroll();
        window.requestAnimationFrame(loop);
    }

    // Inicializa el bucle de animación
    window.animFrame = window.requestAnimationFrame(loop); // Guardar la referencia para posible cancelación

    // Inicializa el parallax de mouse
    setupMouseParallax();
});