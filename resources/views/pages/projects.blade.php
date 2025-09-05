@extends('layouts.app')

@section('title', 'Proyectos - ORivasDev - Portafolio de Desarrollo')
@section('description', 'Oswaldo Rivas - Explora mi portafolio de proyectos desarrollados con Laravel, APIs RESTful y tecnologías móviles. Sistemas web, aplicaciones móviles y microservicios.')

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                Mis Proyectos
            </h1>
            <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                Una colección de proyectos que demuestran mi experiencia en desarrollo backend, 
                APIs RESTful y aplicaciones móviles con las mejores tecnologías.
            </p>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="py-12 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div x-data="projectFilters()" class="space-y-6">
                <!-- Category Filter -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Filtrar por Categoría</h3>
                    <div class="flex flex-wrap gap-3">
                        <button @click="setCategory('all')" 
                                :class="selectedCategory === 'all' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                                class="px-4 py-2 rounded-lg font-medium transition-colors duration-200 hover:bg-primary-600 hover:text-white">
                            Todos
                        </button>
                        @foreach($categories as $category)
                        <button @click="setCategory('{{ $category }}')" 
                                :class="selectedCategory === '{{ $category }}' ? 'bg-primary-600 text-white' : 'bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300'"
                                class="px-4 py-2 rounded-lg font-medium transition-colors duration-200 hover:bg-primary-600 hover:text-white">
                            {{ $category }}
                        </button>
                        @endforeach
                    </div>
                </div>


                <!-- Active Filters Display -->
                <div x-show="selectedCategory !== 'all'" class="flex items-center gap-4">
                    <span class="text-sm text-gray-600 dark:text-gray-400">Filtro activo:</span>
                    <div class="flex gap-2">
                        <span class="inline-flex items-center px-3 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-800 dark:text-primary-200 text-sm rounded-full">
                            Categoría: <span x-text="selectedCategory"></span>
                            <button @click="setCategory('all')" class="ml-2 text-primary-600 hover:text-primary-800">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Grid -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if($projects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
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
                            
                            <!-- Featured Badge -->
                            @if($project->is_featured)
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 bg-yellow-500 text-white text-xs font-medium rounded-full">
                                    Destacado
                                </span>
                            </div>
                            @endif
                            
                            <!-- Category Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1 bg-blue-600 text-white text-xs font-medium rounded-full">
                                    {{ $project->category }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                {{ $project->title }}
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                {{ $project->short_description }}
                            </p>
                            
                            <!-- Technologies -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($project->technologies_list as $tech)
                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs rounded">
                                    {{ $tech }}
                                </span>
                                @endforeach
                            </div>
                            
                            <!-- Action Buttons -->
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
                                   class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
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

                <!-- Pagination -->
                @if($projects->hasPages())
                <div class="mt-12">
                    {{ $projects->links() }}
                </div>
                @endif
            @else
                <div class="text-center py-12">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">
                        No se encontraron proyectos
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        Intenta ajustar los filtros para ver más resultados.
                    </p>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">
                ¿Te gustó lo que viste?
            </h2>
            <p class="text-xl text-blue-100 mb-8 max-w-3xl mx-auto">
                Estoy disponible para nuevos proyectos y colaboraciones. 
                ¡Hablemos sobre cómo puedo ayudarte a crear algo increíble!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact.show') }}" 
                   class="inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                    Contactar
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="{{ route('about') }}" 
                   class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-blue-600 transition-colors duration-200">
                    Conocer Más
                </a>
            </div>
        </div>
    </section>

    <!-- Filter Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('projectFilters', () => ({
                selectedCategory: '{{ request('category', 'all') }}',
                
                setCategory(category) {
                    this.selectedCategory = category;
                    this.applyFilters();
                },
                
                applyFilters() {
                    const params = new URLSearchParams();
                    
                    if (this.selectedCategory !== 'all') {
                        params.append('category', this.selectedCategory);
                    }
                    
                    const url = new URL(window.location);
                    url.search = params.toString();
                    window.location.href = url.toString();
                }
            }));
        });
    </script>
@endsection
