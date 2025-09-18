// Sistema de animación de partículas mejorado con efectos adicionales
class ImageParticleSystemEnhanced extends ImageParticleSystem {
    constructor() {
        super();
        
        // Nuevas propiedades para efectos avanzados
        this.morphTargets = [];
        this.currentMorphTarget = 0;
        this.morphTransition = 0;
        this.waveAmplitude = 0.2;
        this.waveFrequency = 0.5;
        this.breathingIntensity = 0.1;
        this.particleTrails = [];
        this.explosionParticles = [];
        this.magneticField = { x: 0, y: 0, strength: 0 };
        this.contentShown = false;
        
        // Configuración de efectos
        this.effects = {
            breathing: true,
            waves: false,
            magneticMouse: false,
            particleTrails: false,
            colorCycling: false,
            explosion: false,
            morphing: false,
            gravity: false,
            wind: false
        };
        
        // Estados de efectos
        this.gravityStrength = 0;
        this.windDirection = { x: 0, y: 0 };
        this.windStrength = 0;
        
        // Campo magnético visual
        this.magneticFieldIndicator = null;
        this.showMagneticField = false;
    }
    
    // 1. EFECTO DE RESPIRACIÓN - La imagen "respira"
    addBreathingEffect() {
        this.effects.breathing = true;
    }
    
    // 2. EFECTO DE ONDAS - Ondas que atraviesan la imagen
    addWaveEffect(amplitude = 0.2, frequency = 0.5) {
        this.effects.waves = true;
        this.waveAmplitude = amplitude;
        this.waveFrequency = frequency;
    }
    
    // 3. CAMPO MAGNÉTICO DEL MOUSE - Atrae partículas (simple)
    addMagneticMouseEffect() {
        this.effects.magneticMouse = true;
    }
    
    // Crear indicador visual del campo magnético
    createMagneticFieldIndicator() {
        // Crear geometría de anillo para mostrar el campo magnético
        const ringGeometry = new THREE.RingGeometry(0, 2.5, 32);
        const ringMaterial = new THREE.ShaderMaterial({
            uniforms: {
                time: { value: 0 },
                mousePos: { value: new THREE.Vector2(0, 0) },
                opacity: { value: 0.3 }
            },
            vertexShader: `
                varying vec2 vUv;
                void main() {
                    vUv = uv;
                    gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);
                }
            `,
            fragmentShader: `
                uniform float time;
                uniform vec2 mousePos;
                uniform float opacity;
                varying vec2 vUv;
                
                void main() {
                    vec2 center = vec2(0.5, 0.5);
                    float distance = length(vUv - center);
                    
                    // Crear ondas concéntricas
                    float wave1 = sin(distance * 20.0 - time * 3.0) * 0.5 + 0.5;
                    float wave2 = sin(distance * 15.0 - time * 2.0) * 0.5 + 0.5;
                    
                    // Gradiente radial
                    float radialGradient = 1.0 - smoothstep(0.0, 0.8, distance);
                    
                    // Color magnético (azul-cyan)
                    vec3 color = vec3(0.2, 0.8, 1.0);
                    
                    float alpha = (wave1 * wave2) * radialGradient * opacity;
                    
                    gl_FragColor = vec4(color, alpha);
                }
            `,
            transparent: true,
            side: THREE.DoubleSide
        });
        
        this.magneticFieldIndicator = new THREE.Mesh(ringGeometry, ringMaterial);
        this.magneticFieldIndicator.visible = false;
        this.scene.add(this.magneticFieldIndicator);
    }
    
    // Actualizar indicador del campo magnético
    updateMagneticFieldIndicator(mouse, time) {
        if (this.magneticFieldIndicator) {
            // Posicionar el indicador en la posición del mouse
            this.magneticFieldIndicator.position.x = mouse.x * 3;
            this.magneticFieldIndicator.position.y = mouse.y * 3;
            this.magneticFieldIndicator.position.z = 0.1;
            
            // Actualizar uniforms del shader
            this.magneticFieldIndicator.material.uniforms.time.value = time;
            this.magneticFieldIndicator.material.uniforms.mousePos.value.set(mouse.x, mouse.y);
            
            // Mostrar/ocultar basado en movimiento del mouse
            const mouseMovement = Math.abs(mouse.x) + Math.abs(mouse.y);
            this.magneticFieldIndicator.visible = mouseMovement > 0.1;
            
            // Rotar suavemente
            this.magneticFieldIndicator.rotation.z += 0.01;
        }
    }
    
