<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {

        // Validator::make($input, [
        //     'username' => ['required', 'string', 'max:255', 'unique:users'],
        //     'name' => ['required', 'string', 'max:255'],
        //     'lastname' => ['required', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'fullnamecomm' => ['required', 'string', 'max:255'],
        //     'password' => $this->passwordRules(),
        //     'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        // ])->validate();

        // return DB::transaction(function () use ($input) {
        //     return tap(User::create([
        //         'username' => $input['username'],
        //         'name' => $input['name'],
        //         'fullnamecomm' => $input['fullnamecomm'],
        //         'lastname' => $input['lastname'],
        //         'slug' => Str::slug($input['username'] . '-' . random_int(100, 10000)),
        //         'email' => $input['email'],
        //         'password' => Hash::make($input['password']),
        //     ]), function (User $user) {
        //         $this->createTeam($user);
        //     });
        // });
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
            'name' => explode(' Equipo de ', $user->name, 2)[0] . "",
            'personal_team' => true,
        ]));
    }
}
