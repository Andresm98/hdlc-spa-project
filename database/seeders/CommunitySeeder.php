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

        for ($i = 0; $i <= 30; $i++) {
            $comunity = Community::create([
                'name' => 'comunidad '. Str::random(10),
                'cellphone' =>  Str::random(6),
                'phone' => Str::random(6),
                'email' => Str::random(4) . '@gmail.com',
                'foundation_comm' => '1930-02-02',
                'foundation_work' => '1750-12-10',
                'rn_collaborators' => $i * 3
            ]);
        }
    }
}
