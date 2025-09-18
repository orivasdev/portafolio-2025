// Sistema de partículas reactivas al audio
class AudioReactiveParticleSystem {
    constructor(particleSystem) {
        this.particleSystem = particleSystem;
        this.audioContext = null;
        this.analyser = null;
        this.dataArray = null;
        this.source = null;
        this.isListening = false;
        
        // Configuración de análisis
        this.fftSize = 256;
        this.frequencyBands = {
            bass: { start: 0, end: 50 },
            mid: { start: 50, end: 150 },
            treble: { start: 150, end: 256 }
        };
        
        // Estado del audio
        this.audioLevels = {
            bass: 0,
            mid: 0,
            treble: 0,
            overall: 0
        };
        
        // Efectos basados en audio
        this.audioEffects = {
            bassExpansion: true,
            trebleShimmer: true,
            midColorShift: true,
            beatPulse: true,
            frequencyWaves: true
        };
        
        this.beatDetection = {
            threshold: 0.3,
            lastBeat: 0,
            beatHistory: []
        };
    }
    
    // Inicializar captura de audio del micrófono
    async initMicrophone() {
        try {
            const stream = await navigator.mediaDevices.getUserMedia({ 
                audio: {
                    echoCancellation: false,
                    noiseSuppression: false,
                    autoGainControl: false
                } 
            });
            
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.analyser = this.audioContext.createAnalyser();
            this.analyser.fftSize = this.fftSize;
            
            this.source = this.audioContext.createMediaStreamSource(stream);
            this.source.connect(this.analyser);
            
            this.dataArray = new Uint8Array(this.analyser.frequencyBinCount);
            this.isListening = true;
            
            console.log('🎤 Micrófono conectado para partículas reactivas');
            return true;
            
        } catch (error) {
            console.error('Error al acceder al micrófono:', error);
            return false;
        }
    }
    
    // Conectar elemento de audio existente
    connectAudioElement(audioElement) {
        try {
            this.audioContext = new (window.AudioContext || window.webkitAudioContext)();
            this.analyser = this.audioContext.createAnalyser();
            this.analyser.fftSize = this.fftSize;
            
            this.source = this.audioContext.createMediaElementSource(audioElement);
            this.source.connect(this.analyser);
            this.source.connect(this.audioContext.destination);
            
            this.dataArray = new Uint8Array(this.analyser.frequencyBinCount);
            this.isListening = true;
            
            console.log('🎵 Elemento de audio conectado');
            return true;
            
        } catch (error) {
            console.error('Error al conectar audio:', error);
            return false;
        }
    }
    
    // Analizar datos de audio
    analyzeAudio() {
        if (!this.isListening || !this.analyser) return;
        
        this.analyser.getByteFrequencyData(this.dataArray);
        
        // Calcular niveles por banda de frecuencia
        this.audioLevels.bass = this.getFrequencyAverage(
            this.frequencyBands.bass.start, 
            this.frequencyBands.bass.end
        );
        
        this.audioLevels.mid = this.getFrequencyAverage(
            this.frequencyBands.mid.start, 
            this.frequencyBands.mid.end
        );
        
        this.audioLevels.treble = this.getFrequencyAverage(
            this.frequencyBands.treble.start, 
            this.frequencyBands.treble.end
        );
        
        this.audioLevels.overall = this.getFrequencyAverage(0, this.dataArray.length);
        
        // Detección de beats
        this.detectBeat();
    }
    
    getFrequencyAverage(startIndex, endIndex) {
        let sum = 0;
        const count = endIndex - startIndex;
        
        for (let i = startIndex; i < endIndex && i < this.dataArray.length; i++) {
            sum += this.dataArray[i];
        }
        
        return (sum / count) / 255; // Normalizar a 0-1
    }
    
    detectBeat() {
        const currentTime = Date.now();
        const bassLevel = this.audioLevels.bass;
        
        // Agregar a historial
        this.beatDetection.beatHistory.push(bassLevel);
        if (this.beatDetection.beatHistory.length > 10) {
            this.beatDetection.beatHistory.shift();
        }
        
        // Calcular promedio
        const average = this.beatDetection.beatHistory.reduce((a, b) => a + b, 0) / this.beatDetection.beatHistory.length;
        
        // Detectar pico
        if (bassLevel > average * 1.5 && 
            bassLevel > this.beatDetection.threshold &&
            currentTime - this.beatDetection.lastBeat > 100) {
            
            this.beatDetection.lastBeat = currentTime;
            this.onBeatDetected();
        }
    }
    
    onBeatDetected() {
        // Efecto de pulso en el beat
        if (this.audioEffects.beatPulse) {
            this.particleSystem.triggerBeatPulse();
        }
        
        console.log('🥁 Beat detectado');
    }
    
