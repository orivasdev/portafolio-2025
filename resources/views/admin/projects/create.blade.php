@extends('admin.layout')

@section('title', 'Crear Proyecto')
@section('page-title', 'Crear Nuevo Proyecto')
@section('page-description', 'Agrega un nuevo proyecto a tu portafolio')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i data-feather="plus" class="h-5 w-5 lg:h-6 lg:w-6 text-blue-600"></i>
                </div>
                <div>
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900">Crear Proyecto</h2>
                    <p class="text-sm lg:text-base text-gray-600">Agrega un nuevo proyecto a tu portafolio</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Título -->
                <div class="lg:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Título del Proyecto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                           placeholder="Ej: Sistema de Gestión de Inventarios"
                           required>
                    @error('title')
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
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror"
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

                <!-- Orden -->
                <div>
                    <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                        Posición en la Lista
                    </label>
                    <select name="order" 
                            id="order" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('order') border-red-500 @enderror">
                        @foreach($availableOrders as $orderValue)
                            <option value="{{ $orderValue }}" {{ old('order', count($availableOrders)) == $orderValue ? 'selected' : '' }}>
                                Posición {{ $orderValue }}
                                @if($orderValue == count($availableOrders))
                                    (Al final)
                                @elseif($orderValue == 1)
                                    (Al inicio)
                                @endif
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-xs text-gray-500">
                        Los proyectos se reordenarán automáticamente al seleccionar una nueva posición
                    </p>
                    @error('order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Campos para nueva categoría (ocultos por defecto) -->
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
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('new_category_name') border-red-500 @enderror"
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
                               class="w-full h-10 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('new_category_color') border-red-500 @enderror">
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
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('new_category_icon') border-red-500 @enderror">
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
        </div>

        <!-- Descripción -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Descripción</h3>
            
            <div class="space-y-4">
                <!-- Descripción Corta -->
                <div>
                    <label for="short_description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción Corta <span class="text-red-500">*</span>
                    </label>
                    <textarea name="short_description" 
                              id="short_description" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('short_description') border-red-500 @enderror"
                              placeholder="Breve descripción del proyecto (máximo 500 caracteres)"
                              maxlength="500"
                              required>{{ old('short_description') }}</textarea>
                    <div class="mt-1 flex justify-between text-sm text-gray-500">
                        <span>Usada en tarjetas y listados</span>
                        <span id="short-desc-count">0/500</span>
                    </div>
                    @error('short_description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción Completa -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Descripción Completa <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" 
                              id="description" 
                              rows="8"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                              placeholder="Descripción detallada del proyecto, tecnologías utilizadas, desafíos resueltos, etc."
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Imagen -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Imagen del Proyecto</h3>
            
            <div class="space-y-4">
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                        Imagen Principal
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <i data-feather="upload" class="mx-auto h-12 w-12 text-gray-400"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                    <span>Subir archivo</span>
                                    <input id="image" name="image" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">o arrastra y suelta</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                        </div>
                    </div>
                    @error('image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview de imagen -->
                <div id="image-preview" class="hidden">
                    <img id="preview-img" class="h-32 w-full object-cover rounded-lg border border-gray-200" alt="Preview">
                </div>
            </div>
        </div>

        <!-- Enlaces -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Enlaces</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- GitHub -->
                <div>
                    <label for="github_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL de GitHub
                    </label>
                    <input type="url" 
                           name="github_url" 
                           id="github_url" 
                           value="{{ old('github_url') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('github_url') border-red-500 @enderror"
                           placeholder="https://github.com/usuario/proyecto">
                    @error('github_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL en Vivo -->
                <div>
                    <label for="live_url" class="block text-sm font-medium text-gray-700 mb-2">
                        URL en Vivo
                    </label>
                    <input type="url" 
                           name="live_url" 
                           id="live_url" 
                           value="{{ old('live_url') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('live_url') border-red-500 @enderror"
                           placeholder="https://mi-proyecto.com">
                    @error('live_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Tecnologías -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Tecnologías Utilizadas</h3>
            
            <div>
                <label for="technologies" class="block text-sm font-medium text-gray-700 mb-2">
                    Tecnologías <span class="text-red-500">*</span>
                </label>
                <div id="technologies-container" class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <input type="text" 
                               name="technologies[]" 
                               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('technologies') border-red-500 @enderror"
                               placeholder="Ej: Laravel, Vue.js, MySQL"
                               value="{{ old('technologies.0') }}">
                        <button type="button" onclick="addTechnology()" class="px-3 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            <i data-feather="plus" class="h-4 w-4"></i>
                        </button>
                    </div>
                </div>
                <p class="mt-2 text-sm text-gray-500">Agrega al menos una tecnología utilizada en el proyecto</p>
                @error('technologies')
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
                           name="is_featured" 
                           id="is_featured" 
                           value="1"
                           {{ old('is_featured') ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_featured" class="ml-2 block text-sm text-gray-900">
                        Proyecto Destacado
                    </label>
                </div>
                <p class="text-sm text-gray-500">Los proyectos destacados aparecen en la sección principal del portafolio</p>

                <div class="flex items-center">
                    <input type="checkbox" 
                           name="is_active" 
                           id="is_active" 
                           value="1"
                           {{ old('is_active', true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="is_active" class="ml-2 block text-sm text-gray-900">
                        Proyecto Activo
                    </label>
                </div>
                <p class="text-sm text-gray-500">Solo los proyectos activos se muestran en el portafolio público</p>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.projects.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                <i data-feather="x" class="h-4 w-4 mr-2"></i>
                Cancelar
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                <i data-feather="save" class="h-4 w-4 mr-2"></i>
                Crear Proyecto
            </button>
        </div>
    </form>
</div>

<script>
// Contador de caracteres para descripción corta
document.getElementById('short_description').addEventListener('input', function() {
    const count = this.value.length;
    document.getElementById('short-desc-count').textContent = count + '/500';
});

// Preview de imagen
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Agregar campo de tecnología
function addTechnology() {
    const container = document.getElementById('technologies-container');
    const div = document.createElement('div');
    div.className = 'flex items-center space-x-2';
    div.innerHTML = `
        <input type="text" 
               name="technologies[]" 
               class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
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

// Función para mostrar/ocultar campos de nueva categoría
function toggleNewCategory() {
    const categorySelect = document.getElementById('category_id');
    const newCategoryFields = document.getElementById('new-category-fields');
    
    if (categorySelect.value === 'new') {
        newCategoryFields.classList.remove('hidden');
        // Hacer requeridos los campos de nueva categoría
        document.getElementById('new_category_name').required = true;
    } else {
        newCategoryFields.classList.add('hidden');
        // Quitar requerido de los campos de nueva categoría
        document.getElementById('new_category_name').required = false;
    }
}

// Función para mostrar información de reordenamiento
function updateOrderInfo() {
    const orderSelect = document.getElementById('order');
    const selectedOrder = parseInt(orderSelect.value);
    const totalProjects = orderSelect.options.length;
    
    // Crear o actualizar mensaje informativo
    let infoElement = document.getElementById('order-info');
    if (!infoElement) {
        infoElement = document.createElement('div');
        infoElement.id = 'order-info';
        infoElement.className = 'mt-2 p-2 bg-blue-50 border border-blue-200 rounded-lg text-sm text-blue-700';
        orderSelect.parentNode.appendChild(infoElement);
    }
    
    if (selectedOrder === totalProjects) {
        infoElement.innerHTML = '📌 Este proyecto se agregará al final de la lista';
    } else if (selectedOrder === 1) {
        infoElement.innerHTML = '📌 Este proyecto se moverá al inicio de la lista';
    } else {
        infoElement.innerHTML = `📌 Este proyecto se insertará en la posición ${selectedOrder}, desplazando los demás hacia abajo`;
    }
}

// Inicializar contador
document.addEventListener('DOMContentLoaded', function() {
    const shortDesc = document.getElementById('short_description');
    if (shortDesc.value) {
        document.getElementById('short-desc-count').textContent = shortDesc.value.length + '/500';
    }
    
    // Inicializar estado de nueva categoría
    toggleNewCategory();
    
    // Inicializar información de orden
    updateOrderInfo();
    
    // Agregar listener al select de orden
    const orderSelect = document.getElementById('order');
    if (orderSelect) {
        orderSelect.addEventListener('change', updateOrderInfo);
    }
});
</script>
@endsection
