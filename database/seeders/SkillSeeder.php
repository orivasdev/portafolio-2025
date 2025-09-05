<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Backend
            [
                'name' => 'Laravel',
                'category' => 'Backend',
                'level' => 5,
                'icon' => 'laravel',
                'description' => 'Framework PHP para desarrollo web robusto y escalable',
                'order' => 1,
            ],
            [
                'name' => 'PHP',
                'category' => 'Backend',
                'level' => 5,
                'icon' => 'php',
                'description' => 'Lenguaje de programación del lado del servidor',
                'order' => 2,
            ],
            [
                'name' => 'CodeIgniter',
                'category' => 'Backend',
                'level' => 4,
                'icon' => 'php',
                'description' => 'Framework PHP ligero para desarrollo web',
                'order' => 3,
            ],
            [
                'name' => 'MySQL',
                'category' => 'Database',
                'level' => 5,
                'icon' => 'database',
                'description' => 'Sistema de gestión de bases de datos relacionales',
                'order' => 1,
            ],
            [
                'name' => 'SQL',
                'category' => 'Database',
                'level' => 5,
                'icon' => 'database',
                'description' => 'Lenguaje de consulta estructurado para bases de datos',
                'order' => 2,
            ],
            [
                'name' => 'SQLite',
                'category' => 'Database',
                'level' => 4,
                'icon' => 'database',
                'description' => 'Base de datos local para aplicaciones móviles',
                'order' => 3,
            ],
            [
                'name' => 'AsyncStorage',
                'category' => 'Database',
                'level' => 4,
                'icon' => 'database',
                'description' => 'Almacenamiento local para aplicaciones React Native',
                'order' => 4,
            ],
            [
                'name' => 'Drift',
                'category' => 'Database',
                'level' => 4,
                'icon' => 'database',
                'description' => 'ORM moderno para Flutter con SQLite',
                'order' => 5,
            ],
            [
                'name' => 'SharedPreferences',
                'category' => 'Database',
                'level' => 4,
                'icon' => 'database',
                'description' => 'Almacenamiento de preferencias para Flutter',
                'order' => 6,
            ],

            // Arquitectura
            [
                'name' => 'APIs RESTful',
                'category' => 'Arquitectura',
                'level' => 5,
                'icon' => 'api',
                'description' => 'Arquitectura de APIs RESTful para servicios web',
                'order' => 1,
            ],
            [
                'name' => 'Patrón MVC',
                'category' => 'Arquitectura',
                'level' => 5,
                'icon' => 'api',
                'description' => 'Patrón de arquitectura Modelo-Vista-Controlador',
                'order' => 2,
            ],
            [
                'name' => 'Clean Architecture',
                'category' => 'Arquitectura',
                'level' => 4,
                'icon' => 'api',
                'description' => 'Arquitectura limpia y modular por features',
                'order' => 3,
            ],
            [
                'name' => 'Repository Pattern',
                'category' => 'Arquitectura',
                'level' => 4,
                'icon' => 'api',
                'description' => 'Abstracción de datos con repositorios y data sources',
                'order' => 4,
            ],

            // Frontend
            [
                'name' => 'AngularJS',
                'category' => 'Frontend',
                'level' => 4,
                'icon' => 'angular',
                'description' => 'Framework JavaScript para aplicaciones web dinámicas',
                'order' => 1,
            ],
            [
                'name' => 'Bootstrap',
                'category' => 'Frontend',
                'level' => 4,
                'icon' => 'css',
                'description' => 'Framework CSS para diseño responsivo',
                'order' => 2,
            ],
            [
                'name' => 'jQuery',
                'category' => 'Frontend',
                'level' => 4,
                'icon' => 'javascript',
                'description' => 'Biblioteca JavaScript para manipulación del DOM',
                'order' => 3,
            ],
            [
                'name' => 'JavaScript',
                'category' => 'Frontend',
                'level' => 5,
                'icon' => 'javascript',
                'description' => 'Lenguaje de programación del lado del cliente',
                'order' => 4,
            ],
            [
                'name' => 'HTML/CSS',
                'category' => 'Frontend',
                'level' => 5,
                'icon' => 'html',
                'description' => 'Lenguajes de marcado y estilos para desarrollo web',
                'order' => 5,
            ],
            [
                'name' => 'Redux',
                'category' => 'Frontend',
                'level' => 4,
                'icon' => 'react',
                'description' => 'Gestión de estado global para aplicaciones React/React Native',
                'order' => 6,
            ],
            [
                'name' => 'Axios',
                'category' => 'Frontend',
                'level' => 5,
                'icon' => 'api',
                'description' => 'Cliente HTTP para peticiones REST y APIs',
                'order' => 7,
            ],
            [
                'name' => 'Dio',
                'category' => 'Frontend',
                'level' => 4,
                'icon' => 'api',
                'description' => 'Cliente HTTP avanzado para Flutter con interceptores',
                'order' => 8,
            ],

            // Mobile
            [
                'name' => 'React Native',
                'category' => 'Mobile',
                'level' => 5,
                'icon' => 'mobile',
                'description' => 'Framework principal para desarrollo móvil multiplataforma',
                'order' => 1,
            ],
            [
                'name' => 'Expo SDK',
                'category' => 'Mobile',
                'level' => 5,
                'icon' => 'mobile',
                'description' => 'Plataforma de desarrollo y despliegue para React Native',
                'order' => 2,
            ],
            [
                'name' => 'React Navigation',
                'category' => 'Mobile',
                'level' => 5,
                'icon' => 'mobile',
                'description' => 'Navegación completa (Stack, Drawer, Tabs) para React Native',
                'order' => 3,
            ],
            [
                'name' => 'Flutter',
                'category' => 'Mobile',
                'level' => 5,
                'icon' => 'mobile',
                'description' => 'Framework principal de desarrollo multiplataforma con Dart',
                'order' => 6,
            ],
            [
                'name' => 'Dart',
                'category' => 'Mobile',
                'level' => 5,
                'icon' => 'mobile',
                'description' => 'Lenguaje de programación principal para Flutter',
                'order' => 7,
            ],
            [
                'name' => 'BLoC Pattern',
                'category' => 'Mobile',
                'level' => 4,
                'icon' => 'mobile',
                'description' => 'Business Logic Component para gestión de estado reactiva',
                'order' => 8,
            ],
            [
                'name' => 'Cubits',
                'category' => 'Mobile',
                'level' => 4,
                'icon' => 'mobile',
                'description' => 'Gestión de estado y lógica de negocio con estados inmutables',
                'order' => 9,
            ],
            [
                'name' => 'Material Design',
                'category' => 'Mobile',
                'level' => 4,
                'icon' => 'mobile',
                'description' => 'Sistema de diseño de Google para interfaces nativas',
                'order' => 10,
            ],

            // DevOps
            [
                'name' => 'Git',
                'category' => 'DevOps',
                'level' => 5,
                'icon' => 'git',
                'description' => 'Sistema de control de versiones distribuido',
                'order' => 1,
            ],
            [
                'name' => 'Liderazgo Técnico',
                'category' => 'DevOps',
                'level' => 4,
                'icon' => 'leadership',
                'description' => 'Supervisión y coordinación de equipos de desarrollo',
                'order' => 2,
            ],
            [
                'name' => 'EAS Build',
                'category' => 'DevOps',
                'level' => 4,
                'icon' => 'cicd',
                'description' => 'Sistema de construcción y despliegue para aplicaciones Expo',
                'order' => 3,
            ],
            [
                'name' => 'Gradle',
                'category' => 'DevOps',
                'level' => 3,
                'icon' => 'cicd',
                'description' => 'Sistema de construcción para aplicaciones Android',
                'order' => 4,
            ],
            [
                'name' => 'ESLint & Prettier',
                'category' => 'DevOps',
                'level' => 4,
                'icon' => 'cicd',
                'description' => 'Linting y formateo de código para mantener calidad',
                'order' => 5,
            ],
            [
                'name' => 'Flutter Lints',
                'category' => 'DevOps',
                'level' => 4,
                'icon' => 'cicd',
                'description' => 'Análisis estático de código para Flutter',
                'order' => 6,
            ],
            [
                'name' => 'Build Runner',
                'category' => 'DevOps',
                'level' => 3,
                'icon' => 'cicd',
                'description' => 'Generación automática de código para Flutter',
                'order' => 7,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::create($skill);
        }
    }
}
