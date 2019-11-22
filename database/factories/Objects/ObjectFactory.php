<?php

use Faker\Generator as Faker;
use App\Models\Objects\CObject;

$factory->define(CObject::class, function (Faker $faker) {
    return [
        'code' => $faker->numberBetween($min = 27, $max = 330),
        'name' => $faker->company,
        'address' => $faker->streetAddress,
    ];
});
