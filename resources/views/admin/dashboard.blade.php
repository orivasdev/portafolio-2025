@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-description', 'Resumen general de tu portafolio')

@section('content')
<!-- Welcome Section - Figma Style -->
<div class="mb-8">
    <div class="figma-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl flex items-center justify-center">
                    <i data-feather="activity" class="h-6 w-6 text-white"></i>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">¡Bienvenido de vuelta!</h2>
                    <p class="text-gray-600">Gestiona el contenido de tu portafolio desde aquí</p>
                </div>
            </div>
            <div class="hidden sm:flex items-center space-x-6">
                <div class="text-center">
                    <p class="text-2xl font-bold text-gray-900">{{ now()->format('d') }}</p>
                    <p class="text-xs text-gray-500 uppercase">{{ now()->format('M Y') }}</p>
                </div>
                <div class="w-px h-12 bg-gray-200"></div>
                <div class="text-center">
                    <p class="text-lg font-semibold text-gray-900">{{ now()->format('H:i') }}</p>
                    <p class="text-xs text-gray-500">Hora actual</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards - Figma Design -->
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">
    <!-- Proyectos -->
    <div class="figma-stat-card group cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                <i data-feather="folder" class="h-6 w-6 text-blue-600"></i>
            </div>
            <div class="text-right">
                <div class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">
                    {{ $stats['projects']['active'] }}/{{ $stats['projects']['total'] }}
                </div>
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600 mb-1">Total Proyectos</p>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['projects']['total'] }}</p>
            <div class="flex items-center text-sm text-gray-500">
                <i data-feather="trending-up" class="h-4 w-4 mr-1 text-green-500"></i>
                <span>{{ $stats['projects']['featured'] }} destacados</span>
            </div>
        </div>
    </div>

    <!-- Habilidades -->
    <div class="figma-stat-card group cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-200 transition-colors">
                <i data-feather="star" class="h-6 w-6 text-green-600"></i>
            </div>
            <div class="text-right">
                <div class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">
                    {{ $stats['skills']['active'] }}/{{ $stats['skills']['total'] }}
                </div>
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600 mb-1">Habilidades</p>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['skills']['total'] }}</p>
            <div class="flex items-center text-sm text-gray-500">
                <i data-feather="check-circle" class="h-4 w-4 mr-1 text-green-500"></i>
                <span>{{ $stats['skills']['active'] }} activas</span>
            </div>
        </div>
    </div>

    <!-- Experiencias -->
    <div class="figma-stat-card group cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                <i data-feather="briefcase" class="h-6 w-6 text-purple-600"></i>
            </div>
            <div class="text-right">
                <div class="text-xs font-medium text-purple-600 bg-purple-50 px-2 py-1 rounded-full">
                    {{ $stats['experiences']['active'] }}/{{ $stats['experiences']['total'] }}
                </div>
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600 mb-1">Experiencias</p>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['experiences']['total'] }}</p>
            <div class="flex items-center text-sm text-gray-500">
                @if($stats['experiences']['current'] > 0)
                    <i data-feather="clock" class="h-4 w-4 mr-1 text-blue-500"></i>
                    <span>{{ $stats['experiences']['current'] }} actual</span>
                @else
                    <i data-feather="check-circle" class="h-4 w-4 mr-1 text-green-500"></i>
                    <span>{{ $stats['experiences']['active'] }} activas</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Contactos -->
    <div class="figma-stat-card group cursor-pointer">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                <i data-feather="mail" class="h-6 w-6 text-orange-600"></i>
            </div>
            <div class="text-right">
                @if($stats['contacts']['unread'] > 0)
                    <div class="text-xs font-medium text-red-600 bg-red-50 px-2 py-1 rounded-full animate-pulse">
                        {{ $stats['contacts']['unread'] }} nuevos
                    </div>
                @else
                    <div class="text-xs font-medium text-green-600 bg-green-50 px-2 py-1 rounded-full">
                        Al día
                    </div>
                @endif
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-600 mb-1">Mensajes</p>
            <p class="text-3xl font-bold text-gray-900 mb-2">{{ $stats['contacts']['total'] }}</p>
            <div class="flex items-center text-sm text-gray-500">
                @if($stats['contacts']['unread'] > 0)
                    <i data-feather="alert-circle" class="h-4 w-4 mr-1 text-red-500"></i>
                    <span>{{ $stats['contacts']['unread'] }} sin leer</span>
                @else
                    <i data-feather="check-circle" class="h-4 w-4 mr-1 text-green-500"></i>
                    <span>Todos leídos</span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity - Figma Style -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <!-- Contactos recientes -->
    <div class="figma-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Contactos Recientes</h3>
                <i data-feather="message-circle" class="h-5 w-5 text-gray-400"></i>
            </div>
        </div>
        <div class="p-0">
            @forelse($recentContacts as $contact)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-b-0">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-semibold text-white">
                                {{ strtoupper(substr($contact->name, 0, 2)) }}
                            </span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $contact->name }}</p>
                                @if($contact->status === 'unread')
                                    <span class="ml-2 w-2 h-2 bg-red-500 rounded-full"></span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 truncate">{{ $contact->email }}</p>
                            <p class="text-sm text-gray-700 truncate mt-1">{{ $contact->subject }}</p>
                            <p class="text-xs text-gray-400 mt-1">{{ $contact->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <i data-feather="inbox" class="h-8 w-8 text-gray-300 mx-auto mb-2"></i>
                    <p class="text-gray-500 text-sm">No hay contactos recientes</p>
                </div>
            @endforelse
        </div>
        @if($recentContacts->count() > 0)
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('admin.contacts.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center justify-center">
                    Ver todos los contactos
                    <i data-feather="arrow-right" class="h-4 w-4 ml-1"></i>
                </a>
            </div>
        @endif
    </div>

    <!-- Proyectos recientes -->
    <div class="figma-card">
        <div class="px-6 py-4 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Proyectos Recientes</h3>
                <i data-feather="folder" class="h-5 w-5 text-gray-400"></i>
            </div>
        </div>
        <div class="p-0">
            @forelse($recentProjects as $project)
                <div class="px-6 py-4 hover:bg-gray-50 transition-colors border-b border-gray-50 last:border-b-0">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            @if($project->image)
                                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-10 h-10 rounded-lg object-cover">
                            @else
                                <i data-feather="image" class="h-5 w-5 text-gray-400"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <p class="text-sm font-semibold text-gray-900 truncate">{{ $project->title }}</p>
                                <div class="flex items-center space-x-1 ml-2">
                                    @if($project->is_featured)
                                        <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                                    @endif
                                    @if($project->is_active)
                                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                                    @endif
                                </div>
                            </div>
                            <p class="text-xs text-gray-500">{{ $project->category }}</p>
                            <div class="flex items-center mt-2 space-x-2">
                                @if($project->is_featured)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-50 text-yellow-700 border border-yellow-200">
                                        Destacado
                                    </span>
                                @endif
                                @if($project->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-50 text-green-700 border border-green-200">
                                        Activo
                                    </span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-400 mt-1">{{ $project->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <i data-feather="folder-plus" class="h-8 w-8 text-gray-300 mx-auto mb-2"></i>
                    <p class="text-gray-500 text-sm">No hay proyectos recientes</p>
                </div>
            @endforelse
        </div>
        @if($recentProjects->count() > 0)
            <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                <a href="{{ route('admin.projects.index') }}" class="text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center justify-center">
                    Ver todos los proyectos
                    <i data-feather="arrow-right" class="h-4 w-4 ml-1"></i>
                </a>
            </div>
        @endif
    </div>
</div>

<!-- Quick Actions - Figma Style -->
<div class="mb-8">
    <div class="figma-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900">Acciones Rápidas</h3>
            <i data-feather="zap" class="h-5 w-5 text-gray-400"></i>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.projects.create') }}" class="group flex flex-col items-center p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center group-hover:bg-blue-200 mb-2">
                    <i data-feather="plus" class="h-5 w-5 text-blue-600"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Nuevo Proyecto</span>
            </a>
            
            <a href="{{ route('admin.skills.create') }}" class="group flex flex-col items-center p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all">
                <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-200 mb-2">
                    <i data-feather="plus" class="h-5 w-5 text-green-600"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-green-700">Nueva Habilidad</span>
            </a>
            
            <a href="{{ route('admin.experiences.create') }}" class="group flex flex-col items-center p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-purple-300 hover:bg-purple-50 transition-all">
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center group-hover:bg-purple-200 mb-2">
                    <i data-feather="plus" class="h-5 w-5 text-purple-600"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-purple-700">Nueva Experiencia</span>
            </a>
            
            <a href="{{ route('admin.contacts.index') }}" class="group flex flex-col items-center p-4 rounded-xl border-2 border-dashed border-gray-200 hover:border-orange-300 hover:bg-orange-50 transition-all">
                <div class="w-10 h-10 bg-orange-100 rounded-xl flex items-center justify-center group-hover:bg-orange-200 mb-2">
                    <i data-feather="eye" class="h-5 w-5 text-orange-600"></i>
                </div>
                <span class="text-sm font-medium text-gray-700 group-hover:text-orange-700">Ver Contactos</span>
            </a>
        </div>
    </div>
</div>

<!-- Distribución de habilidades por categoría - Figma Style -->
@if(!empty($stats['skills']['by_category']))
    <div class="mb-8">
        <div class="figma-card p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-gray-900">Habilidades por Categoría</h3>
                <i data-feather="bar-chart-2" class="h-5 w-5 text-gray-400"></i>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($stats['skills']['by_category'] as $category => $count)
                    <div class="group p-4 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl hover:from-blue-50 hover:to-blue-100 transition-all cursor-pointer">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900 group-hover:text-blue-600 transition-colors">{{ $count }}</div>
                            <div class="text-sm text-gray-600 capitalize mt-1">{{ $category }}</div>
                            <div class="w-full bg-gray-200 rounded-full h-1 mt-2">
                                <div class="bg-blue-500 h-1 rounded-full transition-all duration-500" style="width: {{ ($count / $stats['skills']['total']) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@endsection
