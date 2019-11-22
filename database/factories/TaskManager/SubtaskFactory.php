<?php

use Faker\Generator as Faker;
use App\Models\TaskManager\Subtask;
use App\Models\TaskManager\Task;

$factory->define(Subtask::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'checked' => $faker->boolean,
        'task_id' => Task::all()->random()->id,
    ];
});
