@extends('layouts.app')

@section('title', 'Sobre Mí - ORivasDev - Desarrollador Backend')
@section('description', 'Oswaldo Rivas - Desarrollador backend con más de 5 años de experiencia en Laravel, APIs RESTful y desarrollo móvil. Conoce mi trayectoria profesional.')

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-primary-600 to-primary-800 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-6">
                Sobre Mí
            </h1>
            <p class="text-xl text-primary-100 max-w-3xl mx-auto">
                Oswaldo Rivas - Desarrollador backend con más de 5 años de experiencia creando 
                soluciones tecnológicas escalables, eficientes y orientadas al crecimiento empresarial.
            </p>
        </div>
    </section>

    <!-- Personal Info Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">
                        ¿Quién Soy?
                    </h2>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        Soy Oswaldo Rivas, desarrollador backend con más de 5 años de experiencia especializado en Laravel, 
                        APIs RESTful y desarrollo móvil. Me apasiona crear soluciones tecnológicas que resuelvan 
                        problemas reales y mejoren la experiencia del usuario.
                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-300 mb-6 leading-relaxed">
                        Mi enfoque se centra en escribir código limpio, mantenible y escalable, siguiendo las 
                        mejores prácticas de desarrollo y patrones de diseño establecidos. Creo firmemente en 
                        la importancia de la documentación, testing y colaboración en equipo.
                    </p>
                    <p class="text-lg text-gray-600 dark:text-gray-300 leading-relaxed">
                        Cuando no estoy programando, disfruto aprendiendo nuevas tecnologías, contribuyendo a 
                        proyectos open source y compartiendo conocimiento con la comunidad de desarrolladores.
                    </p>
                </div>
                <div class="text-center">
                    <div class="w-64 h-64 mx-auto bg-gradient-to-br from-primary-500 to-primary-700 rounded-full flex items-center justify-center mb-6">
                        <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">Oswaldo Rivas</h3>
                    <p class="text-gray-600 dark:text-gray-300">Desarrollador Backend Senior | ORivasDev</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Habilidades Técnicas
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Sólido dominio de tecnologías modernas y frameworks para desarrollo web y móvil, 
                    con experiencia en diseño y mantenimiento de sistemas robustos
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($skills as $category => $categorySkills)
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-lg hover:shadow-xl border border-gray-200 dark:border-gray-600 transition-all duration-300">
                    <h3 class="text-xl font-semibold text-primary-900 dark:text-white mb-6 capitalize flex items-center">
                        <span class="w-8 h-8 bg-primary-100 dark:bg-primary-900/30 rounded-lg flex items-center justify-center mr-3">
                            @if($category === 'Backend')
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                                </svg>
                            @elseif($category === 'Frontend')
                                <svg class="w-5 h-5 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            @elseif($category === 'Database')
                                <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"></path>
                                </svg>
                            @elseif($category === 'DevOps')
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            @elseif($category === 'Mobile')
                                <svg class="w-5 h-5 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                            @elseif($category === 'Testing')
                                <svg class="w-5 h-5 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            @else
                                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                </svg>
                            @endif
                        </span>
                        {{ $category }}
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        @foreach($categorySkills as $skill)
                        <div class="flex items-center space-x-2 p-2 rounded-lg bg-gray-50 dark:bg-gray-700 hover:bg-primary-100 dark:hover:bg-primary-900/20 transition-colors duration-200 border border-gray-200 dark:border-gray-600">
                            <div class="w-2 h-2 bg-primary-500 rounded-full"></div>
                            <span class="text-sm font-medium text-primary-800 dark:text-gray-300">{{ $skill->name }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Experiencia Laboral
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Mi trayectoria profesional en el desarrollo de software
                </p>
            </div>

            <div class="space-y-8">
                @foreach($experiences as $experience)
                <div class="bg-white dark:bg-gray-700 rounded-xl p-6 relative shadow-md border border-gray-200 dark:border-gray-600">
                    @if($experience->is_current)
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-success-500 text-white text-xs font-medium rounded-full">
                            Actual
                        </span>
                    </div>
                    @endif
                    
                    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-primary-900 dark:text-white">
                                {{ $experience->title }}
                            </h3>
                            <p class="text-lg text-primary-700 dark:text-white font-medium">
                                {{ $experience->company }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $experience->location }} • {{ ucfirst($experience->type) }}
                            </p>
                        </div>
                        <div class="text-right mt-2 lg:mt-0">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $experience->formatted_start_date }} - {{ $experience->formatted_end_date }}
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $experience->duration }}
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 dark:text-gray-300 mb-4">
                        {{ $experience->description }}
                    </p>
                    @if($experience->technologies_used)
                    <div class="flex flex-wrap gap-2">
                        @foreach($experience->technologies_used as $tech)
                        <span class="px-2 py-1 bg-primary-100 dark:bg-primary-900/30 text-primary-800 dark:text-primary-200 text-xs rounded">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section class="py-20 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Educación y Certificaciones
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Mi formación académica y certificaciones técnicas
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Degree -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-16 h-16 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-primary-900 dark:text-white mb-2">
                        Ingeniería Informática
                    </h3>
                    <p class="text-primary-700 dark:text-gray-300 mb-2">
                        Universidad Politécnica de Madrid
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        2014 - 2018
                    </p>
                </div>

                <!-- Laravel Certification -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-16 h-16 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-accent-900 dark:text-white mb-2">
                        Laravel Certified Developer
                    </h3>
                    <p class="text-accent-700 dark:text-gray-300 mb-2">
                        Laravel Certification Program
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        2022
                    </p>
                </div>

                <!-- AWS Certification -->
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg border border-gray-200 dark:border-gray-600">
                    <div class="w-16 h-16 bg-success-100 dark:bg-success-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-success-900 dark:text-white mb-2">
                        AWS Solutions Architect
                    </h3>
                    <p class="text-success-700 dark:text-gray-300 mb-2">
                        Amazon Web Services
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        2023
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Work Philosophy Section -->
    <section class="py-20 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Mi Filosofía de Trabajo
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto">
                    Los principios que guían mi desarrollo profesional
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-20 h-20 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Calidad</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Escribo código limpio, bien documentado y testeado para garantizar la calidad y mantenibilidad.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-accent-100 dark:bg-accent-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-accent-600 dark:text-accent-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Rendimiento</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Optimizo cada aspecto para lograr la mejor experiencia de usuario y eficiencia del sistema.
                    </p>
                </div>

                <div class="text-center">
                    <div class="w-20 h-20 bg-success-100 dark:bg-success-900/30 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-success-600 dark:text-success-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Colaboración</h3>
                    <p class="text-gray-600 dark:text-gray-300">
                        Trabajo en equipo, comparto conocimiento y me comunico efectivamente con stakeholders.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-primary-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">
                ¿Te gustaría trabajar juntos?
            </h2>
            <p class="text-xl text-primary-100 mb-8 max-w-3xl mx-auto">
                Estoy siempre abierto a nuevas oportunidades, proyectos freelance y colaboraciones interesantes. 
                ¡Hablemos sobre cómo puedo ayudarte a alcanzar tus objetivos!
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact.show') }}" 
                   class="inline-flex items-center px-8 py-4 bg-white text-primary-600 font-semibold rounded-lg hover:bg-gray-100 transition-colors duration-200 shadow-lg">
                    Contactar
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
                <a href="{{ route('projects') }}" 
                   class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-primary-600 transition-colors duration-200">
                    Ver Proyectos
                </a>
            </div>
        </div>
    </section>
@endsection
