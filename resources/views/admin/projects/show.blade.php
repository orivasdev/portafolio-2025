@extends('admin.layout')

@section('title', 'Ver Proyecto')
@section('page-title', 'Detalles del Proyecto')
@section('page-description', 'Información completa del proyecto')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i data-feather="eye" class="h-5 w-5 lg:h-6 lg:w-6 text-blue-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold text-gray-900">{{ $project->title }}</h2>
                        <p class="text-sm lg:text-base text-gray-600">Detalles del proyecto</p>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.projects.edit', $project) }}" 
                       class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar
                    </a>
                    <a href="{{ route('admin.projects.index') }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i data-feather="arrow-left" class="h-4 w-4 mr-2"></i>
                        Volver
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contenido Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Imagen del Proyecto -->
            @if($project->image)
                <div class="figma-card p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Imagen del Proyecto</h3>
                    <div class="relative">
                        <img src="{{ $project->image_url }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-64 object-cover rounded-lg border border-gray-200">
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/90 text-gray-700 backdrop-blur-sm">
                                <i data-feather="image" class="h-4 w-4 mr-1"></i>
                                Imagen Principal
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Descripción -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción</h3>
                
                <div class="space-y-4">
                    <!-- Descripción Corta -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Descripción Corta</h4>
                        <p class="text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-200">
                            {{ $project->short_description }}
                        </p>
                    </div>

                    <!-- Descripción Completa -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Descripción Completa</h4>
                        <div class="text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-200 whitespace-pre-wrap">
                            {{ $project->description }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tecnologías -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Tecnologías Utilizadas</h3>
                
                @if($project->technologies_list && count($project->technologies_list) > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies_list as $tech)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                <i data-feather="code" class="h-3 w-3 mr-1"></i>
                                {{ $tech }}
                            </span>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 italic">No se han especificado tecnologías para este proyecto.</p>
                @endif
            </div>

            <!-- Enlaces -->
            @if($project->github_url || $project->live_url)
                <div class="figma-card p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Enlaces</h3>
                    
                    <div class="space-y-3">
                        @if($project->github_url)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center">
                                        <i data-feather="github" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Código Fuente</p>
                                        <p class="text-xs text-gray-500">Repositorio en GitHub</p>
                                    </div>
                                </div>
                                <a href="{{ $project->github_url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center px-3 py-1 bg-gray-800 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                                    <i data-feather="external-link" class="h-3 w-3 mr-1"></i>
                                    Ver Código
                                </a>
                            </div>
                        @endif

                        @if($project->live_url)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center">
                                        <i data-feather="globe" class="h-4 w-4 text-white"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Sitio Web</p>
                                        <p class="text-xs text-gray-500">Aplicación en vivo</p>
                                    </div>
                                </div>
                                <a href="{{ $project->live_url }}" 
                                   target="_blank" 
                                   rel="noopener noreferrer"
                                   class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                                    <i data-feather="external-link" class="h-3 w-3 mr-1"></i>
                                    Ver Sitio
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Información General -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información General</h3>
                
                <div class="space-y-4">
                    <!-- Categoría -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Categoría</label>
                        @if($project->category)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium border" 
                                  style="background-color: {{ $project->category->color }}20; color: {{ $project->category->color }}; border-color: {{ $project->category->color }}40;">
                                {{ $project->category->icon_emoji }} {{ $project->category->name }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                <i data-feather="folder" class="h-3 w-3 mr-1"></i>
                                Sin categoría
                            </span>
                        @endif
                    </div>

                    <!-- Orden -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-sm font-semibold text-gray-700">
                            {{ $project->order }}
                        </span>
                    </div>

                    <!-- Fecha de Creación -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Creado</label>
                        <p class="text-sm text-gray-900">{{ $project->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Última Actualización -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Actualizado</label>
                        <p class="text-sm text-gray-900">{{ $project->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Estado -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado</h3>
                
                <div class="space-y-4">
                    <!-- Estado Activo -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($project->is_active)
                                <i data-feather="check-circle" class="h-5 w-5 text-green-600"></i>
                                <span class="text-sm font-medium text-gray-900">Activo</span>
                            @else
                                <i data-feather="x-circle" class="h-5 w-5 text-red-600"></i>
                                <span class="text-sm font-medium text-gray-900">Inactivo</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.projects.toggle-active', $project) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                {{ $project->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </div>

                    <!-- Proyecto Destacado -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($project->is_featured)
                                <i data-feather="star" class="h-5 w-5 text-yellow-600"></i>
                                <span class="text-sm font-medium text-gray-900">Destacado</span>
                            @else
                                <i data-feather="star" class="h-5 w-5 text-gray-400"></i>
                                <span class="text-sm font-medium text-gray-900">No Destacado</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.projects.toggle-featured', $project) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                {{ $project->is_featured ? 'No destacar' : 'Destacar' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.projects.edit', $project) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar Proyecto
                    </a>
                    
                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de que quieres eliminar este proyecto? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                            <i data-feather="trash-2" class="h-4 w-4 mr-2"></i>
                            Eliminar Proyecto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
