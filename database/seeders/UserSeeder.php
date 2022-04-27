<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Office;
use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Laravel\Jetstream\Jetstream;
use App\Models\PoliticalDivision;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            'Admin' => 'admin@gmail.com',
            'Owner' => 'owner@gmail.com',
            'Collaborator' => 'collaborator@gmail.com',
            'Staff' => 'staff@gmail.com',
            'Volunteer' => 'volunteer@gmail.com',
        ];
        foreach ($users as $name => $email) {
            DB::transaction(function () use ($name, $email) {
                return tap(User::create([
                    'username' => 'usernamehdlc' . $name,
                    'slug' => Str::slug('usernamehdlc ' . $name),
                    'name' => $name,
                    'lastname' => 'last-' . $name,
                    'email' => $email,
                    'password' => Hash::make('secret'),
                ]), function (User $user) {
                    $this->createTeam($user);
                    $user->assignRole('super admin');
                });
            });
        }
        // Create one team
        $team = $this->createBigTeam('owner@gmail.com');


        // assign to team
        $role = 'collaborator';
        $email = 'collaborator@gmail.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );


        $role = 'staff';
        $email = 'staff@gmail.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        $role = 'volunteer';
        $email = 'volunteer@gmail.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        // invited

        for ($i = 0; $i <= 60; $i++) {
            $username = 'invited  ' . Str::random(15);
            $slug =  Str::slug($username);
            $user =  User::create([
                'username' => $username,
                'slug' => $slug,
                'name' => Str::random(15),
                'lastname' =>  Str::random(15),
                'email' =>  $slug .  '@gmail.com',
                'password' => Hash::make('secret'),
            ]);
            $user->assignRole('invited');
            $this->createTeam($user);
        }

        //  secretary
        $username = 'secretary  ' . Str::random(15);
        $slug =  Str::slug($username);
        $user =  User::create([
            'username' => $username,
            'slug' => $slug,
            'name' => Str::random(15),
            'lastname' =>  Str::random(15),
            'email' =>  'secretary@gmail.com',
            'password' => Hash::make('secret'),
        ]);
        $user->assignRole('secretary');
        $this->createTeam($user);

        for ($i = 0; $i <= 60; $i++) {
            $username = 'secretary  ' . Str::random(15);
            $slug =  Str::slug($username);
            $user =  User::create([
                'username' => $username,
                'slug' => $slug,
                'name' => Str::random(15),
                'lastname' =>  Str::random(15),
                'email' =>  $slug .  '@gmail.com',
                'password' => Hash::make('secret'),
            ]);
            $user->assignRole('secretary');
            $this->createTeam($user);
        }


        //  daughter
        for ($i = 0; $i <= 200; $i++) {
            // Convert to timetamps
            $min = strtotime('1900-02-01 00:00:00');
            $max = strtotime('2022-02-01 00:00:00');

            // Generate random number using above bounds
            $val = rand($min, $max);

            // Convert back to desired date format

            $username = 'daughter  ' . Str::random(15);
            $slug =  Str::slug($username);
            $user =  User::create([
                'username' => $username,
                'slug' => $slug,
                'name' => Str::random(15),
                'lastname' =>  Str::random(15),
                'email' =>  $slug . '@gmail.com',
                'password' => Hash::make('secret'),
            ]);
            $user->assignRole('daughter');

            $political_division_id =   PoliticalDivision::where('level', '=', 3)
                ->where('last_level', '=', 'Y')
                ->inRandomOrder()
                ->first();

            $profile = $user->profile()->create([
                'identity_card' => '1004280135',
                'status' => rand(1, 3),
                'date_birth' => date('Y-m-d H:i:s', rand($min, $max)),
                'date_vocation' => date('Y-m-d H:i:s', $val),
                'date_admission' => date('Y-m-d H:i:s', $val),
                'date_send' => date('Y-m-d H:i:s', rand($min, $max)),
                'date_vote' => date('Y-m-d H:i:s', rand($min, $max)),
                'cellphone' => '09967316479',
                'phone' => '022405124',
                'observation' => 'Observation of ' . $user->name,
            ]);

            if ($profile->status == 2) {
                $profile->update([
                    'date_death' => date('Y-m-d H:i:s', $val),
                ]);
            }
            if ($profile->status == 3) {
                $profile->update([
                    'date_exit' => date('Y-m-d H:i:s', $val),
                ]);
            }



            if (strlen($political_division_id->id) == 6) {
                $profile->address()->create([
                    'address' => 'Dirr de ' . $user->name,
                    'political_division_id' =>  $political_division_id->id . '',
                ]);
            } else {
                $profile->address()->create([
                    'address' => 'Dirr de ' . $user->name,
                    'political_division_id' => '0' . $political_division_id->id . '',
                ]);
            }

            $comm =  Community::where('comm_status', '=', 1)
                ->inRandomOrder()
                ->first();

            $office =  Office::select('*')
                ->inRandomOrder()
                ->first();

            $profile->transfers()->create([
                'transfer_reason' => 'Reason of ' . $user->name,
                'transfer_date_adission' => date('Y-m-d H:i:s', rand($min, $max)),
                // 'transfer_date_relocated' => $request->get('transfer_date_relocated'),
                'transfer_observation' => 'Observation transfer of ' . $user->name,
                'community_id' => $comm->id,
                'office_id' =>  $office->id,
            ]);

            $this->createTeam($user);
        }
    }
    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => 'Equipo de ' . $user->name,
            'personal_team' => true,
        ]));
    }
    /**
     * @param mixed $email
     * @return Team
     */
    protected function createBigTeam($email): Team
    {
        $user = Jetstream::findUserByEmailOrFail($email);
        $team = Team::forceCreate([
            'user_id' => $user->id,
            'name' => "HDLC Company",
            'personal_team' => false,
        ]);
        $user->ownedTeams()->save($team);
        return $team;
    }
}
