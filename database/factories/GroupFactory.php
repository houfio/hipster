<?php

/** @var Factory $factory */

use App\Group;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Group::class, function (Faker $faker) {
    static $letter = 'a';

    $period =  $faker->numberBetween(1, 16);
    $formattedPeriod = sprintf("%02d", $period);

    $data = [
        'period_id' => $period,
        'name' => "42INSO$formattedPeriod$letter"
    ];

    ++$letter;

    return $data;
});
