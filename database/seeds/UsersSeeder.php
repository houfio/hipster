<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        /** @var User[] $users */
        $users = factory(User::class, 2)->make();

        $users[0]->role()->associate(Role::find(1))->save();
        $users[1]->role()->associate(Role::find(2))->save();
    }
}
