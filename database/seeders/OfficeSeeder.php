<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Office;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // $office = Office::create([
        //     'office_name'  => 'Superiora',
        //     'office_observation' => 'Es la encargada de dirigir la inst.',
        // ]);
        $office = Office::create([
            'office_name'  => 'Hermana Sirviente',
            'office_observation' => 'Hermana de rango superior.',
        ]);
        $office = Office::create([
            'office_name'  => 'Hermana Compañera',
            'office_observation' => 'Hermana de rango medio',
        ]);
        $office = Office::create([
            'office_name'  => 'Hermana Seminario',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
    }
}
