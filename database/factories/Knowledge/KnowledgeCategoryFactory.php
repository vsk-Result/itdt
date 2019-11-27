<?php

use Faker\Generator as Faker;
use App\Models\Knowledge\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->realText($maxNbChars = 60, $indexSize = 2),
    ];
});
