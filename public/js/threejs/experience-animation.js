// Sistema de animación para la sección de experiencia
class ExperienceAnimationSystem {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.particleSystem = null;
        this.originalPositions = null;
        this.originalColors = null;
        this.material = null;
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.createExperienceParticles();
        this.setupEventListeners();
    }
    
    createScene() {
        const canvas = document.getElementById('experience-canvas');
        if (!canvas) return;
        
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.camera.position.z = 12;
    }
    
    createExperienceParticles() {
        // Crear partículas de experiencia más visibles
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(150 * 3); // Más partículas
        const colors = new Float32Array(150 * 3);
        const sizes = new Float32Array(150);
        
        for (let i = 0; i < 150; i++) {
            const i3 = i * 3;
            positions[i3] = (Math.random() - 0.5) * 20;
            positions[i3 + 1] = (Math.random() - 0.5) * 20;
            positions[i3 + 2] = (Math.random() - 0.5) * 20;
            
            // Colores más vibrantes
            colors[i3] = 0.1 + Math.random() * 0.3; // R
            colors[i3 + 1] = 0.4 + Math.random() * 0.4; // G más verde
            colors[i3 + 2] = 0.6 + Math.random() * 0.4; // B más azul
            
            // Tamaños variables y más grandes
            sizes[i] = 0.05 + Math.random() * 0.08; // Más grandes
        }
        
        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
        geometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
        
        // Material más visible
        const material = new THREE.PointsMaterial({
            size: 0.08, // Mucho más grande
            vertexColors: true,
            transparent: true,
            opacity: 0.8, // Más opaco
            blending: THREE.AdditiveBlending
        });
        
        this.particleSystem = new THREE.Points(geometry, material);
        this.scene.add(this.particleSystem);
        
        // Guardar posiciones y colores originales
        this.originalPositions = positions.slice();
        this.originalColors = colors.slice();
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
    
    update(time) {
        if (!this.particleSystem) return;
        
        const positions = this.particleSystem.geometry.attributes.position.array;
        const colors = this.particleSystem.geometry.attributes.color.array;
        
        for (let i = 0; i < positions.length / 3; i++) {
            const i3 = i * 3;
            const originalX = this.originalPositions[i3];
            const originalY = this.originalPositions[i3 + 1];
            const originalZ = this.originalPositions[i3 + 2];
            
            // Ondas más pronunciadas
            const wave1 = Math.sin(time * 0.3 + i * 0.02) * 0.4;
            const wave2 = Math.cos(time * 0.4 + i * 0.03) * 0.3;
            const wave3 = Math.sin(time * 0.6 + i * 0.025) * 0.25;
            
            positions[i3] = originalX + wave1;
            positions[i3 + 1] = originalY + wave2;
            positions[i3 + 2] = originalZ + wave3;
            
            // Pulsación de colores más visible
            const pulse = 0.5 + Math.sin(time * 1.5 + i * 0.05) * 0.5;
            colors[i3 + 1] = this.originalColors[i3 + 1] * pulse;
            colors[i3 + 2] = this.originalColors[i3 + 2] * pulse;
        }
        
        this.particleSystem.geometry.attributes.position.needsUpdate = true;
        this.particleSystem.geometry.attributes.color.needsUpdate = true;
        this.renderer.render(this.scene, this.camera);
    }
}
