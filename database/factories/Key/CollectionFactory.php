<?php

use Faker\Generator as Faker;
use App\Models\Keys\Key;
use App\User;

$factory->define(Key::class, function (Faker $faker) {
    return [
        'key' => $faker->unique()->numberBetween($min = 1000000, $max = 9000000),
        'login' => $faker->unique()->word,
        'password' => $faker->unique()->word,
        'product' => 'CHIKI PIKI',
        'expire_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 30 years'),
        'user_id' => User::all()->random()->id,
        'is_renewal_use' => $faker->boolean,
    ];
});
