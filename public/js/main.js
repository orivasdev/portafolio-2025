// Sistema principal de animaciones Three.js
class AdvancedThreeJSAnimationSystem {
    constructor() {
        this.systems = {};
        this.mouse = new THREE.Vector2();
        this.mouseTarget = new THREE.Vector2();
        this.time = 0;
        this.clock = new THREE.Clock();
        this.animationMixers = [];
        this.composer = null;
        this.renderTarget = null;
        
        this.init();
    }
    
    init() {
        this.setupEventListeners();
        this.createAnimationSystems();
        this.setupPostProcessing();
        this.animate();
    }
    
    setupEventListeners() {
        window.addEventListener('mousemove', (event) => {
            this.mouseTarget.x = (event.clientX / window.innerWidth) * 2 - 1;
            this.mouseTarget.y = -(event.clientY / window.innerHeight) * 2 + 1;
        });
        
        window.addEventListener('resize', () => {
            Object.values(this.systems).forEach(system => {
                if (system.camera && system.renderer) {
                    system.camera.aspect = window.innerWidth / window.innerHeight;
                    system.camera.updateProjectionMatrix();
                    system.renderer.setSize(window.innerWidth, window.innerHeight);
                }
            });
        });
    }
    
    createAnimationSystems() {
        // Crear sistemas de animación para cada sección
        
        // ===== CAMBIO DE ANIMACIÓN =====
        // Para ANIMACIÓN DE IMAGEN BÁSICA: 
        // this.systems.hero = new ImageParticleSystem();
        
        // Para ANIMACIÓN DE IMAGEN MEJORADA: descomenta la línea de abajo
        this.systems.hero = new ImageParticleSystemEnhanced();
        
        // Para ANIMACIÓN DE TEXTO ("ORIVASDEV"): comenta las líneas de arriba y descomenta la de abajo
        // this.systems.hero = new HeroAnimationSystem();
        

        //this.systems.hero = new PortraitParticleSystem();

        this.systems.skills = new SkillsAnimationSystem();
        this.systems.projects = new ProjectsAnimationSystem();
        this.systems.experience = new ExperienceAnimationSystem();
        this.systems.cta = new CTAAnimationSystem();
        
        // Inicializar sistemas adicionales después de un momento
        setTimeout(() => {
            this.initializeEnhancedFeatures();
        }, 1000);
    }
    
    initializeEnhancedFeatures() {
        // Solo si se está usando el sistema mejorado
        if (this.systems.hero instanceof ImageParticleSystemEnhanced) {
            
            // Configurar efectos iniciales (solo respiración y mouse magnético)
            this.setupInitialEffects();
            
            // Agregar controles de teclado simplificados
            this.setupKeyboardControls();
        }
    }
    
    setupInitialEffects() {
        // Activar solo respiración
        this.systems.hero.addBreathingEffect();
        
        // Configurar intensidad de respiración
        this.systems.hero.setEffectIntensity('breathing', 0.1);
    }
    
    setupKeyboardControls() {
        // Sin controles de teclado - solo respiración automática
    }
    
    // Sin menú de ayuda - sistema simplificado
    
    setupPostProcessing() {
        // Configurar render targets para efectos post-procesamiento
        this.renderTarget = new THREE.WebGLRenderTarget(
            window.innerWidth,
            window.innerHeight,
            {
                minFilter: THREE.LinearFilter,
                magFilter: THREE.LinearFilter,
                format: THREE.RGBAFormat
            }
        );
    }
    
    animate() {
        requestAnimationFrame(() => this.animate());
        
        const deltaTime = this.clock.getDelta();
        this.time += deltaTime;
        
        // Actualizar mixers de animación
        this.animationMixers.forEach(mixer => mixer.update(deltaTime));
        
        // Suavizar movimiento del mouse
        this.mouse.x += (this.mouseTarget.x - this.mouse.x) * 0.05;
        this.mouse.y += (this.mouseTarget.y - this.mouse.y) * 0.05;
        
        // Actualizar cada sistema de animación
        if (this.systems.hero) {
            this.systems.hero.update(this.time, this.mouse);
        }
        
        if (this.systems.skills) {
            this.systems.skills.update(this.time);
        }
        
        if (this.systems.projects) {
            this.systems.projects.update(this.time);
        }
        
        if (this.systems.experience) {
            this.systems.experience.update(this.time);
        }
        
        if (this.systems.cta) {
            this.systems.cta.update(this.time);
        }
    }
}

// Inicializar sistema avanzado de animaciones
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.pathname === '/' || window.location.pathname === '/home') {
        new AdvancedThreeJSAnimationSystem();
    }
});
