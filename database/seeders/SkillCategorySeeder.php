<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SkillCategory;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Backend',
                'slug' => 'backend',
                'description' => 'Tecnologías y frameworks para desarrollo del lado del servidor',
                'color' => '#3B82F6', // Azul
                'icon' => 'server',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Frontend',
                'slug' => 'frontend',
                'description' => 'Tecnologías para desarrollo de interfaces de usuario',
                'color' => '#10B981', // Verde
                'icon' => 'monitor',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Database',
                'slug' => 'database',
                'description' => 'Sistemas de gestión de bases de datos y consultas',
                'color' => '#F59E0B', // Amarillo
                'icon' => 'database',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Mobile',
                'slug' => 'mobile',
                'description' => 'Desarrollo de aplicaciones móviles',
                'color' => '#8B5CF6', // Púrpura
                'icon' => 'smartphone',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Herramientas de desarrollo y operaciones',
                'color' => '#EF4444', // Rojo
                'icon' => 'settings',
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Arquitectura',
                'slug' => 'arquitectura',
                'description' => 'Patrones de diseño y arquitectura de software',
                'color' => '#06B6D4', // Cian
                'icon' => 'layers',
                'order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            SkillCategory::create($category);
        }
    }
}