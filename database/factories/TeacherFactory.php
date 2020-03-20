<?php

/** @var Factory $factory */

use App\Teacher;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(Teacher::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;

    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => preg_replace('/[^a-zA-Z.@0-9]/', '', strtolower("$firstName[0]." . str_replace(' ', '.', $lastName) . "@docent.avans.nl")),
        'abbreviation' => strtoupper(Str::random(4))
    ];
});
