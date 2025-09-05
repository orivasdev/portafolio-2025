<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $projects = [
            [
                'title' => 'Sistema de Gestión de Encomiendas',
                'description' => 'Aplicación móvil desarrollada con React Native para la gestión y seguimiento de encomiendas en tiempo real. Incluye funcionalidades de geolocalización avanzada, captura de eventos relacionados con entregas y sistema de notificaciones push para clientes y analistas.',
                'short_description' => 'App móvil para gestión y seguimiento de encomiendas con geolocalización.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['React Native', 'Laravel', 'MySQL', 'APIs RESTful', 'Geolocalización'],
                'category' => 'Móvil',
                'order' => 1,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema de Control de Combustible',
                'description' => 'Aplicación móvil desarrollada con React Native para el control y monitoreo del consumo de combustible en flotas de vehículos. Incluye registro de despachos, seguimiento de consumo y reportes de eficiencia para optimizar la gestión de recursos.',
                'short_description' => 'App móvil para control y monitoreo de combustible en flotas vehiculares.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['React Native', 'Flutter', 'MySQL', 'APIs RESTful', 'Reportes'],
                'category' => 'Móvil',
                'order' => 2,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema de Gestión de Contenido Dinámico',
                'description' => 'Plataforma web desarrollada con Laravel y AngularJS que permite a los usuarios crear vistas personalizadas, duplicarlas y editar contenido de manera eficiente. Incluye un gestor de contenido robusto y adaptable para diferentes sectores empresariales.',
                'short_description' => 'Sistema web para gestión de contenido dinámico y personalizable.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['Laravel', 'AngularJS', 'MySQL', 'Bootstrap', 'JavaScript'],
                'category' => 'Sistema Web',
                'order' => 3,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Módulos CRUD para CMS',
                'description' => 'Módulos funcionales desarrollados con PHP CodeIgniter y AngularJS para sistemas de gestión de contenido. Incluye funcionalidades completas de creación, lectura, actualización y eliminación de datos, con integración dinámica de información y soporte multiidioma.',
                'short_description' => 'Módulos CRUD para sistemas de gestión de contenido con soporte multiidioma.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['PHP', 'CodeIgniter', 'AngularJS', 'MySQL', 'HTML/CSS'],
                'category' => 'Sistema Web',
                'order' => 4,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema de Gestión de Incidencias',
                'description' => 'Plataforma web desarrollada con Laravel para el registro, asignación y seguimiento de problemas técnicos y operativos. Permite la interacción eficiente entre usuarios y equipos especializados, mejorando la resolución de incidencias organizacionales.',
                'short_description' => 'Sistema web para gestión y seguimiento de incidencias técnicas.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'Bootstrap', 'JavaScript'],
                'category' => 'Sistema Web',
                'order' => 5,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'API RESTful para Servicios Empresariales',
                'description' => 'API robusta desarrollada con Laravel siguiendo el patrón MVC y arquitectura RESTful. Proporciona servicios web escalables para aplicaciones móviles y sistemas web, con autenticación segura y documentación completa.',
                'short_description' => 'API RESTful para servicios empresariales con arquitectura MVC.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => ['Laravel', 'PHP', 'MySQL', 'APIs RESTful', 'Patrón MVC'],
                'category' => 'API',
                'order' => 6,
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema de Gestión de Paquetes Phoenix',
                'description' => 'Aplicación móvil empresarial desarrollada con React Native y Expo para la gestión integral de paquetes entrantes y salientes en agencias, plataformas y corporativos. Incluye funcionalidades avanzadas de escaneo de códigos de barras con hardware especializado (Zebra/Sunmi), sincronización offline-first, generación de reportes PDF, comunicación en tiempo real con WebSockets, y sistema de autenticación robusto con encriptación AES.',
                'short_description' => 'App móvil empresarial para gestión integral de paquetes con escaneo especializado y sincronización offline.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => [
                    'React Native', 
                    'Expo SDK', 
                    'Redux', 
                    'SQLite', 
                    'Zebra Scanner', 
                    'Sunmi Scanner', 
                    'React Navigation', 
                    'Axios', 
                    'Crypto-JS', 
                    'React Native Camera', 
                    'QR Code Scanner', 
                    'PDF Generation', 
                    'Offline-First Architecture', 
                    'WebSocket', 
                    'AES Encryption', 
                    'EAS Build', 
                    'Gradle', 
                    'Android NDK'
                ],
                'category' => 'Móvil',
                'order' => 7,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'title' => 'Sistema de Gestión de Encomiendas Phoenix (Flutter)',
                'description' => 'Aplicación móvil desarrollada con Flutter para la gestión integral de encomiendas y paquetes. Incluye funcionalidades de escaneo QR/barcode, sincronización offline/online, gestión de entrantes y salientes por agencias y plataformas, integración con hardware especializado (DataWedge, Sunmi Scanner), y sistema de autenticación robusto con diferentes perfiles de usuario (agencia, plataforma, corporativo).',
                'short_description' => 'App móvil Flutter para gestión integral de encomiendas con escaneo QR y sincronización offline.',
                'image' => null,
                'github_url' => null,
                'live_url' => null,
                'technologies' => [
                    'Flutter', 
                    'Dart', 
                    'Laravel', 
                    'BLoC Pattern', 
                    'SQLite', 
                    'Drift ORM', 
                    'APIs RESTful', 
                    'QR/Barcode Scanner', 
                    'DataWedge Integration', 
                    'Sunmi Scanner', 
                    'Offline Sync', 
                    'Dependency Injection', 
                    'Clean Architecture'
                ],
                'category' => 'Móvil',
                'order' => 8,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
