<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AppointmentLevel;

class AppointmentLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $this->appointment_categories();
        $this->appointment_categories_name();
    }

    public function  appointment_categories()
    {
        $categories = [
            ['Nivel de Provincia', 'En la presente categoría se se encuentran todos los rangos a nivel provincial.'],
            ['Nivel de Comunidad Local', 'En la presente categoría se se encuentran todos los rangos a nivel de comunidad local.'],
            ['Nivel de Obras', 'En la presente categoría se se encuentran todos los rangos a nivel de obras.']
        ];

        foreach ($categories  as list($name, $description)) {
            AppointmentLevel::create([
                'name' => $name,
                'description' => $description,
                'level' => 1,
                'last_level' => 'N'
            ]);
        }
    }

    public function appointment_categories_name()
    {
        $names =  [
            // Level Province
            [1, 'Visitadora Provincial', 'El presente nombre de categoría pertenece al rango de Visitadora Provincial'],
            [1, 'Asistente Provincial', 'El presente nombre de categoría pertenece al rango de Asistente Provincial'],
            [1, 'Consejera Provincial', 'El presente nombre de categoría pertenece al rango de Consejera Provincial'],
            [1, 'Secretaria Provincial', 'El presente nombre de categoría pertenece al rango de Secretaria Provincial'],
            [1, 'Ecónoma Provincial', 'El presente nombre de categoría pertenece al rango de Ecónoma Provincial'],
            [1, 'Padre Director', 'El presente nombre de categoría pertenece al rango de Padre Director'],

            // Level Local Community
            [2, 'Hermana Sirviente', 'El presente nombre de categoría pertenece al rango de Hermana Sirviente'],
            [2, 'Asistente Local', 'El presente nombre de categoría pertenece al rango de Asistente Local'],
            [2, 'Secretaria Local', 'El presente nombre de categoría pertenece al rango de Secretaria Local'],
            [2, 'Ecónoma Local', 'El presente nombre de categoría pertenece al rango de Ecónoma Local'],
            [2, 'Hermana Compañera', 'El presente nombre de categoría pertenece al rango deHermana Compañera'],

            // Level Works
            [3, 'Representante Legal', 'El presente nombre de categoría pertenece al rango de Representante Legal'],
            [3, 'Rector/a', 'El presente nombre de categoría pertenece al rango de Rector/a'],
            [3, 'Director/a', 'El presente nombre de categoría pertenece al rango de Director/a'],
        ];

        foreach ($names as list($appointment_levelc_id, $name, $description)) {
            AppointmentLevel::create([
                'appointment_levelc_id' => $appointment_levelc_id,
                'name' => $name,
                'description' => $description,
                'level' => 2,
                'last_level' => 'Y'
            ]);
        }
    }
}
