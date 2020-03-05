<?php

/** @var Factory $factory */

use App\Exam;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Exam::class, function (Faker $faker) {
    $startDate = $faker->dateTime;

    return [
        'name' => 'Assessment',
        'description' => $faker->text(255),
        'start_date' => $startDate,
        'end_date' => $startDate->modify("+8 days")
    ];
});
