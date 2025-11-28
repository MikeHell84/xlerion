import React, { useState, useEffect } from 'react';

// En un proyecto real, cada una de estas secciones estaría en su propio archivo
// (por ejemplo, DesarrolloSection.jsx) para una mejor organización.

const HomeSection = () => (
    <>
        <h1 className="text-4xl md:text-6xl font-extrabold text-white mb-4 animate-fade-in">Xlerion Studio</h1>
        <p className="text-xl text-gray-400 max-w-2xl mx-auto animate-fade-in delay-200">
            Soluciones Disruptivas: Ingeniería modular para mentes creativas.
        </p>
    </>
);

const DesarrolloSection = () => (
    <>
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6 animate-fade-in">Desarrollo de Videojuegos Narrativos y Técnicos</h2>
        <div className="prose prose-invert max-w-none text-lg text-gray-400">
            <div className="space-y-6">
                <h3 className="text-3xl font-bold text-white mb-4 animate-fade-in delay-200">Total Darkness</h3>
                <p className="text-lg animate-fade-in delay-400">Una experiencia inmersiva basada en la música de la banda Redemthor, integrando escenas sincronizadas con atmósferas sonoras y mecánicas adaptativas.</p>
                <ul className="max-w-xl mx-auto list-disc list-inside space-y-2 text-gray-400">
                    <li className="animate-fade-in delay-600">Creación de IPs propias con narrativa interactiva, música original y mecánicas adaptativas.</li>
                    <li className="animate-fade-in delay-800">Diseño técnico-visual escalable para entornos AAA, indie y educativos.</li>
                    <li className="animate-fade-in delay-1000">Prototipado rápido con lógica modular y validación de dependencias.</li>
                </ul>
            </div>
        </div>
    </>
);

const ToolkitsSection = () => (
    <>
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6 animate-fade-in">Toolkits Técnicos para Estudios y Desarrolladores</h2>
        <div className="prose prose-invert max-w-none text-lg text-gray-400">
            <div className="space-y-6">
                <h3 className="text-3xl font-bold text-white mb-4 animate-fade-in delay-200">Xlerion Toolkit</h3>
                <p className="text-lg animate-fade-in delay-400">La ingeniería creativa comienza con modularidad. Automatizamos lo complejo, documentamos lo esencial, validamos lo invisible.</p>
                <ul className="max-w-xl mx-auto list-disc list-inside space-y-2 text-gray-400">
                    <li className="animate-fade-in delay-600">Módulos para logging extendido, validación automática, FX especiales y comparadores de rendimiento.</li>
                    <li className="animate-fade-in delay-800">Interfaces jerárquicas con íconos personalizados y lógica visual predictiva.</li>
                    <li className="animate-fade-in delay-1000">Compatibilidad con motores como Unreal, Unity y Godot.</li>
                    <li className="animate-fade-in delay-1200">Documentación reutilizable y nomenclatura clara para mantenimiento sostenible.</li>
                </ul>
            </div>
        </div>
    </>
);

const SimuladoresSection = () => (
    <>
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6 animate-fade-in">Simuladores Interactivos y Aplicaciones Técnicas</h2>
        <div className="prose prose-invert max-w-none text-lg text-gray-400">
            <div className="space-y-6">
                <p className="text-lg animate-fade-in delay-200">Desarrollamos experiencias interactivas y entornos auditables. La diversidad cognitiva construye la mejor ingeniería.</p>
                <ul className="max-w-xl mx-auto list-disc list-inside space-y-2 text-gray-400">
                    <li className="animate-fade-in delay-400">Simuladores para formación técnica, arte digital, neurodiversidad y entornos auditables.</li>
                    <li className="animate-fade-in delay-600">Integración de sensores, captura de movimiento y edición de voz.</li>
                    <li className="animate-fade-in delay-800">Aplicaciones para instituciones educativas, sector público y GovTech.</li>
                </ul>
            </div>
        </div>
    </>
);

const BrandingSection = () => (
    <>
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6 animate-fade-in">Branding Técnico-Creativo</h2>
        <div className="prose prose-invert max-w-none text-lg text-gray-400">
            <div className="space-y-6">
                <p className="text-lg animate-fade-in delay-200">Innovación que respeta tu forma única de crear. Diseñamos una identidad visual que refleja robustez e inteligencia.</p>
                <ul className="max-w-xl mx-auto list-disc list-inside space-y-2 text-gray-400">
                    <li className="animate-fade-in delay-400">Diseño de interfaces modulares, íconos personalizados y lógica visual alineada a la filosofía de producto.</li>
                    <li className="animate-fade-in delay-600">Desarrollo de identidad visual para videojuegos, simuladores y herramientas técnicas.</li>
                    <li className="animate-fade-in delay-800">Integración de arte sonoro y narrativa como elementos de marca.</li>
                </ul>
            </div>
        </div>
    </>
);

