<?php

use Faker\Generator as Faker;
use App\Models\Knowledge\Category;
use App\Models\Icon;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'icon_id' => Icon::all()->random()->id,
    ];
});
