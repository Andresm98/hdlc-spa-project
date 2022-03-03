<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Community;

use Illuminate\Support\Str;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 0; $i <= 70; $i++) {
            $comunity = Community::create([
                'comm_identity_card' =>Str::random(10),
                'comm_name' => 'comunidad ' . Str::random(10),
                'comm_slug' => Str::slug('comunidad ' . Str::random(14)),
                'comm_cellphone' =>  Str::random(6),
                'comm_phone' => Str::random(6),
                'comm_email' => Str::random(4) . '@gmail.com',
                'date_fndt_comm' => '1900-02-01',
                'date_fndt_work' => '1900-12-10',
                'rn_collaborators' => $i * 3
            ]);
        }
    }
}
