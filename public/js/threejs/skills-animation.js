// Sistema de animación para la sección de habilidades
class SkillsAnimationSystem {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.skillElements = [];
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.createSkillElements();
        this.setupEventListeners();
    }
    
    createScene() {
        const canvas = document.getElementById('skills-canvas');
        if (!canvas) return;
        
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.camera.position.z = 8;
    }
    
    createSkillElements() {
        // Crear elementos flotantes para habilidades
        for (let i = 0; i < 15; i++) {
            const geometry = new THREE.OctahedronGeometry(0.05, 0);
            const material = new THREE.MeshBasicMaterial({
                color: 0x3b82f6,
                transparent: true,
                opacity: 0.6
            });
            
            const mesh = new THREE.Mesh(geometry, material);
            mesh.position.set(
                (Math.random() - 0.5) * 20,
                (Math.random() - 0.5) * 20,
                (Math.random() - 0.5) * 20
            );
            
            this.scene.add(mesh);
            this.skillElements.push(mesh);
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
        if (!this.skillElements.length) return;
        
        // Animar elementos de habilidades
        this.skillElements.forEach((element, index) => {
            element.rotation.x += 0.01;
            element.rotation.y += 0.01;
            element.position.y += Math.sin(time + index) * 0.01;
        });
        
        this.renderer.render(this.scene, this.camera);
    }
}
