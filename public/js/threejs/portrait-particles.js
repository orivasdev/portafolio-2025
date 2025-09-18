// Sistema de partículas para retrato personal
class PortraitParticleSystem {
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
        this.particleCount = 0;
        this.contentShown = false;
        this.imageLoaded = false;
        this.imageData = null;
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.loadPortraitImage();
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
    
    loadPortraitImage() {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = () => {
            this.processPortraitImage(img);
        };
        img.onerror = () => {
            console.log('Error cargando retrato, usando patrón por defecto');
            this.createFallbackPattern();
        };
        
        // 🎯 TU RETRATO AQUÍ
        img.src = '/images/asd.png';
    }
    
    processPortraitImage(img) {
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        
        // Mantener proporciones originales de la imagen
        const maxSize = 500; // Más grande para mejor detalle facial
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
        this.createPortraitParticles();
    }
    
    createPortraitParticles() {
        if (!this.imageData) return;
        
        const particles = [];
        const data = this.imageData.data;
        const width = this.imageData.width;
        const height = this.imageData.height;
        
        // Extraer partículas de las áreas CLARAS (rostro, gafas, etc.)
        for (let x = 0; x < width; x += 2) { // Densidad media para mejor rendimiento
            for (let y = 0; y < height; y += 2) {
                const index = (y * width + x) * 4;
                const r = data[index];     // Red
                const g = data[index + 1]; // Green
                const b = data[index + 2]; // Blue
                const alpha = data[index + 3]; // Alpha
                
                // Calcular brillo del píxel
                const brightness = (r + g + b) / 3;
                
                // Solo crear partículas en áreas CLARAS (brillo > 50)
                // Esto ignora el fondo negro y solo toma el rostro
                if (alpha > 100 && brightness > 50) {
                    const particleX = (x - width / 2) * 0.012;  // Tamaño ajustado
                    const particleY = -(y - height / 2) * 0.012; // Tamaño ajustado
                    const particleZ = (Math.random() - 0.5) * 0.3;
                    
                    // Intensidad basada en qué tan claro es el píxel
                    const intensity = brightness / 255;
                    
                    particles.push({
                        x: particleX,
                        y: particleY,
                        z: particleZ,
                        originalAlpha: intensity,
                        brightness: brightness
                    });
                }
            }
        }
        
        this.particleCount = particles.length;
        console.log(` Partículas creadas: ${this.particleCount}`);
        
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
            
            //  Colores basados en el brillo del píxel original
            const intensity = particle.originalAlpha;
            const brightness = particle.brightness;
            
            // Colores más suaves y naturales para retrato
            if (brightness > 200) {
                // Áreas muy claras (piel, gafas) - Azul suave
                this.colors[i3] = 0.2 * intensity; // R
                this.colors[i3 + 1] = 0.7 * intensity; // G
                this.colors[i3 + 2] = 1.0 * intensity; // B
            } else if (brightness > 150) {
                // Áreas medias - Verde esmeralda
                this.colors[i3] = 0.0; // R
                this.colors[i3 + 1] = 0.8 * intensity; // G
                this.colors[i3 + 2] = 0.6 * intensity; // B
            } else if (brightness > 100) {
                // Áreas más oscuras - Cian
                this.colors[i3] = 0.0; // R
                this.colors[i3 + 1] = 0.9 * intensity; // G
                this.colors[i3 + 2] = 0.9 * intensity; // B
            } else {
                // Áreas oscuras - Púrpura suave
                this.colors[i3] = 0.6 * intensity; // R
                this.colors[i3 + 1] = 0.4 * intensity; // G
                this.colors[i3 + 2] = 0.8 * intensity; // B
            }
            
            // Tamaño basado en el brillo
            this.sizes[i] = 0.03 + (intensity * 0.05);
            this.alphas[i] = 0.6 + (intensity * 0.4);
        });
        
        geometry.setAttribute('position', new THREE.BufferAttribute(this.positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(this.colors, 3));
        geometry.setAttribute('size', new THREE.BufferAttribute(this.sizes, 1));
        geometry.setAttribute('alpha', new THREE.BufferAttribute(this.alphas, 1));
        
        this.material = new THREE.ShaderMaterial({
            uniforms: {
                time: { value: 0 },
                mouse: { value: new THREE.Vector2() }
            },
            vertexShader: `
                attribute float size;
                attribute float alpha;
                attribute vec3 color;
                varying float vAlpha;
                varying vec3 vColor;
                uniform float time;
                uniform vec2 mouse;
                
                void main() {
                    vAlpha = alpha;
                    vColor = color;
                    
                    vec3 pos = position;
                    
                    // Efecto sutil de mouse
                    float mouseInfluence = 0.8;
                    pos.x += mouse.x * mouseInfluence;
                    pos.y += mouse.y * mouseInfluence;
                    
                    // Movimiento orgánico muy sutil
                    pos.x += sin(time * 0.2 + position.y * 0.01) * 0.1;
                    pos.y += cos(time * 0.15 + position.x * 0.01) * 0.1;
                    pos.z += sin(time * 0.3 + position.x * 0.02) * 0.05;
                    
                    vec4 mvPosition = modelViewMatrix * vec4(pos, 1.0);
                    gl_PointSize = size * (400.0 / -mvPosition.z);
                    gl_Position = projectionMatrix * mvPosition;
                }
            `,
            fragmentShader: `
                varying float vAlpha;
                varying vec3 vColor;
                uniform float time;
                
                void main() {
                    float distance = length(gl_PointCoord - vec2(0.5));
                    float alpha = 1.0 - smoothstep(0.0, 0.4, distance);
                    alpha *= vAlpha;
                    
                    vec3 finalColor = vColor;
                    
                    // Pulsación suave
                    float pulse = sin(time * 1.0) * 0.2;
                    finalColor += pulse * 0.1;
                    
                    // Brillo dinámico
                    float brightness = 1.0 + sin(time * 2.0) * 0.15;
                    finalColor *= brightness;
                    
                    // Halo suave
                    float halo = 1.0 - smoothstep(0.0, 0.6, distance);
                    finalColor += halo * 0.1;
                    
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
    
    createFallbackPattern() {
        // Patrón de respaldo si no carga la imagen
        const canvas = document.createElement('canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = 400;
        canvas.height = 400;
        
        ctx.fillStyle = 'white';
        ctx.font = 'bold 120px Arial';
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';
        ctx.fillText('', canvas.width / 2, canvas.height / 2);
        
        this.imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
        this.createPortraitParticles();
    }
    
    setupEventListeners() {
        const handleResize = () => {
            if (this.camera && this.renderer) {
                const canvas = document.getElementById('particles-canvas');
                if (!canvas) return;
                
                const heroSection = canvas.closest('section');
                if (!heroSection) return;
                
                const rect = heroSection.getBoundingClientRect();
                const width = rect.width;
                const height = rect.height;
                
                this.camera.aspect = width / height;
                this.camera.updateProjectionMatrix();
                this.renderer.setSize(width, height);
                
                canvas.style.width = width + 'px';
                canvas.style.height = height + 'px';
            }
        };
        
        window.addEventListener('resize', handleResize);
        window.addEventListener('orientationchange', () => {
            setTimeout(handleResize, 100);
        });
        
        setTimeout(handleResize, 100);
    }
    
    showHeroContent() {
        if (this.contentShown) return;
        this.contentShown = true;
        
        setTimeout(() => {
            const heroContent = document.getElementById('hero-content');
            if (heroContent) {
                heroContent.style.visibility = 'visible';
                heroContent.style.opacity = '1';
                heroContent.style.transform = 'translateY(0)';
            }
        }, 1000);
        
        setTimeout(() => {
            const heroVisual = document.getElementById('hero-visual');
            if (heroVisual) {
                heroVisual.style.visibility = 'visible';
                heroVisual.style.opacity = '1';
                heroVisual.style.transform = 'translateY(0)';
            }
        }, 1500);
    }
    
    update(time, mouse) {
        if (!this.particleSystem || !this.material || !this.imageLoaded) return;
        
        // Actualizar uniforms del shader
        this.material.uniforms.time.value = time;
        this.material.uniforms.mouse.value.set(mouse.x, mouse.y);
        
        // Mostrar contenido después de un tiempo
        if (time > 2.0) {
            this.showHeroContent();
        }
        
        // Efectos de cámara suaves
        this.camera.position.x = Math.sin(time * 0.03) * 0.1;
        this.camera.position.y = Math.cos(time * 0.05) * 0.1;
        this.camera.lookAt(0, 0, 0);
        
        this.renderer.render(this.scene, this.camera);
    }
}
