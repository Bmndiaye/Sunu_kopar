<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Création des rôles
        $superAdmin = Role::create(['name' => 'SUPER_ADMIN']);
        $gerant = Role::create(['name' => 'GERANT']);
        $participant = Role::create(['name' => 'PARTICIPANT']);

        // Attribution de permissions aux rôles
        $superAdmin->givePermissionTo(Permission::all());

        $gerant->givePermissionTo([
            'view_tontines',
            'create_tontines',
            'edit_tontines',
            'delete_tontines',
            'view_users',
        ]);

        $participant->givePermissionTo([
            'view_tontines',
        ]);
    }
}
