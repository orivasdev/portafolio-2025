@extends('admin.layout')

@section('title', 'Ver Mensaje')
@section('page-title', 'Detalles del Mensaje')
@section('page-description', 'Información completa del mensaje de contacto')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 lg:space-x-4">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i data-feather="mail" class="h-5 w-5 lg:h-6 lg:w-6 text-purple-600"></i>
                    </div>
                    <div>
                        <h2 class="text-lg lg:text-xl font-bold text-gray-900">Mensaje de {{ $contact->name }}</h2>
                        <p class="text-sm lg:text-base text-gray-600">{{ $contact->subject }}</p>
                    </div>
                </div>
                
                <!-- Acciones -->
                <div class="flex items-center space-x-2">
                    @if($contact->isUnread())
                        <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                                <i data-feather="check" class="h-4 w-4 mr-2"></i>
                                Marcar Leído
                            </button>
                        </form>
                    @endif
                    
                    @if(!$contact->isReplied())
                        <form action="{{ route('admin.contacts.mark-replied', $contact) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                                <i data-feather="reply" class="h-4 w-4 mr-2"></i>
                                Marcar Respondido
                            </button>
                        </form>
                    @endif
                    
                    <a href="{{ route('admin.contacts.index') }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
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
            <!-- Información del Contacto -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Contacto</h3>
                
                <div class="space-y-4">
                    <!-- Avatar y Datos -->
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-purple-100 rounded-xl flex items-center justify-center">
                            <span class="text-xl font-bold text-purple-600">
                                {{ strtoupper(substr($contact->name, 0, 2)) }}
                            </span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-xl font-bold text-gray-900">{{ $contact->name }}</h4>
                            <p class="text-lg text-gray-600 flex items-center">
                                <i data-feather="mail" class="h-4 w-4 mr-2 text-gray-400"></i>
                                <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $contact->email }}
                                </a>
                            </p>
                            <p class="text-sm text-gray-500 flex items-center mt-1">
                                <i data-feather="clock" class="h-4 w-4 mr-1"></i>
                                Enviado el {{ $contact->created_at->format('d/m/Y') }} a las {{ $contact->created_at->format('H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Asunto -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h5 class="text-sm font-medium text-gray-700 mb-2">Asunto</h5>
                        <p class="text-lg font-semibold text-gray-900">{{ $contact->subject }}</p>
                    </div>
                </div>
            </div>

            <!-- Mensaje -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Mensaje</h3>
                
                <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                    <div class="text-gray-900 whitespace-pre-wrap leading-relaxed">
                        {{ $contact->message }}
                    </div>
                </div>
            </div>

            <!-- Acciones de Respuesta -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Responder</h3>
                
                <div class="space-y-4">
                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                        <div class="flex items-start space-x-3">
                            <i data-feather="info" class="h-5 w-5 text-blue-600 mt-0.5"></i>
                            <div>
                                <p class="text-sm font-medium text-blue-900">Información de Contacto</p>
                                <p class="text-sm text-blue-700 mt-1">
                                    Puedes responder directamente a <strong>{{ $contact->email }}</strong> usando tu cliente de correo preferido.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                           class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            <i data-feather="mail" class="h-4 w-4 mr-2"></i>
                            Responder por Email
                        </a>
                        
                        <button onclick="copyEmail()" 
                                class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                            <i data-feather="copy" class="h-4 w-4 mr-2"></i>
                            Copiar Email
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Estado del Mensaje -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado del Mensaje</h3>
                
                <div class="space-y-4">
                    <!-- Estado Actual -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @if($contact->isUnread())
                                <i data-feather="mail" class="h-5 w-5 text-red-600"></i>
                                <span class="text-sm font-medium text-gray-900">Sin leer</span>
                            @elseif($contact->isReplied())
                                <i data-feather="check-circle" class="h-5 w-5 text-green-600"></i>
                                <span class="text-sm font-medium text-gray-900">Respondido</span>
                            @else
                                <i data-feather="eye" class="h-5 w-5 text-blue-600"></i>
                                <span class="text-sm font-medium text-gray-900">Leído</span>
                            @endif
                        </div>
                        @if($contact->isUnread())
                            <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-xs text-blue-600 hover:text-blue-800 font-medium">
                                    Marcar leído
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Fecha de Lectura -->
                    @if($contact->read_at)
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Leído el</label>
                            <p class="text-sm text-gray-900">{{ $contact->read_at->format('d/m/Y H:i') }}</p>
                        </div>
                    @endif

                    <!-- Estado de Respuesta -->
                    @if(!$contact->isReplied())
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Pendiente de respuesta</span>
                            <form action="{{ route('admin.contacts.mark-replied', $contact) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-xs text-green-600 hover:text-green-800 font-medium">
                                    Marcar respondido
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex items-center space-x-2">
                            <i data-feather="check-circle" class="h-4 w-4 text-green-600"></i>
                            <span class="text-sm text-green-600 font-medium">Respondido</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información General -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Información General</h3>
                
                <div class="space-y-4">
                    <!-- Fecha de Envío -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Enviado</label>
                        <p class="text-sm text-gray-900">{{ $contact->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-xs text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                    </div>

                    <!-- ID del Mensaje -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">ID del Mensaje</label>
                        <p class="text-sm text-gray-900 font-mono">{{ $contact->id }}</p>
                    </div>

                    <!-- Longitud del Mensaje -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Longitud</label>
                        <p class="text-sm text-gray-900">{{ strlen($contact->message) }} caracteres</p>
                    </div>
                </div>
            </div>

            <!-- Acciones Rápidas -->
            <div class="figma-card p-4 lg:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones</h3>
                
                <div class="space-y-3">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i data-feather="mail" class="h-4 w-4 mr-2"></i>
                        Responder por Email
                    </a>
                    
                    <button onclick="copyEmail()" 
                            class="w-full inline-flex items-center justify-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                        <i data-feather="copy" class="h-4 w-4 mr-2"></i>
                        Copiar Email
                    </button>
                    
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" 
                          onsubmit="return confirm('¿Estás seguro de que quieres eliminar este mensaje? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                            <i data-feather="trash-2" class="h-4 w-4 mr-2"></i>
                            Eliminar Mensaje
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Copiar email al portapapeles
function copyEmail() {
    const email = '{{ $contact->email }}';
    navigator.clipboard.writeText(email).then(function() {
        // Mostrar notificación de éxito
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i data-feather="check" class="h-4 w-4 mr-2"></i>Copiado';
        button.classList.add('bg-green-600', 'hover:bg-green-700');
        button.classList.remove('border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
        
        setTimeout(function() {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-600', 'hover:bg-green-700');
            button.classList.add('border-gray-300', 'text-gray-700', 'hover:bg-gray-50');
            feather.replace();
        }, 2000);
        
        feather.replace();
    }).catch(function(err) {
        console.error('Error al copiar: ', err);
        alert('Error al copiar el email');
    });
}
</script>
@endsection
