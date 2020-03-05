<?php

use App\Group;
use App\User;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    public function run()
    {
        factory(Group::class, 6)->create()->each(function (Group $group) {
            $group->users()->saveMany(factory(User::class, 8)->make());
        });
    }
}
