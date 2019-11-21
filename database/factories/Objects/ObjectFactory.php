<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Objects\CObject::class, function (Faker $faker) {
    return [
        'code' => $faker->numberBetween($min = 27, $max = 330),
        'name' => $faker->company,
        'address' => $faker->streetAddress,
    ];
});
