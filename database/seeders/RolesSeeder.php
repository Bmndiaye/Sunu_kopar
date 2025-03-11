<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'SUPER_ADMIN']);
        Role::create(['name' => 'GERANT']);
        Role::create(['name' => 'PARTICIPANT']);
    }
}
