<?php

/** @var Factory $factory */

use App\Teacher;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Teacher::class, function (Faker $faker) {
    $firstName = $faker->firstName;
    $lastName = $faker->lastName;

    return [
        'first_name' => $firstName,
        'last_name' => $lastName,
        'email' => "$firstName.$lastName@docent.avans.nl",
        'abbreviation' => strtoupper($faker->text(4)),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
    ];
});
