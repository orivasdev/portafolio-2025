<!DOCTYPE html>
<html lang="es" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'ORivasDev - Desarrollador Backend - Laravel & APIs')</title>
    <meta name="description" content="@yield('description', 'Oswaldo Rivas - Desarrollador backend con más de 5 años de experiencia en Laravel, APIs RESTful y desarrollo móvil. Portafolio profesional con proyectos destacados.')">
    <meta name="keywords" content="Oswaldo Rivas, ORivasDev, desarrollador backend, Laravel, PHP, APIs REST, desarrollo móvil, programador, Venezuela">
    <meta name="author" content="Oswaldo Rivas">
    
    <!-- Open Graph -->
    <meta property="og:title" content="@yield('title', 'ORivasDev - Desarrollador Backend - Laravel & APIs')">
    <meta property="og:description" content="@yield('description', 'Oswaldo Rivas - Desarrollador backend con más de 5 años de experiencia en Laravel, APIs RESTful y desarrollo móvil.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="ORivasDev">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Three.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    
    <!-- Three.js Animation Systems Base -->
    <script src="{{ asset('js/threejs/hero-animation.js') }}"></script>
    <script src="{{ asset('js/threejs/image-particles.js') }}"></script>
    <script src="{{ asset('js/threejs/portrait-particles.js') }}"></script>
    <script src="{{ asset('js/threejs/skills-animation.js') }}"></script>
    <script src="{{ asset('js/threejs/projects-animation.js') }}"></script>
    <script src="{{ asset('js/threejs/experience-animation.js') }}"></script>
    <script src="{{ asset('js/threejs/cta-animation.js') }}"></script>
    
    <!-- Three.js Enhanced Systems -->
    <script src="{{ asset('js/threejs/image-particles-enhanced.js') }}"></script>
    <script src="{{ asset('js/threejs/particle-control-panel.js') }}"></script>
    <script src="{{ asset('js/threejs/audio-reactive-particles.js') }}"></script>
    
    <!-- Main System -->
    <script src="{{ asset('js/main.js') }}"></script>
    
    <!-- Heroicons -->
    <script src="https://unpkg.com/@heroicons/v2/24/outline/esm/index.js"></script>
</head>
<body class="font-sans antialiased bg-gray-900 text-gray-100 dark transition-colors duration-300">
    
    <!-- Header -->
    @include('partials.header')
    
    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('partials.footer')
    
    <!-- Modo oscuro por defecto - sin toggle -->
    <script>
        // Forzar modo oscuro siempre
        document.documentElement.classList.add('dark');
    </script>
    
    <!-- Flash Messages -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
             class="fixed top-4 right-4 bg-success-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('success') }}
        </div>
    @endif
    
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" 
             class="fixed top-4 right-4 bg-accent-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
            {{ session('error') }}
        </div>
    @endif
</body>
</html>
