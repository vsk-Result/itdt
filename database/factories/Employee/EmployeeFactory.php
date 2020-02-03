<?php
use App\Models\Employees\Employee;
use App\Models\Employees\Post;

use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'fullname' => $faker->name,
        'work_phone' => $faker->numberBetween($min = 100, $max = 200),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'description' => $faker->text($maxNbChars = 50),
        'email' => $faker->email,
        'email2' => $faker->email,
        'phone_number' => $faker->phoneNumber,
        'post_id' => Post::all()->random()->id,
    ];
});
