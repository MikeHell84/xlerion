import * as THREE from 'https://cdn.jsdelivr.net/npm/three@0.147.0/build/three.module.js';
import { FontLoader } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/loaders/FontLoader.js';
import { TextGeometry } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/geometries/TextGeometry.js';
import { EffectComposer } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/postprocessing/EffectComposer.js';
import { RenderPass } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/postprocessing/RenderPass.js';
import { UnrealBloomPass } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/postprocessing/UnrealBloomPass.js';
import { OutputPass } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/postprocessing/OutputPass.js';
import { MeshSurfaceSampler } from 'https://cdn.jsdelivr.net/npm/three@0.147.0/examples/jsm/math/MeshSurfaceSampler.js';

// --- Global variables for the animation ---
let scene, camera, renderer, particles, composer;
let nodes, traces; // Elements for the circuit effect
let clock = new THREE.Clock();
const particleCount = 20000; // Reduced for better performance with lines
let font;

let currentPattern = 0;
let targetPositions = {};
let animationSequence = [];

let isTransitioning = false;
let transitionProgress = 0;
const transitionSpeed = 0.02;

const colorPalettes = [
    [new THREE.Color(0x38bdf8), new THREE.Color(0x6366f1)], // X
    [new THREE.Color(0x4ade80), new THREE.Color(0x22c55e)], // L
    [new THREE.Color(0xfacc15), new THREE.Color(0xf97316)], // E
    [new THREE.Color(0xf43f5e), new THREE.Color(0xec4899)], // R
    [new THREE.Color(0x06b6d4), new THREE.Color(0x0891b2)], // I
    [new THREE.Color(0x34d399), new THREE.Color(0x10b981)], // O
    [new THREE.Color(0x8b5cf6), new THREE.Color(0x6d28d9)], // N
    [new THREE.Color(0xef4444), new THREE.Color(0xdc2626)], // Circle
];

// Reutilizable MeshSurfaceSampler
let sampler;

// --- Funciones para la animación de las partículas ---

/**
 * Creates the particles with a geometry and a material.
 */
function createParticleSystem() {
    const geometry = new THREE.BufferGeometry();
    const positions = new Float32Array(particleCount * 3);
    const colors = new Float32Array(particleCount * 3);
    const sizes = new Float32Array(particleCount);

    for (let i = 0; i < particleCount; i++) {
        // Initial positions (random in a sphere)
        const x = (Math.random() - 0.5) * 200;
        const y = (Math.random() - 0.5) * 200;
        const z = (Math.random() - 0.5) * 200;
        positions[i * 3] = x;
        positions[i * 3 + 1] = y;
        positions[i * 3 + 2] = z;

        // Initial colors (from the first palette)
        const color = new THREE.Color().lerpColors(colorPalettes[0][0], colorPalettes[0][1], Math.random());
        colors[i * 3] = color.r;
        colors[i * 3 + 1] = color.g;
        colors[i * 3 + 2] = color.b;

        // Initial sizes
        sizes[i] = Math.random() * 2 + 1;
    }

    geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
    geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
    geometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));

    const material = new THREE.ShaderMaterial({
        uniforms: {
            pointTexture: { value: new THREE.TextureLoader().load('https://threejs.org/examples/textures/sprites/circle.png') },
            size: { value: 1.0 },
        },
        vertexShader: `
            attribute float size;
            attribute vec3 color;
            varying vec3 vColor;
            void main() {
                vColor = color;
                vec4 mvPosition = modelViewMatrix * vec4(position, 1.0);
                gl_PointSize = size * (150.0 / -mvPosition.z);
                gl_Position = projectionMatrix * mvPosition;
            }
        `,
        fragmentShader: `
            varying vec3 vColor;
            uniform sampler2D pointTexture;
            void main() {
                gl_FragColor = vec4(vColor, 1.0);
                gl_FragColor = gl_FragColor * texture2D(pointTexture, gl_PointCoord);
            }
        `,
        blending: THREE.AdditiveBlending,
        transparent: true,
        vertexColors: true,
    });

    particles = new THREE.Points(geometry, material);
    scene.add(particles);
}

/**
 * Prepares the different patterns for the animation (letters and sphere).
 */
