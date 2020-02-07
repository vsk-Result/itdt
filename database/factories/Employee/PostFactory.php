<?php
use App\Models\Employees\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
        'name' => $faker->jobTitle,
=======
        'post' => $faker->jobTitle,
>>>>>>> писос
=======
        'name' => $faker->jobTitle,
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
    ];
});
