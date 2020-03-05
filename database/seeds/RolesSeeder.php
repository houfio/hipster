<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run()
    {
        $user_role = new Role();
        $user_role->name = 'user';
        $user_role->save();

        $manager_role = new Role();
        $manager_role->name = 'manager';
        $manager_role->save();

        $admin_role = new Role();
        $admin_role->name = 'admin';
        $admin_role->save();
    }
}
