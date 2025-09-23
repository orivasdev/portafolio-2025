@extends('admin.layout')

@section('title', 'Proyectos')
@section('page-title', 'Gestión de Proyectos')
@section('page-description', 'Administra todos los proyectos de tu portafolio')

@section('content')
<!-- Header Section - Mobile Responsive -->
<div class="mb-6">
    <div class="figma-card p-4 lg:p-6">
        <div class="flex flex-col space-y-4 lg:flex-row lg:items-center lg:justify-between lg:space-y-0">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i data-feather="folder" class="h-5 w-5 lg:h-6 lg:w-6 text-blue-600"></i>
                </div>
                <div>
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900">Proyectos</h2>
                    <p class="text-sm lg:text-base text-gray-600">{{ $projects->total() }} proyectos en total</p>
                </div>
            </div>
            
            <!-- Mobile Actions -->
            <div class="flex flex-col space-y-2 lg:flex-row lg:items-center lg:space-y-0 lg:space-x-3">
                <!-- Add New Button - Priority on mobile -->
                <a href="{{ route('admin.projects.create') }}" 
                   class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    <i data-feather="plus" class="h-4 w-4 mr-2"></i>
                    Nuevo Proyecto
                </a>
                
                <!-- Filter Button - Secondary on mobile -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="w-full lg:w-auto inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <i data-feather="filter" class="h-4 w-4 mr-2"></i>
                        Filtrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Projects List - Mobile Responsive -->
