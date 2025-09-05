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
                <!-- Theme Toggle -->
                <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                        class="p-2 text-gray-500 dark:text-gray-400 hover:text-primary-500 dark:hover:text-primary-400 transition-colors duration-200">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </button>

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
