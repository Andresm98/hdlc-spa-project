<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Vehicle;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 800; $i++) {

            $community = Community::inRandomOrder()->first();

            // Convert to timetamps
            $min = strtotime('1990-02-01 00:00:00');
            $max = strtotime('2015-02-01 00:00:00');

            $val = rand($min, $max);

            Vehicle::create([
                'brand' => 'brand ' . Str::random(10),
                'type' => 'type ' . Str::random(10),
                'color' => 'color ' . Str::random(10),
                'plaque' => 'plaque ' . Str::random(10),
                'plaque' => 'plaque ' . Str::random(10),
                'year' =>   date('Y-m-d H:i:s', $val),
                'community_id' => $community->id,
            ]);
        }
    }
}
