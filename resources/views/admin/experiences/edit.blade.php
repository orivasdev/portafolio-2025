@extends('admin.layout')

@section('title', 'Editar Experiencia')
@section('page-title', 'Editar Experiencia')
@section('page-description', 'Modifica la información de la experiencia laboral')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-green-100 rounded-xl flex items-center justify-center">
                    <i data-feather="edit-2" class="h-5 w-5 lg:h-6 lg:w-6 text-green-600"></i>
                </div>
                <div>
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900">Editar Experiencia</h2>
                    <p class="text-sm lg:text-base text-gray-600">{{ $experience->title }} en {{ $experience->company }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.experiences.update', $experience) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')
        
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Título del Puesto -->
                <div class="lg:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Título del Puesto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $experience->title) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('title') border-red-500 @enderror"
                           placeholder="Ej: Desarrollador Backend Senior"
                           required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Empresa -->
                <div>
                    <label for="company" class="block text-sm font-medium text-gray-700 mb-2">
                        Empresa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="company" 
                           id="company" 
                           value="{{ old('company', $experience->company) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('company') border-red-500 @enderror"
                           placeholder="Ej: TechCorp Solutions"
                           required>
                    @error('company')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo de Trabajo -->
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                        Tipo de Trabajo <span class="text-red-500">*</span>
                    </label>
                    <select name="type" 
                            id="type" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('type') border-red-500 @enderror"
                            required>
                        <option value="">Selecciona el tipo</option>
                        <option value="full-time" {{ old('type', $experience->type) === 'full-time' ? 'selected' : '' }}>Tiempo Completo</option>
                        <option value="part-time" {{ old('type', $experience->type) === 'part-time' ? 'selected' : '' }}>Medio Tiempo</option>
                        <option value="freelance" {{ old('type', $experience->type) === 'freelance' ? 'selected' : '' }}>Freelance</option>
                        <option value="internship" {{ old('type', $experience->type) === 'internship' ? 'selected' : '' }}>Prácticas</option>
                        <option value="contract" {{ old('type', $experience->type) === 'contract' ? 'selected' : '' }}>Contrato</option>
                    </select>
                    @error('type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Ubicación -->
                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Ubicación
                    </label>
                    <input type="text" 
                           name="location" 
                           id="location" 
                           value="{{ old('location', $experience->location) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('location') border-red-500 @enderror"
                           placeholder="Ej: Madrid, España (Remoto)">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Orden -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Orden de Visualización
                    </label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', $experience->order) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('order') border-red-500 @enderror"
                           placeholder="0">
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Fechas -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Período de Trabajo</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Fecha de Inicio -->
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Inicio <span class="text-red-500">*</span>
                    </label>
                    <input type="date" 
                           name="start_date" 
                           id="start_date" 
                           value="{{ old('start_date', $experience->start_date->format('Y-m-d')) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('start_date') border-red-500 @enderror"
                           required>
                    @error('start_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Fecha de Fin -->
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                        Fecha de Fin
                    </label>
                    <input type="date" 
                           name="end_date" 
                           id="end_date" 
                           value="{{ old('end_date', $experience->end_date ? $experience->end_date->format('Y-m-d') : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('end_date') border-red-500 @enderror"
                           {{ $experience->is_current ? 'disabled' : '' }}>
                    @error('end_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Trabajo Actual -->
            <div class="mt-4">
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_current" 
                           id="is_current" 
                           value="1"
                           {{ old('is_current', $experience->is_current) ? 'checked' : '' }}
                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded"
                           onchange="toggleEndDate()">
                    <label for="is_current" class="ml-2 block text-sm text-gray-900">
                        Trabajo Actual
                    </label>
                </div>
                <p class="text-sm text-gray-500 mt-1">Marca esta casilla si actualmente trabajas en esta empresa</p>
            </div>
        </div>

        <!-- Descripción -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción del Trabajo</h3>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="8"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror"
                          placeholder="Describe tus responsabilidades, logros y proyectos en los que trabajaste..."
                          required>{{ old('description', $experience->description) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Incluye tus responsabilidades principales, logros destacados y proyectos importantes</p>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Tecnologías Utilizadas -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tecnologías Utilizadas</h3>
            
            <div>
                <label for="technologies_used" class="block text-sm font-medium text-gray-700 mb-2">
                    Tecnologías y Herramientas
                </label>
                <div id="technologies-container" class="space-y-2">
                    @if(old('technologies_used'))
                        @foreach(old('technologies_used') as $index => $tech)
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       name="technologies_used[]" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('technologies_used') border-red-500 @enderror"
                                       placeholder="Ej: Laravel, Vue.js, MySQL, Docker"
                                       value="{{ $tech }}">
                                @if($index > 0)
                                    <button type="button" onclick="removeTechnology(this)" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                        <i data-feather="x" class="h-4 w-4"></i>
                                    </button>
                                @else
                                    <button type="button" onclick="addTechnology()" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                        <i data-feather="plus" class="h-4 w-4"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    @else
                        @if($experience->technologies_used && count($experience->technologies_used) > 0)
                            @foreach($experience->technologies_used as $index => $tech)
                                <div class="flex items-center space-x-2">
                                    <input type="text" 
                                           name="technologies_used[]" 
                                           class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('technologies_used') border-red-500 @enderror"
                                           placeholder="Ej: Laravel, Vue.js, MySQL, Docker"
                                           value="{{ $tech }}">
                                    @if($index > 0)
                                        <button type="button" onclick="removeTechnology(this)" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                                            <i data-feather="x" class="h-4 w-4"></i>
                                        </button>
                                    @else
                                        <button type="button" onclick="addTechnology()" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                            <i data-feather="plus" class="h-4 w-4"></i>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center space-x-2">
                                <input type="text" 
                                       name="technologies_used[]" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('technologies_used') border-red-500 @enderror"
                                       placeholder="Ej: Laravel, Vue.js, MySQL, Docker">
                                <button type="button" onclick="addTechnology()" class="px-3 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                                    <i data-feather="plus" class="h-4 w-4"></i>
                                </button>
                            </div>
                        @endif
                    @endif
                </div>
                <p class="mt-2 text-sm text-gray-500">Lista las tecnologías, frameworks y herramientas que utilizaste en este trabajo</p>
                @error('technologies_used')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Configuración -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Configuración</h3>
            
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           value="1"
                           {{ old('is_active', $experience->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Experiencia Activa
                    </label>
                </div>
                <p class="text-sm text-gray-500">Solo las experiencias activas se muestran en el portafolio público</p>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.experiences.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                <i data-feather="x" class="h-4 w-4 mr-2"></i>
                Cancelar
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                <i data-feather="save" class="h-4 w-4 mr-2"></i>
                Actualizar Experiencia
            </button>
        </div>
    </form>
</div>

<script>
// Toggle fecha de fin
function toggleEndDate() {
    const isCurrent = document.getElementById('is_current').checked;
    const endDateInput = document.getElementById('end_date');
    
    if (isCurrent) {
        endDateInput.disabled = true;
        endDateInput.value = '';
    } else {
        endDateInput.disabled = false;
    }
}

// Agregar campo de tecnología
function addTechnology() {
    const container = document.getElementById('technologies-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" 
               name="technologies_used[]" 
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
               placeholder="Ej: React, Node.js, MongoDB">
        <button type="button" onclick="removeTechnology(this)" class="px-3 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
            <i data-feather="x" class="h-4 w-4"></i>
        </button>
    `;
    container.appendChild(div);
    feather.replace();
}

// Remover campo de tecnología
function removeTechnology(button) {
    button.parentElement.remove();
}

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    toggleEndDate();
});
</script>
@endsection
