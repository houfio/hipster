<?php

/** @var Factory $factory */

use App\Tag;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Tag::class, function (Faker $faker) {
    static $i = 0;

    $tags = [
        'Easy',
        'Hard',
        'Fun',
        'Boring',
        'High effort',
        'Low effort'
    ];

    $data = [
        'name' => $tags[$i]
    ];

    ++$i;
    return $data;
});