const ConsultoriaSection = () => (
    <>
        <h2 className="text-4xl md:text-5xl font-bold text-white mb-6 animate-fade-in">Consultoría Técnica y Creativa</h2>
        <div className="prose prose-invert max-w-none text-lg text-gray-400">
            <div className="space-y-6">
                <p className="text-lg animate-fade-in delay-200">Validar antes de ejecutar. Escalar sin improvisar. Ofrecemos asesoría especializada para optimizar tus procesos de desarrollo.</p>
                <ul className="max-w-xl mx-auto list-disc list-inside space-y-2 text-gray-400">
                    <li className="animate-fade-in delay-400">Diagnóstico predictivo de entornos técnicos y migración de perfiles.</li>
                    <li className="animate-fade-in delay-600">Optimización de pipelines de desarrollo, documentación y validación.</li>
                    <li className="animate-fade-in delay-800">Asesoría en escalabilidad modular, accesibilidad cognitiva y diseño inclusivo.</li>
                </ul>
            </div>
        </div>
    </>
);

const footerTitles = {
    'home': 'Xlerion Studio',
    'desarrollo': 'Desarrollo de Videojuegos',
    'toolkits': 'Toolkits Técnicos',
    'simuladores': 'Simuladores Interactivos',
    'branding': 'Branding Técnico-Creativo',
    'consultoria': 'Consultoría Creativa'
};

const backgroundIds = {
    'home': 'bg-default',
    'desarrollo': 'bg-desarrollo',
    'toolkits': 'bg-toolkits',
    'simuladores': 'bg-simuladores',
    'branding': 'bg-branding',
    'consultoria': 'bg-consultoria'
};

const SectionRenderer = ({ activeSection }) => {
    switch (activeSection) {
        case 'desarrollo':
            return <DesarrolloSection />;
        case 'toolkits':
            return <ToolkitsSection />;
        case 'simuladores':
            return <SimuladoresSection />;
        case 'branding':
            return <BrandingSection />;
        case 'consultoria':
            return <ConsultoriaSection />;
        default:
            return <HomeSection />;
    }
};

