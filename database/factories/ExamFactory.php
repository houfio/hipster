<?php

/** @var Factory $factory */

use App\Exam;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Exam::class, function (Faker $faker) {
    $isAssessment = $faker->boolean(60);

    if ($faker->boolean(60)) {
        if ($faker->boolean(75)) {
            $grade = $faker->randomFloat(1, 5.5, 10);
        } else {
            $grade = $faker->randomFloat(1, 1, 5.5);
        }
    } else {
        $grade = null;
    }

    $names = [
        'Writing',
        'Supersim',
        'Presentation',
        'Speaking',
        'Studymate',
        'Research',
        'Improvement',
        'Seabattle',
        'Hangman',
        'Multiple choice'
    ];

    return [
        'name' => $names[array_rand($names)],
        'description' => $faker->text(255),
        'due_on' => $faker->dateTimeBetween('now', '+8 weeks'),
        'file' => $isAssessment && !$grade ? '/Path/To/File' : null,
        'grade' => $grade,
        'is_assessment' => $isAssessment
    ];
});
