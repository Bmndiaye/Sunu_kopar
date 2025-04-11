<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User management permissions
        Permission::create(['name' => 'view_users']);
        Permission::create(['name' => 'create_users']);
        Permission::create(['name' => 'edit_users']);
        Permission::create(['name' => 'delete_users']);
        
        // Role management permissions
        Permission::create(['name' => 'view_roles']);
        Permission::create(['name' => 'create_roles']);
        Permission::create(['name' => 'edit_roles']);
        Permission::create(['name' => 'delete_roles']);
        
        // Tontine management permissions
        Permission::create(['name' => 'view_tontines']);
        Permission::create(['name' => 'create_tontines']);
        Permission::create(['name' => 'edit_tontines']);
        Permission::create(['name' => 'delete_tontines']);
        
        // System configuration permissions
        Permission::create(['name' => 'manage_system']);
        Permission::create(['name' => 'view_logs']);
        Permission::create(['name' => 'manage_backups']);
    }
}