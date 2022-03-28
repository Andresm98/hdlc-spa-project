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

        $office = Office::create([
            'office_name'  => 'Superiora',
            'office_observation' => 'Es la encargada de dirigir la inst.',
        ]);
        $office = Office::create([
            'office_name'  => 'Hermana Sirviente',
            'office_observation' => 'Hermana de rango s.',
        ]);
        $office = Office::create([
            'office_name'  => 'Hermana General',
            'office_observation' => 'Hermana de rango g',
        ]);
        $office = Office::create([
            'office_name'  => 'Hermanas Novicias',
            'office_observation' => 'Hermana de rango novicia.',
        ]);
    }
}
