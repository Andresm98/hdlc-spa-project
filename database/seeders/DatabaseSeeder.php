<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(AppointmentLevelsSeeder::class);
        $this->call(OfficeSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(PoliticalDivisionSeeder::class);
        $this->call(PastoralSeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(CommunitySeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);

        $this->call(EventSeeder::class);

        // $this->call(ProfileSeeder::class);

    }
}
