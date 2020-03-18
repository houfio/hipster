<?php

use App\Subject;
use App\Teacher;
use Illuminate\Database\Seeder;

class TeachersSeeder extends Seeder
{
    public function run()
    {
        $subjects = Subject::all()->pluck('id')->toArray();

        factory(Teacher::class, 20)->create()->each(function (Teacher $teacher) use ($subjects) {
            $teacher->subjects()->attach($subjects[array_rand($subjects)]);
        });
    }
}
