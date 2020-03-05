<?php

use App\Group;
use Illuminate\Database\Seeder;

class GroupsSeeder extends Seeder
{
    public function run()
    {
        factory(Group::class, 8)->create();
    }
}
