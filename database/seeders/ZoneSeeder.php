<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Zone::create([
            'name'  => 'Zona 1',
            'description' => 'En la presente zona se encuentran todas las comunidades u obras asociadas a la zona 1.',
            // "user_id" => rand(100, 150),
        ]);
        Zone::create([
            'name'  => 'Zona 2',
            'description' => 'En la presente zona se encuentran todas las comunidades u obras asociadas a la zona 2.',
            // "user_id" => rand(100, 150),
        ]);
        Zone::create([
            'name'  => 'Zona 3',
            'description' => 'En la presente zona se encuentran todas las comunidades u obras asociadas a la zona 3.',
            // "user_id" => rand(100, 150),
        ]);
        Zone::create([
            'name'  => 'Zona 4',
            'description' => 'En la presente zona se encuentran todas las comunidades u obras asociadas a la zona 4',
            // "user_id" => rand(100, 150),
        ]);
        Zone::create([
            'name'  => 'Zona 5',
            'description' => 'En la presente zona se encuentran todas las comunidades u obras asociadas a la zona 5.',
            // "user_id" => rand(100, 150),
        ]);
        Zone::create([
            'name'  => 'Zona 6',
            'description' => 'En la presente zona se encuentran todas las comunidades u obras asociadas a la zona 6.',
            // "user_id" => rand(100, 150),
        ]);
    }
}
