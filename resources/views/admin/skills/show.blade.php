@extends('admin.layout')

@section('title', 'Ver Habilidad')
@section('page-title', 'Detalles de la Habilidad')
@section('page-description', 'Información completa de la habilidad')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                        <i data-feather="eye" class="h-5 w-5 lg:h-6 lg:w-6 text-indigo-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold text-gray-900">{{ $skill->name }}</h2>
                        <p class="text-sm lg:text-base text-gray-600">Detalles de la habilidad</p>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.skills.edit', $skill) }}" 
                       class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar
                    </a>
                    <a href="{{ route('admin.skills.index') }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
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
            <!-- Información de la Habilidad -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información de la Habilidad</h3>
                
                <div class="space-y-4">
                    <!-- Nombre e Icono -->
                    <div class="flex items-center space-x-4">
                        @if($skill->icon)
                            <div class="w-16 h-16 bg-indigo-100 rounded-xl flex items-center justify-center text-2xl">
                                {!! $skill->icon !!}
                            </div>
                        @else
                            <div class="w-16 h-16 bg-gray-100 rounded-xl flex items-center justify-center">
                                <i data-feather="code" class="h-8 w-8 text-gray-400"></i>
                            </div>
                        @endif
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">{{ $skill->name }}</h4>
                            <p class="text-sm text-gray-600">{{ ucfirst($skill->category) }}</p>
                        </div>
                    </div>

                    <!-- Descripción -->
                    @if($skill->description)
                        <div>
                            <h4 class="text-sm font-medium text-gray-700 mb-2">Descripción</h4>
                            <div class="text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-200 whitespace-pre-wrap">
                                {{ $skill->description }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

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
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800 border border-indigo-200">
                            <i data-feather="folder" class="h-3 w-3 mr-1"></i>
                            {{ ucfirst($skill->category) }}
                        </span>
                    </div>

                    <!-- Orden -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Orden</label>
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-sm font-semibold text-gray-700">
                            {{ $skill->order }}
                        </span>
                    </div>

                    <!-- Fecha de Creación -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Creado</label>
                        <p class="text-sm text-gray-900">{{ $skill->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Última Actualización -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Actualizado</label>
                        <p class="text-sm text-gray-900">{{ $skill->updated_at->format('d/m/Y H:i') }}</p>
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
                            @if($skill->is_active)
                                <i data-feather="check-circle" class="h-5 w-5 text-green-600"></i>
                                <span class="text-sm font-medium text-gray-900">Activa</span>
                            @else
                                <i data-feather="x-circle" class="h-5 w-5 text-red-600"></i>
                                <span class="text-sm font-medium text-gray-900">Inactiva</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.skills.toggle-active', $skill) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                                {{ $skill->is_active ? 'Desactivar' : 'Activar' }}
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
                        <span class="text-sm text-gray-600">Categoría</span>
                        @if($skill->category)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium"
                                  style="background-color: {{ $skill->category->color }}20; color: {{ $skill->category->color }};">
                                {{ $skill->category->icon_emoji }} {{ $skill->category->name }}
                            </span>
                        @else
                            <span class="text-sm font-semibold text-gray-900">Sin categoría</span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Orden</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $skill->order }}</span>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.skills.edit', $skill) }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar Habilidad
                    </a>
                    
                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta habilidad? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                            <i data-feather="trash-2" class="h-4 w-4 mr-2"></i>
                            Eliminar Habilidad
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
