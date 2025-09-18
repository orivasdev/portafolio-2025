<header class="bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-40 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-primary-500 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold text-lg">OR</span>
                    </div>
                    <span class="text-xl font-bold text-gray-900 dark:text-white">ORivasDev</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex space-x-8">
                <a href="{{ route('home') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary-500 dark:text-primary-400' : '' }}">
                    Inicio
                </a>
                <a href="{{ route('about') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('about') ? 'text-primary-500 dark:text-primary-400' : '' }}">
                    Sobre Mí
                </a>
                <a href="{{ route('projects') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('projects') ? 'text-primary-500 dark:text-primary-400' : '' }}">
                    Proyectos
                </a>
                <a href="{{ route('contact.show') }}" 
                   class="text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 px-3 py-2 text-sm font-medium transition-colors duration-200 {{ request()->routeIs('contact.*') ? 'text-primary-500 dark:text-primary-400' : '' }}">
                    Contacto
                </a>
            </nav>

            <!-- Right side -->
            <div class="flex items-center space-x-4">
                <!-- Sin toggle de tema - modo oscuro por defecto -->

                <!-- Mobile menu button -->
                <button @click="$dispatch('toggle-mobile-menu')" class="md:hidden p-2 text-gray-500 dark:text-gray-400 hover:text-primary-500 dark:hover:text-primary-400 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div x-data="{ open: false }" @toggle-mobile-menu.window="open = !open" x-show="open" x-transition class="md:hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white dark:bg-gray-800 shadow-lg">
            <a href="{{ route('home') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('home') ? 'text-primary-500 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : '' }}">
                Inicio
            </a>
            <a href="{{ route('about') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('about') ? 'text-primary-500 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : '' }}">
                Sobre Mí
            </a>
            <a href="{{ route('projects') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('projects') ? 'text-primary-500 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : '' }}">
                Proyectos
            </a>
            <a href="{{ route('contact.show') }}" 
               class="block px-3 py-2 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-primary-500 dark:hover:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200 {{ request()->routeIs('contact.*') ? 'text-primary-500 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : '' }}">
                Contacto
            </a>
        </div>
    </div>
</header>
