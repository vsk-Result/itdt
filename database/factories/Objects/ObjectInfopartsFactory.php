<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Objects\InfoPart::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'body' => $faker->realText,
        'order' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
