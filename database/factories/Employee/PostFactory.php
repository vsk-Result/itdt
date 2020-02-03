<?php
use App\Models\Employees\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'post' => $faker->jobTitle,
    ];
});
