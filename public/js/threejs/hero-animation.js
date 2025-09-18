// Sistema de animación del hero con partículas que forman texto
class HeroAnimationSystem {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.particleSystem = null;
        this.material = null;
        this.positions = null;
        this.targetPositions = null;
        this.originalPositions = null;
        this.colors = null;
        this.sizes = null;
        this.alphas = null;
        this.transitionTime = 0;
        this.isTransitioning = false;
        this.particleCount = 0;
        this.contentShown = false;
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.createParticles();
        this.setupEventListeners();
    }
    
    createScene() {
        const canvas = document.getElementById('particles-canvas');
        if (!canvas) return;
        
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.camera.position.z = 5;
    }
    
    createParticles() {
        // Crear partículas que formen el texto "ORIVASDEV"
        const textParticles = this.createTextParticles("ORIVASDEV");
        this.particleCount = textParticles.length;
        
        const geometry = new THREE.BufferGeometry();
        this.positions = new Float32Array(this.particleCount * 3);
        this.colors = new Float32Array(this.particleCount * 3);
        this.sizes = new Float32Array(this.particleCount);
        this.alphas = new Float32Array(this.particleCount);
        this.targetPositions = new Float32Array(this.particleCount * 3);
        this.originalPositions = new Float32Array(this.particleCount * 3);
        
        // Configurar partículas basadas en el texto
        textParticles.forEach((particle, i) => {
            const i3 = i * 3;
            
            // Posición inicial del texto
            this.originalPositions[i3] = particle.x;
            this.originalPositions[i3 + 1] = particle.y;
            this.originalPositions[i3 + 2] = particle.z;
            
            // Posición actual (inicialmente igual a la original)
            this.positions[i3] = particle.x;
            this.positions[i3 + 1] = particle.y;
            this.positions[i3 + 2] = particle.z;
            
            // Posición objetivo (inicialmente igual a la original)
            this.targetPositions[i3] = particle.x;
            this.targetPositions[i3 + 1] = particle.y;
            this.targetPositions[i3 + 2] = particle.z;
            
            // Colores vibrantes que contrastan con el texto blanco
            const colorVariation = Math.random();
if (colorVariation < 0.33) {
    // #8a1029 - Rojo oscuro
    this.colors[i3] = 0.54; // R (138/255)
    this.colors[i3 + 1] = 0.06; // G (16/255)
    this.colors[i3 + 2] = 0.16; // B (41/255)
} else if (colorVariation < 0.66) {
    // #10298a - Azul oscuro
    this.colors[i3] = 0.06; // R (16/255)
    this.colors[i3 + 1] = 0.16; // G (41/255)
    this.colors[i3 + 2] = 0.54; // B (138/255)
} else {
    // #288a10 - Verde oscuro
    this.colors[i3] = 0.16; // R (40/255)
    this.colors[i3 + 1] = 0.54; // G (138/255)
    this.colors[i3 + 2] = 0.06; // B (16/255)
}
            
            this.sizes[i] = 0.06 + Math.random() * 0.04; // Partículas más grandes
            this.alphas[i] = 0.9 + Math.random() * 0.1; // Más opacas
        });
        
        geometry.setAttribute('position', new THREE.BufferAttribute(this.positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(this.colors, 3));
        geometry.setAttribute('size', new THREE.BufferAttribute(this.sizes, 1));
        geometry.setAttribute('alpha', new THREE.BufferAttribute(this.alphas, 1));
        
        this.material = new THREE.ShaderMaterial({
            uniforms: {
                time: { value: 0 },
                mouse: { value: new THREE.Vector2() },
                transition: { value: 0 }
            },
            vertexShader: `
                attribute float size;
                attribute float alpha;
                attribute vec3 color;
                varying float vAlpha;
                varying vec3 vColor;
                uniform float time;
                uniform vec2 mouse;
                uniform float transition;
                
                void main() {
                    vAlpha = alpha;
                    vColor = color;
                    
                    vec3 pos = position;
                    
                    // Efecto de mouse más pronunciado
                    float mouseInfluence = 0.8;
                    pos.x += mouse.x * mouseInfluence * transition;
                    pos.y += mouse.y * mouseInfluence * transition;
                    
                    // Ondas orgánicas cuando está en modo disperso
                    if (transition > 0.1) {
                        pos.x += sin(time * 0.5 + position.y * 0.02) * 0.3 * transition;
                        pos.y += cos(time * 0.3 + position.x * 0.02) * 0.2 * transition;
                        pos.z += sin(time * 0.7 + position.x * 0.03) * 0.1 * transition;
                    }
                    
                    vec4 mvPosition = modelViewMatrix * vec4(pos, 1.0);
                    gl_PointSize = size * (300.0 / -mvPosition.z) * (1.0 + transition * 0.5);
                    gl_Position = projectionMatrix * mvPosition;
                }
            `,
            fragmentShader: `
                varying float vAlpha;
                varying vec3 vColor;
                uniform float time;
                uniform float transition;
                
                void main() {
                    float distance = length(gl_PointCoord - vec2(0.5));
                    float alpha = 1.0 - smoothstep(0.0, 0.4, distance);
                    alpha *= vAlpha;
                    
                    // Preservar colores originales sin añadir blanco
                    vec3 finalColor = vColor;
                    
                    // Efecto de pulsación de color (no blanco)
                    float pulse = sin(time * 2.0 + transition * 3.0) * 0.2;
                    finalColor.r += pulse * 0.1; // Pulsación sutil en rojo
                    finalColor.g += pulse * 0.1; // Pulsación sutil en verde
                    finalColor.b += pulse * 0.1; // Pulsación sutil en azul
                    
                    // Aumentar saturación en lugar de brillo
                    finalColor = mix(finalColor, finalColor * 1.2, transition * 0.3);
                    
                    // Efecto de halo para mayor visibilidad (sin blanco)
                    float halo = 1.0 - smoothstep(0.0, 0.8, distance);
                    finalColor += halo * 0.1; // Halo sutil
                    
                    gl_FragColor = vec4(finalColor, alpha);
                }
            `,
            transparent: true,
            blending: THREE.AdditiveBlending
        });
        
        this.particleSystem = new THREE.Points(geometry, this.material);
        this.scene.add(this.particleSystem);
    }
    
    createTextParticles(text) {
        const particles = [];
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 1200;
        canvas.height = 300;
        
        // Configurar el texto con mejor visibilidad
        ctx.font = 'bold 180px Arial, sans-serif';
        ctx.fillStyle = 'white';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.strokeStyle = 'white';
        ctx.lineWidth = 4;
        
        // Dibujar el texto con contorno para mayor visibilidad
        ctx.strokeText(text, canvas.width / 2, canvas.height / 2);
        ctx.fillText(text, canvas.width / 2, canvas.height / 2);
        
        // Extraer píxeles del texto con mayor densidad
        const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        const data = imageData.data;
        
        // Crear partículas más densas y visibles
        for (let x = 0; x < canvas.width; x += 2) { // Reducido de 4 a 2 para más densidad
            for (let y = 0; y < canvas.height; y += 2) {
                const index = (y * canvas.width + x) * 4;
                const alpha = data[index + 3];
                
                if (alpha > 50) { // Reducido el umbral para capturar más píxeles
                    const particleX = (x - canvas.width / 2) * 0.008; // Ajustado el tamaño
                    const particleY = -(y - canvas.height / 2) * 0.008;
                    const particleZ = (Math.random() - 0.5) * 0.3; // Menos dispersión en Z
                    
                    particles.push({
                        x: particleX,
                        y: particleY,
                        z: particleZ
                    });
                }
            }
        }
        
        return particles;
    }
    
    setupEventListeners() {
        window.addEventListener('resize', () => {
            if (this.camera && this.renderer) {
                this.camera.aspect = window.innerWidth / window.innerHeight;
                this.camera.updateProjectionMatrix();
                this.renderer.setSize(window.innerWidth, window.innerHeight);
            }
        });
    }
    
    easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }
    
    showHeroContent() {
        if (this.contentShown) return;
        this.contentShown = true;
        
        // Efecto dramático: mostrar contenido principal con delay
        setTimeout(() => {
            const heroContent = document.getElementById('hero-content');
            if (heroContent) {
                heroContent.style.visibility = 'visible';
                heroContent.style.opacity = '1';
                heroContent.style.transform = 'translateY(0)';
            }
        }, 500); // Delay de 500ms después de que termine la dispersión
        
        // Mostrar visual con delay más largo
        setTimeout(() => {
            const heroVisual = document.getElementById('hero-visual');
            if (heroVisual) {
                heroVisual.style.visibility = 'visible';
                heroVisual.style.opacity = '1';
                heroVisual.style.transform = 'translateY(0)';
            }
        }, 800); // Delay de 800ms
        
        // Mostrar scroll indicator al final
        setTimeout(() => {
            const scrollIndicator = document.getElementById('scroll-indicator');
            if (scrollIndicator) {
                scrollIndicator.style.visibility = 'visible';
                scrollIndicator.style.opacity = '1';
            }
        }, 1200); // Delay de 1200ms
    }
    
    update(time, mouse) {
        if (!this.particleSystem || !this.material) return;
        
        // Actualizar uniforms del shader
        this.material.uniforms.time.value = time;
        this.material.uniforms.mouse.value.set(mouse.x, mouse.y);
        
        // Controlar la transición
        if (!this.isTransitioning && time > 1.5) {
            // Después de 1.5 segundos, comenzar transición
            this.isTransitioning = true;
        }
        
        // Mostrar contenido después de que las partículas terminen de dispersarse
        if (this.isTransitioning && this.transitionTime > 0.8) {
            this.showHeroContent();
        }
        
        if (this.isTransitioning) {
            this.transitionTime += 0.016 * 0.8; // 60fps
            const transition = Math.min(this.transitionTime, 1);
            this.material.uniforms.transition.value = transition;
            
            // Calcular posiciones objetivo con dispersión más elegante
            for (let i = 0; i < this.particleCount; i++) {
                const i3 = i * 3;
                const originalX = this.originalPositions[i3];
                const originalY = this.originalPositions[i3 + 1];
                const originalZ = this.originalPositions[i3 + 2];
                
                // Crear dispersión más orgánica usando funciones trigonométricas
                const angle = (i / this.particleCount) * Math.PI * 2;
                const radius = 3 + Math.sin(i * 0.1) * 2;
                const height = Math.cos(i * 0.05) * 1.5;
                
                const dispersedX = originalX + Math.cos(angle) * radius;
                const dispersedY = originalY + Math.sin(angle) * radius + height;
                const dispersedZ = originalZ + Math.sin(i * 0.02) * 2;
                
                // Influencia del mouse más suave
                const mouseX = mouse.x * 1.5;
                const mouseY = mouse.y * 1.5;
                
                // Interpolar con easing suave
                const easeTransition = this.easeInOutCubic(transition);
                this.targetPositions[i3] = originalX + (dispersedX - originalX) * easeTransition + mouseX * easeTransition;
                this.targetPositions[i3 + 1] = originalY + (dispersedY - originalY) * easeTransition + mouseY * easeTransition;
                this.targetPositions[i3 + 2] = originalZ + (dispersedZ - originalZ) * easeTransition;
            }
        }
        
        // Suavizar movimiento hacia las posiciones objetivo
        for (let i = 0; i < this.particleCount; i++) {
            const i3 = i * 3;
            this.positions[i3] += (this.targetPositions[i3] - this.positions[i3]) * 0.1;
            this.positions[i3 + 1] += (this.targetPositions[i3 + 1] - this.positions[i3 + 1]) * 0.1;
            this.positions[i3 + 2] += (this.targetPositions[i3 + 2] - this.positions[i3 + 2]) * 0.1;
        }
        
        this.particleSystem.geometry.attributes.position.needsUpdate = true;
        
        // Efectos de cámara dinámicos
        this.camera.position.x = Math.sin(time * 0.1) * 0.3;
        this.camera.position.y = Math.cos(time * 0.15) * 0.2;
        this.camera.lookAt(0, 0, 0);
        
        this.renderer.render(this.scene, this.camera);
    }
}
