@extends('layouts.app')

@section('title', 'Inicio - ORivasDev - Desarrollador Backend')
@section('description', 'Oswaldo Rivas - Desarrollador backend con más de 5 años de experiencia en Laravel, APIs RESTful y desarrollo móvil. Portafolio profesional con proyectos destacados.')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 via-primary-700 to-primary-800 text-white overflow-hidden" style="min-height: 100vh; max-height: 100vh;">
        <!-- Canvas de partículas -->
        <canvas id="particles-canvas" class="absolute inset-0 w-full h-full pointer-events-none z-0" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></canvas>
        
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

@endsection
