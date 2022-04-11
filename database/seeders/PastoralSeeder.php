<?php

namespace Database\Seeders;

use App\Models\Pastoral;
use Illuminate\Database\Seeder;

class PastoralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pastoral = [
            ['Educativa', 'La presente pastoral pertenece a pastorales educativas.'],
            ['Salud', 'La presente pastoral pertenece a pastorales de salud.'],
            ['Social', 'La presente pastoral pertenece a pastorales sociales.'],
            ['Obras diversas y parroquiales', 'La presente pastoral pertenece a pastorales obras diversas y parroquiales.'],
            ['Nuestras pobrezas', 'La presente pastoral pertenece a pastorales nuestras pobrezas.'],
            ['Casa de espiritualidad', 'La presente pastoral pertenece a pastorales casa de espiritualidad.'],
            ['Casa de hermanas mayores', 'La presente pastoral pertenece a las casas de hermanas mayores.'],
            ['Casa de formación', 'La presente pastoral pertenece a pastorales de casa de formación.'],
            ['Casa y curia provincial', 'La presente pastoral pertenece a pastorales de casa de curia y provincia.'],
            ['Seminario interprovincial', 'La presente pastoral pertenece a pastorales de seminario interprovincial.'],
        ];


        foreach ($pastoral as list($name, $description)) {
            Pastoral::create([
                'name' => $name,
                'description' => $description,
            ]);
        }
    }
}
