<?php
use App\Models\Employees\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'post' => $faker->jobTitle,
        'name' => $faker->jobTitle,
    ];
});
