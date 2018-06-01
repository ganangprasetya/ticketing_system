<?php

use Illuminate\Database\Seeder;

use App\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create([
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'User is admin',
        ]);
        $pershop = Role::create([
            'name' => 'user',
            'display_name' => 'User',
            'description' => 'User Ticketing',
        ]);
    }
}
