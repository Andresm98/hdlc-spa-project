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
        Office::create([
            'office_name'  => 'Hermana Sirviente',
            'office_observation' => 'Hermana de rango superior.',
        ]);
        Office::create([
            'office_name'  => 'Hermana Compañera',
            'office_observation' => 'Hermana de rango medio',
        ]);
        Office::create([
            'office_name'  => 'Hermana Seminario',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
        Office::create([
            'office_name'  => 'Visitadora Provincial',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
        Office::create([
            'office_name'  => 'Asistente Provincial',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
        Office::create([
            'office_name'  => 'Consejera Provincial',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
        Office::create([
            'office_name'  => 'Secretaria Provincial',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
        Office::create([
            'office_name'  => 'Ecónoma Provincial',
            'office_observation' => 'Hermana de rango inicial.',
        ]);
    }
}
