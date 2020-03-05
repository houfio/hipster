<?php

/** @var Factory $factory */

use App\Period;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Period::class, function (Faker $faker) {
    static $period = 1;

    $data = [
        'semester' => intval(ceil($period / 2))
    ];

    ++$period;

    return $data;
});
