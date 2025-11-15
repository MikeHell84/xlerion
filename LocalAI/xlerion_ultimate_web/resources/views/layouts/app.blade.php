<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Xlerion – Soluciones Disruptivas</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- Asume que aquí cargas tus estilos de Tailwind/Vite --}}
    @vite('resources/css/app.css') 
    <style>
        /* Definir la variable CSS para el color de Tailwind para usarla en el CSS puro */
        :root {
            --tw-color-laser-blue: #00FFFF; /* Valor de #00FFFF para laser-blue */
        }

        /* Estilos específicos para la línea láser y la animación */
        .laser-line {
            position: relative;
            width: 100%;
            height: 2px; /* Altura sutil */
            overflow: hidden; /* Para contener el pseudo-elemento animado */
            background-color: transparent; /* Fondo transparente */
        }

        .laser-line::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%; /* Inicia fuera de la vista a la izquierda */
            width: 100%;
            height: 100%;
            /* Degradado para simular el efecto de luz del láser */
            background: linear-gradient(90deg, transparent, var(--tw-color-laser-blue), transparent);
            /* Sombra para el efecto de brillo */
            box-shadow: 0 0 10px var(--tw-color-laser-blue), 0 0 20px var(--tw-color-laser-blue), 0 0 30px var(--tw-color-laser-blue);
            /* Animación de ida y vuelta */
            animation: slide-laser 3s infinite alternate ease-in-out;
        }

        @keyframes slide-laser {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-100 antialiased min-h-screen flex flex-col">
    <header id="main-header" class="bg-gray-800/90 backdrop-blur-lg shadow-lg sticky top-0 z-50 transition-all duration-300">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Main Navigation">
            <div class="flex justify-between items-center py-4">
                {{-- Logo --}}
                <a href="/" class="flex-shrink-0" aria-label="Xlerion Home">
                    <img class="h-8 w-auto" src="{{ asset('img/LogoX.svg') }}" alt="Xlerion Logo">
                </a>
    
                {{-- Desktop Navigation --}}
                <div class="hidden lg:flex lg:items-center lg:space-x-4">
                    @foreach ($navigationLinks as $link)
                        <a href="{{ $link->route }}" class="flex items-center px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-teal-400 hover:bg-gray-700 transition">
                            <i class="{{ $link->icon_class }} mr-2"></i>
                            <span>{{ $link->name }}</span>
                        </a>
                    @endforeach
                </div>
    
                {{-- Mobile Menu Button --}}
                <div class="lg:hidden">
                    <button id="mobile-menu-button" type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg id="hamburger-icon" class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                        <svg id="close-icon" class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
        <div class="laser-line"></div>
    
        <!-- Mobile Menu, Off-canvas -->
        <div id="mobile-menu" class="hidden lg:hidden fixed inset-0 z-60" aria-labelledby="mobile-menu-button" role="dialog" aria-modal="true">
            <!-- Overlay -->
            <div id="mobile-menu-overlay" class="absolute inset-0 bg-black/60 backdrop-blur-sm transition-opacity duration-300 ease-in-out opacity-0"></div>
            
            <!-- Panel -->
            <div id="mobile-menu-panel" class="absolute top-0 right-0 h-full w-full max-w-xs bg-gray-900 shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out border-l border-gray-700">
                <div class="pt-5 pb-6 px-2">
                    <div class="flex items-center justify-between px-2">
                        <a href="/" aria-label="Xlerion Home">
                            <img class="h-8 w-auto" src="{{ asset('img/LogoX.svg') }}" alt="Xlerion Logo">
                        </a>
                        <button id="mobile-close-button" type="button" class="p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-white">
                            <span class="sr-only">Close menu</span>
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-6">
                        <nav class="grid gap-y-2">
                            @foreach ($navigationLinks as $link)
                                <a href="{{ $link->route }}" class="flex items-center p-3 rounded-md text-base font-medium text-gray-300 hover:text-teal-400 hover:bg-gray-700 transition">
                                    <i class="{{ $link->icon_class }} mr-3 w-6 text-center"></i>
                                    <span>{{ $link->name }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>

    {{-- Incluir chatbot en todo el sitio --}}
    @include('partials.chatbot')

    @push('scripts')
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu logic (existing)
        const header = document.getElementById('main-header');
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenuPanel = document.getElementById('mobile-menu-panel');
        const mobileCloseButton = document.getElementById('mobile-close-button');
        const hamburgerIcon = document.getElementById('hamburger-icon');
        const closeIcon = document.getElementById('close-icon');
        
        let menuTimeout;

        const scrollThreshold = 50;
        if (header) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > scrollThreshold) {
                    header.classList.add('bg-gray-900/90', 'shadow-xl');
                    header.classList.remove('bg-gray-800/90', 'shadow-lg');
                } else {
                    header.classList.remove('bg-gray-900/90', 'shadow-xl');
                    header.classList.add('bg-gray-800/90', 'shadow-lg');
                }
            });
        }
    
        const toggleMenu = (forceOpen) => {
            clearTimeout(menuTimeout);
            const isOpen = forceOpen === undefined ? mobileMenuButton.getAttribute('aria-expanded') === 'false' : forceOpen;
            mobileMenuButton.setAttribute('aria-expanded', isOpen);
    
            if (isOpen) {
                mobileMenu.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
                
                requestAnimationFrame(() => {
                    mobileMenuOverlay.classList.remove('opacity-0');
                    mobileMenuPanel.classList.remove('translate-x-full');
                });
                
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                mobileMenuOverlay.classList.add('opacity-0');
                mobileMenuPanel.classList.add('translate-x-full');
                
                document.body.style.overflow = '';
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
    
                menuTimeout = setTimeout(() => {
                    mobileMenu.classList.add('hidden');
                }, 300);
            }
        };
    
        if (mobileMenuButton) {
            mobileMenuButton.addEventListener('click', () => toggleMenu());
        }
        if (mobileCloseButton) {
            mobileCloseButton.addEventListener('click', () => toggleMenu(false));
        }
    
        if (mobileMenuOverlay) {
            mobileMenuOverlay.addEventListener('click', () => toggleMenu(false));
        }
    
        document.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && mobileMenuButton.getAttribute('aria-expanded') === 'true') {
                toggleMenu(false);
            }
        });

        // --- Chat Widget Logic ---
        const KNOWLEDGE_BASE = {
            "que es xlerion": "Xlerion es un laboratorio técnico y creativo que desarrolla soluciones modulares especializadas para industrias como videojuegos AAA, multimedia avanzada y producción interactiva, con un enfoque en la autosuficiencia, documentación rigurosa y impacto cultural.",
            "filosofia xlerion": "Nuestra filosofía se basa en la modularidad, la autosuficiencia creativa, la empatía aplicada a entornos técnicos, la documentación como legado replicable y el impacto cultural con enfoque territorial.",
            "tipo soluciones": "Ofrecemos toolkits modulares con interfaces adaptativas, sistemas avanzados de diagnóstico y análisis de rendimiento, branding técnico-creativo, documentación estructurada y una integración avanzada con motores gráficos como Unreal Engine, Unity y 3DS Max.",
            "documentan soluciones": "Cada solución cuenta con manuales técnicos por módulo, diagramas de flujo y arquitectura, guías de instalación y configuración, y una filosofía de documentación que busca empoderar a los usuarios y comunidades para fomentar la autonomía y la innovación.",
            "quien fundador": "Miguel Eduardo Rodríguez Martínez (Mike) es el fundador y líder creativo de Xlerion TechLab. Es un autodidacta con un enfoque neurodivergente que combina arte digital, modelado 3D, scripting y defensa legal para crear soluciones técnicas con impacto cultural.",
            "contacto informacion": "Puedes contactarnos a través de nuestro formulario en la página, enviar un correo a cualquiera de nuestros emails oficiales, o seguirnos en nuestras redes sociales como LinkedIn, Instagram, Facebook, Patreon y más.",
            "eventos convocatorias": "Sí, participamos activamente en convocatorias culturales y tecnológicas como CoCrea 2025 y Colombia 4.0, buscando alianzas que fortalezcan nuestro impacto y validen nuestro enfoque empírico.",
            "garantias legales": "Contamos con políticas claras de privacidad de datos, términos de uso para nuestro sitio y toolkits, licencias de software y contenido, y una declaración de derechos del consumidor para proteger a nuestros usuarios y clientes.",
            "filosofia modular videojuegos": "Es un enfoque que permite diseñar videojuegos con componentes independientes y escalables, facilitando la innovación técnica y creativa, la adaptabilidad y la optimización continua.",
            "acceder toolkits": "Puedes solicitar información y acceso a nuestros toolkits a través del contacto directo en la página o mediante nuestras redes sociales y plataformas de crowdfunding como Kickstarter e Indiegogo.",
        };

        const chatFab = document.getElementById('chat-fab');
        const chatWidget = document.getElementById('chat-widget');
        const closeChatWidget = document.getElementById('close-chat-widget');
        const chatInput = document.getElementById('chat-input');
        const chatSend = document.getElementById('chat-send');
        const chatMessages = document.getElementById('chat-messages');
        const questionButtonsContainer = document.getElementById('chat-question-buttons');

        if (chatFab && chatWidget && closeChatWidget && chatInput && chatSend && chatMessages) {
            
                const normalizeInput = (text) => {
                    if (!text) return '';
                    // Normalize and remove diacritics (tildes) so 'menú' -> 'menu'
                    const normalized = text.normalize('NFD').replace(/\p{Diacritic}/gu, '');
                    return normalized.toLowerCase().replace(/[^\p{L}\p{N}\s]/gu, '').trim();
                };

            const getBotResponse = (userInput) => {
                const normalizedQuery = normalizeInput(userInput);
                if (normalizedQuery === 'salir' || normalizedQuery === 'adios') {
                    return 'SALIR_REQUEST';
                }
                if (normalizedQuery.includes('menu')) {
                    return 'MENU_REQUEST'; 
                }

                let bestMatch = { key: null, score: 0 };

                for (const key in KNOWLEDGE_BASE) {
                    const keyWords = key.split(' ');
                    let currentScore = 0;
                    keyWords.forEach(word => {
                        if (normalizedQuery.includes(word)) {
                            currentScore++;
                        }
                    });
                    
                    const scorePercentage = currentScore / keyWords.length;

                    if (scorePercentage > bestMatch.score) {
                        bestMatch = { key: key, score: scorePercentage };
                    }
                }

                if (bestMatch.score > 0.5) {
                    return KNOWLEDGE_BASE[bestMatch.key];
                }

                return "Disculpa, no entendí esa pregunta. Por favor, intenta reformularla o elige una de las opciones. Escribe 'menu' para ver las preguntas frecuentes.";
            };

            const appendMessage = (message, sender) => {
                const messageDiv = document.createElement('div');
                const bubbleClass = sender === 'user' ? 'bg-xlerion-deep-blue' : 'bg-gray-700';
                const justification = sender === 'user' ? 'justify-end' : 'justify-start';
                
                messageDiv.className = `flex ${justification} mb-4`;
                messageDiv.innerHTML = `<div class="${bubbleClass} text-white p-2 rounded-lg max-w-xs" style="word-break: break-word;"><p>${message}</p></div>`;
                chatMessages.appendChild(messageDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;
            };
            
            const createQuestionButtons = () => {
                const questions = {
                    "¿Qué es Xlerion?": "que es xlerion",
                    "Filosofía de Xlerion": "filosofia xlerion",
                    "¿Qué soluciones ofrecen?": "tipo soluciones",
                    "¿Cómo documentan?": "documentan soluciones",
                    "¿Quién es el fundador?": "quien fundador",
                    "Información de Contacto": "contacto informacion",
                    "Garantías Legales": "garantias legales",
                    "Acceder a Toolkits": "acceder toolkits"
                };
                
                questionButtonsContainer.innerHTML = ''; // Clear existing buttons
                Object.keys(questions).forEach(questionText => {
                    const button = document.createElement('button');
                    button.className = 'bg-gray-600 hover:bg-gray-500 text-white text-left text-sm py-2 px-3 rounded-lg transition-colors w-full';
                    button.textContent = questionText;
                    button.onclick = () => {
                        chatInput.value = questions[questionText];
                        sendMessage();
                    };
                    questionButtonsContainer.appendChild(button);
                });
                questionButtonsContainer.style.display = 'flex';
            };

            const toggleChat = () => {
                const isHidden = chatWidget.classList.contains('hidden');
                if (isHidden) {
                    createQuestionButtons();
                    chatWidget.style.display = 'flex';
                    chatWidget.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        chatWidget.style.opacity = '1';
                        chatWidget.style.transform = 'scale(1) translateY(0)';
                    });
                } else {
                    chatWidget.style.opacity = '0';
                    chatWidget.style.transform = 'scale(0.95) translateY(20px)';
                    setTimeout(() => {
                        chatWidget.classList.add('hidden');
                        chatWidget.style.display = '';
                    }, 200);
                }
            };

            const sendMessage = () => {
                const message = chatInput.value.trim();
                if (message === '') return;

                appendMessage(message, 'user');
                chatInput.value = '';
                
                const botResponse = getBotResponse(message);

                if (botResponse !== 'MENU_REQUEST' && questionButtonsContainer && questionButtonsContainer.style.display !== 'none') {
                    questionButtonsContainer.style.display = 'none';
                }

                setTimeout(() => {
                    if (botResponse === 'MENU_REQUEST') {
                        appendMessage("Aquí tienes algunas preguntas frecuentes:", 'bot');
                        createQuestionButtons();
                        // Asegurarse de que los botones estén visibles después de crearlos
                        if (questionButtonsContainer) {
                            questionButtonsContainer.style.display = 'flex';
                        }
                    } else if (botResponse === 'SALIR_REQUEST') {
                        appendMessage("¡Gracias por usar XBot! Hasta pronto.", 'bot');
                        setTimeout(toggleChat, 2000);
                    } else {
                        appendMessage(botResponse, 'bot');
                    }
                }, 800);
            };

            chatFab.addEventListener('click', toggleChat);
            closeChatWidget.addEventListener('click', toggleChat);
            chatSend.addEventListener('click', sendMessage);
            chatInput.addEventListener('keypress', (e) => {
                if (e.key === 'Enter') sendMessage();
            });
        }
    });
    </script>
    @endpush

    <main class="flex-grow">
        @yield('content')
    </main>

    <div class="laser-line"></div>
    @include('components.footer')
    @stack('scripts')

    <!-- Contenedor de FABs Flotantes (Lado Derecho) -->
    <div class="fixed top-1/2 -translate-y-1/2 right-0 z-50 flex flex-col space-y-4">
        <!-- Widget 1: Contacto WhatsApp -->
        <button 
            onclick="window.open('https://wa.me/573208605600', '_blank')"
            class="bg-xlerion-tech-bright-blue text-white flex items-center justify-center w-16 h-12 rounded-l-full shadow-lg hover:bg-xlerion-deep-blue focus:outline-none focus:ring-2 focus:ring-xlerion-tech-bright-blue focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:-translate-x-1"
            aria-label="Contactar por WhatsApp"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.894 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.886-.001 2.269.655 4.357 1.849 6.037l-1.092 3.996 4.042-1.052z"/>
            </svg>
        </button>

        <!-- Widget 2: Chat Automatizado -->
        <button 
            id="chat-fab"
            class="bg-xlerion-deep-blue text-white flex items-center justify-center w-16 h-12 rounded-l-full shadow-lg hover:bg-xlerion-tech-bright-blue focus:outline-none focus:ring-2 focus:ring-xlerion-deep-blue focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:-translate-x-1"
            aria-label="Abrir chat automatizado"
        >
            <i class="fa-solid fa-robot text-xl"></i>
        </button>

        <!-- Widget 3: Traducir Página -->
        <button 
            onclick="console.log('Acción ejecutada: Traducir Página')"
            class="bg-xlerion-tech-bright-blue text-white flex items-center justify-center w-16 h-12 rounded-l-full shadow-lg hover:bg-xlerion-deep-blue focus:outline-none focus:ring-2 focus:ring-xlerion-tech-bright-blue focus:ring-offset-2 transition-all duration-300 ease-in-out transform hover:-translate-x-1"
            aria-label="Traducir esta página"
        >
            <i class="fa-solid fa-language text-xl"></i>
        </button>
    </div>

    <!-- Chat Widget -->
    <div id="chat-widget" class="hidden fixed bottom-5 right-5 w-80 h-96 bg-gray-800 rounded-lg shadow-2xl z-50 transition-all duration-300 ease-in-out">
        <!-- Header -->
        <div class="bg-gray-700 p-3 flex justify-between items-center rounded-t-lg cursor-move">
            <h3 class="text-white font-semibold">Asistente Virtual</h3>
            <button id="close-chat-widget" class="text-gray-300 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <!-- Messages -->
        <div id="chat-messages" class="flex-1 p-4 overflow-y-auto">
            <!-- Bot message -->
            <div class="flex mb-4">
                <div class="bg-gray-700 text-white p-2 rounded-lg max-w-xs">
                    <p>¡Hola! Soy tu asistente virtual. ¿En qué puedo ayudarte?</p>
                </div>
            </div>
            <div id="chat-question-buttons" class="flex flex-col gap-2 mb-4 items-stretch">
                <!-- Quick question buttons will be injected here -->
            </div>
        </div>
        <!-- Input -->
        <div class="p-3 bg-gray-700 rounded-b-lg">
            <div class="flex">
                <input type="text" id="chat-input" placeholder="Escribe un mensaje..." class="flex-1 p-2 rounded-l-md bg-gray-600 text-white border-gray-500 focus:outline-none focus:ring-2 focus:ring-xlerion-deep-blue">
                <button id="chat-send" class="bg-xlerion-deep-blue text-white px-4 rounded-r-md hover:bg-xlerion-tech-bright-blue">Enviar</button>
            </div>
        </div>
    </div>
</body>
</html>