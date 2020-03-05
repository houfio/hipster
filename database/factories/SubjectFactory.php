<?php

/** @var Factory $factory */

use App\Subject;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Subject::class, function (Faker $faker) {
    return [
        'name' => 'Willekeurig vak',
        'description' => $faker->text(255),
        'credits' => $faker->numberBetween(1, 4)
    ];
});
