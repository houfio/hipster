<?php

use App\Teacher;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    public function run()
    {
        factory(Teacher::class, 20)->create();
    }
}
