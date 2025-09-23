<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Móvil',
                'slug' => 'movil',
                'description' => 'Aplicaciones móviles para iOS y Android',
                'color' => '#10B981', // Verde
                'icon' => 'smartphone',
                'order' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sistema Web',
                'slug' => 'sistema-web',
                'description' => 'Sistemas web completos y aplicaciones web',
                'color' => '#3B82F6', // Azul
                'icon' => 'globe',
                'order' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'API',
                'slug' => 'api',
                'description' => 'APIs RESTful y servicios backend',
                'color' => '#8B5CF6', // Púrpura
                'icon' => 'zap',
                'order' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Desarrollo Web',
                'slug' => 'desarrollo-web',
                'description' => 'Sitios web y aplicaciones frontend',
                'color' => '#F59E0B', // Amarillo
                'icon' => 'code',
                'order' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Aplicación Desktop',
                'slug' => 'aplicacion-desktop',
                'description' => 'Aplicaciones de escritorio multiplataforma',
                'color' => '#EF4444', // Rojo
                'icon' => 'monitor',
                'order' => 5,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Full Stack',
                'slug' => 'full-stack',
                'description' => 'Proyectos completos frontend y backend',
                'color' => '#06B6D4', // Cian
                'icon' => 'layers',
                'order' => 6,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Otros',
                'slug' => 'otros',
                'description' => 'Otros tipos de proyectos y experimentos',
                'color' => '#6B7280', // Gris
                'icon' => 'wrench',
                'order' => 7,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
