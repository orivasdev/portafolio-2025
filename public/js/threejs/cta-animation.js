// Sistema de animación para la sección de llamada a la acción
class CTAAnimationSystem {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.ctaElements = [];
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.createCTAElements();
        this.setupEventListeners();
    }
    
    createScene() {
        const canvas = document.getElementById('cta-canvas');
        if (!canvas) return;
        
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.camera.position.z = 6;
    }
    
    createCTAElements() {
        // Crear efectos de llamada a la acción
        for (let i = 0; i < 8; i++) {
            const geometry = new THREE.SphereGeometry(0.1, 8, 6);
            const material = new THREE.MeshBasicMaterial({
                color: 0xffffff,
                transparent: true,
                opacity: 0.7
            });
            
            const mesh = new THREE.Mesh(geometry, material);
            mesh.position.set(
                (Math.random() - 0.5) * 12,
                (Math.random() - 0.5) * 12,
                (Math.random() - 0.5) * 12
            );
            
            this.scene.add(mesh);
            this.ctaElements.push(mesh);
        }
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
        if (!this.ctaElements.length) return;
        
        // Animar elementos de CTA
        this.ctaElements.forEach((element, index) => {
            element.rotation.x += 0.02;
            element.rotation.y += 0.02;
            element.position.x += Math.sin(time * 0.5 + index) * 0.005;
            element.position.y += Math.cos(time * 0.3 + index) * 0.005;
        });
        
        this.renderer.render(this.scene, this.camera);
    }
}