    // Aplicar efectos de audio a las partículas
    applyAudioEffects(time) {
        if (!this.isListening) return;
        
        this.analyzeAudio();
        
        const particleCount = this.particleSystem.particleCount;
        
        for (let i = 0; i < particleCount; i++) {
            const i3 = i * 3;
            
            // Posiciones base
            let targetX = this.particleSystem.originalPositions[i3];
            let targetY = this.particleSystem.originalPositions[i3 + 1];
            let targetZ = this.particleSystem.originalPositions[i3 + 2];
            
            // 1. EXPANSIÓN CON BAJOS
            if (this.audioEffects.bassExpansion) {
                const expansion = 1 + this.audioLevels.bass * 0.8;
                targetX *= expansion;
                targetY *= expansion;
            }
            
            // 2. VIBRACIÓN CON AGUDOS
            if (this.audioEffects.trebleShimmer) {
                const shimmer = this.audioLevels.treble * 0.15;
                targetX += (Math.random() - 0.5) * shimmer;
                targetY += (Math.random() - 0.5) * shimmer;
                targetZ += (Math.random() - 0.5) * shimmer * 0.5;
            }
            
            // 3. ONDAS DE FRECUENCIA
            if (this.audioEffects.frequencyWaves) {
                const waveIntensity = this.audioLevels.mid * 0.3;
                const frequency = 5 + this.audioLevels.overall * 10;
                
                targetX += Math.sin(time * frequency + i * 0.1) * waveIntensity;
                targetY += Math.cos(time * frequency + i * 0.1) * waveIntensity;
            }
            
            // 4. CAMBIO DE COLOR CON MEDIOS
            if (this.audioEffects.midColorShift && this.particleSystem.colors) {
                const colorShift = this.audioLevels.mid;
                const hue = (time * 0.5 + colorShift + i * 0.01) % 1;
                const [r, g, b] = this.hslToRgb(hue, 0.8 + colorShift * 0.2, 0.6 + colorShift * 0.3);
                
                this.particleSystem.colors[i3] = r;
                this.particleSystem.colors[i3 + 1] = g;
                this.particleSystem.colors[i3 + 2] = b;
            }
            
            // Aplicar posiciones
            this.particleSystem.targetPositions[i3] = targetX;
            this.particleSystem.targetPositions[i3 + 1] = targetY;
            this.particleSystem.targetPositions[i3 + 2] = targetZ;
        }
        
        // Actualizar tamaño de partículas basado en volumen general
        if (this.particleSystem.sizes) {
            for (let i = 0; i < particleCount; i++) {
                const baseSize = 0.05;
                const audioSize = this.audioLevels.overall * 0.03;
                this.particleSystem.sizes[i] = baseSize + audioSize + Math.random() * 0.01;
            }
            this.particleSystem.particleSystem.geometry.attributes.size.needsUpdate = true;
        }
        
        // Actualizar colores
        if (this.audioEffects.midColorShift && this.particleSystem.particleSystem) {
            this.particleSystem.particleSystem.geometry.attributes.color.needsUpdate = true;
        }
    }
    
    // Crear visualización de espectro de frecuencias
    createSpectrumVisualizer() {
        const canvas = document.createElement('canvas');
        canvas.id = 'spectrum-visualizer';
        canvas.width = 300;
        canvas.height = 100;
        canvas.style.cssText = `
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            z-index: 1000;
        `;
        
        document.body.appendChild(canvas);
        
        const ctx = canvas.getContext('2d');
        
        // Animar visualización
        const animate = () => {
            if (!this.isListening) return;
            
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            if (this.dataArray) {
                const barWidth = canvas.width / this.dataArray.length;
                
                for (let i = 0; i < this.dataArray.length; i++) {
                    const barHeight = (this.dataArray[i] / 255) * canvas.height;
                    
                    // Colores basados en frecuencia
                    let hue;
                    if (i < 50) hue = 0; // Rojos para bajos
                    else if (i < 150) hue = 120; // Verdes para medios
                    else hue = 240; // Azules para agudos
                    
                    ctx.fillStyle = `hsl(${hue}, 100%, ${50 + barHeight/2}%)`;
                    ctx.fillRect(i * barWidth, canvas.height - barHeight, barWidth, barHeight);
                }
            }
            
            // Mostrar niveles de audio
            ctx.fillStyle = 'white';
            ctx.font = '12px Arial';
            ctx.fillText(`Bass: ${(this.audioLevels.bass * 100).toFixed(0)}%`, 10, 20);
            ctx.fillText(`Mid: ${(this.audioLevels.mid * 100).toFixed(0)}%`, 10, 35);
            ctx.fillText(`Treble: ${(this.audioLevels.treble * 100).toFixed(0)}%`, 10, 50);
            
            requestAnimationFrame(animate);
        };
        
        animate();
    }
    
    // Controles de audio
    toggleEffect(effectName) {
        if (this.audioEffects.hasOwnProperty(effectName)) {
            this.audioEffects[effectName] = !this.audioEffects[effectName];
        }
    }
    
    setThreshold(threshold) {
        this.beatDetection.threshold = threshold;
    }
    
    // Método para detener la captura
    stop() {
        this.isListening = false;
        if (this.source) {
            this.source.disconnect();
        }
        if (this.audioContext) {
            this.audioContext.close();
        }
    }
    
    // Helper para conversión de color
    hslToRgb(h, s, l) {
        let r, g, b;
        if (s === 0) {
            r = g = b = l;
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

// Extender el sistema de partículas original con funcionalidad de audio
if (typeof ImageParticleSystem !== 'undefined') {
    ImageParticleSystem.prototype.triggerBeatPulse = function() {
        // Efecto de pulso en beat detectado
        for (let i = 0; i < this.particleCount; i++) {
            const i3 = i * 3;
            const pulse = 1.3;
            
            this.targetPositions[i3] = this.originalPositions[i3] * pulse;
            this.targetPositions[i3 + 1] = this.originalPositions[i3 + 1] * pulse;
            
            // Resetear después de un momento
            setTimeout(() => {
                this.targetPositions[i3] = this.originalPositions[i3];
                this.targetPositions[i3 + 1] = this.originalPositions[i3 + 1];
            }, 100);
        }
    };
}
