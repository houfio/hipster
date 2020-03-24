<?php

/** @var Factory $factory */

use App\Subject;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Subject::class, function (Faker $faker) {
    static $period = 1;

    $subjects = [
        'PROG',
        'MODL',
        'PRESAM',
        'WEBSJS',
        'WEBSPHP',
        'EPRES',
        'SLC',
        'PROJ',
        'DPINT',
        'IDONT',
        'ICTMCSH',
        'DB',
        'ECOME'
    ];

    $data = [
        'name' => "{$subjects[array_rand($subjects)]}$period",
        'description' => $faker->text(255),
        'credits' => $faker->numberBetween(1, 4),
        'period_id' => $faker->numberBetween(1, 16)
    ];

    ++$period;
    return $data;
});
