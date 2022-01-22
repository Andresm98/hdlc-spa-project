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
            'name'  => 'Superiora',
            'observation' => 'Es la encargada de dirigir la inst.',
        ]);
        $office = Office::create([
            'name'  => 'Hermana Sirviente',
            'observation' => 'Hermana de rango s.',
        ]);
        $office = Office::create([
            'name'  => 'Hermana General',
            'observation' => 'Hermana de rango g',
        ]);
        $office = Office::create([
            'name'  => 'Hermanas Novicias',
            'observation' => 'Hermana de rango novicia.',
        ]);
    }
}
