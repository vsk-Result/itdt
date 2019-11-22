<?php

use Faker\Generator as Faker;
use App\Models\TaskManager\Task;
use App\Models\Objects\CObject;
use App\Models\TaskManager\Status;
use App\Models\TaskManager\Priority;
use App\Models\TaskManager\Type;
use App\User;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'description' => $faker->realText,
        'user_id' => User::all()->random()->id,
        'object_id' => CObject::all()->random()->id,
        'status_id' => Status::all()->random()->id,
        'priority_id' => Priority::all()->random()->id,
        'type_id' => Type::all()->random()->id,
    ];
});
