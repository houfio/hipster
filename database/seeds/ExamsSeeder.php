<?php

use App\Exam;
use App\Subject;
use Illuminate\Database\Seeder;

class ExamsSeeder extends Seeder
{
    public function run()
    {
        $subjects = Subject::all();

        factory(Exam::class, 220)->make()->each(function (Exam $exam) use ($subjects) {
            $exam->subject()->associate($subjects->random())->save();
        });
    }
}
