// Panel de control para efectos de partículas
class ParticleControlPanel {
    constructor(particleSystem) {
        this.particleSystem = particleSystem;
        this.isVisible = false;
        this.panel = null;
        
        this.createPanel();
        this.setupEventListeners();
    }
    
    createPanel() {
        // Crear panel flotante
        this.panel = document.createElement('div');
        this.panel.id = 'particle-control-panel';
        this.panel.innerHTML = `
            <div class="control-panel">
                <div class="panel-header">
                    <h3>🎨 Efectos de Partículas</h3>
                    <button id="toggle-panel" class="toggle-btn">−</button>
                </div>
                
                <div class="panel-content">
                    <!-- Efectos On/Off -->
                    <div class="control-group">
                        <h4>Efectos Activos</h4>
                        <label class="switch">
                            <input type="checkbox" id="breathing-toggle" checked>
                            <span class="slider"></span>
                            Respiración
                        </label>
                        
                        <label class="switch">
                            <input type="checkbox" id="waves-toggle">
                            <span class="slider"></span>
                            Ondas
                        </label>
                        
                        <label class="switch">
                            <input type="checkbox" id="magnetic-toggle">
                            <span class="slider"></span>
                            Mouse Magnético
                        </label>
                        
                        <label class="switch">
                            <input type="checkbox" id="trails-toggle">
                            <span class="slider"></span>
                            Estelas
                        </label>
                        
                        <label class="switch">
                            <input type="checkbox" id="colors-toggle" checked>
                            <span class="slider"></span>
                            Ciclo de Colores
                        </label>
                        
                        <label class="switch">
                            <input type="checkbox" id="gravity-toggle">
                            <span class="slider"></span>
                            Gravedad
                        </label>
                        
                        <label class="switch">
                            <input type="checkbox" id="wind-toggle">
                            <span class="slider"></span>
                            Viento
                        </label>
                    </div>
                    
                    <!-- Controles de Intensidad -->
                    <div class="control-group">
                        <h4>Intensidades</h4>
                        
                        <div class="slider-control">
                            <label>Respiración</label>
                            <input type="range" id="breathing-intensity" min="0" max="0.5" step="0.01" value="0.1">
                            <span class="value">0.1</span>
                        </div>
                        
                        <div class="slider-control">
                            <label>Ondas</label>
                            <input type="range" id="waves-intensity" min="0" max="1" step="0.01" value="0.2">
                            <span class="value">0.2</span>
                        </div>
                        
                        <div class="slider-control">
                            <label>Gravedad</label>
                            <input type="range" id="gravity-intensity" min="0" max="0.5" step="0.01" value="0.1">
                            <span class="value">0.1</span>
                        </div>
                        
                        <div class="slider-control">
                            <label>Viento</label>
                            <input type="range" id="wind-intensity" min="0" max="0.2" step="0.01" value="0.05">
                            <span class="value">0.05</span>
                        </div>
                    </div>
                    
                    <!-- Efectos Especiales -->
                    <div class="control-group">
                        <h4>Efectos Especiales</h4>
                        <button id="explosion-btn" class="effect-btn">💥 Explosión</button>
                        <button id="reset-btn" class="effect-btn">🔄 Resetear</button>
                        <button id="random-btn" class="effect-btn">🎲 Aleatorio</button>
                    </div>
                    
                    <!-- Presets -->
                    <div class="control-group">
                        <h4>Presets</h4>
                        <button class="preset-btn" data-preset="calm">😌 Tranquilo</button>
                        <button class="preset-btn" data-preset="dynamic">⚡ Dinámico</button>
                        <button class="preset-btn" data-preset="chaotic">🌪️ Caótico</button>
                        <button class="preset-btn" data-preset="minimal">✨ Minimalista</button>
                    </div>
                </div>
            </div>
        `;
        
        // Estilos CSS
        const styles = document.createElement('style');
        styles.textContent = `
            #particle-control-panel {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
                font-family: 'Arial', sans-serif;
                transform: translateX(100%);
                transition: transform 0.3s ease;
            }
            
            #particle-control-panel.visible {
                transform: translateX(0);
            }
            
            .control-panel {
                background: rgba(0, 0, 0, 0.9);
                backdrop-filter: blur(10px);
                border-radius: 12px;
                padding: 20px;
                width: 280px;
                color: white;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            }
            
            .panel-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
                padding-bottom: 10px;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            }
            
            .panel-header h3 {
                margin: 0;
                font-size: 16px;
                color: #4F46E5;
            }
            
            .toggle-btn {
                background: none;
                border: none;
                color: white;
                font-size: 18px;
                cursor: pointer;
                padding: 5px;
                border-radius: 4px;
                transition: background 0.2s;
            }
            
            .toggle-btn:hover {
                background: rgba(255, 255, 255, 0.1);
            }
            
            .control-group {
                margin-bottom: 20px;
            }
            
            .control-group h4 {
                margin: 0 0 10px 0;
                font-size: 14px;
                color: #9CA3AF;
                text-transform: uppercase;
                letter-spacing: 0.5px;
            }
            
            .switch {
                display: flex;
                align-items: center;
                margin-bottom: 8px;
                font-size: 13px;
                cursor: pointer;
            }
            
            .switch input {
                display: none;
            }
            
            .slider {
                width: 40px;
                height: 20px;
                background: #374151;
                border-radius: 20px;
                margin-right: 10px;
                position: relative;
                transition: background 0.2s;
            }
            
            .slider:before {
                content: '';
                position: absolute;
                width: 16px;
                height: 16px;
                background: white;
                border-radius: 50%;
                top: 2px;
                left: 2px;
                transition: transform 0.2s;
            }
            
            .switch input:checked + .slider {
                background: #4F46E5;
            }
            
            .switch input:checked + .slider:before {
                transform: translateX(20px);
            }
            
            .slider-control {
                margin-bottom: 12px;
            }
            
            .slider-control label {
                display: block;
                font-size: 12px;
                margin-bottom: 4px;
                color: #D1D5DB;
            }
            
            .slider-control input[type="range"] {
                width: 100%;
                margin-bottom: 4px;
                accent-color: #4F46E5;
            }
            
            .slider-control .value {
                font-size: 11px;
                color: #9CA3AF;
                float: right;
            }
            
            .effect-btn, .preset-btn {
                width: 100%;
                padding: 8px 12px;
                margin-bottom: 6px;
                background: linear-gradient(135deg, #4F46E5, #7C3AED);
                border: none;
                border-radius: 6px;
                color: white;
                font-size: 12px;
                cursor: pointer;
                transition: all 0.2s;
            }
            
            .effect-btn:hover, .preset-btn:hover {
                background: linear-gradient(135deg, #5B21B6, #4F46E5);
                transform: translateY(-1px);
            }
            
            .preset-btn {
                background: linear-gradient(135deg, #059669, #10B981);
            }
            
            .preset-btn:hover {
                background: linear-gradient(135deg, #047857, #059669);
            }
            
            /* Botón para mostrar/ocultar panel */
            .panel-toggle {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1001;
                background: #4F46E5;
                border: none;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                color: white;
                font-size: 20px;
                cursor: pointer;
                box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
                transition: all 0.2s;
            }
            
            .panel-toggle:hover {
                background: #4338CA;
                transform: scale(1.1);
            }
        `;
        
        document.head.appendChild(styles);
        document.body.appendChild(this.panel);
        
        // Crear botón toggle
        const toggleButton = document.createElement('button');
        toggleButton.className = 'panel-toggle';
        toggleButton.innerHTML = '🎛️';
        toggleButton.onclick = () => this.togglePanel();
        document.body.appendChild(toggleButton);
    }
    
