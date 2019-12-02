<?php

use Faker\Generator as Faker;
use App\Models\Objects\InfoPart;
use App\Models\Icon;

$factory->define(InfoPart::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'body' => $faker->realText,
        'order' => $faker->numberBetween($min = 1, $max = 10),
        'icon_id' => Icon::all()->random()->id,
    ];
});
