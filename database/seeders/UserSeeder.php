<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;

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
            'Admin' => 'admin@votetracker.org',
            'Owner' => 'owner@example.com',
            'Collaborator' => 'collaborator@example.com',
            'Staff' => 'staff@example.com',
            'Volunteer' => 'volunteer@example.com',
        ];
        foreach ($users as $name => $email) {
            DB::transaction(function () use ($name, $email) {
                return tap(User::create([
                    'username' => 'usernamehdlc ' . $name,
                    'slug' => Str::slug('usernamehdlc ' . $name),
                    'name' => $name,
                    'lastname' => 'last-' . $name,
                    'email' => $email,
                    'password' => Hash::make('secret'),
                ]), function (User $user) {
                    $this->createTeam($user);
                });
            });
        }
        // Create one team
        $team = $this->createBigTeam('owner@example.com');


        // assign to team
        $role = 'collaborator';
        $email = 'collaborator@example.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        $role = 'staff';
        $email = 'staff@example.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );

        $role = 'volunteer';
        $email = 'volunteer@example.com';
        $team->users()->attach(
            Jetstream::findUserByEmailOrFail($email),
            ['role' => $role]
        );


        //
        for ($i = 0; $i <= 6000; $i++) {
            $user =  User::create([
                'username' => 'username_' . Str::random(5),
                'slug' => Str::slug('username_' . Str::random(10)),
                'name' => Str::random(10),
                'lastname' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('secret'),
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
