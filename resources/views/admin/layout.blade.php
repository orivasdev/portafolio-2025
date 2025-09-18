<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Mi Portafolio</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Iconos adicionales -->
    <script src="https://unpkg.com/feather-icons"></script>
    
    <style>
        /* Figma Design Colors */
        :root {
            --primary-blue: #3B82F6;
            --primary-dark: #1E40AF;
            --secondary-purple: #8B5CF6;
            --accent-green: #10B981;
            --accent-orange: #F59E0B;
            --accent-red: #EF4444;
            --gray-50: #F9FAFB;
            --gray-100: #F3F4F6;
            --gray-200: #E5E7EB;
            --gray-300: #D1D5DB;
            --gray-400: #9CA3AF;
            --gray-500: #6B7280;
            --gray-600: #4B5563;
            --gray-700: #374151;
            --gray-800: #1F2937;
            --gray-900: #111827;
        }
        
        /* Figma Layout Styles */
        .figma-sidebar {
            background: linear-gradient(180deg, #1E40AF 0%, #3B82F6 100%);
            box-shadow: 4px 0px 24px rgba(0, 0, 0, 0.08);
        }
        
        .figma-main-bg {
            background: #F8FAFC;
        }
        
        .figma-card {
            background: #FFFFFF;
            border: 1px solid #E2E8F0;
            border-radius: 12px;
            box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.2s ease;
        }
        
        .figma-card:hover {
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        
        .figma-nav-item {
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        
        .figma-nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .figma-nav-item.active {
            background: rgba(255, 255, 255, 0.15);
            border-left: 3px solid #FFFFFF;
        }
        
        .figma-stat-card {
            background: linear-gradient(135deg, #FFFFFF 0%, #F8FAFC 100%);
            border: 1px solid #E2E8F0;
            border-radius: 16px;
            padding: 24px;
            transition: all 0.3s ease;
        }
        
        .figma-stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* Animaciones */
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in {
            animation: slideIn 0.3s ease-out;
        }
        
        @keyframes slideIn {
            from { transform: translateX(-100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
</head>
<body class="h-full figma-main-bg" x-data="{ sidebarOpen: false }" x-init="feather.replace()")
    <div class="min-h-full">
        <!-- Sidebar - Figma Design -->
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
            <div class="flex grow flex-col figma-sidebar">
                <!-- Logo/Header Section -->
                <div class="flex h-16 items-center px-6 border-b border-white/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center">
                            <i data-feather="layers" class="h-5 w-5 text-blue-600"></i>
                        </div>
                        <div>
                            <h1 class="text-white text-lg font-semibold">CMS Panel</h1>
                            <p class="text-blue-200 text-xs">Mi Portafolio</p>
                        </div>
                    </div>
                </div>
                
                <!-- User Profile Section -->
                <div class="px-6 py-4 border-b border-white/10">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                            <i data-feather="user" class="h-5 w-5 text-white"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-white text-sm font-medium">Administrador</p>
                            <p class="text-blue-200 text-xs">admin@portafolio.com</p>
                        </div>
                        <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                    </div>
                </div>
                
                <!-- Navigation Menu -->
                <nav class="flex-1 px-6 py-4">
                    <div class="space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="figma-nav-item @if(request()->routeIs('admin.dashboard')) active @endif flex items-center px-3 py-2.5 text-sm font-medium text-white">
                            <i data-feather="home" class="mr-3 h-5 w-5"></i>
                            <span>Dashboard</span>
                            @if(request()->routeIs('admin.dashboard'))
                                <span class="ml-auto w-2 h-2 bg-white rounded-full"></span>
                            @endif
                        </a>
                                
                        <!-- Proyectos -->
                        <a href="{{ route('admin.projects.index') }}" 
                           class="figma-nav-item @if(request()->routeIs('admin.projects.*')) active @endif flex items-center px-3 py-2.5 text-sm font-medium text-white">
                            <i data-feather="folder" class="mr-3 h-5 w-5"></i>
                            <span>Proyectos</span>
                            @if(request()->routeIs('admin.projects.*'))
                                <span class="ml-auto w-2 h-2 bg-white rounded-full"></span>
                            @endif
                        </a>
                        
                        <!-- Habilidades -->
                        <a href="{{ route('admin.skills.index') }}" 
                           class="figma-nav-item @if(request()->routeIs('admin.skills.*')) active @endif flex items-center px-3 py-2.5 text-sm font-medium text-white">
                            <i data-feather="star" class="mr-3 h-5 w-5"></i>
                            <span>Habilidades</span>
                            @if(request()->routeIs('admin.skills.*'))
                                <span class="ml-auto w-2 h-2 bg-white rounded-full"></span>
                            @endif
                        </a>
                        
                        <!-- Experiencias -->
                        <a href="{{ route('admin.experiences.index') }}" 
                           class="figma-nav-item @if(request()->routeIs('admin.experiences.*')) active @endif flex items-center px-3 py-2.5 text-sm font-medium text-white">
                            <i data-feather="briefcase" class="mr-3 h-5 w-5"></i>
                            <span>Experiencias</span>
                            @if(request()->routeIs('admin.experiences.*'))
                                <span class="ml-auto w-2 h-2 bg-white rounded-full"></span>
                            @endif
                        </a>
                        
                        <!-- Contactos -->
                        <a href="{{ route('admin.contacts.index') }}" 
                           class="figma-nav-item @if(request()->routeIs('admin.contacts.*')) active @endif flex items-center px-3 py-2.5 text-sm font-medium text-white">
                            <i data-feather="mail" class="mr-3 h-5 w-5"></i>
                            <span>Contactos</span>
                            @if(request()->routeIs('admin.contacts.*'))
                                <span class="ml-auto w-2 h-2 bg-white rounded-full"></span>
                            @endif
                        </a>
                    </div>
                </nav>
                        
                <!-- Bottom Actions -->
                <div class="px-6 py-4 border-t border-white/10 mt-auto">
                    <div class="space-y-2">
                        <a href="{{ route('home') }}" target="_blank"
                           class="figma-nav-item flex items-center px-3 py-2.5 text-sm font-medium text-white">
                            <i data-feather="external-link" class="mr-3 h-5 w-5"></i>
                            <span>Ver Sitio Web</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full figma-nav-item flex items-center px-3 py-2.5 text-sm font-medium text-white hover:bg-red-500/20">
                                <i data-feather="log-out" class="mr-3 h-5 w-5"></i>
                                <span>Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile menu button -->
        <div class="sticky top-0 z-40 flex items-center gap-x-6 sidebar-gradient px-4 py-4 shadow-lg sm:px-6 lg:hidden">
            <button type="button" class="-m-2.5 p-2.5 text-white lg:hidden" @click="sidebarOpen = !sidebarOpen">
                <span class="sr-only">Abrir sidebar</span>
                <i data-feather="menu" class="h-6 w-6"></i>
            </button>
            <div class="flex-1 text-lg font-bold leading-6 text-white">Panel de Administración</div>
        </div>

        <!-- Mobile sidebar overlay -->
        <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
            <div class="fixed inset-0 bg-gray-900/80" @click="sidebarOpen = false"></div>
            <div class="fixed inset-y-0 left-0 z-50 w-full overflow-y-auto sidebar-gradient px-6 pb-4 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10 slide-in-left">
                <!-- Mobile sidebar content (same as desktop) -->
            </div>
        </div>

        <!-- Main content - Figma Style -->
        <main class="lg:pl-72">
            <!-- Top Header Bar -->
            <div class="sticky top-0 z-30 bg-white/80 backdrop-blur-md border-b border-gray-200 px-6 py-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        <p class="text-sm text-gray-600 mt-1">@yield('page-description', 'Panel de administración')</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <!-- Search Bar -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i data-feather="search" class="h-4 w-4 text-gray-400"></i>
                            </div>
                            <input type="text" placeholder="Buscar..." 
                                   class="block w-64 pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <!-- Notifications -->
                        <button class="relative p-2 text-gray-400 hover:text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-lg">
                            <i data-feather="bell" class="h-5 w-5"></i>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Content Area -->
            <div class="px-6 py-6">
                <!-- Alerts mejoradas -->
                @if(session('success'))
                    <div class="mb-6 rounded-xl bg-gradient-to-r from-green-50 to-emerald-50 p-4 shadow-lg border border-green-200 fade-in" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100">
                                    <i data-feather="check" class="h-5 w-5 text-green-600"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-semibold text-green-800">¡Éxito!</h3>
                                <p class="mt-1 text-sm text-green-700">{{ session('success') }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <button @click="show = false" class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
                                    <i data-feather="x" class="h-4 w-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 p-4 shadow-lg border border-red-200 fade-in" x-data="{ show: true }" x-show="show">
                        <div class="flex items-start">
                            <div class="flex-shrink-0">
                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100">
                                    <i data-feather="alert-circle" class="h-5 w-5 text-red-600"></i>
                                </div>
                            </div>
                            <div class="ml-3 flex-1">
                                <h3 class="text-sm font-semibold text-red-800">Error</h3>
                                <p class="mt-1 text-sm text-red-700">{{ session('error') }}</p>
                            </div>
                            <div class="ml-4 flex-shrink-0">
                                <button @click="show = false" class="inline-flex rounded-md bg-red-50 p-1.5 text-red-500 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 focus:ring-offset-red-50">
                                    <i data-feather="x" class="h-4 w-4"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            // Mobile sidebar toggle functionality can be added here
            console.log('Toggle sidebar');
        }
    </script>
</body>
</html>
