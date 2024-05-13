<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Profile;


class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for ($i = 1; $i <= 4; $i++) {
            $profile =  Profile::create([
                'identity_card' => Str::random(10),
                'date_birth' => '1998-02-01',
                'date_vocation' => '2009-02-01',
                'date_admission' => '2012-02-01',
                'date_send' => '2010-02-02',
                'date_vote' => '2020-02-02',
                'date_death' => '2022-02-02',
                'cellphone' => Str::random(10),
                'phone' => Str::random(10),
                'observation' => 'THE OBSEVATION 1',
                'user_id' => $i,
            ]);
        }
    }
}
