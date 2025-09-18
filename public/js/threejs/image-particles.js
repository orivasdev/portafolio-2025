// Sistema de animación de partículas que forman una imagen
class ImageParticleSystem {
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
        this.imageLoaded = false;
        this.imageData = null;
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.loadImage();
        this.setupEventListeners();
    }
    
    createScene() {
        const canvas = document.getElementById('particles-canvas');
        if (!canvas) return;
        
        // Obtener el contenedor del hero
        const heroSection = canvas.closest('section');
        if (!heroSection) return;
        
        const rect = heroSection.getBoundingClientRect();
        const width = rect.width;
        const height = rect.height;
        
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, width / height, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        
        this.renderer.setSize(width, height);
        this.camera.position.z = 5;
        
        // Asegurar dimensiones correctas del canvas
        canvas.style.width = width + 'px';
        canvas.style.height = height + 'px';
    }
    
    loadImage() {
        // Cargar imagen real del logo
        this.loadRealImage();
    }
    
    loadRealImage() {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = () => {
            this.processRealImage(img);
        };
        img.onerror = () => {
            console.log('Error cargando imagen, usando patrón por defecto');
            this.createProgrammaticImage(); // Fallback
        };
        
        // 🎯 TU IMAGEN AQUÍ
        img.src = '/images/mi-logo.jpg';
    }
    
    processRealImage(img) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        // Mantener proporciones originales de la imagen
        const maxSize = 400;
        const aspectRatio = img.width / img.height;
        
        let canvasWidth, canvasHeight;
        
        if (aspectRatio > 1) {
            // Imagen más ancha que alta
            canvasWidth = maxSize;
            canvasHeight = maxSize / aspectRatio;
        } else {
            // Imagen más alta que ancha o cuadrada
            canvasHeight = maxSize;
            canvasWidth = maxSize * aspectRatio;
        }
        
        canvas.width = canvasWidth;
        canvas.height = canvasHeight;
        
        // Dibujar la imagen manteniendo proporciones
        ctx.drawImage(img, 0, 0, canvasWidth, canvasHeight);
        
        // Obtener datos de píxeles
        this.imageData = ctx.getImageData(0, 0, canvasWidth, canvasHeight);
        this.createParticles();
    }
    
    createProgrammaticImage() {
        // Crear un canvas para generar una imagen programática
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 400;
        canvas.height = 400;
        
        // Limpiar canvas
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        
        // Crear un diseño geométrico moderno
        const centerX = canvas.width / 2;
        const centerY = canvas.height / 2;
        
        // Gradiente de fondo
        const gradient = ctx.createRadialGradient(centerX, centerY, 0, centerX, centerY, 200);
        gradient.addColorStop(0, 'rgba(255, 255, 255, 0.8)');
        gradient.addColorStop(0.5, 'rgba(255, 255, 255, 0.4)');
        gradient.addColorStop(1, 'rgba(255, 255, 255, 0.1)');
        
        ctx.fillStyle = gradient;
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Crear un patrón geométrico complejo
        ctx.strokeStyle = 'white';
        ctx.lineWidth = 3;
        ctx.fillStyle = 'white';
        
        // Círculos concéntricos
        for (let i = 0; i < 5; i++) {
            const radius = 30 + i * 25;
            ctx.beginPath();
            ctx.arc(centerX, centerY, radius, 0, Math.PI * 2);
            ctx.stroke();
        }
        
        // Líneas radiales
        for (let i = 0; i < 12; i++) {
            const angle = (i / 12) * Math.PI * 2;
            const x1 = centerX + Math.cos(angle) * 20;
            const y1 = centerY + Math.sin(angle) * 20;
            const x2 = centerX + Math.cos(angle) * 120;
            const y2 = centerY + Math.sin(angle) * 120;
            
            ctx.beginPath();
            ctx.moveTo(x1, y1);
            ctx.lineTo(x2, y2);
            ctx.stroke();
        }
        
        // Triángulo central
        ctx.beginPath();
        ctx.moveTo(centerX, centerY - 40);
        ctx.lineTo(centerX - 35, centerY + 20);
        ctx.lineTo(centerX + 35, centerY + 20);
        ctx.closePath();
        ctx.fill();
        
        // Puntos adicionales para mayor densidad
        for (let i = 0; i < 8; i++) {
            const angle = (i / 8) * Math.PI * 2;
            const radius = 80;
            const x = centerX + Math.cos(angle) * radius;
            const y = centerY + Math.sin(angle) * radius;
            
            ctx.beginPath();
            ctx.arc(x, y, 8, 0, Math.PI * 2);
            ctx.fill();
        }
        
        // Obtener datos de la imagen
        this.imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        this.createParticles();
    }
    
    createParticles() {
        if (!this.imageData) return;
        
        const particles = [];
        const data = this.imageData.data;
        const width = this.imageData.width;
        const height = this.imageData.height;
        
        // Extraer partículas solo de las áreas OSCURAS (líneas del logo)
        for (let x = 0; x < width; x += 1) { // Más densidad para mejor detalle
            for (let y = 0; y < height; y += 2) {
                const index = (y * width + x) * 4;
                const r = data[index];     // Red
                const g = data[index + 1]; // Green
                const b = data[index + 2]; // Blue
                const alpha = data[index + 3]; // Alpha
                
                // Calcular brillo del píxel
                const brightness = (r + g + b) / 3;
                
                // Solo crear partículas en áreas OSCURAS (brillo < 100)
                // Esto ignora el fondo blanco y solo toma las líneas negras
                if (alpha > 50 && brightness < 100) {
                    const particleX = (x - width / 2) * 0.015;  // Más grande
                    const particleY = -(y - height / 2) * 0.015; // Más grande
                    const particleZ = (Math.random() - 0.5) * 0.2;
                    
                    // Intensidad basada en qué tan oscuro es el píxel
                    const intensity = 1 - (brightness / 255);
                    
                    particles.push({
                        x: particleX,
                        y: particleY,
                        z: particleZ,
                        originalAlpha: intensity
                    });
                }
            }
        }
        
        this.particleCount = particles.length;
        
        const geometry = new THREE.BufferGeometry();
        this.positions = new Float32Array(this.particleCount * 3);
        this.colors = new Float32Array(this.particleCount * 3);
        this.sizes = new Float32Array(this.particleCount);
        this.alphas = new Float32Array(this.particleCount);
        this.targetPositions = new Float32Array(this.particleCount * 3);
        this.originalPositions = new Float32Array(this.particleCount * 3);
        
        // Configurar partículas
        particles.forEach((particle, i) => {
            const i3 = i * 3;
            
            // Posiciones
            this.originalPositions[i3] = particle.x;
            this.originalPositions[i3 + 1] = particle.y;
            this.originalPositions[i3 + 2] = particle.z;
            
            this.positions[i3] = particle.x;
            this.positions[i3 + 1] = particle.y;
            this.positions[i3 + 2] = particle.z;
            
            this.targetPositions[i3] = particle.x;
            this.targetPositions[i3 + 1] = particle.y;
            this.targetPositions[i3 + 2] = particle.z;
            
            // 🎨 Paleta de colores profesional y moderna
            const intensity = particle.originalAlpha;
            const colorVariation = Math.random();
            
            if (colorVariation < 0.3) {
                // Azul eléctrico profundo - Muy tecnológico
                this.colors[i3] = 0.1 * intensity; // R
                this.colors[i3 + 1] = 0.6 * intensity; // G
                this.colors[i3 + 2] = 1.0 * intensity; // B
            } else if (colorVariation < 0.6) {
                // Verde esmeralda - Moderno y elegante
                this.colors[i3] = 0.0; // R
                this.colors[i3 + 1] = 0.9 * intensity; // G
                this.colors[i3 + 2] = 0.7 * intensity; // B
            } else if (colorVariation < 0.8) {
                // Cian brillante - Muy llamativo
                this.colors[i3] = 0.0; // R
                this.colors[i3 + 1] = 1.0 * intensity; // G
                this.colors[i3 + 2] = 1.0 * intensity; // B
            } else {
                // Púrpura tecnológico - Sofisticado
                this.colors[i3] = 0.7 * intensity; // R
                this.colors[i3 + 1] = 0.3 * intensity; // G
                this.colors[i3 + 2] = 1.0 * intensity; // B
            }
            
            this.sizes[i] = 0.05 + Math.random() * 0.03;
            this.alphas[i] = 0.7 + Math.random() * 0.3;
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
                    
                    // 🚫 EFECTOS DE DISPERSIÓN DESACTIVADOS
                    // Efecto de mouse
                    // float mouseInfluence = 0.6;
                    // pos.x += mouse.x * mouseInfluence * transition;
                    // pos.y += mouse.y * mouseInfluence * transition;
                    
                    // Ondas orgánicas cuando está disperso
                    // if (transition > 0.1) {
                    //     pos.x += sin(time * 0.4 + position.y * 0.01) * 0.4 * transition;
                    //     pos.y += cos(time * 0.3 + position.x * 0.01) * 0.3 * transition;
                    //     pos.z += sin(time * 0.6 + position.x * 0.02) * 0.2 * transition;
                    // }
                    
                    // Rotación sutil de la imagen
                    // float rotationAngle = time * 0.1 * transition;
                    // float cosA = cos(rotationAngle);
                    // float sinA = sin(rotationAngle);
                    // float newX = pos.x * cosA - pos.y * sinA;
                    // float newY = pos.x * sinA + pos.y * cosA;
                    // pos.x = newX;
                    // pos.y = newY;
                    
                    vec4 mvPosition = modelViewMatrix * vec4(pos, 1.0);
                    gl_PointSize = size * (300.0 / -mvPosition.z); // Sin efecto de transición
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
                    float alpha = 1.0 - smoothstep(0.0, 0.5, distance);
                    alpha *= vAlpha;
                    
                    vec3 finalColor = vColor;
                    
                    // Efecto de pulsación de color (sin dispersión)
                    float pulse = sin(time * 1.5) * 0.3;
                    finalColor += pulse * 0.2;
                    
                    // Efecto de brillo constante
                    float brightness = 1.0 + sin(time * 3.0) * 0.2;
                    finalColor *= brightness;
                    
                    // Halo para mayor visibilidad
                    float halo = 1.0 - smoothstep(0.0, 0.7, distance);
                    finalColor += halo * 0.15;
                    
                    gl_FragColor = vec4(finalColor, alpha);
                }
            `,
            transparent: true,
            blending: THREE.AdditiveBlending
        });
        
        this.particleSystem = new THREE.Points(geometry, this.material);
        this.scene.add(this.particleSystem);
        this.imageLoaded = true;
    }
    
    setupEventListeners() {
        // Función para manejar redimensionamiento
        const handleResize = () => {
            if (this.camera && this.renderer) {
                const canvas = document.getElementById('particles-canvas');
                if (!canvas) return;
                
                // Obtener el contenedor del hero
                const heroSection = canvas.closest('section');
                if (!heroSection) return;
                
                // Usar las dimensiones del contenedor, no de la ventana
                const rect = heroSection.getBoundingClientRect();
                const width = rect.width;
                const height = rect.height;
                
                // Actualizar cámara y renderer
                this.camera.aspect = width / height;
                this.camera.updateProjectionMatrix();
                this.renderer.setSize(width, height);
                
                // Asegurar que el canvas tenga las dimensiones correctas
                canvas.style.width = width + 'px';
                canvas.style.height = height + 'px';
            }
        };
        
        // Escuchar redimensionamiento
        window.addEventListener('resize', handleResize);
        
        // Escuchar cambios de orientación en móviles
        window.addEventListener('orientationchange', () => {
            setTimeout(handleResize, 100); // Delay para que se complete el cambio
        });
        
        // Ejecutar una vez al cargar
        setTimeout(handleResize, 100);
    }
    
    easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
    }
    
    showHeroContent() {
        if (this.contentShown) return;
        this.contentShown = true;
        
        // Mostrar contenido principal
        setTimeout(() => {
            const heroContent = document.getElementById('hero-content');
            if (heroContent) {
                heroContent.style.visibility = 'visible';
                heroContent.style.opacity = '1';
                heroContent.style.transform = 'translateY(0)';
            }
        }, 800);
        
        // Mostrar visual
        setTimeout(() => {
            const heroVisual = document.getElementById('hero-visual');
            if (heroVisual) {
                heroVisual.style.visibility = 'visible';
                heroVisual.style.opacity = '1';
                heroVisual.style.transform = 'translateY(0)';
            }
        }, 1200);
        
        // Mostrar scroll indicator
        setTimeout(() => {
            const scrollIndicator = document.getElementById('scroll-indicator');
            if (scrollIndicator) {
                scrollIndicator.style.visibility = 'visible';
                scrollIndicator.style.opacity = '1';
            }
        }, 1600);
    }
    
    update(time, mouse) {
        if (!this.particleSystem || !this.material || !this.imageLoaded) return;
        
        // Actualizar uniforms del shader
        this.material.uniforms.time.value = time;
        this.material.uniforms.mouse.value.set(mouse.x, mouse.y);
        
        // 🚫 DISPERSIÓN DESACTIVADA - Las partículas se mantienen en su lugar
        // Controlar la transición
        // if (!this.isTransitioning && time > 2.0) {
        //     this.isTransitioning = true;
        // }
        
        // Mostrar contenido después de la dispersión
        if (time > 2.0) {
            this.showHeroContent();
        }
        
        // if (this.isTransitioning) {
        //     this.transitionTime += 0.016 * 0.6; // Transición más lenta
        //     const transition = Math.min(this.transitionTime, 1);
        //     this.material.uniforms.transition.value = transition;
            
        //     // Calcular posiciones objetivo con dispersión elegante
        //     for (let i = 0; i < this.particleCount; i++) {
        //         const i3 = i * 3;
        //         const originalX = this.originalPositions[i3];
        //         const originalY = this.originalPositions[i3 + 1];
        //         const originalZ = this.originalPositions[i3 + 2];
        //         
        //         // Dispersión en espiral
        //         const angle = (i / this.particleCount) * Math.PI * 4;
        //         const radius = 2 + Math.sin(i * 0.05) * 1.5;
        //         const height = Math.cos(i * 0.03) * 1.0;
        //         
        //         const dispersedX = originalX + Math.cos(angle) * radius;
        //         const dispersedY = originalY + Math.sin(angle) * radius + height;
        //         const dispersedZ = originalZ + Math.sin(i * 0.01) * 1.5;
        //         
        //         // Influencia del mouse
        //         const mouseX = mouse.x * 1.2;
        //         const mouseY = mouse.y * 1.2;
        //         
        //         // Interpolar con easing
        //         const easeTransition = this.easeInOutCubic(transition);
        //         this.targetPositions[i3] = originalX + (dispersedX - originalX) * easeTransition + mouseX * easeTransition;
        //         this.targetPositions[i3 + 1] = originalY + (dispersedY - originalY) * easeTransition + mouseY * easeTransition;
        //         this.targetPositions[i3 + 2] = originalZ + (dispersedZ - originalZ) * easeTransition;
        //     }
        // }
        
        // Suavizar movimiento hacia las posiciones objetivo
        for (let i = 0; i < this.particleCount; i++) {
            const i3 = i * 3;
            this.positions[i3] += (this.targetPositions[i3] - this.positions[i3]) * 0.08;
            this.positions[i3 + 1] += (this.targetPositions[i3 + 1] - this.positions[i3 + 1]) * 0.08;
            this.positions[i3 + 2] += (this.targetPositions[i3 + 2] - this.positions[i3 + 2]) * 0.08;
        }
        
        this.particleSystem.geometry.attributes.position.needsUpdate = true;
        
        // Efectos de cámara dinámicos más suaves
        this.camera.position.x = Math.sin(time * 0.05) * 0.2;
        this.camera.position.y = Math.cos(time * 0.08) * 0.15;
        this.camera.lookAt(0, 0, 0);
        
        this.renderer.render(this.scene, this.camera);
    }
    
    // Función para convertir HSL a RGB (para gradientes personalizados)
    hslToRgb(h, s, l) {
        let r, g, b;
        if (s === 0) {
            r = g = b = l; // achromatic
        } else {
            const hue2rgb = (p, q, t) => {
                if (t < 0) t += 1;
                if (t > 1) t -= 1;
                if (t < 1/6) return p + (q - p) * 6 * t;
                if (t < 1/2) return q;
                if (t < 2/3) return p + (q - p) * (2/3 - t) * 6;
                return p;
            };
            const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            const p = 2 * l - q;
            r = hue2rgb(p, q, h + 1/3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1/3);
        }
        return [r, g, b];
    }
}
