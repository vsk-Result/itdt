<?php

use Faker\Generator as Faker;
use App\Models\Keys\Usage;
use App\Models\Keys\Key;
use App\User;

$factory->define(Usage::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'user_name' => $faker->firstName,
        'PC_name' => $faker->word,
        'IP' => $faker->ipv4,
    ];
});
