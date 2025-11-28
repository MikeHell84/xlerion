// --- Datos de Traducción y Modales ---
const translations = {
    es: {
        // Navegación
        nav_solutions: "Soluciones",
        nav_product: "Producto",
        nav_differentiators: "Diferenciales",
        nav_roadmap: "Hoja de Ruta",
        nav_total_darkness: "Total Darkness",
        nav_contact: "Contacto",
        nav_solutions_mobile: "Soluciones",
        nav_product_mobile: "Producto",
        nav_differentiators_mobile: "Diferenciales",
        nav_roadmap_mobile: "Hoja de Ruta",
        nav_total_darkness_mobile: "Total Darkness",
        nav_contact_mobile: "Contacto",
        hero_title: "La <span class='gradient-text'>Diversidad Cognitiva</span> Construye la Mejor Ingeniería.",
        hero_subtitle: "Aprovechamos perspectivas únicas para construir toolkits modulares que optimizan, diagnostican y automatizan los entornos técnicos más complejos.",
        hero_button: "Explorar Soluciones",
        solutions_title: "Un Ecosistema de Soluciones",
        solutions_subtitle: "Más que herramientas, ofrecemos un sistema integrado de servicios. Haz clic en cada nodo para explorar cómo podemos ayudarte.",
        infographic_core: "Xlerion",
        infographic_node1_title: "Arquitectura",
        infographic_node2_title: "Rendimiento",
        infographic_node3_title: "Automatización",
        infographic_node4_title: "Seguridad",
        product_title: "Nuestro Producto: <span class='gradient-text'>Xlerion Toolkit</span>",
        product_subtitle: "Una solución integral que combina modularidad, autonomía y comportamiento adaptativo.",
        product_feature1_title: "Filosofía Modular",
        product_feature1_desc: "Cada componente es independiente y se integra fluidamente, permitiendo soluciones personalizadas.",
        product_feature2_title: "Autonomía Inteligente",
        product_feature2_desc: "Las herramientas se adaptan y resuelven problemas de forma proactiva, sin intervención constante.",
        product_feature3_title: "Comportamiento Adaptativo",
        product_feature3_desc: "El sistema evoluciona y mejora su funcionalidad basándose en datos del entorno.",
        differentiators_title: "Lo que nos Hace Diferentes",
        differentiators_subtitle: "Nuestra metodología se basa en la co-creación y la mejora continua, no solo en la tecnología.",
        differentiators_feature1_title: "Enfoque Humano",
        differentiators_feature1_desc: "Diseñamos soluciones que se integran con los flujos de trabajo existentes para potenciar a los equipos.",
        differentiators_feature2_title: "Adaptabilidad Disruptiva",
        differentiators_feature2_desc: "Nuestras herramientas no solo resuelven problemas, sino que anticipan las necesidades futuras.",
        roadmap_title: "Hoja de Ruta y Evolución",
        roadmap_subtitle: "Un vistazo a nuestro pasado y a lo que el futuro nos depara.",
        roadmap_item1_title: "Primeras Implementaciones",
        roadmap_item1_desc: "Lanzamiento de las primeras herramientas modulares y casos de uso iniciales.",
        roadmap_item2_title: "Crecimiento del Ecosistema",
        roadmap_item2_desc: "Expansión de la suite de productos y asociaciones estratégicas.",
        roadmap_item3_title: "Reconocimiento a la Innovación",
        roadmap_item3_desc: "Posicionamiento en el mercado y premios por soluciones disruptivas.",
        roadmap_item4_title: "El Futuro con IA",
        roadmap_item4_desc: "Integración de capacidades de IA y aprendizaje automático en el toolkit.",
        darkness_title: "Entendiendo <span class='gradient-text'>Total Darkness</span>",
        darkness_subtitle: "Total Darkness es nuestra iniciativa para operar en los entornos técnicos más desafiantes.",
        darkness_item1: "Diagnóstico en sistemas legados y opacos.",
        darkness_item2: "Automatización en redes de alta latencia.",
        darkness_item3: "Resiliencia ante fallas de infraestructura.",
        darkness_button1: "Saber Más",
        darkness_button2: "Descargar Whitepaper",
        contact_title: "Contáctanos",
        contact_subtitle: "Estamos listos para ayudarte a construir el futuro de tus soluciones.",
        footer_copyright: "&copy; 2025 Xlerion – Soluciones Disruptivas. Todos los derechos reservados.",
        footer_location: "Nocaima, Cundinamarca, Colombia",
        footer_legal: "Aviso Legal",
        footer_privacy: "Política de Privacidad",
        
        // Modales de Soluciones
        modal_arquitectura_title: "Arquitectura de Sistemas y Microservicios",
        modal_arquitectura_desc: "Diseñamos la base de tu infraestructura con un enfoque en la escalabilidad, la resiliencia y el mantenimiento. Construimos sistemas robustos y eficientes, listos para cualquier desafío.",
        modal_arquitectura_details: [
            "Análisis de requisitos y diseño de arquitectura.",
            "Implementación de microservicios y contenedores (Docker, Kubernetes).",
            "Monitoreo y optimización continua de la arquitectura."
        ],
        modal_arquitectura_reel_title: "Casos de Éxito",
        modal_arquitectura_reel_item1: "E-commerce de alto tráfico",
        modal_arquitectura_reel_item2: "Plataforma IoT de datos masivos",
        modal_arquitectura_reel_item3: "Sistema bancario en la nube",
        
        modal_rendimiento_title: "Optimización de Rendimiento",
        modal_rendimiento_desc: "Identificamos y eliminamos cuellos de botella en tus aplicaciones, bases de datos y redes. Nuestra meta es maximizar la velocidad y la eficiencia, garantizando una experiencia de usuario fluida.",
        modal_rendimiento_details: [
            "Auditoría de rendimiento de aplicaciones.",
            "Ajuste de bases de datos y consultas.",
            "Estrategias de caching y CDN."
        ],
        modal_rendimiento_reel_title: "Resultados",
        modal_rendimiento_reel_item1: "Reducción de latencia 40%",
        modal_rendimiento_reel_item2: "Aumento de usuarios simultáneos",
        modal_rendimiento_reel_item3: "Mejora en tiempo de carga",

        modal_automatizacion_title: "Automatización de Procesos y DevOps",
        modal_automatizacion_desc: "Desde la integración continua hasta el despliegue automático, agilizamos tus flujos de trabajo. Nuestra automatización libera a tus equipos para que se centren en la innovación y el desarrollo, no en tareas repetitivas.",
        modal_automatizacion_details: [
            "Configuración de CI/CD (GitLab, Jenkins).",
            "Automatización de pruebas y despliegues.",
            "Gestión de infraestructura como código (Terraform)."
        ],
        modal_automatizacion_reel_title: "Herramientas",
        modal_automatizacion_reel_item1: "Jenkins Pipeline",
        modal_automatizacion_reel_item2: "Terraform",
        modal_automatizacion_reel_item3: "Ansible",
        
        modal_seguridad_title: "Ciberseguridad y Resiliencia",
        modal_seguridad_desc: "Protegemos tus activos digitales con soluciones de seguridad proactivas y reactivas. Implementamos defensas robustas para detectar y mitigar amenazas antes de que comprometan tus operaciones.",
        modal_seguridad_details: [
            "Auditorías de seguridad y pentesting.",
            "Implementación de WAF y firewalls.",
            "Planes de respuesta a incidentes."
        ],
        modal_seguridad_reel_title: "Certificaciones",
        modal_seguridad_reel_item1: "ISO 27001 Compliance",
        modal_seguridad_reel_item2: "Cloud Security",
        modal_seguridad_reel_item3: "Red Team Exercises",
        
        // Modales de Producto
        modal_filosofia_modular_title: "Nuestra Filosofía Modular",
        modal_filosofia_modular_desc: "Creemos en la libertad de elección y la flexibilidad. Por eso, cada componente de nuestro toolkit funciona de manera independiente, permitiéndote construir la solución que necesitas, sin sobrecargas.",
        modal_filosofia_modular_details: [
            "Componentes desacoplados para una fácil integración.",
            "Arquitectura basada en plugins y microservicios.",
            "Flexibilidad para escalar solo lo que necesitas."
        ],
        modal_filosofia_modular_reel_title: "Módulos Disponibles",
        modal_filosofia_modular_reel_item1: "Módulo de Monitoreo",
        modal_filosofia_modular_reel_item2: "Módulo de Diagnóstico",
        modal_filosofia_modular_reel_item3: "Módulo de Automatización",
        
        modal_autonomia_inteligente_title: "Autonomía Inteligente",
        modal_autonomia_inteligente_desc: "Nuestras herramientas no solo ejecutan tareas, sino que también toman decisiones. Utilizan algoritmos de IA para aprender de tu entorno, predecir problemas y actuar de forma proactiva.",
        modal_autonomia_inteligente_details: [
            "Aprendizaje automático para optimización.",
            "Resolución proactiva de problemas.",
            "Adaptación automática a cambios de infraestructura."
        ],
        modal_autonomia_inteligente_reel_title: "Aplicaciones",
        modal_autonomia_inteligente_reel_item1: "Detección de Anomalías",
        modal_autonomia_inteligente_reel_item2: "Optimización de Cargas",
        modal_autonomia_inteligente_reel_item3: "Planificación Predictiva",

        modal_comportamiento_adaptativo_title: "Comportamiento Adaptativo",
        modal_comportamiento_adaptativo_desc: "El Xlerion Toolkit está diseñado para evolucionar contigo. Se ajusta dinámicamente a nuevas infraestructuras, tecnologías emergentes y tus cambiantes necesidades de negocio.",
        modal_comportamiento_adaptativo_details: [
            "Integración fluida con nuevas tecnologías.",
            "Configuraciones que se auto-ajustan.",
            "Mapeo dinámico del ecosistema técnico."
        ],
        modal_comportamiento_adaptativo_reel_title: "Demo en Vivo",
        modal_comportamiento_adaptativo_reel_item1: "Ver demo de auto-escalado",
        modal_comportamiento_adaptativo_reel_item2: "Ver demo de auto-reparación",
        modal_comportamiento_adaptativo_reel_item3: "Ver demo de auto-diagnóstico",
        
        // Modales de Diferenciales
        modal_enfoque_humano_title: "Nuestro Enfoque Humano",
        modal_enfoque_humano_desc: "Las mejores soluciones tecnológicas potencian a las personas. Por eso, diseñamos nuestras herramientas para que sean intuitivas y se integren perfectamente con los flujos de trabajo de tus equipos.",
        modal_enfoque_humano_details: [
            "Interfaz de usuario centrada en el desarrollador.",
            "Flujos de trabajo colaborativos.",
            "Capacitación y soporte para equipos."
        ],
        modal_enfoque_humano_reel_title: "Testimonios",
        modal_enfoque_humano_reel_item1: "Equipo A: Más productividad",
        modal_enfoque_humano_reel_item2: "Equipo B: Menos errores",
        modal_enfoque_humano_reel_item3: "Equipo C: Mayor innovación",
        
        modal_adaptabilidad_disruptiva_title: "Adaptabilidad Disruptiva",
        modal_adaptabilidad_disruptiva_desc: "No solo nos adaptamos, sino que anticipamos. Construimos soluciones que te preparan para el futuro, permitiéndote innovar más rápido y mantener una ventaja competitiva.",
        modal_adaptabilidad_disruptiva_details: [
            "Estrategias de 'shift-left' en seguridad y calidad.",
            "Integración de tecnologías emergentes.",
            "Plataforma a prueba de futuro."
        ],
        modal_adaptabilidad_disruptiva_reel_title: "Innovación",
        modal_adaptabilidad_disruptiva_reel_item1: "Publicaciones de I+D",
        modal_adaptabilidad_disruptiva_reel_item2: "Patentes de Tecnología",
        modal_adaptabilidad_disruptiva_reel_item3: "Conferencias de Vanguardia",

        // Modales de la Hoja de Ruta
        modal_primeras_implementaciones_title: "Primeras Implementaciones",
        modal_primeras_implementaciones_desc: "Lanzamos las primeras herramientas modulares, enfocadas en la optimización de servidores y el diagnóstico de redes. Estos casos de uso iniciales sentaron las bases de nuestra filosofía de producto.",
        modal_primeras_implementaciones_details: [
            "Lanzamiento de Xlerion Core.",
            "Primeros 100 clientes Beta.",
            "Recopilación de feedback inicial."
        ],
        modal_primeras_implementaciones_reel_title: "Hitos",
        modal_primeras_implementaciones_reel_item1: "Presentación en Startup Showcase",
        modal_primeras_implementaciones_reel_item2: "Primera ronda de inversión",
        modal_primeras_implementaciones_reel_item3: "Publicación de 'Principios del Toolkit'",

        modal_crecimiento_ecosistema_title: "Crecimiento del Ecosistema",
        modal_crecimiento_ecosistema_desc: "Expandimos nuestra suite de productos para incluir módulos de seguridad y automatización. Además, establecimos asociaciones clave con proveedores de la nube y empresas de tecnología para potenciar nuestra oferta.",
        modal_crecimiento_ecosistema_details: [
            "Lanzamiento de módulos de seguridad.",
            "Asociaciones con AWS y Google Cloud.",
            "Expansión a nuevos mercados."
        ],
        modal_crecimiento_ecosistema_reel_title: "Partners",
        modal_crecimiento_ecosistema_reel_item1: "AWS Advanced Partner",
        modal_crecimiento_ecosistema_reel_item2: "Google Cloud Ready",
        modal_crecimiento_ecosistema_reel_item3: "Certificación de seguridad",

        modal_reconocimiento_innovacion_title: "Reconocimiento a la Innovación",
        modal_reconocimiento_desc: "Nuestras soluciones disruptivas comenzaron a ser reconocidas por la industria. Obtuvimos premios y menciones por nuestra aproximación única a la ingeniería y la diversidad cognitiva.",
        modal_reconocimiento_details: [
            "Premio a la innovación tecnológica.",
            "Mención en revista de tecnología líder.",
            "Participación en conferencias globales."
        ],
        modal_reconocimiento_reel_title: "Reconocimientos",
        modal_reconocimiento_reel_item1: "Innovation Award",
        modal_reconocimiento_reel_item2: "Branding",
        modal_reconocimiento_reel_item3: "Community",

        modal_futuro_ia_title: "El Futuro con IA",
        modal_futuro_ia_desc: "Estamos integrando IA y aprendizaje automático en el corazón de nuestro toolkit para predecir, diagnosticar y resolver problemas de forma autónoma, llevando la ingeniería al siguiente nivel.",
        modal_futuro_ia_details: [
            "Desarrollo de motor de predicción.",
            "Integración de modelos de IA generativa.",
            "Herramientas de auto-reparación basadas en IA."
        ],
        modal_futuro_ia_reel_title: "Conceptos Futuros",
        modal_futuro_ia_reel_item1: "Auto-reparación",
        modal_futuro_ia_reel_item2: "Análisis predictivo",
        modal_futuro_ia_reel_item3: "Asistente de IA"
    },
    
    en: {
        // Navigation
        nav_solutions: "Solutions",
        nav_product: "Product",
        nav_differentiators: "Differentiators",
        nav_roadmap: "Roadmap",
        nav_total_darkness: "Total Darkness",
        nav_contact: "Contact",
        nav_solutions_mobile: "Solutions",
        nav_product_mobile: "Product",
        nav_differentiators_mobile: "Differentiators",
        nav_roadmap_mobile: "Roadmap",
        nav_total_darkness_mobile: "Total Darkness",
        nav_contact_mobile: "Contact",
        hero_title: "Cognitive <span class='gradient-text'>Diversity</span> Builds the Best Engineering.",
        hero_subtitle: "We leverage unique perspectives to build modular toolkits that optimize, diagnose, and automate the most complex technical environments.",
        hero_button: "Explore Solutions",
        solutions_title: "A Solutions Ecosystem",
        solutions_subtitle: "More than tools, we offer an integrated system of services. Click on each node to explore how we can help you.",
        infographic_core: "Xlerion",
        infographic_node1_title: "Architecture",
        infographic_node2_title: "Performance",
        infographic_node3_title: "Automation",
        infographic_node4_title: "Security",
        product_title: "Our Product: <span class='gradient-text'>Xlerion Toolkit</span>",
        product_subtitle: "A comprehensive solution combining modularity, autonomy, and adaptive behavior.",
        product_feature1_title: "Modular Philosophy",
        product_feature1_desc: "Each component is independent and integrates seamlessly, allowing for personalized solutions.",
        product_feature2_title: "Smart Autonomy",
        product_feature2_desc: "The tools adapt and proactively solve problems without constant intervention.",
        product_feature3_title: "Adaptive Behavior",
        product_feature3_desc: "The system evolves and improves its functionality based on environmental data.",
        differentiators_title: "What Makes Us Different",
        differentiators_subtitle: "Our methodology is based on co-creation and continuous improvement, not just on technology.",
        differentiators_feature1_title: "Human-Centric Approach",
        differentiators_feature1_desc: "We design solutions that integrate with existing workflows to empower your teams.",
        differentiators_feature2_title: "Disruptive Adaptability",
        differentiators_feature2_desc: "Our tools not only solve problems but also anticipate future needs.",
        roadmap_title: "Roadmap and Evolution",
        roadmap_subtitle: "A look at our past and what the future holds.",
        roadmap_item1_title: "Initial Implementations",
        roadmap_item1_desc: "Launch of the first modular tools and initial use cases.",
        roadmap_item2_title: "Ecosystem Growth",
        roadmap_item2_desc: "Expansion of the product suite and strategic partnerships.",
        roadmap_item3_title: "Innovation Recognition",
        roadmap_item3_desc: "Market positioning and awards for disruptive solutions.",
        roadmap_item4_title: "The Future with AI",
        roadmap_item4_desc: "Integration of AI and machine learning capabilities into the toolkit.",
        darkness_title: "Understanding <span class='gradient-text'>Total Darkness</span>",
        darkness_subtitle: "Total Darkness is our initiative to operate in the most challenging technical environments.",
        darkness_item1: "Diagnosis in legacy and opaque systems.",
        darkness_item2: "Automation in high-latency networks.",
        darkness_item3: "Resilience to infrastructure failures.",
        darkness_button1: "Learn More",
        darkness_button2: "Download Whitepaper",
        contact_title: "Contact Us",
        contact_subtitle: "We are ready to help you build the future of your solutions.",
        footer_copyright: "&copy; 2025 Xlerion – Disruptive Solutions. All rights reserved.",
        footer_location: "Nocaima, Cundinamarca, Colombia",
        footer_legal: "Legal Notice",
        footer_privacy: "Privacy Policy",
        
        // Solutions Modals
        modal_arquitectura_title: "Systems and Microservices Architecture",
        modal_arquitectura_desc: "We design the foundation of your infrastructure with a focus on scalability, resilience, and maintenance. We build robust and efficient systems, ready for any challenge.",
        modal_arquitectura_details: [
            "Requirements analysis and architecture design.",
            "Implementation of microservices and containers (Docker, Kubernetes).",
            "Continuous monitoring and optimization of the architecture."
        ],
        modal_arquitectura_reel_title: "Success Stories",
        modal_arquitectura_reel_item1: "High-traffic E-commerce",
        modal_arquitectura_reel_item2: "Massive IoT data platform",
        modal_arquitectura_reel_item3: "Cloud banking system",
        
        modal_rendimiento_title: "Performance Optimization",
        modal_rendimiento_desc: "We identify and eliminate bottlenecks in your applications, databases, and networks. Our goal is to maximize speed and efficiency, ensuring a fluid user experience.",
        modal_rendimiento_details: [
            "Application performance auditing.",
            "Database and query tuning.",
            "Caching and CDN strategies."
        ],
        modal_rendimiento_reel_title: "Results",
        modal_rendimiento_reel_item1: "40% latency reduction",
        modal_rendimiento_reel_item2: "Increase in concurrent users",
        modal_rendimiento_reel_item3: "Improved load time",

        modal_automatizacion_title: "Process Automation and DevOps",
        modal_automatizacion_desc: "From continuous integration to automatic deployment, we streamline your workflows. Our automation frees your teams to focus on innovation and development, not repetitive tasks.",
        modal_automatizacion_details: [
            "CI/CD setup (GitLab, Jenkins).",
            "Test and deployment automation.",
            "Infrastructure as code management (Terraform)."
        ],
        modal_automatizacion_reel_title: "Tools",
        modal_automatizacion_reel_item1: "Jenkins Pipeline",
        modal_automatizacion_reel_item2: "Terraform",
        modal_automatizacion_reel_item3: "Ansible",
        
        modal_seguridad_title: "Cybersecurity and Resilience",
        modal_seguridad_desc: "We protect your digital assets with proactive and reactive security solutions. We implement robust defenses to detect and mitigate threats before they compromise your operations.",
        modal_seguridad_details: [
            "Security audits and pentesting.",
            "WAF and firewall implementation.",
            "Incident response plans."
        ],
        modal_seguridad_reel_title: "Certifications",
        modal_seguridad_reel_item1: "ISO 27001 Compliance",
        modal_seguridad_reel_item2: "Cloud Security",
        modal_seguridad_reel_item3: "Red Team Exercises",
        
        // Product Modals
        modal_filosofia_modular_title: "Our Modular Philosophy",
        modal_filosofia_modular_desc: "We believe in freedom of choice and flexibility. That's why each component of our toolkit works independently, allowing you to build the solution you need without bloat.",
        modal_filosofia_modular_details: [
            "Decoupled components for easy integration.",
            "Plugin and microservices based architecture.",
            "Flexibility to scale only what you need."
        ],
        modal_filosofia_modular_reel_title: "Available Modules",
        modal_filosofia_modular_reel_item1: "Monitoring Module",
        modal_filosofia_modular_reel_item2: "Diagnostic Module",
        modal_filosofia_modular_reel_item3: "Automation Module",
        
        modal_autonomia_inteligente_title: "Smart Autonomy",
        modal_autonomia_inteligente_desc: "Our tools not only execute tasks, but also make decisions. They use AI algorithms to learn from your environment, predict problems, and act proactively.",
        modal_autonomia_inteligente_details: [
            "Machine learning for optimization.",
            "Proactive problem solving.",
            "Automatic adaptation to infrastructure changes."
        ],
        modal_autonomia_inteligente_reel_title: "Applications",
        modal_autonomia_inteligente_reel_item1: "Anomaly Detection",
        modal_autonomia_inteligente_reel_item2: "Load Optimization",
        modal_autonomia_inteligente_reel_item3: "Predictive Planning",

        modal_comportamiento_adaptativo_title: "Adaptive Behavior",
        modal_comportamiento_adaptativo_desc: "The Xlerion Toolkit is designed to evolve with you. It dynamically adjusts to new infrastructures, emerging technologies, and your changing business needs.",
        modal_comportamiento_adaptativo_details: [
            "Seamless integration with new technologies.",
            "Self-adjusting configurations.",
            "Dynamic mapping of the technical ecosystem."
        ],
        modal_comportamiento_adaptativo_reel_title: "Live Demo",
        modal_comportamiento_adaptativo_reel_item1: "View auto-scaling demo",
        modal_comportamiento_adaptativo_reel_item2: "View self-healing demo",
        modal_comportamiento_adaptativo_reel_item3: "View self-diagnostics demo",
        
        // Differentiators Modals
        modal_enfoque_humano_title: "Our Human-Centric Approach",
        modal_enfoque_humano_desc: "The best technological solutions empower people. That's why we design our tools to be intuitive and to integrate perfectly with your teams' workflows.",
        modal_enfoque_humano_details: [
            "Developer-centric user interface.",
            "Collaborative workflows.",
            "Team training and support."
        ],
        modal_enfoque_humano_reel_title: "Testimonials",
        modal_enfoque_humano_reel_item1: "Team A: Increased productivity",
        modal_enfoque_humano_reel_item2: "Team B: Fewer errors",
        modal_enfoque_humano_reel_item3: "Team C: Greater innovation",
        
        modal_adaptabilidad_disruptiva_title: "Disruptive Adaptability",
        modal_adaptabilidad_disruptiva_desc: "We don't just adapt, we anticipate. We build solutions that prepare you for the future, allowing you to innovate faster and maintain a competitive edge.",
        modal_adaptabilidad_disruptiva_details: [
            "Shift-left strategies in security and quality.",
            "Integration of emerging technologies.",
            "Future-proof platform."
        ],
        modal_adaptabilidad_disruptiva_reel_title: "Innovation",
        modal_adaptabilidad_disruptiva_reel_item1: "R&D Publications",
        modal_adaptabilidad_disruptiva_reel_item2: "Technology Patents",
        modal_adaptabilidad_disruptiva_reel_item3: "Cutting-Edge Conferences",

        // Roadmap Modals
        modal_primeras_implementaciones_title: "Initial Implementations",
        modal_primeras_implementaciones_desc: "We launched the first modular tools, focused on server optimization and network diagnostics. These initial use cases laid the foundation for our product philosophy.",
        modal_primeras_implementaciones_details: [
            "Launch of Xlerion Core.",
            "First 100 Beta clients.",
            "Initial feedback collection."
        ],
        modal_primeras_implementaciones_reel_title: "Milestones",
        modal_primeras_implementaciones_reel_item1: "Presentation at Startup Showcase",
        modal_primeras_implementaciones_reel_item2: "First round of investment",
        modal_primeras_implementaciones_reel_item3: "Publication of 'Toolkit Principles'",

        modal_crecimiento_ecosistema_title: "Ecosystem Growth",
        modal_crecimiento_ecosistema_desc: "We expanded our product suite to include security and automation modules. We also established key partnerships with cloud providers and technology companies to enhance our offering.",
        modal_crecimiento_ecosistema_details: [
            "Launch of security modules.",
            "Partnerships with AWS and Google Cloud.",
            "Expansion into new markets."
        ],
        modal_crecimiento_ecosistema_reel_title: "Partners",
        modal_crecimiento_ecosistema_reel_item1: "AWS Advanced Partner",
        modal_crecimiento_ecosistema_reel_item2: "Google Cloud Ready",
        modal_crecimiento_ecosistema_reel_item3: "Security Certification",

        modal_reconocimiento_innovacion_title: "Innovation Recognition",
        modal_reconocimiento_desc: "Our disruptive solutions began to be recognized by the industry. We received awards and mentions for our unique approach to engineering and cognitive diversity.",
        modal_reconocimiento_details: [
            "Technology innovation award.",
            "Mention in a leading tech magazine.",
            "Participation in global conferences."
        ],
        modal_reconocimiento_reel_title: "Acknowledgements",
        modal_reconocimiento_reel_item1: "Innovation Award",
        modal_reconocimiento_reel_item2: "Branding",
        modal_reconocimiento_reel_item3: "Community",

        modal_futuro_ia_title: "The Future with AI",
        modal_futuro_ia_desc: "We are integrating AI and machine learning at the core of our toolkit to predict, diagnose, and solve problems autonomously, taking engineering to the next level.",
        modal_futuro_ia_details: [
            "Development of a predictive engine.",
            "Integration of generative AI models.",
            "AI-powered self-healing tools."
        ],
        modal_futuro_ia_reel_title: "Future Concepts",
        modal_futuro_ia_reel_item1: "Self-healing",
        modal_futuro_ia_reel_item2: "Predictive analysis",
        modal_futuro_ia_reel_item3: "AI assistant"
    }
};

