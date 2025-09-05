@extends('layouts.app')

@section('title', 'Inicio - ORivasDev - Desarrollador Backend')
@section('description', 'Oswaldo Rivas - Desarrollador backend con más de 5 años de experiencia en Laravel, APIs RESTful y desarrollo móvil. Portafolio profesional con proyectos destacados.')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white overflow-hidden">
        <!-- Canvas de partículas -->
        <canvas id="particles-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
        
        <div class="absolute inset-0 bg-black opacity-20 z-10"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32 z-20">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div id="hero-content" class="opacity-0 transform translate-y-8 transition-all duration-1000 ease-out" style="visibility: hidden;">
                    <h1 class="text-4xl lg:text-6xl font-bold leading-tight mb-6">
                        Desarrollador 
                        <span class="text-primary-200">Backend</span>
                        <br>Especializado
                    </h1>
                    <p class="text-xl lg:text-2xl text-primary-100 mb-8 leading-relaxed">
                        Desarrollador Backend con más de 5 años de experiencia creando soluciones tecnológicas escalables, 
                        eficientes y orientadas al crecimiento empresarial. Especializado en Laravel, APIs RESTful y desarrollo móvil.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('projects') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                            Ver Proyectos
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                        </a>
                        <a href="{{ route('contact.show') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-600 transition-colors duration-200">
                            Contactar
                        </a>
                    </div>
                </div>
                <div id="hero-visual" class="hidden lg:block opacity-0 transform translate-y-8 transition-all duration-1000 ease-out delay-300" style="visibility: hidden;">
                    <div class="relative">
                        <div class="w-96 h-96 bg-primary-500 rounded-full opacity-20 animate-pulse"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-center">
                                <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center mb-4">
                                    <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                    </svg>
                                </div>
                                <p class="text-primary-100 font-medium">Laravel • APIs • Mobile</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Scroll indicator -->
        <div id="scroll-indicator" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 opacity-0 transition-all duration-1000 ease-out delay-500" style="visibility: hidden;">
            <div class="animate-bounce">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="py-20 bg-white dark:bg-gray-800 relative overflow-hidden">
        <!-- Canvas para efectos de habilidades -->
        <canvas id="skills-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Habilidades Técnicas
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Sólido dominio de tecnologías modernas y frameworks para desarrollo web y móvil, 
                    con experiencia en diseño y mantenimiento de sistemas robustos
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($skills as $category => $categorySkills)
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 shadow-md hover:shadow-xl border border-gray-200 dark:border-gray-600 transition-all duration-300">
                    <h3 class="text-xl font-semibold text-primary-900 dark:text-white mb-6 capitalize flex items-center">
                        <span class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mr-3">
                            @if($category === 'Backend')
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                </svg>
                            @elseif($category === 'Frontend')
                                <svg class="w-5 h-5 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @elseif($category === 'Database')
                                <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                            @elseif($category === 'DevOps')
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            @endif
                        </span>
                        {{ $category }}
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($categorySkills->take(6) as $skill)
                        <div class="flex items-center space-x-2 p-2 rounded-lg bg-gray-50 dark:bg-gray-800 hover:bg-primary-100 dark:hover:bg-primary-900/20 transition-colors duration-200 border border-gray-200 dark:border-gray-600">
                            <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                            <span class="text-sm font-medium text-primary-800 dark:text-gray-300">{{ $skill->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Projects Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900 relative overflow-hidden">
        <!-- Canvas para efectos de proyectos -->
        <canvas id="projects-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Proyectos Destacados
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Aplicaciones con funcionalidades avanzadas y soluciones tecnológicas innovadoras
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($featuredProjects as $project)
                <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="aspect-video bg-gray-200 dark:bg-gray-700 relative overflow-hidden">
                        @if($project->image)
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="absolute top-4 right-4">
                            <span class="px-3 py-1 bg-accent-500 text-white text-xs font-medium rounded-full">
                                {{ $project->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            {{ $project->title }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-300 mb-4">
                            {{ $project->short_description }}
                        </p>
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($project->technologies_list as $tech)
                            <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs rounded">
                                {{ $tech }}
                            </span>
                            @endforeach
                        </div>
                        <div class="flex space-x-3">
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" rel="noopener noreferrer"
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-lg hover:bg-gray-800 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                                Código
                            </a>
                            @endif
                            @if($project->live_url)
                            <a href="{{ $project->live_url }}" target="_blank" rel="noopener noreferrer"
                               class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-primary-500 text-white text-sm font-medium rounded-lg hover:bg-primary-600 transition-colors duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                Demo
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('projects') }}" 
                   class="inline-flex items-center px-8 py-4 bg-primary-500 text-white font-semibold rounded-lg hover:bg-primary-600 transition-colors duration-200 shadow-lg">
                    Ver Todos los Proyectos
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="py-20 bg-white dark:bg-gray-800 relative overflow-hidden">
        <!-- Canvas para efectos de experiencia -->
        <canvas id="experience-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Experiencia Laboral
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Más de 5 años de experiencia en desarrollo de software, liderando equipos y creando soluciones innovadoras
                </p>
            </div>

            <div class="space-y-8">
                @foreach($experiences as $experience)
                <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6">
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $experience->title }}
                            </h3>
                            <p class="text-lg text-primary-600 dark:text-primary-400 font-medium">
                                {{ $experience->company }}
                            </p>
                        </div>
                        <div class="text-right mt-2 lg:mt-0">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $experience->formatted_start_date }} - {{ $experience->formatted_end_date }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $experience->duration }}
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        {{ $experience->description }}
                    </p>
                    @if($experience->technologies_used)
                    <div class="flex flex-wrap gap-2">
                        @foreach($experience->technologies_used as $tech)
                        <span class="px-2 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-800 dark:text-primary-200 text-xs rounded">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary-500 text-white relative overflow-hidden">
        <!-- Canvas para efectos de CTA -->
        <canvas id="cta-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0"></canvas>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">
                ¿Tienes un proyecto en mente?
            </h2>
            <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                Estoy listo para ayudarte a convertir tus ideas en realidad. 
                Desarrollemos juntos la próxima gran aplicación web.
            </p>
            <a href="{{ route('contact.show') }}" 
               class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                Comenzar Proyecto
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </section>

    <!-- Sistema de Animaciones Three.js Avanzado con Shaders y Keyframes -->
    <script>
        // Sistema avanzado de animaciones con shaders personalizados y keyframes
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
                this.contentShown = false;
                
                this.init();
            }
            
            init() {
                this.setupEventListeners();
                this.createShaderMaterials();
                this.createHeroSystem();
                this.createSkillsSystem();
                this.createProjectsSystem();
                this.createExperienceSystem();
                this.createCTASystem();
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
            
            createShaderMaterials() {
                // Shader personalizado para partículas con efectos de brillo y transiciones
                this.particleShader = {
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
                            
                            // Efecto de mouse más pronunciado
                            float mouseInfluence = 0.8;
                            pos.x += mouse.x * mouseInfluence * transition;
                            pos.y += mouse.y * mouseInfluence * transition;
                            
                            // Ondas orgánicas cuando está en modo disperso
                            if (transition > 0.1) {
                                pos.x += sin(time * 0.5 + position.y * 0.02) * 0.3 * transition;
                                pos.y += cos(time * 0.3 + position.x * 0.02) * 0.2 * transition;
                                pos.z += sin(time * 0.7 + position.x * 0.03) * 0.1 * transition;
                            }
                            
                            vec4 mvPosition = modelViewMatrix * vec4(pos, 1.0);
                            gl_PointSize = size * (300.0 / -mvPosition.z) * (1.0 + transition * 0.5);
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
                            float alpha = 1.0 - smoothstep(0.0, 0.4, distance);
                            alpha *= vAlpha;
                            
                            // Efecto de brillo más intenso y visible
                            vec3 finalColor = vColor;
                            finalColor += sin(time * 2.0 + transition * 3.0) * 0.3;
                            finalColor += transition * 0.4; // Más brillo cuando está disperso
                            finalColor *= 1.5; // Aumentar brillo general
                            
                            // Efecto de halo para mayor visibilidad
                            float halo = 1.0 - smoothstep(0.0, 0.8, distance);
                            finalColor += halo * 0.2;
                            
                            gl_FragColor = vec4(finalColor, alpha);
                        }
                    `
                };
                
                // Shader para efectos de ondas
                this.waveShader = {
                    vertexShader: `
                        uniform float time;
                        uniform float amplitude;
                        varying vec2 vUv;
                        varying float vElevation;
                        
                        void main() {
                            vUv = uv;
                            vec4 modelPosition = modelMatrix * vec4(position, 1.0);
                            
                            float elevation = sin(modelPosition.x * 0.1 + time) * amplitude;
                            elevation += sin(modelPosition.z * 0.1 + time * 0.5) * amplitude * 0.5;
                            
                            modelPosition.y += elevation;
                            vElevation = elevation;
                            
                            vec4 viewPosition = viewMatrix * modelPosition;
                            vec4 projectedPosition = projectionMatrix * viewPosition;
                            gl_Position = projectedPosition;
                        }
                    `,
                    fragmentShader: `
                        uniform vec3 color1;
                        uniform vec3 color2;
                        uniform float time;
                        varying vec2 vUv;
                        varying float vElevation;
                        
                        void main() {
                            vec3 color = mix(color1, color2, vElevation * 0.5 + 0.5);
                            color += sin(time + vUv.x * 10.0) * 0.1;
                            gl_FragColor = vec4(color, 0.8);
                        }
                    `
                };
            }
            
            createHeroSystem() {
                const canvas = document.getElementById('particles-canvas');
                if (!canvas) return;
                
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
                
                renderer.setSize(window.innerWidth, window.innerHeight);
                camera.position.z = 5;
                
                // Crear partículas que formen el texto "ORIVASDEV"
                const textParticles = this.createTextParticles("ORIVASDEV");
                const particleCount = textParticles.length;
                
                const geometry = new THREE.BufferGeometry();
                const positions = new Float32Array(particleCount * 3);
                const colors = new Float32Array(particleCount * 3);
                const sizes = new Float32Array(particleCount);
                const alphas = new Float32Array(particleCount);
                const targetPositions = new Float32Array(particleCount * 3);
                const originalPositions = new Float32Array(particleCount * 3);
                
                // Configurar partículas basadas en el texto
                textParticles.forEach((particle, i) => {
                    const i3 = i * 3;
                    
                    // Posición inicial del texto
                    originalPositions[i3] = particle.x;
                    originalPositions[i3 + 1] = particle.y;
                    originalPositions[i3 + 2] = particle.z;
                    
                    // Posición actual (inicialmente igual a la original)
                    positions[i3] = particle.x;
                    positions[i3 + 1] = particle.y;
                    positions[i3 + 2] = particle.z;
                    
                    // Posición objetivo (inicialmente igual a la original)
                    targetPositions[i3] = particle.x;
                    targetPositions[i3 + 1] = particle.y;
                    targetPositions[i3 + 2] = particle.z;
                    
                    // Colores verde-amarillo más vibrantes como en la imagen
                    colors[i3] = 0.2 + Math.random() * 0.2; // R más rojo
                    colors[i3 + 1] = 0.8 + Math.random() * 0.2; // G más verde brillante
                    colors[i3 + 2] = 0.3 + Math.random() * 0.4; // B más azul
                    
                    sizes[i] = 0.05 + Math.random() * 0.03; // Partículas más grandes
                    alphas[i] = 0.9 + Math.random() * 0.1; // Más opacas
                });
                
                geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
                geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
                geometry.setAttribute('size', new THREE.BufferAttribute(sizes, 1));
                geometry.setAttribute('alpha', new THREE.BufferAttribute(alphas, 1));
                
                const material = new THREE.ShaderMaterial({
                    uniforms: {
                        time: { value: 0 },
                        mouse: { value: new THREE.Vector2() },
                        transition: { value: 0 }
                    },
                    vertexShader: this.particleShader.vertexShader,
                    fragmentShader: this.particleShader.fragmentShader,
                    transparent: true,
                    blending: THREE.AdditiveBlending
                });
                
                const particleSystem = new THREE.Points(geometry, material);
                scene.add(particleSystem);
                
                this.systems.hero = {
                    scene, camera, renderer, particleSystem,
                    positions, targetPositions, originalPositions,
                    colors, sizes, alphas, material,
                    transitionTime: 0,
                    isTransitioning: false,
                    particleCount
                };
            }
            
            createTextParticles(text) {
                const particles = [];
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = 1200;
                canvas.height = 300;
                
                // Configurar el texto con mejor visibilidad
                ctx.font = 'bold 180px Arial, sans-serif';
                ctx.fillStyle = 'white';
                ctx.textAlign = 'center';
                ctx.textBaseline = 'middle';
                ctx.strokeStyle = 'white';
                ctx.lineWidth = 4;
                
                // Dibujar el texto con contorno para mayor visibilidad
                ctx.strokeText(text, canvas.width / 2, canvas.height / 2);
                ctx.fillText(text, canvas.width / 2, canvas.height / 2);
                
                // Extraer píxeles del texto con mayor densidad
                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const data = imageData.data;
                
                // Crear partículas más densas y visibles
                for (let x = 0; x < canvas.width; x += 2) { // Reducido de 4 a 2 para más densidad
                    for (let y = 0; y < canvas.height; y += 2) {
                        const index = (y * canvas.width + x) * 4;
                        const alpha = data[index + 3];
                        
                        if (alpha > 50) { // Reducido el umbral para capturar más píxeles
                            const particleX = (x - canvas.width / 2) * 0.008; // Ajustado el tamaño
                            const particleY = -(y - canvas.height / 2) * 0.008;
                            const particleZ = (Math.random() - 0.5) * 0.3; // Menos dispersión en Z
                            
                            particles.push({
                                x: particleX,
                                y: particleY,
                                z: particleZ
                            });
                        }
                    }
                }
                
                return particles;
            }
            
            easeInOutCubic(t) {
                return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
            }
            
            showHeroContent() {
                if (this.contentShown) return;
                this.contentShown = true;
                
                // Efecto dramático: mostrar contenido principal con delay
                setTimeout(() => {
                    const heroContent = document.getElementById('hero-content');
                    if (heroContent) {
                        heroContent.style.visibility = 'visible';
                        heroContent.style.opacity = '1';
                        heroContent.style.transform = 'translateY(0)';
                    }
                }, 500); // Delay de 500ms después de que termine la dispersión
                
                // Mostrar visual con delay más largo
                setTimeout(() => {
                    const heroVisual = document.getElementById('hero-visual');
                    if (heroVisual) {
                        heroVisual.style.visibility = 'visible';
                        heroVisual.style.opacity = '1';
                        heroVisual.style.transform = 'translateY(0)';
                    }
                }, 800); // Delay de 800ms
                
                // Mostrar scroll indicator al final
                setTimeout(() => {
                    const scrollIndicator = document.getElementById('scroll-indicator');
                    if (scrollIndicator) {
                        scrollIndicator.style.visibility = 'visible';
                        scrollIndicator.style.opacity = '1';
                    }
                }, 1200); // Delay de 1200ms
            }
            
            createSkillsSystem() {
                const canvas = document.getElementById('skills-canvas');
                if (!canvas) return;
                
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
                
                renderer.setSize(window.innerWidth, window.innerHeight);
                camera.position.z = 8;
                
                // Crear elementos flotantes para habilidades
                const skillElements = [];
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
                    
                    scene.add(mesh);
                    skillElements.push(mesh);
                }
                
                this.systems.skills = {
                    scene, camera, renderer, skillElements
                };
            }
            
            createProjectsSystem() {
                const canvas = document.getElementById('projects-canvas');
                if (!canvas) return;
                
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
                
                renderer.setSize(window.innerWidth, window.innerHeight);
                camera.position.z = 10;
                
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
                
                const lines = new THREE.LineSegments(geometry, material);
                scene.add(lines);
                
                this.systems.projects = {
                    scene, camera, renderer, lines,
                    originalPositions: positions.slice()
                };
            }
            
            createExperienceSystem() {
                const canvas = document.getElementById('experience-canvas');
                if (!canvas) return;
                
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
                
                renderer.setSize(window.innerWidth, window.innerHeight);
                camera.position.z = 12;
                
                // Crear partículas de experiencia
                const geometry = new THREE.BufferGeometry();
                const positions = new Float32Array(100 * 3);
                const colors = new Float32Array(100 * 3);
                
                for (let i = 0; i < 100; i++) {
                    const i3 = i * 3;
                    positions[i3] = (Math.random() - 0.5) * 25;
                    positions[i3 + 1] = (Math.random() - 0.5) * 25;
                    positions[i3 + 2] = (Math.random() - 0.5) * 25;
                    
                    colors[i3] = 0.2;
                    colors[i3 + 1] = 0.6;
                    colors[i3 + 2] = 0.8;
                }
                
                geometry.setAttribute('position', new THREE.BufferAttribute(positions, 3));
                geometry.setAttribute('color', new THREE.BufferAttribute(colors, 3));
                
                const material = new THREE.PointsMaterial({
                    size: 0.02,
                    vertexColors: true,
                    transparent: true,
                    opacity: 0.5,
                    blending: THREE.AdditiveBlending
                });
                
                const particleSystem = new THREE.Points(geometry, material);
                scene.add(particleSystem);
                
                this.systems.experience = {
                    scene, camera, renderer, particleSystem,
                    originalPositions: positions.slice(),
                    originalColors: colors.slice()
                };
            }
            
            createCTASystem() {
                const canvas = document.getElementById('cta-canvas');
                if (!canvas) return;
                
                const scene = new THREE.Scene();
                const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
                const renderer = new THREE.WebGLRenderer({ canvas, alpha: true, antialias: true });
                
                renderer.setSize(window.innerWidth, window.innerHeight);
                camera.position.z = 6;
                
                // Crear efectos de llamada a la acción
                const ctaElements = [];
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
                    
                    scene.add(mesh);
                    ctaElements.push(mesh);
                }
                
                this.systems.cta = {
                    scene, camera, renderer, ctaElements
                };
            }
            
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
                
                // Animar sistema hero con transición de texto a partículas
                if (this.systems.hero) {
                    const { 
                        particleSystem, material, positions, targetPositions, 
                        originalPositions, transitionTime, isTransitioning, particleCount 
                    } = this.systems.hero;
                    
                    // Actualizar uniforms del shader
                    material.uniforms.time.value = this.time;
                    material.uniforms.mouse.value.set(this.mouse.x, this.mouse.y);
                    
                    // Controlar la transición
                    if (!isTransitioning && this.time > 1.5) {
                        // Después de 1.5 segundos, comenzar transición
                        this.systems.hero.isTransitioning = true;
                    }
                    
                    // Mostrar contenido después de que las partículas terminen de dispersarse
                    if (isTransitioning && this.systems.hero.transitionTime > 0.8) {
                        this.showHeroContent();
                    }
                    
                    if (isTransitioning) {
                        this.systems.hero.transitionTime += deltaTime * 0.8;
                        const transition = Math.min(this.systems.hero.transitionTime, 1);
                        material.uniforms.transition.value = transition;
                        
                        // Calcular posiciones objetivo con dispersión más elegante
                        for (let i = 0; i < particleCount; i++) {
                            const i3 = i * 3;
                            const originalX = originalPositions[i3];
                            const originalY = originalPositions[i3 + 1];
                            const originalZ = originalPositions[i3 + 2];
                            
                            // Crear dispersión más orgánica usando funciones trigonométricas
                            const angle = (i / particleCount) * Math.PI * 2;
                            const radius = 3 + Math.sin(i * 0.1) * 2;
                            const height = Math.cos(i * 0.05) * 1.5;
                            
                            const dispersedX = originalX + Math.cos(angle) * radius;
                            const dispersedY = originalY + Math.sin(angle) * radius + height;
                            const dispersedZ = originalZ + Math.sin(i * 0.02) * 2;
                            
                            // Influencia del mouse más suave
                            const mouseX = this.mouse.x * 1.5;
                            const mouseY = this.mouse.y * 1.5;
                            
                            // Interpolar con easing suave
                            const easeTransition = this.easeInOutCubic(transition);
                            targetPositions[i3] = originalX + (dispersedX - originalX) * easeTransition + mouseX * easeTransition;
                            targetPositions[i3 + 1] = originalY + (dispersedY - originalY) * easeTransition + mouseY * easeTransition;
                            targetPositions[i3 + 2] = originalZ + (dispersedZ - originalZ) * easeTransition;
                        }
                    }
                    
                    // Suavizar movimiento hacia las posiciones objetivo
                    for (let i = 0; i < particleCount; i++) {
                        const i3 = i * 3;
                        positions[i3] += (targetPositions[i3] - positions[i3]) * 0.1;
                        positions[i3 + 1] += (targetPositions[i3 + 1] - positions[i3 + 1]) * 0.1;
                        positions[i3 + 2] += (targetPositions[i3 + 2] - positions[i3 + 2]) * 0.1;
                    }
                    
                    particleSystem.geometry.attributes.position.needsUpdate = true;
                    
                    // Efectos de cámara dinámicos
                    this.systems.hero.camera.position.x = Math.sin(this.time * 0.1) * 0.3;
                    this.systems.hero.camera.position.y = Math.cos(this.time * 0.15) * 0.2;
                    this.systems.hero.camera.lookAt(0, 0, 0);
                    
                    this.systems.hero.renderer.render(this.systems.hero.scene, this.systems.hero.camera);
                }
                
                // Animar sistema skills
                if (this.systems.skills) {
                    this.systems.skills.skillElements.forEach((element, index) => {
                        element.rotation.x += 0.01;
                        element.rotation.y += 0.01;
                        element.position.y += Math.sin(this.time + index) * 0.01;
                    });
                    this.systems.skills.renderer.render(this.systems.skills.scene, this.systems.skills.camera);
                }
                
                // Animar sistema projects
                if (this.systems.projects) {
                    const { lines, originalPositions } = this.systems.projects;
                    const positions = lines.geometry.attributes.position.array;
                    
                    for (let i = 0; i < positions.length; i += 3) {
                        positions[i + 1] += Math.sin(this.time + i) * 0.01;
                    }
                    lines.geometry.attributes.position.needsUpdate = true;
                    this.systems.projects.renderer.render(this.systems.projects.scene, this.systems.projects.camera);
                }
                
                // Animar sistema experience
                if (this.systems.experience) {
                    const { particleSystem, originalPositions, originalColors } = this.systems.experience;
                    const positions = particleSystem.geometry.attributes.position.array;
                    const colors = particleSystem.geometry.attributes.color.array;
                    
                    for (let i = 0; i < positions.length / 3; i++) {
                        const i3 = i * 3;
                        const originalX = originalPositions[i3];
                        const originalY = originalPositions[i3 + 1];
                        const originalZ = originalPositions[i3 + 2];
                        
                        const wave1 = Math.sin(this.time * 0.3 + i * 0.02) * 0.1;
                        const wave2 = Math.cos(this.time * 0.4 + i * 0.03) * 0.08;
                        const wave3 = Math.sin(this.time * 0.6 + i * 0.025) * 0.06;
                        
                        positions[i3] = originalX + wave1;
                        positions[i3 + 1] = originalY + wave2;
                        positions[i3 + 2] = originalZ + wave3;
                        
                        const pulse = 0.7 + Math.sin(this.time * 1.5 + i * 0.05) * 0.3;
                        colors[i3 + 1] = originalColors[i3 + 1] * pulse;
                    }
                    
                    particleSystem.geometry.attributes.position.needsUpdate = true;
                    particleSystem.geometry.attributes.color.needsUpdate = true;
                    this.systems.experience.renderer.render(this.systems.experience.scene, this.systems.experience.camera);
                }
                
                // Animar sistema CTA
                if (this.systems.cta) {
                    this.systems.cta.ctaElements.forEach((element, index) => {
                        element.rotation.x += 0.02;
                        element.rotation.y += 0.02;
                        element.position.x += Math.sin(this.time * 0.5 + index) * 0.005;
                        element.position.y += Math.cos(this.time * 0.3 + index) * 0.005;
                    });
                    this.systems.cta.renderer.render(this.systems.cta.scene, this.systems.cta.camera);
                }
            }
        }
        
        // Inicializar sistema avanzado de animaciones
        document.addEventListener('DOMContentLoaded', () => {
            if (window.location.pathname === '/' || window.location.pathname === '/home') {
                new AdvancedThreeJSAnimationSystem();
            }
        });
    </script>
@endsection
