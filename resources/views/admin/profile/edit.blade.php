@extends('admin.layout')

@section('title', 'Editar Perfil')
@section('page-title', 'Editar Perfil')
@section('page-description', 'Modifica tu información personal y profesional')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i data-feather="edit-2" class="h-5 w-5 lg:h-6 lg:w-6 text-purple-600"></i>
                </div>
                <div>
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900">Editar Perfil</h2>
                    <p class="text-sm lg:text-base text-gray-600">Modifica tu información personal y profesional</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')
        
        <!-- Información Básica -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Nombre -->
                <div class="lg:col-span-2">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                        Nombre Completo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="name" 
                           id="name" 
                           value="{{ old('name', $user->name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('name') border-red-500 @enderror"
                           placeholder="Tu nombre completo"
                           required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                        Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" 
                           name="email" 
                           id="email" 
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('email') border-red-500 @enderror"
                           placeholder="tu@email.com"
                           required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Título Profesional -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                        Título Profesional
                    </label>
                    <input type="text" 
                           name="title" 
                           id="title" 
                           value="{{ old('title', $user->title) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('title') border-red-500 @enderror"
                           placeholder="Ej: Desarrollador Full Stack">
                    @error('title')
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
                           value="{{ old('location', $user->location) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('location') border-red-500 @enderror"
                           placeholder="Ej: Madrid, España">
                    @error('location')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                        Teléfono
                    </label>
                    <input type="tel" 
                           name="phone" 
                           id="phone" 
                           value="{{ old('phone', $user->phone) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('phone') border-red-500 @enderror"
                           placeholder="+34 123 456 789">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Avatar -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Foto de Perfil</h3>
            
            <div class="space-y-4">
                <!-- Avatar Actual -->
                @if($user->avatar)
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Avatar Actual</label>
                        <div class="relative inline-block">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" class="h-24 w-24 rounded-xl object-cover border border-gray-200">
                            <div class="absolute top-2 right-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i data-feather="check" class="h-3 w-3 mr-1"></i>
                                    Actual
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Nueva Imagen -->
                <div>
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ $user->avatar ? 'Cambiar Avatar' : 'Subir Avatar' }}
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                        <div class="space-y-1 text-center">
                            <i data-feather="upload" class="mx-auto h-12 w-12 text-gray-400"></i>
                            <div class="flex text-sm text-gray-600">
                                <label for="avatar" class="relative cursor-pointer bg-white rounded-md font-medium text-purple-600 hover:text-purple-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-purple-500">
                                    <span>Subir archivo</span>
                                    <input id="avatar" name="avatar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                </label>
                                <p class="pl-1">o arrastra y suelta</p>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF hasta 2MB</p>
                        </div>
                    </div>
                    @error('avatar')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Preview de nueva imagen -->
                <div id="image-preview" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nueva Imagen</label>
                    <img id="preview-img" class="h-24 w-24 rounded-xl object-cover border border-gray-200" alt="Preview">
                </div>
            </div>
        </div>

        <!-- Biografía -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Biografía</h3>
            
            <div>
                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                    Biografía
                </label>
                <textarea name="bio" 
                          id="bio" 
                          rows="6"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('bio') border-red-500 @enderror"
                          placeholder="Cuéntanos sobre ti, tu experiencia, pasiones y objetivos profesionales...">{{ old('bio', $user->bio) }}</textarea>
                <p class="mt-1 text-sm text-gray-500">Máximo 1000 caracteres</p>
                @error('bio')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Enlaces y Redes Sociales -->
        <div class="figma-card p-4 lg:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Enlaces y Redes Sociales</h3>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Sitio Web -->
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-2">
                        Sitio Web
                    </label>
                    <input type="url" 
                           name="website" 
                           id="website" 
                           value="{{ old('website', $user->website) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('website') border-red-500 @enderror"
                           placeholder="https://tu-sitio-web.com">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- LinkedIn -->
                <div>
                    <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">
                        LinkedIn
                    </label>
                    <input type="url" 
                           name="linkedin" 
                           id="linkedin" 
                           value="{{ old('linkedin', $user->linkedin) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('linkedin') border-red-500 @enderror"
                           placeholder="https://linkedin.com/in/tu-perfil">
                    @error('linkedin')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- GitHub -->
                <div>
                    <label for="github" class="block text-sm font-medium text-gray-700 mb-2">
                        GitHub
                    </label>
                    <input type="url" 
                           name="github" 
                           id="github" 
                           value="{{ old('github', $user->github) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('github') border-red-500 @enderror"
                           placeholder="https://github.com/tu-usuario">
                    @error('github')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Twitter -->
                <div>
                    <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">
                        Twitter
                    </label>
                    <input type="url" 
                           name="twitter" 
                           id="twitter" 
                           value="{{ old('twitter', $user->twitter) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('twitter') border-red-500 @enderror"
                           placeholder="https://twitter.com/tu-usuario">
                    @error('twitter')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.profile.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                <i data-feather="x" class="h-4 w-4 mr-2"></i>
                Cancelar
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors">
                <i data-feather="save" class="h-4 w-4 mr-2"></i>
                Actualizar Perfil
            </button>
        </div>
    </form>
</div>

<script>
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
</script>
@endsection