<div class="figma-card overflow-hidden">
    <!-- Header -->
    <div class="px-4 py-3 lg:px-6 lg:py-4 border-b border-gray-100 bg-gray-50/50">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <h3 class="text-base lg:text-lg font-semibold text-gray-900">Lista de Proyectos</h3>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    {{ $projects->total() }}
                </span>
            </div>
            <div class="hidden lg:flex items-center space-x-2">
                <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                    <i data-feather="grid" class="h-4 w-4"></i>
                </button>
                <button class="p-2 text-gray-600 bg-gray-100 rounded-lg">
                    <i data-feather="list" class="h-4 w-4"></i>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Cards View -->
    <div class="lg:hidden">
        @forelse($projects as $project)
            <div class="border-b border-gray-100 last:border-b-0">
                <div class="p-4 hover:bg-gray-50 transition-colors">
                    <div class="flex items-start space-x-3">
                        <!-- Project Image -->
                        <div class="flex-shrink-0">
                            @if($project->image)
                                <img class="h-12 w-12 rounded-lg object-cover" src="{{ $project->image_url }}" alt="{{ $project->title }}">
                            @else
                                <div class="h-12 w-12 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i data-feather="image" class="h-5 w-5 text-gray-400"></i>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Project Info -->
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h4 class="text-sm font-semibold text-gray-900 truncate">{{ $project->title }}</h4>
                                    <div class="flex items-center mt-1">
                                        @if($project->category)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium" 
                                                  style="background-color: {{ $project->category->color }}20; color: {{ $project->category->color }};">
                                                {{ $project->category->icon_emoji }} {{ $project->category->name }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                                🔧 Sin categoría
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600 mt-1 line-clamp-2">{{ Str::limit($project->short_description, 80) }}</p>
                                </div>
                                
                                <!-- Mobile Actions -->
                                <div class="flex items-center space-x-1 ml-2">
                                    <a href="{{ route('admin.projects.edit', $project) }}" 
                                       class="p-1.5 text-gray-400 hover:text-blue-600 rounded-md hover:bg-blue-50 transition-colors">
                                        <i data-feather="edit-2" class="h-4 w-4"></i>
                                    </a>
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" 
                                          onsubmit="return confirm('¿Eliminar proyecto?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-gray-400 hover:text-red-600 rounded-md hover:bg-red-50 transition-colors">
                                            <i data-feather="trash-2" class="h-4 w-4"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            
                            <!-- Status and Technologies -->
                            <div class="mt-3 space-y-2">
                                <div class="flex items-center space-x-2">
                                    @if($project->is_active)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700">
                                            <i data-feather="check-circle" class="h-3 w-3 mr-1"></i>
                                            Activo
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700">
                                            <i data-feather="x-circle" class="h-3 w-3 mr-1"></i>
                                            Inactivo
                                        </span>
                                    @endif
                                    
                                    @if($project->is_featured)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700">
                                            <i data-feather="star" class="h-3 w-3 mr-1"></i>
                                            Destacado
                                        </span>
                                    @endif
                                    
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-700">
                                        #{{ $project->order }}
                                    </span>
                                </div>
                                
                                <!-- Technologies -->
                                <div class="flex flex-wrap gap-1">
                                    @foreach(array_slice($project->technologies_list, 0, 3) as $tech)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-50 text-blue-700">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                    @if(count($project->technologies_list) > 3)
                                        <span class="text-xs text-gray-400">+{{ count($project->technologies_list) - 3 }}</span>
                                    @endif
                                </div>
                                
                                <!-- Quick Actions -->
                                <div class="flex items-center space-x-4 pt-2 border-t border-gray-100">
                                    <form action="{{ route('admin.projects.toggle-active', $project) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            {{ $project->is_active ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.projects.toggle-featured', $project) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                            {{ $project->is_featured ? 'No destacar' : 'Destacar' }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-8 text-center">
                <div class="flex flex-col items-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                        <i data-feather="folder-plus" class="h-8 w-8 text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay proyectos</h3>
                    <p class="text-sm text-gray-500 mb-6 max-w-sm text-center">
                        Comienza agregando tu primer proyecto para mostrar tu trabajo
                    </p>
                    <a href="{{ route('admin.projects.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i data-feather="plus" class="h-4 w-4 mr-2"></i>
                        Crear primer proyecto
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Desktop Table View -->
    <div class="hidden lg:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-100">
            <thead class="bg-gray-50/30">
                <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Proyecto
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Categoría
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Orden
                    </th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-50">
                @forelse($projects as $project)
                <tr class="hover:bg-blue-50/30 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex items-center space-x-4">
                            <div class="flex-shrink-0">
                                @if($project->image)
                                    <img class="h-12 w-12 rounded-xl object-cover shadow-sm" src="{{ $project->image_url }}" alt="{{ $project->title }}">
                                @else
                                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <i data-feather="image" class="h-5 w-5 text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 group-hover:text-blue-700 transition-colors">
                                    {{ $project->title }}
                                </p>
                                <p class="text-sm text-gray-500 mt-1">
                                    {{ Str::limit($project->short_description, 60) }}
                                </p>
                                <div class="flex items-center mt-2 space-x-1">
                                    @foreach(array_slice($project->technologies_list, 0, 3) as $tech)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-700">
                                            {{ $tech }}
                                        </span>
                                    @endforeach
                                    @if(count($project->technologies_list) > 3)
                                        <span class="text-xs text-gray-400">+{{ count($project->technologies_list) - 3 }} más</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        @if($project->category)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium border" 
                                  style="background-color: {{ $project->category->color }}20; color: {{ $project->category->color }}; border-color: {{ $project->category->color }}40;">
                                {{ $project->category->icon_emoji }} {{ $project->category->name }}
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                🔧 Sin categoría
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5">
                        <div class="space-y-2">
                            <div class="flex items-center space-x-2">
                                @if($project->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                        <i data-feather="check-circle" class="h-3 w-3 mr-1"></i>
                                        Activo
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-50 text-red-700 border border-red-200">
                                        <i data-feather="x-circle" class="h-3 w-3 mr-1"></i>
                                        Inactivo
                                    </span>
                                @endif
                                
                                @if($project->is_featured)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                        <i data-feather="star" class="h-3 w-3 mr-1"></i>
                                        Destacado
                                    </span>
                                @endif
                            </div>
                            
                            <div class="flex items-center space-x-2">
                                <form action="{{ route('admin.projects.toggle-active', $project) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $project->is_active ? 'Desactivar' : 'Activar' }}
                                    </button>
                                </form>
                                <span class="text-gray-300">•</span>
                                <form action="{{ route('admin.projects.toggle-featured', $project) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                        {{ $project->is_featured ? 'No destacar' : 'Destacar' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5">
                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-100 text-sm font-semibold text-gray-700">
                            {{ $project->order }}
                        </span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-end space-x-2">
                            <a href="{{ route('admin.projects.show', $project) }}" 
                               class="p-2 text-gray-400 hover:text-blue-600 rounded-lg hover:bg-blue-50 transition-colors" title="Ver">
                                <i data-feather="eye" class="h-4 w-4"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" 
                               class="p-2 text-gray-400 hover:text-green-600 rounded-lg hover:bg-green-50 transition-colors" title="Editar">
                                <i data-feather="edit-2" class="h-4 w-4"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" 
                                  onsubmit="return confirm('¿Estás seguro de que quieres eliminar este proyecto?')" 
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 rounded-lg hover:bg-red-50 transition-colors" title="Eliminar">
                                    <i data-feather="trash-2" class="h-4 w-4"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mb-4">
                                <i data-feather="folder-plus" class="h-8 w-8 text-gray-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No hay proyectos</h3>
                            <p class="text-sm text-gray-500 mb-6 max-w-sm">
                                Comienza agregando tu primer proyecto para mostrar tu trabajo
                            </p>
                            <a href="{{ route('admin.projects.create') }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                <i data-feather="plus" class="h-4 w-4 mr-2"></i>
                                Crear primer proyecto
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination - Mobile Responsive -->
    @if($projects->hasPages())
        <div class="px-4 py-4 lg:px-6 border-t border-gray-100 bg-gray-50/30">
            <div class="flex flex-col space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0">
                <div class="text-sm text-gray-500 text-center lg:text-left">
                    Mostrando {{ $projects->firstItem() }} a {{ $projects->lastItem() }} de {{ $projects->total() }} resultados
                </div>
                <div class="flex justify-center lg:justify-end">
                    {{ $projects->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