    // 4. ESTELAS DE PARTÍCULAS - Dejan rastros de luz
    addParticleTrails() {
        this.effects.particleTrails = true;
        this.particleTrails = new Array(this.particleCount).fill(null).map(() => []);
    }
    
    // 5. CICLO DE COLORES - Los colores cambian gradualmente
    addColorCycling() {
        this.effects.colorCycling = true;
    }
    
    // 6. EFECTO DE EXPLOSIÓN - Dispersión dramática
    triggerExplosion(intensity = 2.0) {
        this.effects.explosion = true;
        this.explosionStartTime = performance.now();
        this.explosionIntensity = intensity;
        
        // Crear partículas de explosión adicionales
        for (let i = 0; i < 100; i++) {
            this.explosionParticles.push({
                position: { x: 0, y: 0, z: 0 },
                velocity: {
                    x: (Math.random() - 0.5) * intensity,
                    y: (Math.random() - 0.5) * intensity,
                    z: (Math.random() - 0.5) * intensity
                },
                life: 1.0,
                size: Math.random() * 0.05 + 0.02
            });
        }
    }
    
    // 7. MORFISMO - Transición entre diferentes formas
    addMorphTarget(imageUrl) {
        const img = new Image();
        img.crossOrigin = 'anonymous';
        img.onload = () => {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = 400;
            canvas.height = 400;
            ctx.drawImage(img, 0, 0, 400, 400);
            
            const imageData = ctx.getImageData(0, 0, 400, 400);
            const morphTarget = this.extractParticlesFromImageData(imageData);
            this.morphTargets.push(morphTarget);
        };
        img.src = imageUrl;
    }
    
    // 8. EFECTO DE GRAVEDAD - Las partículas caen
    addGravityEffect(strength = 0.1) {
        this.effects.gravity = true;
        this.gravityStrength = strength;
    }
    
    // 9. EFECTO DE VIENTO - Movimiento direccional
    addWindEffect(direction = { x: 1, y: 0 }, strength = 0.05) {
        this.effects.wind = true;
        this.windDirection = direction;
        this.windStrength = strength;
    }
    
    // 10. REACCIÓN AL AUDIO - Responde a la música
    connectAudioAnalyzer(audioAnalyzer) {
        this.audioAnalyzer = audioAnalyzer;
        this.effects.audioReactive = true;
    }
    
    // Método para extraer partículas de datos de imagen (helper)
    extractParticlesFromImageData(imageData) {
        const particles = [];
        const data = imageData.data;
        const width = imageData.width;
        const height = imageData.height;
        
        for (let x = 0; x < width; x += 2) {
            for (let y = 0; y < height; y += 2) {
                const index = (y * width + x) * 4;
                const r = data[index];
                const g = data[index + 1];
                const b = data[index + 2];
                const alpha = data[index + 3];
                
                const brightness = (r + g + b) / 3;
                
                if (alpha > 50 && brightness < 100) {
                    particles.push({
                        x: (x - width / 2) * 0.015,
                        y: -(y - height / 2) * 0.015,
                        z: (Math.random() - 0.5) * 0.2
                    });
                }
            }
        }
        
        return particles;
    }
    
    // Función para mostrar el contenido del hero (heredada del sistema original)
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

    // Actualizar con todos los efectos
    update(time, mouse) {
        if (!this.particleSystem || !this.material || !this.imageLoaded) return;
        
        // Actualizar uniforms base
        this.material.uniforms.time.value = time;
        this.material.uniforms.mouse.value.set(mouse.x, mouse.y);
        
        // Mostrar contenido después de 2 segundos
        if (time > 2.0) {
            this.showHeroContent();
        }
        
        // Aplicar efectos activos
        this.applyActiveEffects(time, mouse);
        
        // Efecto magnético simple sin efectos visuales adicionales
        
        // Actualizar posiciones
        this.updateParticlePositions(time, mouse);
        
        // Efectos de cámara
        this.updateCamera(time);
        
        // Renderizar
        this.renderer.render(this.scene, this.camera);
    }
    
    applyActiveEffects(time, mouse) {
        for (let i = 0; i < this.particleCount; i++) {
            const i3 = i * 3;
            
            // Reset a posición original
            let targetX = this.originalPositions[i3];
            let targetY = this.originalPositions[i3 + 1];
            let targetZ = this.originalPositions[i3 + 2];
            
            // 1. EFECTO RESPIRACIÓN (0.1 intensidad)
            if (this.effects.breathing) {
                const breathe = Math.sin(time * 0.8) * this.breathingIntensity;
                const scale = 1 + breathe;
                targetX *= scale;
                targetY *= scale;
            }
            
            // Solo respiración - sin efectos de mouse
            
            // Aplicar posiciones objetivo
            this.targetPositions[i3] = targetX;
            this.targetPositions[i3 + 1] = targetY;
            this.targetPositions[i3 + 2] = targetZ;
        }
    }
    
