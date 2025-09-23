@extends('admin.layout')

@section('title', 'Mi Perfil')
@section('page-title', 'Mi Perfil')
@section('page-description', 'Gestiona tu información personal y profesional')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i data-feather="user" class="h-5 w-5 lg:h-6 lg:w-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold text-gray-900">Mi Perfil</h2>
                        <p class="text-sm lg:text-base text-gray-600">Gestiona tu información personal y profesional</p>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="inline-flex items-center px-3 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar Perfil
                    </a>
                    <a href="{{ route('admin.profile.change-password') }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                        <i data-feather="key" class="h-4 w-4 mr-2"></i>
                        Cambiar Contraseña
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Contenido Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Información Personal -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Personal</h3>
                
                <div class="space-y-4">
                    <!-- Avatar y Datos Básicos -->
                    <div class="flex items-start space-x-4">
                        <div class="w-20 h-20 bg-purple-100 rounded-xl flex items-center justify-center overflow-hidden">
                            @if($user->avatar)
                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-bold text-purple-600">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <h4 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h4>
                            @if($user->title)
                                <p class="text-lg text-gray-600">{{ $user->title }}</p>
                            @endif
                            @if($user->location)
                                <p class="text-sm text-gray-500 flex items-center mt-1">
                                    <i data-feather="map-pin" class="h-4 w-4 mr-1"></i>
                                    {{ $user->location }}
                                </p>
                            @endif
                        </div>
                    </div>

                    <!-- Biografía -->
                    @if($user->bio)
                        <div>
                            <h5 class="text-sm font-medium text-gray-700 mb-2">Biografía</h5>
                            <div class="text-gray-900 bg-gray-50 p-4 rounded-lg border border-gray-200 whitespace-pre-wrap">
                                {{ $user->bio }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información de Contacto -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información de Contacto</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Email -->
                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i data-feather="mail" class="h-4 w-4 text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Email</p>
                            <p class="text-sm text-gray-900">{{ $user->email }}</p>
                        </div>
                    </div>

                    <!-- Teléfono -->
                    @if($user->phone)
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                <i data-feather="phone" class="h-4 w-4 text-green-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Teléfono</p>
                                <p class="text-sm text-gray-900">{{ $user->phone }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Sitio Web -->
                    @if($user->website)
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
                            <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i data-feather="globe" class="h-4 w-4 text-purple-600"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Sitio Web</p>
                                <a href="{{ $user->website }}" target="_blank" class="text-sm text-blue-600 hover:text-blue-800">
                                    {{ $user->website }}
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Redes Sociales -->
            @if($user->linkedin || $user->github || $user->twitter)
                <div class="figma-card p-4 lg:p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Redes Sociales</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @if($user->linkedin)
                            <a href="{{ $user->linkedin }}" target="_blank" 
                               class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                                    <i data-feather="linkedin" class="h-4 w-4 text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">LinkedIn</p>
                                    <p class="text-sm text-blue-600">Ver perfil</p>
                                </div>
                            </a>
                        @endif

                        @if($user->github)
                            <a href="{{ $user->github }}" target="_blank" 
                               class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="w-8 h-8 bg-gray-800 rounded-lg flex items-center justify-center">
                                    <i data-feather="github" class="h-4 w-4 text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">GitHub</p>
                                    <p class="text-sm text-gray-600">Ver perfil</p>
                                </div>
                            </a>
                        @endif

                        @if($user->twitter)
                            <a href="{{ $user->twitter }}" target="_blank" 
                               class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                <div class="w-8 h-8 bg-blue-400 rounded-lg flex items-center justify-center">
                                    <i data-feather="twitter" class="h-4 w-4 text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-700">Twitter</p>
                                    <p class="text-sm text-blue-600">Ver perfil</p>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Información de la Cuenta -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información de la Cuenta</h3>
                
                <div class="space-y-4">
                    <!-- Fecha de Registro -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Miembro desde</label>
                        <p class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</p>
                    </div>

                    <!-- Última Actualización -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Última actualización</label>
                        <p class="text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <!-- Email Verificado -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado del Email</label>
                        <div class="flex items-center space-x-2">
                            @if($user->email_verified_at)
                                <i data-feather="check-circle" class="h-4 w-4 text-green-600"></i>
                                <span class="text-sm text-green-600 font-medium">Verificado</span>
                            @else
                                <i data-feather="x-circle" class="h-4 w-4 text-red-600"></i>
                                <span class="text-sm text-red-600 font-medium">No verificado</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.profile.edit') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                        <i data-feather="edit-2" class="h-4 w-4 mr-2"></i>
                        Editar Perfil
                    </a>
                    
                    <a href="{{ route('admin.profile.change-password') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                        <i data-feather="key" class="h-4 w-4 mr-2"></i>
                        Cambiar Contraseña
                    </a>
                </div>
            </div>

            <!-- Estadísticas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estadísticas</h3>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Proyectos</span>
                        <span class="text-sm font-semibold text-gray-900">{{ \App\Models\Project::count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Habilidades</span>
                        <span class="text-sm font-semibold text-gray-900">{{ \App\Models\Skill::count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Experiencias</span>
                        <span class="text-sm font-semibold text-gray-900">{{ \App\Models\Experience::count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">Mensajes</span>
                        <span class="text-sm font-semibold text-gray-900">{{ \App\Models\Contact::count() }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