    setupEventListeners() {
        // Toggles de efectos
        document.getElementById('breathing-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('breathing');
        });
        
        document.getElementById('waves-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('waves');
            if (e.target.checked) this.particleSystem.addWaveEffect();
        });
        
        document.getElementById('magnetic-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('magneticMouse');
            if (e.target.checked) this.particleSystem.addMagneticMouseEffect();
        });
        
        document.getElementById('trails-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('particleTrails');
            if (e.target.checked) this.particleSystem.addParticleTrails();
        });
        
        document.getElementById('colors-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('colorCycling');
        });
        
        document.getElementById('gravity-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('gravity');
            if (e.target.checked) this.particleSystem.addGravityEffect();
        });
        
        document.getElementById('wind-toggle').addEventListener('change', (e) => {
            this.particleSystem.toggleEffect('wind');
            if (e.target.checked) this.particleSystem.addWindEffect();
        });
        
        // Sliders de intensidad
        document.getElementById('breathing-intensity').addEventListener('input', (e) => {
            this.particleSystem.setEffectIntensity('breathing', parseFloat(e.target.value));
            e.target.nextElementSibling.textContent = e.target.value;
        });
        
        document.getElementById('waves-intensity').addEventListener('input', (e) => {
            this.particleSystem.setEffectIntensity('waves', parseFloat(e.target.value));
            e.target.nextElementSibling.textContent = e.target.value;
        });
        
        document.getElementById('gravity-intensity').addEventListener('input', (e) => {
            this.particleSystem.setEffectIntensity('gravity', parseFloat(e.target.value));
            e.target.nextElementSibling.textContent = e.target.value;
        });
        
        document.getElementById('wind-intensity').addEventListener('input', (e) => {
            this.particleSystem.setEffectIntensity('wind', parseFloat(e.target.value));
            e.target.nextElementSibling.textContent = e.target.value;
        });
        
        // Efectos especiales
        document.getElementById('explosion-btn').addEventListener('click', () => {
            this.particleSystem.triggerExplosion(2.0);
        });
        
        document.getElementById('reset-btn').addEventListener('click', () => {
            this.resetAllEffects();
        });
        
        document.getElementById('random-btn').addEventListener('click', () => {
            this.randomizeEffects();
        });
        
        // Presets
        document.querySelectorAll('.preset-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                this.applyPreset(e.target.dataset.preset);
            });
        });
        
        // Toggle panel
        document.getElementById('toggle-panel').addEventListener('click', () => {
            this.togglePanelContent();
        });
    }
    
    togglePanel() {
        this.isVisible = !this.isVisible;
        this.panel.classList.toggle('visible', this.isVisible);
    }
    
    togglePanelContent() {
        const content = this.panel.querySelector('.panel-content');
        const toggle = document.getElementById('toggle-panel');
        
        if (content.style.display === 'none') {
            content.style.display = 'block';
            toggle.textContent = '−';
        } else {
            content.style.display = 'none';
            toggle.textContent = '+';
        }
    }
    
    resetAllEffects() {
        // Desactivar todos los efectos
        Object.keys(this.particleSystem.effects).forEach(effect => {
            this.particleSystem.effects[effect] = false;
        });
        
        // Activar solo efectos básicos
        this.particleSystem.effects.breathing = true;
        this.particleSystem.effects.colorCycling = true;
        
        // Actualizar UI
        this.updateUI();
    }
    
    randomizeEffects() {
        // Activar efectos aleatoriamente
        Object.keys(this.particleSystem.effects).forEach(effect => {
            this.particleSystem.effects[effect] = Math.random() > 0.5;
        });
        
        // Randomizar intensidades
        this.particleSystem.setEffectIntensity('breathing', Math.random() * 0.3);
        this.particleSystem.setEffectIntensity('waves', Math.random() * 0.5);
        this.particleSystem.setEffectIntensity('gravity', Math.random() * 0.2);
        this.particleSystem.setEffectIntensity('wind', Math.random() * 0.1);
        
        this.updateUI();
    }
    
    applyPreset(preset) {
        switch(preset) {
            case 'calm':
                this.resetAllEffects();
                this.particleSystem.effects.breathing = true;
                this.particleSystem.setEffectIntensity('breathing', 0.05);
                break;
                
            case 'dynamic':
                this.resetAllEffects();
                this.particleSystem.effects.breathing = true;
                this.particleSystem.effects.waves = true;
                this.particleSystem.effects.colorCycling = true;
                this.particleSystem.setEffectIntensity('waves', 0.3);
                break;
                
            case 'chaotic':
                Object.keys(this.particleSystem.effects).forEach(effect => {
                    this.particleSystem.effects[effect] = true;
                });
                this.particleSystem.setEffectIntensity('waves', 0.4);
                this.particleSystem.setEffectIntensity('gravity', 0.15);
                break;
                
            case 'minimal':
                this.resetAllEffects();
                break;
        }
        
        this.updateUI();
    }
    
    updateUI() {
        // Actualizar checkboxes
        Object.keys(this.particleSystem.effects).forEach(effect => {
            const checkbox = document.getElementById(effect + '-toggle');
            if (checkbox) {
                checkbox.checked = this.particleSystem.effects[effect];
            }
        });
    }
}
