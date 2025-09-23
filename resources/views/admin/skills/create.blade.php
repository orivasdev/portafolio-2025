@extends('admin.layout')

@section('title', 'Crear Habilidad')
@section('page-title', 'Crear Nueva Habilidad')
@section('page-description', 'Agrega una nueva habilidad a tu portafolio')

@section('content')
<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-indigo-100 rounded-xl flex items-center justify-center">
                    <i data-feather="plus" class="h-5 w-5 lg:h-6 lg:w-6 text-indigo-600"></i>
                </div>
                <div>
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900">Crear Habilidad</h2>
                    <p class="text-sm lg:text-base text-gray-600">Agrega una nueva habilidad a tu portafolio</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.skills.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div class="lg:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre de la Habilidad <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                           placeholder="Ej: Laravel, JavaScript, React"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Categoría -->
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Categoría <span class="text-red-500">*</span>
                    </label>
                    <select name="category_id"
                            id="category_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('category_id') border-red-500 @enderror"
                            onchange="toggleNewCategory()">
                        <option value="">Selecciona una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    data-color="{{ $category->color }}"
                                    data-icon="{{ $category->icon }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->icon_emoji }} {{ $category->name }}
                            </option>
                        @endforeach
                        <option value="new">➕ Crear nueva categoría</option>
                    </select>
                    @error('category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campos para nueva categoría -->
                <div id="new-category-fields" class="hidden bg-gray-50 p-4 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Crear Nueva Categoría</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Nombre de la nueva categoría -->
                        <div>
                            <label for="new_category_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nombre de la Categoría <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   name="new_category_name"
                                   id="new_category_name"
                                   value="{{ old('new_category_name') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('new_category_name') border-red-500 @enderror"
                                   placeholder="Ej: Machine Learning">
                            @error('new_category_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Color de la categoría -->
                        <div>
                            <label for="new_category_color" class="block text-sm font-medium text-gray-700 mb-2">
                                Color
                            </label>
                            <input type="color"
                                   name="new_category_color"
                                   id="new_category_color"
                                   value="{{ old('new_category_color', '#3B82F6') }}"
                                   class="w-full h-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('new_category_color') border-red-500 @enderror">
                            @error('new_category_color')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Icono de la categoría -->
                        <div>
                            <label for="new_category_icon" class="block text-sm font-medium text-gray-700 mb-2">
                                Icono
                            </label>
                            <select name="new_category_icon"
                                    id="new_category_icon"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('new_category_icon') border-red-500 @enderror">
                                @foreach(\App\Helpers\IconHelper::getCategoryIcons() as $iconKey => $iconValue)
                                    <option value="{{ $iconKey }}" {{ old('new_category_icon', 'wrench') == $iconKey ? 'selected' : '' }}>
                                        {{ $iconValue }}
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-xs text-gray-500">Selecciona un icono para la categoría</p>
                            @error('new_category_icon')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Orden -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Orden de Visualización
                    </label>
                    <input type="number" 
                           name="order" 
                           id="order" 
                           value="{{ old('order', 0) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('order') border-red-500 @enderror"
                           placeholder="0">
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>


        <!-- Icono -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Icono</h3>
            
            <div>
                <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                    Icono (HTML/Emoji)
                </label>
                <div class="space-y-4">
                    <input type="text" 
                           name="icon" 
                           id="icon" 
                           value="{{ old('icon') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('icon') border-red-500 @enderror"
                           placeholder="Ej: 🚀, 💻, ⚡ o código HTML">
                    
                    <!-- Preview del icono -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <div class="flex items-center space-x-3">
                            <div id="icon-preview" class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center text-xl">
                                <span class="text-gray-400">?</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-700">Vista previa del icono</p>
                                <p class="text-xs text-gray-500">Se mostrará junto al nombre de la habilidad</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sugerencias de iconos -->
                    <div>
                        <p class="text-sm font-medium text-gray-700 mb-2">Sugerencias:</p>
                        <div class="flex flex-wrap gap-2">
                            <button type="button" onclick="setIcon('🚀')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">🚀</button>
                            <button type="button" onclick="setIcon('💻')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">💻</button>
                            <button type="button" onclick="setIcon('⚡')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">⚡</button>
                            <button type="button" onclick="setIcon('🔧')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">🔧</button>
                            <button type="button" onclick="setIcon('📱')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">📱</button>
                            <button type="button" onclick="setIcon('🌐')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">🌐</button>
                            <button type="button" onclick="setIcon('💾')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">💾</button>
                            <button type="button" onclick="setIcon('🎨')" class="px-3 py-1 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm transition-colors">🎨</button>
                        </div>
                    </div>
                </div>
                @error('icon')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Descripción -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción</h3>
            
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción (Opcional)
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror"
                          placeholder="Describe tu experiencia con esta habilidad, proyectos donde la has usado, etc.">{{ old('description') }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Información adicional sobre tu experiencia con esta habilidad</p>
                @error('description')
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
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Habilidad Activa
                    </label>
                </div>
                <p class="text-sm text-gray-500">Solo las habilidades activas se muestran en el portafolio público</p>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.skills.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                <i data-feather="x" class="h-4 w-4 mr-2"></i>
                Cancelar
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                <i data-feather="save" class="h-4 w-4 mr-2"></i>
                Crear Habilidad
            </button>
        </div>
    </form>
</div>

<script>

// Establecer icono
function setIcon(icon) {
    document.getElementById('icon').value = icon;
    updateIconPreview();
}

// Actualizar preview del icono
function updateIconPreview() {
    const icon = document.getElementById('icon').value;
    const preview = document.getElementById('icon-preview');
    
    if (icon) {
        preview.innerHTML = icon;
    } else {
        preview.innerHTML = '<span class="text-gray-400">?</span>';
    }
}

// Event listeners
document.getElementById('icon').addEventListener('input', updateIconPreview);

// Toggle nueva categoría
function toggleNewCategory() {
    const categorySelect = document.getElementById('category_id');
    const newCategoryFields = document.getElementById('new-category-fields');

    if (categorySelect.value === 'new') {
        newCategoryFields.classList.remove('hidden');
        document.getElementById('new_category_name').required = true;
    } else {
        newCategoryFields.classList.add('hidden');
        document.getElementById('new_category_name').required = false;
    }
}

// Inicializar
document.addEventListener('DOMContentLoaded', function() {
    updateIconPreview();
    toggleNewCategory();
});
</script>

@endsection
