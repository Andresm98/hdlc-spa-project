<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'super admin']);
        $role->permissions()->attach([
            1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 12, 13, 14, 15,
            16, 17, 18, 19,
            20, 21, 22, 23,
            24, 25
        ]);

        $role = Role::create(['name' => 'invited']);
        $role->permissions()->attach([10]);

        $role = Role::create(['name' => 'secretary']);
        $role->permissions()->attach([10, 11]);

        $role = Role::create(['name' => 'daughter']);
        $role->permissions()->attach([10]);
    }
}
