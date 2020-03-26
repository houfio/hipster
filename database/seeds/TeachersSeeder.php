<?php

use App\Subject;
use App\Teacher;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    public function run()
    {
        $subjects = Subject::all();

        factory(Teacher::class, 14)->create()->each(function (Teacher $teacher) use ($subjects) {
            $teacher->subjects()->saveMany($subjects->random(rand(2, 6)));
        });
    }
}
