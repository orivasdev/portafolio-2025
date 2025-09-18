// Sistema de animación para la sección de proyectos
class ProjectsAnimationSystem {
    constructor() {
        this.scene = null;
        this.camera = null;
        this.renderer = null;
        this.lines = null;
        this.originalPositions = null;
        
        this.init();
    }
    
    init() {
        this.createScene();
        this.createProjectLines();
        this.setupEventListeners();
    }
    
    createScene() {
        const canvas = document.getElementById('projects-canvas');
        if (!canvas) return;
        
        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        this.renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
        
        this.renderer.setSize(window.innerWidth, window.innerHeight);
        this.camera.position.z = 10;
    }
    
    createProjectLines() {
        // Crear líneas conectivas para proyectos
        const geometry = new THREE.BufferGeometry();
        const positions = new Float32Array(50 * 3);
        
        for (let i = 0; i < 50; i++) {
            const i3 = i * 3;
            positions[i3] = (Math.random() - 0.5) * 15;
            positions[i3 + 1] = (Math.random() - 0.5) * 15;
            positions[i3 + 2] = (Math.random() - 0.5) * 15;
        }
        
        geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        
        const material = new THREE.LineBasicMaterial({
            color: 0x10b981,
            transparent: true,
            opacity: 0.3
        });
        
        this.lines = new THREE.LineSegments(geometry, material);
        this.scene.add(this.lines);
        
        // Guardar posiciones originales
        this.originalPositions = positions.slice();
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
        if (!this.lines) return;
        
        const positions = this.lines.geometry.attributes.position.array;
        
        for (let i = 0; i < positions.length; i += 3) {
            positions[i + 1] += Math.sin(time + i) * 0.01;
        }
        
        this.lines.geometry.attributes.position.needsUpdate = true;
        this.renderer.render(this.scene, this.camera);
    }
}
