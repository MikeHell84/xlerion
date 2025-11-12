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

