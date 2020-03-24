<?php

use App\Exam;
use App\Subject;
use App\Tag;
use Illuminate\Database\Seeder;

class ExamsSeeder extends Seeder
{
    public function run()
    {
        $subjects = Subject::all();
        $tags = Tag::all();

        factory(Exam::class, 220)->make()->each(function (Exam $exam) use ($subjects, $tags) {
            $exam->subject()->associate($subjects->random())->save();
            $exam->tags()->saveMany($tags->random(rand(1, 3)));
        });
    }
}