const modalContent = {
    'arquitectura-sistemas': { titleKey: 'modal_arquitectura_title', descriptionKey: 'modal_arquitectura_desc', detailsKey: 'modal_arquitectura_details', reelTitleKey: 'modal_arquitectura_reel_title', reelContent: [ { type: 'image', textKey: 'modal_arquitectura_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=E-commerce' }, { type: 'image', textKey: 'modal_arquitectura_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=IoT+Platform' }, { type: 'image', textKey: 'modal_arquitectura_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Cloud+System' } ] },
    'optimizacion-rendimiento': { titleKey: 'modal_rendimiento_title', descriptionKey: 'modal_rendimiento_desc', detailsKey: 'modal_rendimiento_details', reelTitleKey: 'modal_rendimiento_reel_title', reelContent: [ { type: 'image', textKey: 'modal_rendimiento_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Latency+Reduction' }, { type: 'image', textKey: 'modal_rendimiento_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Users+Increase' }, { type: 'image', textKey: 'modal_rendimiento_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Load+Time' } ] },
    'automatizacion-procesos': { titleKey: 'modal_automatizacion_title', descriptionKey: 'modal_automatizacion_desc', detailsKey: 'modal_automatizacion_details', reelTitleKey: 'modal_automatizacion_reel_title', reelContent: [ { type: 'image', textKey: 'modal_automatizacion_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Jenkins' }, { type: 'image', textKey: 'modal_automatizacion_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Terraform' }, { type: 'image', textKey: 'modal_automatizacion_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Ansible' } ] },
    'seguridad-cibernetica': { titleKey: 'modal_seguridad_title', descriptionKey: 'modal_seguridad_desc', detailsKey: 'modal_seguridad_details', reelTitleKey: 'modal_seguridad_reel_title', reelContent: [ { type: 'image', textKey: 'modal_seguridad_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Compliance' }, { type: 'image', textKey: 'modal_seguridad_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Cloud+Security' }, { type: 'image', textKey: 'modal_seguridad_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Red+Team' } ] },
    'filosofia-modular': { titleKey: 'modal_filosofia_modular_title', descriptionKey: 'modal_filosofia_modular_desc', detailsKey: 'modal_filosofia_modular_details', reelTitleKey: 'modal_filosofia_modular_reel_title', reelContent: [ { type: 'link', textKey: 'modal_filosofia_modular_reel_item1', url: '#' }, { type: 'link', textKey: 'modal_filosofia_modular_reel_item2', url: '#' }, { type: 'link', textKey: 'modal_filosofia_modular_reel_item3', url: '#' } ] },
    'autonomia-inteligente': { titleKey: 'modal_autonomia_inteligente_title', descriptionKey: 'modal_autonomia_inteligente_desc', detailsKey: 'modal_autonomia_inteligente_details', reelTitleKey: 'modal_autonomia_inteligente_reel_title', reelContent: [ { type: 'image', textKey: 'modal_autonomia_inteligente_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Anomaly+Detection' }, { type: 'image', textKey: 'modal_autonomia_inteligente_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Load+Optimization' }, { type: 'image', textKey: 'modal_autonomia_inteligente_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Predictive+Planning' } ] },
    'comportamiento-adaptativo': { titleKey: 'modal_comportamiento_adaptativo_title', descriptionKey: 'modal_comportamiento_adaptativo_desc', detailsKey: 'modal_comportamiento_adaptativo_details', reelTitleKey: 'modal_comportamiento_adaptativo_reel_title', reelContent: [ { type: 'link', textKey: 'modal_comportamiento_adaptativo_reel_item1', url: '#' }, { type: 'link', textKey: 'modal_comportamiento_adaptativo_reel_item2', url: '#' }, { type: 'link', textKey: 'modal_comportamiento_adaptativo_reel_item3', url: '#' } ] },
    'enfoque-humano': { titleKey: 'modal_enfoque_humano_title', descriptionKey: 'modal_enfoque_humano_desc', detailsKey: 'modal_enfoque_humano_details', reelTitleKey: 'modal_enfoque_humano_reel_title', reelContent: [ { type: 'image', textKey: 'modal_enfoque_humano_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Productivity' }, { type: 'image', textKey: 'modal_enfoque_humano_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Fewer+Errors' }, { type: 'image', textKey: 'modal_enfoque_humano_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Innovation' } ] },
    'adaptabilidad-disruptiva': { titleKey: 'modal_adaptabilidad_disruptiva_title', descriptionKey: 'modal_adaptabilidad_disruptiva_desc', detailsKey: 'modal_adaptabilidad_disruptiva_details', reelTitleKey: 'modal_adaptabilidad_disruptiva_reel_title', reelContent: [ { type: 'image', textKey: 'modal_adaptabilidad_disruptiva_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=R%26D' }, { type: 'image', textKey: 'modal_adaptabilidad_disruptiva_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Patents' }, { type: 'image', textKey: 'modal_adaptabilidad_disruptiva_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Conferences' } ] },
    'primeras-implementaciones': { titleKey: 'modal_primeras_implementaciones_title', descriptionKey: 'modal_primeras_implementaciones_desc', detailsKey: 'modal_primeras_implementaciones_details', reelTitleKey: 'modal_primeras_implementaciones_reel_title', reelContent: [ { type: 'link', textKey: 'modal_primeras_implementaciones_reel_item1', url: '#' }, { type: 'link', textKey: 'modal_primeras_implementaciones_reel_item2', url: '#' }, { type: 'link', textKey: 'modal_primeras_implementaciones_reel_item3', url: '#' } ] },
    'crecimiento-ecosistema': { titleKey: 'modal_crecimiento_ecosistema_title', descriptionKey: 'modal_crecimiento_ecosistema_desc', detailsKey: 'modal_crecimiento_ecosistema_details', reelTitleKey: 'modal_crecimiento_ecosistema_reel_title', reelContent: [ { type: 'image', textKey: 'modal_crecimiento_ecosistema_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=AWS' }, { type: 'image', textKey: 'modal_crecimiento_ecosistema_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=GCP' }, { type: 'image', textKey: 'modal_crecimiento_ecosistema_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Security' } ] },
    'reconocimiento-innovacion': { titleKey: 'modal_reconocimiento_title', descriptionKey: 'modal_reconocimiento_desc', detailsKey: 'modal_reconocimiento_details', reelTitleKey: 'modal_reconocimiento_reel_title', reelContent: [ { type: 'image', textKey: 'modal_reconocimiento_reel_item1', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Innovation+Award' }, { type: 'image', textKey: 'modal_reconocimiento_reel_item2', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Branding' }, { type: 'image', textKey: 'modal_reconocimiento_reel_item3', src: 'https://placehold.co/600x400/0f172a/38bdf8?text=Community' } ] },
    'futuro-ia': { titleKey: 'modal_futuro_ia_title', descriptionKey: 'modal_futuro_ia_desc', detailsKey: 'modal_futuro_ia_details', reelTitleKey: 'modal_futuro_ia_reel_title', reelContent: [ { type: 'link', textKey: 'modal_futuro_ia_reel_item1', url: '#' }, { type: 'link', textKey: 'modal_futuro_ia_reel_item2', url: '#' }, { type: 'link', textKey: 'modal_futuro_ia_reel_item3', url: '#' } ] }
};
