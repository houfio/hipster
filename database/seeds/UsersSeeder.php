<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        factory(User::class, 10)->create()->each(function (User $user) {
            $user->role()->make(factory(Role::class)->make());
        });
    }
}