    updateMouseProximityEffects(mouse) {
        const mouseWorldX = mouse.x * 3;
        const mouseWorldY = mouse.y * 3;
        
        for (let i = 0; i < this.particleCount; i++) {
            const i3 = i * 3;
            
            // Calcular distancia al mouse
            const distanceToMouse = Math.sqrt(
                Math.pow(this.positions[i3] - mouseWorldX, 2) + 
                Math.pow(this.positions[i3 + 1] - mouseWorldY, 2)
            );
            
            const influenceRadius = 2.5;
            
            if (distanceToMouse < influenceRadius) {
                const normalizedDistance = distanceToMouse / influenceRadius;
                const proximity = 1 - normalizedDistance;
                
                // Aumentar tamaño de partículas cercanas al mouse
                const baseSize = 0.05;
                const sizeMultiplier = 1 + proximity * 2; // Hasta 3x más grandes
                this.sizes[i] = baseSize * sizeMultiplier;
                
                // Intensificar colores cerca del mouse
                const intensity = 1 + proximity * 0.8;
                this.colors[i3] *= intensity;     // R
                this.colors[i3 + 1] *= intensity; // G  
                this.colors[i3 + 2] *= intensity; // B
                
                // Aumentar alpha (brillo) cerca del mouse
                this.alphas[i] = Math.min(1.0, 0.7 + proximity * 0.5);
            } else {
                // Restaurar valores normales para partículas lejanas
                const baseSize = 0.05;
                this.sizes[i] = baseSize + Math.random() * 0.03;
                this.alphas[i] = 0.7 + Math.random() * 0.3;
                
                // Restaurar colores originales (necesitaremos guardar los colores originales)
                // Por simplicidad, aplicamos un factor de restauración gradual
                this.colors[i3] *= 0.98;
                this.colors[i3 + 1] *= 0.98;
                this.colors[i3 + 2] *= 0.98;
            }
        }
        
        // Marcar para actualización
        this.particleSystem.geometry.attributes.size.needsUpdate = true;
        this.particleSystem.geometry.attributes.alpha.needsUpdate = true;
        this.particleSystem.geometry.attributes.color.needsUpdate = true;
    }

    updateParticlePositions(time, mouse) {
        // Interpolación suave a posiciones objetivo
        for (let i = 0; i < this.particleCount; i++) {
            const i3 = i * 3;
            this.positions[i3] += (this.targetPositions[i3] - this.positions[i3]) * 0.08;
            this.positions[i3 + 1] += (this.targetPositions[i3 + 1] - this.positions[i3 + 1]) * 0.08;
            this.positions[i3 + 2] += (this.targetPositions[i3 + 2] - this.positions[i3 + 2]) * 0.08;
        }
        
        this.particleSystem.geometry.attributes.position.needsUpdate = true;
    }
    
    updateCamera(time) {
        // Movimiento de cámara más dinámico
        this.camera.position.x = Math.sin(time * 0.05) * 0.3;
        this.camera.position.y = Math.cos(time * 0.08) * 0.2;
        this.camera.position.z = 5 + Math.sin(time * 0.1) * 0.5;
        this.camera.lookAt(0, 0, 0);
    }
    
    // Métodos de control público
    toggleEffect(effectName) {
        if (this.effects.hasOwnProperty(effectName)) {
            this.effects[effectName] = !this.effects[effectName];
        }
    }
    
    // Toggle del indicador visual del campo magnético
    toggleMagneticFieldVisual() {
        this.showMagneticField = !this.showMagneticField;
        if (this.magneticFieldIndicator) {
            this.magneticFieldIndicator.material.uniforms.opacity.value = this.showMagneticField ? 0.3 : 0.1;
        }
    }
    
    setEffectIntensity(effectName, intensity) {
        switch(effectName) {
            case 'breathing':
                this.breathingIntensity = intensity;
                break;
            case 'waves':
                this.waveAmplitude = intensity;
                break;
            case 'gravity':
                this.gravityStrength = intensity;
                break;
            case 'wind':
                this.windStrength = intensity;
                break;
        }
    }
}
