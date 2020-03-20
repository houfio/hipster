<?php

/** @var Factory $factory */

use App\Exam;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Exam::class, function (Faker $faker) {
    $startDate = $faker->dateTime;
    $isAssessment = $faker->boolean(60);

    return [
        'name' => 'Assessment',
        'description' => $faker->text(255),
        'start_date' => $startDate,
        'end_date' => $isAssessment ? $startDate->modify("+8 days") : null,
        'file' => $isAssessment ? '/Path/To/File' : null,
        'grade' => $faker->boolean(50) ? $faker->randomFloat(1, 1, 10) : null,
        'is_assessment' => $isAssessment
    ];
});
