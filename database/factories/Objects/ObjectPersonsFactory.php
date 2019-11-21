<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Objects\Person::class, function (Faker $faker) {
    return [
        'fullname' => $faker->numberBetween($min = 27, $max = 330),
        'appointment' => $faker->name,
        'phone' => $faker->streetAddress,
        'email' => $faker->streetAddress,
    ];
});
