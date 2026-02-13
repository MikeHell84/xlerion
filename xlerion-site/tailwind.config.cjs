/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './index.html',
        './src/components/**/*.{js,jsx}',
        './src/pages/**/*.{js,jsx}',
        './src/main.jsx',
        './src/App.jsx',
    ],
    theme: {
        extend: {
            colors: {
                primary: '#00e9fa',
                secondary: '#333436',
                background: '#000000',
                'white-text': '#FFFFFF',
            },
            fontFamily: {
                sans: ['Inter', 'sans-serif'],
                mono: ['Roboto Mono', 'monospace'],
            },
            borderRadius: {
                'xl-sm': '2px',
            },
        },
    },
    plugins: [],
};