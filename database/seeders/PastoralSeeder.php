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
            ['Social y nuestras pobrezas', 'La presente pastoral pertenece a pastorales sociales y nuestras pobrezas.'],
            ['Obras diversas y parroquiales', 'La presente pastoral pertenece a pastorales obras diversas y parroquiales.'],
            ['Casa de retiro', 'La presente pastoral pertenece a pastorales casa de retiro.'],
            ['Casa de hermanas mayores', 'La presente pastoral pertenece a las casas de hermanas mayores.'],
            ['Casa de formación', 'La presente pastoral pertenece a pastorales de casa de formación.'],
            ['Casa provincial', 'La presente pastoral pertenece a pastorales de casa de provincia.'],
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
