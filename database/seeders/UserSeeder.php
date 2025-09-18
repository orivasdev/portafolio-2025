<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear usuario administrador por defecto
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@portafolio.com',
            'password' => Hash::make('admin123'),
            'email_verified_at' => now(),
        ]);

        // Crear usuario de prueba adicional
        User::create([
            'name' => 'Usuario Demo',
            'email' => 'demo@portafolio.com', 
            'password' => Hash::make('demo123'),
            'email_verified_at' => now(),
        ]);
    }
}
