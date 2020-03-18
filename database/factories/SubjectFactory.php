<?php

/** @var Factory $factory */

use App\Subject;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Subject::class, function (Faker $faker) {
    static $i = 0;

    $subjects = [
        'PROG',
        'MODL',
        'PRESAM',
        'WEBSJS',
        'WEBSPHP',
        'EPRES',
        'SLC',
        'PROJ'
    ];

    if ($i >= sizeof($subjects)) {
        $i = 0;
    }

    $data = [
        'name' => "$subjects[$i]$i",
        'description' => $faker->text(255),
        'credits' => $faker->numberBetween(1, 4),
        'period_id' => $faker->numberBetween(1, 16)
    ];

    ++$i;

    return $data;
});
