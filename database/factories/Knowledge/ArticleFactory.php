<?php

use Faker\Generator as Faker;
use App\Models\Knowledge\Article;
use App\User;
use App\Models\Knowledge\Category;
use App\Models\Icon;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'content' => $faker->realText($maxNbChars = 60, $indexSize = 2),
        'user_id' => User::all()->random()->id,
        'category_id' => Category::all()->random()->id,
        'icon_id' => Icon::all()->random()->id,
        'link' => $faker->realText($maxNbChars = 100, $indexSize = 2),
    ];
});
