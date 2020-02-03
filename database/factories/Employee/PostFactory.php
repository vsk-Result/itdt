<?php
use App\Models\Employees\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
<<<<<<< refs/remotes/origin/master
        'name' => $faker->jobTitle,
=======
        'post' => $faker->jobTitle,
>>>>>>> писос
    ];
});
