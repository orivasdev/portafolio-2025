<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Experience;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        $experiences = [
            [
                'title' => 'Analista de Programación Sr.',
                'company' => 'Menssajero by MRW C.A',
                'description' => 'Diseño, desarrollo y mejora de aplicaciones móviles y prototipos funcionales orientados a optimizar procesos. Mantenimiento y actualización de sistemas existentes para asegurar su eficiencia, estabilidad y adaptabilidad a los requerimientos de la empresa. Identificación y solución de problemas técnicos, aplicando correcciones oportunas para garantizar el buen funcionamiento de las plataformas.',
                'start_date' => '2022-05-01',
                'end_date' => null,
                'is_current' => true,
                'location' => 'Caracas, Venezuela',
                'type' => 'full-time',
                'technologies_used' => ['React Native', 'Laravel', 'PHP', 'MySQL', 'Git', 'APIs RESTful'],
                'order' => 1,
            ],
            [
                'title' => 'Desarrollador Web (Freelancer)',
                'company' => 'Axioma Developers',
                'description' => 'Creación y mantenimiento de módulos funcionales para sistemas de gestión de contenido, asegurando la calidad del código y escalabilidad. Implementación de integración dinámica de información en plataformas web, garantizando la experiencia del usuario y actualizaciones automáticas. Configuración de funcionalidades multiidioma en aplicaciones para uso en diferentes regiones y lenguajes.',
                'start_date' => '2019-03-01',
                'end_date' => '2022-04-30',
                'is_current' => false,
                'location' => 'Caracas, Venezuela',
                'type' => 'freelance',
                'technologies_used' => ['PHP', 'CodeIgniter', 'AngularJS', 'MySQL', 'JavaScript', 'HTML/CSS'],
                'order' => 2,
            ],
            [
                'title' => 'Desarrollador de Aplicaciones para Móviles',
                'company' => 'Impormotor LLS',
                'description' => 'Diseño y programación de aplicaciones móviles orientadas hacia la gestión y control de procesos específicos. Creación de herramientas digitales para optimizar el monitoreo y mantenimiento de vehículos, incluyendo el consumo de combustible. Implementación de funcionalidades que facilitan la automatización y seguimiento de procesos críticos en el sector automotriz.',
                'start_date' => '2021-09-01',
                'end_date' => '2022-04-30',
                'is_current' => false,
                'location' => 'Miranda, Venezuela',
                'type' => 'full-time',
                'technologies_used' => ['React Native', 'Flutter', 'JavaScript', 'APIs RESTful', 'Git'],
                'order' => 3,
            ],
            [
                'title' => 'Desarrollador Web',
                'company' => 'Obeltech Consultores y Asociados C.A',
                'description' => 'Implementación y mejora de sistemas que facilitan la personalización y gestión de vistas y contenido dinámico. Creación de herramientas intuitivas para maximizar la eficiencia y adaptabilidad en la gestión de contenido. Aplicación de tecnologías robustas para garantizar la escalabilidad y sostenibilidad de los sistemas en entornos empresariales.',
                'start_date' => '2021-01-01',
                'end_date' => '2021-09-30',
                'is_current' => false,
                'location' => 'Miranda, Venezuela',
                'type' => 'full-time',
                'technologies_used' => ['Laravel', 'PHP', 'MySQL', 'JavaScript', 'Bootstrap', 'Git'],
                'order' => 4,
            ],
            [
                'title' => 'Coordinador del Área de Sistema',
                'company' => 'Fondo para el Desarrollo Agrario Socialista',
                'description' => 'Supervisión de equipos de desarrollo para el mantenimiento y evolución de sistemas tecnológicos. Planificación y ejecución de tareas alineadas con los objetivos organizacionales y las necesidades operativas. Propuesta e implementación de soluciones que mejoran la eficiencia de los sistemas internos. Interacción con áreas clave para la definición de requerimientos y priorización de proyectos tecnológicos.',
                'start_date' => '2020-02-01',
                'end_date' => '2020-12-31',
                'is_current' => false,
                'location' => 'Caracas, Venezuela',
                'type' => 'full-time',
                'technologies_used' => ['Laravel', 'PHP', 'MySQL', 'Git', 'APIs RESTful', 'Liderazgo Técnico'],
                'order' => 5,
            ],
            [
                'title' => 'Analista',
                'company' => 'Fondo para el Desarrollo Agrario Socialista',
                'description' => 'Creación de plataformas enfocadas en la mejora de procesos internos y resolución de incidencias. Implementación de herramientas para el registro, asignación y seguimiento de problemas técnicos y operativos. Propuesta y desarrollo de soluciones digitales que mejoran la interacción entre usuarios y equipos especializados. Aporte a la mejora operativa mediante la implementación de sistemas eficientes y funcionales.',
                'start_date' => '2018-10-01',
                'end_date' => '2020-02-28',
                'is_current' => false,
                'location' => 'Caracas, Venezuela',
                'type' => 'full-time',
                'technologies_used' => ['Laravel', 'PHP', 'MySQL', 'JavaScript', 'Bootstrap', 'Git'],
                'order' => 6,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
