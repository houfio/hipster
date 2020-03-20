<?php

use App\Exam;
use App\Subject;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    public function run()
    {
        factory(Subject::class, 16)->create();
    }
}