export default function App() {
    const [activeSection, setActiveSection] = useState('home');

    const loadSection = (sectionName) => {
        setActiveSection(sectionName);
    };

    // useEffect para manejar las clases del fondo y el pie de página
    useEffect(() => {
        // Manejar el fondo
        const allBgs = document.querySelectorAll('.parallax-bg');
        // Ocultar todos los textos de fondo al iniciar la transición
        const bgLabels = document.querySelectorAll('.bg-label');
        bgLabels.forEach(label => label.style.opacity = '0');

        // Eliminar la clase 'active' y 'old-active' de todos los fondos
        allBgs.forEach(bg => {
            bg.classList.remove('active', 'old-active');
        });

        // Aplicar la clase 'active' al nuevo fondo
        const newBg = document.getElementById(backgroundIds[activeSection]);
        if (newBg) {
            newBg.classList.add('active');
            const newLabel = newBg.querySelector('.bg-label');
            if (newLabel) {
                 setTimeout(() => {
                    newLabel.style.opacity = '1';
                }, 500);
            }
        }
        
        // Manejar el pie de página
        const footer = document.getElementById('dynamic-footer');
        if (footer) {
            footer.innerText = footerTitles[activeSection];
        }

    }, [activeSection]);


    return (
        <>
            <style>
                {`
                    body {
                        background-color: #121212;
                        color: #f0f0f0;
                        font-family: 'Inter', sans-serif;
                        margin: 0;
                        overflow-x: hidden;
                    }

                    #background-container {
                        position: fixed;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        z-index: -1;
                        overflow: hidden;
                    }

                    .parallax-bg {
                        position: absolute;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        background-size: cover;
                        background-position: center;
                        opacity: 0;
                        transition: opacity 1s ease-in-out;
                    }

                    .parallax-bg.active {
                        opacity: 1;
                        z-index: 1;
                    }

                    .bg-label {
                        position: absolute;
                        bottom: 20px;
                        left: 20px;
                        font-size: 2rem;
                        font-weight: 700;
                        color: rgba(255, 255, 255, 0.1);
                        opacity: 0;
                        transition: opacity 0.5s ease-in-out;
                        pointer-events: none;
                    }

                    /* Tailwind utility classes for animations that are not in the main CSS file */
                    @keyframes fadeIn {
                        from {
                            opacity: 0;
                            transform: translateY(20px);
                        }
                        to {
                            opacity: 1;
                            transform: translateY(0);
                        }
                    }

                    .animate-fade-in {
                        animation: fadeIn 1s ease-out forwards;
                    }

                    .delay-200 {
                        animation-delay: 0.2s;
                    }

                    .delay-400 {
                        animation-delay: 0.4s;
                    }

                    .delay-600 {
                        animation-delay: 0.6s;
                    }

                    .delay-800 {
                        animation-delay: 0.8s;
                    }

                    .delay-1000 {
                        animation-delay: 1.0s;
                    }

                    .delay-1200 {
                        animation-delay: 1.2s;
                    }

                    .prose h3 {
                        font-size: 1.875rem;
                        font-weight: 700;
                        margin-top: 1.5rem;
                        margin-bottom: 0.5rem;
                    }
                `}
            </style>
            {/* Contenedor del fondo con imágenes de paralaje */}
            <div id="background-container">
                <div id="bg-desarrollo" className="parallax-bg" style={{ background: 'linear-gradient(to bottom right, #1d4ed8, #0c4a6e)' }}>
                    <span className="bg-label">Desarrollo</span>
                </div>
                <div id="bg-toolkits" className="parallax-bg" style={{ background: 'linear-gradient(to bottom right, #5b21b6, #4c1d95)' }}>
                    <span className="bg-label">Toolkits</span>
                </div>
                <div id="bg-simuladores" className="parallax-bg" style={{ background: 'linear-gradient(to bottom right, #f56565, #c53030)' }}>
                    <span className="bg-label">Simuladores</span>
                </div>
                <div id="bg-branding" className="parallax-bg" style={{ background: 'linear-gradient(to bottom right, #d69e2e, #9c6e00)' }}>
                    <span className="bg-label">Branding</span>
                </div>
                <div id="bg-consultoria" className="parallax-bg" style={{ background: 'linear-gradient(to bottom right, #0d9488, #065f46)' }}>
                    <span className="bg-label">Consultoría</span>
                </div>
                <div id="bg-default" className="parallax-bg active" style={{ background: 'linear-gradient(to bottom right, #4a5568, #2d3748)' }}>
                    <span className="bg-label">Xlerion</span>
                </div>
            </div>

            {/* Encabezado de la página */}
            <header className="bg-gray-900 shadow-lg fixed top-0 left-0 right-0 z-50">
                <nav className="container mx-auto px-4 py-4 flex flex-col md:flex-row justify-between items-center">
                    <div className="flex items-center space-x-2 mb-4 md:mb-0">
                        {/* Logo SVG estilizado */}
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" className="w-8 h-8 text-blue-400">
                            <path fillRule="evenodd" clipRule="evenodd" d="M12 0L6 12L12 24L18 12L12 0ZM12 4.5L15.366 11.232L12 18L8.634 11.232L12 4.5Z" fill="currentColor"/>
                        </svg>
                        {/* Nombre del estudio */}
                        <span className="font-extrabold text-white text-2xl md:text-3xl">Xlerion Studio</span>
                    </div>
                    <div id="nav-menu" className="flex flex-wrap justify-center gap-2 md:gap-4 font-semibold text-sm">
                        <button onClick={() => loadSection('desarrollo')} className="nav-button px-4 py-2 rounded-full transition-all duration-300 ease-in-out hover:bg-white hover:text-gray-900 border border-gray-600">
                            Desarrollo
                        </button>
                        <button onClick={() => loadSection('toolkits')} className="nav-button px-4 py-2 rounded-full transition-all duration-300 ease-in-out hover:bg-white hover:text-gray-900 border border-gray-600">
                            Toolkits
                        </button>
                        <button onClick={() => loadSection('simuladores')} className="nav-button px-4 py-2 rounded-full transition-all duration-300 ease-in-out hover:bg-white hover:text-gray-900 border border-gray-600">
                            Simuladores
                        </button>
                        <button onClick={() => loadSection('branding')} className="nav-button px-4 py-2 rounded-full transition-all duration-300 ease-in-out hover:bg-white hover:text-gray-900 border border-gray-600">
                            Branding
                        </button>
                        <button onClick={() => loadSection('consultoria')} className="nav-button px-4 py-2 rounded-full transition-all duration-300 ease-in-out hover:bg-white hover:text-gray-900 border border-gray-600">
                            Consultoría
                        </button>
                    </div>
                </nav>
            </header>

            {/* Contenedor principal donde se cargará el contenido de cada sección */}
            <main className="min-h-screen flex items-center justify-center pt-24 md:pt-32 px-4">
                <div id="main-content" className="max-w-7xl w-full text-center p-8 bg-gray-900/90 rounded-2xl shadow-xl transition-all duration-500 ease-in-out">
                    <SectionRenderer activeSection={activeSection} />
                </div>
            </main>
            
            {/* Pie de página dinámico para el texto de la sección actual */}
            <footer id="dynamic-footer" className="fixed bottom-0 left-0 w-full p-4 text-center text-gray-500 text-sm md:text-base font-medium transition-opacity">
                {footerTitles[activeSection]}
            </footer>
        </>
    );
}
