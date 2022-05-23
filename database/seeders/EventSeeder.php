<?php

namespace Database\Seeders;

use App\Models\Events;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 800; $i++) {

            // Convert to timetamps
            $min = strtotime('2020-01-01 00:00:00');
            $max = strtotime('2022-12-25 00:00:00');

            // Generate random number using above bounds
            $val = rand($min, $max);

            Events::create([
                'name' => 'Name for ' . Str::random(59),
                'description' => 'Description for ' . Str::random(59),
                // Comunidad, Extracomunitaria, Ordinaria, Extraordinaria
                'type' => rand(1, 4),
                'dates' =>   date('Y-m-d H:i:s', $val),
                'datesEnd' =>   date('Y-m-d H:i:s', $val),

            ]);
        }
    }
}
