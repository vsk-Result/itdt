<?php

use Faker\Generator as Faker;
use App\Models\Objects\Person;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'fullname' => $faker->numberBetween($min = 27, $max = 330),
        'appointment' => $faker->name,
        'phone' => $faker->streetAddress,
        'email' => $faker->streetAddress,
    ];
});
