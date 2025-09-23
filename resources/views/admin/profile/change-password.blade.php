@extends('admin.layout')

@section('title', 'Cambiar Contraseña')
@section('page-title', 'Cambiar Contraseña')
@section('page-description', 'Actualiza tu contraseña de acceso')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-6">
        <div class="figma-card p-4 lg:p-6">
            <div class="flex items-center space-x-3 lg:space-x-4">
                <div class="w-10 h-10 lg:w-12 lg:h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <i data-feather="key" class="h-5 w-5 lg:h-6 lg:w-6 text-red-600"></i>
                </div>
                <div>
                    <h2 class="text-lg lg:text-xl font-bold text-gray-900">Cambiar Contraseña</h2>
                    <p class="text-sm lg:text-base text-gray-600">Actualiza tu contraseña de acceso</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <form action="{{ route('admin.profile.update-password') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Información de Seguridad -->
        <div class="figma-card p-4 lg:p-6">
            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200 mb-6">
                <div class="flex items-start space-x-3">
                    <i data-feather="info" class="h-5 w-5 text-blue-600 mt-0.5"></i>
                    <div>
                        <p class="text-sm font-medium text-blue-900">Recomendaciones de Seguridad</p>
                        <ul class="text-sm text-blue-700 mt-1 space-y-1">
                            <li>• Usa al menos 8 caracteres</li>
                            <li>• Incluye mayúsculas, minúsculas y números</li>
                            <li>• Agrega símbolos especiales si es posible</li>
                            <li>• No uses contraseñas obvias o personales</li>
                        </ul>
                    </div>
                </div>
            </div>

            <h3 class="text-lg font-semibold text-gray-900 mb-4">Cambiar Contraseña</h3>
            
            <div class="space-y-6">
                <!-- Contraseña Actual -->
                <div>
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                        Contraseña Actual <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="current_password" 
                               id="current_password" 
                               class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('current_password') border-red-500 @enderror"
                               placeholder="Ingresa tu contraseña actual"
                               required>
                        <button type="button" 
                                onclick="togglePassword('current_password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i data-feather="eye" class="h-4 w-4 text-gray-400"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nueva Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                        Nueva Contraseña <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('password') border-red-500 @enderror"
                               placeholder="Ingresa tu nueva contraseña"
                               required>
                        <button type="button" 
                                onclick="togglePassword('password')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i data-feather="eye" class="h-4 w-4 text-gray-400"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Indicador de Fortaleza -->
                    <div class="mt-2">
                        <div class="flex items-center space-x-2">
                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                <div id="strength-bar" class="h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                            </div>
                            <span id="strength-text" class="text-xs text-gray-500">Ingresa una contraseña</span>
                        </div>
                    </div>
                </div>

                <!-- Confirmar Nueva Contraseña -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                        Confirmar Nueva Contraseña <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 @error('password_confirmation') border-red-500 @enderror"
                               placeholder="Confirma tu nueva contraseña"
                               required>
                        <button type="button" 
                                onclick="togglePassword('password_confirmation')"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i data-feather="eye" class="h-4 w-4 text-gray-400"></i>
                        </button>
                    </div>
                    @error('password_confirmation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <!-- Indicador de Coincidencia -->
                    <div class="mt-2">
                        <div id="match-indicator" class="flex items-center space-x-2">
                            <i data-feather="circle" class="h-4 w-4 text-gray-400"></i>
                            <span class="text-xs text-gray-500">Las contraseñas deben coincidir</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones -->
        <div class="flex flex-col sm:flex-row gap-4 justify-end">
            <a href="{{ route('admin.profile.index') }}" 
               class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                <i data-feather="x" class="h-4 w-4 mr-2"></i>
                Cancelar
            </a>
            <button type="submit" 
                    class="inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors">
                <i data-feather="save" class="h-4 w-4 mr-2"></i>
                Actualizar Contraseña
            </button>
        </div>
    </form>
</div>

<script>
// Toggle password visibility
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    const icon = button.querySelector('i');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.setAttribute('data-feather', 'eye-off');
    } else {
        field.type = 'password';
        icon.setAttribute('data-feather', 'eye');
    }
    feather.replace();
}

// Password strength checker
function checkPasswordStrength(password) {
    let strength = 0;
    let strengthText = '';
    let strengthColor = '';
    
    if (password.length >= 8) strength += 1;
    if (/[a-z]/.test(password)) strength += 1;
    if (/[A-Z]/.test(password)) strength += 1;
    if (/[0-9]/.test(password)) strength += 1;
    if (/[^A-Za-z0-9]/.test(password)) strength += 1;
    
    switch (strength) {
        case 0:
        case 1:
            strengthText = 'Muy débil';
            strengthColor = 'bg-red-500';
            break;
        case 2:
            strengthText = 'Débil';
            strengthColor = 'bg-orange-500';
            break;
        case 3:
            strengthText = 'Regular';
            strengthColor = 'bg-yellow-500';
            break;
        case 4:
            strengthText = 'Fuerte';
            strengthColor = 'bg-green-500';
            break;
        case 5:
            strengthText = 'Muy fuerte';
            strengthColor = 'bg-green-600';
            break;
    }
    
    const strengthBar = document.getElementById('strength-bar');
    const strengthTextElement = document.getElementById('strength-text');
    
    strengthBar.className = `h-2 rounded-full transition-all duration-300 ${strengthColor}`;
    strengthBar.style.width = `${(strength / 5) * 100}%`;
    strengthTextElement.textContent = strengthText;
    strengthTextElement.className = `text-xs ${strengthColor.replace('bg-', 'text-')}`;
}

// Password match checker
function checkPasswordMatch() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;
    const indicator = document.getElementById('match-indicator');
    const icon = indicator.querySelector('i');
    const text = indicator.querySelector('span');
    
    if (confirmPassword === '') {
        icon.setAttribute('data-feather', 'circle');
        icon.className = 'h-4 w-4 text-gray-400';
        text.textContent = 'Las contraseñas deben coincidir';
        text.className = 'text-xs text-gray-500';
    } else if (password === confirmPassword) {
        icon.setAttribute('data-feather', 'check-circle');
        icon.className = 'h-4 w-4 text-green-500';
        text.textContent = 'Las contraseñas coinciden';
        text.className = 'text-xs text-green-500';
    } else {
        icon.setAttribute('data-feather', 'x-circle');
        icon.className = 'h-4 w-4 text-red-500';
        text.textContent = 'Las contraseñas no coinciden';
        text.className = 'text-xs text-red-500';
    }
    feather.replace();
}

// Event listeners
document.getElementById('password').addEventListener('input', function() {
    checkPasswordStrength(this.value);
    checkPasswordMatch();
});

document.getElementById('password_confirmation').addEventListener('input', checkPasswordMatch);
</script>
@endsection
