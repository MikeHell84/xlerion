import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            colors: {

                'xlerion-tech-bright-blue': '#00eeffff',
                'xlerion-deep-blue': '#004080',
                'xlerion-charcoal-black': '#121212',
                'xlerion-dark-gray': '#2C2C2C',
                'xlerion-pure-white': '#FFFFFF',
                'xlerion-bright-cyan': '#43ffffff',
            },
            filter: {
                'subtle': 'blur(2px)',
            },
            backdropFilter: {
                'subtle': 'blur(2px)',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                heading: ['Stack Sans Text', ...defaultTheme.fontFamily.sans],
            },
            // *** INICIO DE LA CONFIGURACIÓN DE BLUR PERSONALIZADO ***
            blur: {
                'heavy': '12px', // Generará la clase `blur-heavy`
                '2px': '2px',   // Generará la clase `blur-2px`
                'custom-lg': '20px', // Otro ejemplo
            },
            // *** FIN DE LA CONFIGURACIÓN DE BLUR PERSONALIZADO ***
        },
    },

    plugins: [forms],
};
