<?php

use Faker\Generator as Faker;
use App\Models\TaskManager\SubtaskComment;
use App\Models\TaskManager\Subtask;
use App\User;

$factory->define(SubtaskComment::class, function (Faker $faker) {
    return [
        'text' => $faker->realText($maxNbChars = 180, $indexSize = 2),
        'user_id' => User::all()->random()->id,
    ];
});
