<?php

use Faker\Generator as Faker;
use App\Models\Inventory\Consumables\Consumable;
use App\Models\Inventory\Consumables\Color;

$factory->define(Consumable::class, function (Faker $faker) {
    return [
        'name' => $faker->realText($maxNbChars = 30, $indexSize = 2),
        'color_id' => Color::all()->random()->id,
    ];
});
