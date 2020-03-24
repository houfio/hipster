<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectsSeeder extends Seeder
{
    public function run()
    {
        factory(Subject::class, 160)->create();
    }
}
