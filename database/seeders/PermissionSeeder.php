<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super Administrator

        Permission::create(['name' => 'see admin menu']);

        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'read users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'read roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        // Invited

        Permission::create(['name' => 'see principal menu']);

        // Secretary

        Permission::create(['name' => 'see secretary menu']);


        // Permission 12 to 15 Pastolas (Administrator)

        Permission::create(['name' => 'create pastoral']);
        Permission::create(['name' => 'read pastoral']);
        Permission::create(['name' => 'update pastoral']);
        Permission::create(['name' => 'delete pastoral']);

        // Permission 16 to 19 Appointments Levels (Administrator)

        Permission::create(['name' => 'create appointment level']);
        Permission::create(['name' => 'read appointment level']);
        Permission::create(['name' => 'update appointment level']);
        Permission::create(['name' => 'delete appointment level']);

        // Permission 20 to 23 Zones (Administrator)

        Permission::create(['name' => 'create zone']);
        Permission::create(['name' => 'read zone']);
        Permission::create(['name' => 'update zone']);
        Permission::create(['name' => 'delete zone']);

        // Permission 24 o 25 Zones (Administrator)

        Permission::create(['name' => 'create adminsettings']);
        Permission::create(['name' => 'read adminsettings']);

    }
}