function preparePatterns() {
    // Definir la secuencia de animación
    animationSequence = [
        'X',
        'L',
        'E',
        'R',
        'I',
        'O',
        'N',
    ];

    // Create the geometry for each letter and sample its surface
    animationSequence.forEach((char) => {
        const textGeometry = new TextGeometry(char, {
            font: font,
            size: 80,
            height: 10,
            curveSegments: 12,
        });
        textGeometry.center();
        
        const textMesh = new THREE.Mesh(textGeometry);
        const sampler = new MeshSurfaceSampler(textMesh).build();
        const positions = [];
        const tempPosition = new THREE.Vector3();
        for (let i = 0; i < particleCount; i++) {
            sampler.sample(tempPosition);
            positions.push(tempPosition.x, tempPosition.y, tempPosition.z);
        }
        targetPositions[char] = new Float32Array(positions);
    });
}

/**
 * Updates the positions of the particles during the transition.
 */
function updateParticles() {
    const positions = particles.geometry.attributes.position.array;
    const initialPositions = animationSequence[currentPattern % animationSequence.length];
    const nextPositions = animationSequence[(currentPattern + 1) % animationSequence.length];
    const initialTarget = targetPositions[initialPositions];
    const nextTarget = targetPositions[nextPositions];

    if (isTransitioning) {
        for (let i = 0; i < particleCount; i++) {
            positions[i * 3] = initialTarget[i * 3] * (1 - transitionProgress) + nextTarget[i * 3] * transitionProgress;
            positions[i * 3 + 1] = initialTarget[i * 3 + 1] * (1 - transitionProgress) + nextTarget[i * 3 + 1] * transitionProgress;
            positions[i * 3 + 2] = initialTarget[i * 3 + 2] * (1 - transitionProgress) + nextTarget[i * 3 + 2] * transitionProgress;
        }
        particles.geometry.attributes.position.needsUpdate = true;
    } else {
        // If not transitioning, just set the target positions
        for (let i = 0; i < particleCount; i++) {
            positions[i * 3] = initialTarget[i * 3];
            positions[i * 3 + 1] = initialTarget[i * 3 + 1];
            positions[i * 3 + 2] = initialTarget[i * 3 + 2];
        }
        particles.geometry.attributes.position.needsUpdate = true;
    }
}

/**
 * Main animation loop.
 */
function animate() {
    requestAnimationFrame(animate);

    if (isTransitioning) {
        transitionProgress += transitionSpeed;
        if (transitionProgress >= 1) {
            isTransitioning = false;
            transitionProgress = 0;
            currentPattern = (currentPattern + 1) % animationSequence.length;
            setTimeout(() => {
                isTransitioning = true;
            }, 3000); // Wait 3 seconds before the next transition
        }
        updateParticles();
    } else {
        // Simple rotation when not in transition
        particles.rotation.y += 0.001;
    }

    composer.render();
}

/**
 * Initializes the entire Three.js scene and animation.
 */
export function initAnimation() {
    const container = document.getElementById('particle-container');
    if (!container) {
        console.error("Container element 'particle-container' not found.");
        return;
    }

    scene = new THREE.Scene();
    camera = new THREE.PerspectiveCamera(60, container.clientWidth / container.clientHeight, 0.1, 2000);
    camera.position.z = 100;

    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.setPixelRatio(window.devicePixelRatio);
    container.appendChild(renderer.domElement);

    // Post-processing effects
    composer = new EffectComposer(renderer);
    composer.addPass(new RenderPass(scene, camera));
    const bloomPass = new UnrealBloomPass(new THREE.Vector2(container.clientWidth, container.clientHeight), 0.6, 0.5, 0.85);
    composer.addPass(bloomPass);
    composer.addPass(new OutputPass());
    
    // Handle window resizing
    window.addEventListener('resize', () => {
        const width = container.clientWidth;
        const height = container.clientHeight;
        camera.aspect = width / height;
        camera.updateProjectionMatrix();
        renderer.setSize(width, height);
        composer.setSize(width, height);
    });

    const fontLoader = new FontLoader();
    fontLoader.load(
        'https://threejs.org/examples/fonts/helvetiker_bold.typeface.json',
        (loadedFont) => {
            font = loadedFont;
            document.getElementById('loading-message').style.display = 'none';
            
            preparePatterns();
            createParticleSystem();
            
            // Start the first transition after a delay
            setTimeout(() => {
                isTransitioning = true;
            }, 3000);

            animate();
        },
        (xhr) => {
            console.log((xhr.loaded / xhr.total * 100) + '% loaded');
        },
        (error) => {
            console.error('An error happened loading the font:', error);
            // Show an error message or fallback
            const loadingMessage = document.getElementById('loading-message');
            if (loadingMessage) {
                loadingMessage.innerText = 'Error al cargar la animación 3D.';
                loadingMessage.style.color = '#ef4444'; // Tailwind's red-500
            }
        }
    );
}
