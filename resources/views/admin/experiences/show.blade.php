@extends('admin.layout')

@section('title', 'Ver Experiencia')
@section('page-title', 'Detalles de la Experiencia')
@section('page-description', 'Información completa de la experiencia laboral')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i data-feather="eye" class="h-5 w-5 lg:h-6 lg:w-6 text-green-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold text-gray-900">{{ $experience->title }}</h2>
                        <p class="text-sm lg:text-base text-gray-600">{{ $experience->company }}</p>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.experiences.edit', $experience) }}" 
                       class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar
                    </a>
                    <a href="{{ route('admin.experiences.index') }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
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
            <!-- Información de la Experiencia -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Trabajo</h3>
                
                <div class="space-y-4">
                    <!-- Título y Empresa -->
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-green-100 rounded-xl flex items-center justify-center">
                            <i data-feather="briefcase" class="h-8 w-8 text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">{{ $experience->title }}</h4>
                            <p class="text-lg text-gray-600">{{ $experience->company }}</p>
                            @if($experience->location)
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i data-feather="map-pin" class="h-4 w-4 mr-1"></i>
                                    {{ $experience->location }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Período -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <div class="text-center">
                                    <p class="text-sm font-medium text-gray-700">Inicio</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $experience->formatted_start_date }}</p>
                                </div>
                                <div class="flex-1 h-px bg-gray-300"></div>
                                <div class="text-center">
                                    <p class="text-sm font-medium text-gray-700">Fin</p>
                                    <p class="text-lg font-semibold text-gray-900">{{ $experience->formatted_end_date }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">Duración</p>
                                <p class="text-lg font-semibold text-green-600">{{ $experience->duration }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tipo de Trabajo -->
                    <div class="flex items-center space-x-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                            <i data-feather="clock" class="h-3 w-3 mr-1"></i>
                            {{ ucfirst(str_replace('-', ' ', $experience->type)) }}
                        </span>
                        @if($experience->is_current)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                <i data-feather="check-circle" class="h-3 w-3 mr-1"></i>
                                Trabajo Actual
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Descripción -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción del Trabajo</h3>
                
                <div class="text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-200 whitespace-pre-wrap">
                    {{ $experience->description }}
                </div>
            </div>

            <!-- Tecnologías Utilizadas -->
            @if($experience->technologies_used && count($experience->technologies_used) > 0)
                <div class="figma-card p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Tecnologías Utilizadas</h3>
                    
                    <div class="flex flex-wrap gap-2">
                        @foreach($experience->technologies_used as $tech)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                <i data-feather="code" class="h-3 w-3 mr-1"></i>
                                {{ $tech }}
                            </span>
                        @endforeach
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
                    <!-- Tipo de Trabajo -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Trabajo</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                            <i data-feather="clock" class="h-3 w-3 mr-1"></i>
                            {{ ucfirst(str_replace('-', ' ', $experience->type)) }}
                        </span>
                    </div>

                    <!-- Ubicación -->
                    @if($experience->location)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Ubicación</label>
                            <p class="text-sm text-gray-900 flex items-center">
                                <i data-feather="map-pin" class="h-4 w-4 mr-1 text-gray-400"></i>
                                {{ $experience->location }}
                            </p>
                        </div>
                    @endif

                    <!-- Orden -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-sm font-semibold text-gray-700">
                            {{ $experience->order }}
                        </span>
                    </div>

                    <!-- Fecha de Creación -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Creado</label>
                        <p class="text-sm text-gray-900">{{ $experience->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Última Actualización -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Actualizado</label>
                        <p class="text-sm text-gray-900">{{ $experience->updated_at->format('d/m/Y H:i') }}</p>
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
                            @if($experience->is_active)
                                <i data-feather="check-circle" class="h-5 w-5 text-green-600"></i>
                                <span class="text-sm font-medium text-gray-900">Activa</span>
                            @else
                                <i data-feather="x-circle" class="h-5 w-5 text-red-600"></i>
                                <span class="text-sm font-medium text-gray-900">Inactiva</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.experiences.toggle-active', $experience) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-xs text-green-600 hover:text-green-800 font-medium">
                                {{ $experience->is_active ? 'Desactivar' : 'Activar' }}
                            </button>
                        </form>
                    </div>

                    <!-- Trabajo Actual -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($experience->is_current)
                                <i data-feather="star" class="h-5 w-5 text-yellow-600"></i>
                                <span class="text-sm font-medium text-gray-900">Trabajo Actual</span>
                            @else
                                <i data-feather="star" class="h-5 w-5 text-gray-400"></i>
                                <span class="text-sm font-medium text-gray-900">Trabajo Anterior</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.experiences.toggle-current', $experience) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-xs text-green-600 hover:text-green-800 font-medium">
                                {{ $experience->is_current ? 'Marcar como anterior' : 'Marcar como actual' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estadísticas</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Duración</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $experience->duration }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Tipo</span>
                        <span class="text-sm font-semibold text-gray-900">{{ ucfirst(str_replace('-', ' ', $experience->type)) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Tecnologías</span>
                        <span class="text-sm font-semibold text-gray-900">{{ count($experience->technologies_used ?? []) }}</span>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.experiences.edit', $experience) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar Experiencia
                    </a>
                    
                    <form action="{{ route('admin.experiences.destroy', $experience) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta experiencia? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                            <i data-feather="trash-2" class="h-4 w-4 mr-2"></i>
                            Eliminar Experiencia
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
