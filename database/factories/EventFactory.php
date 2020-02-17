<?php
use App\Models\Event;
use App\User;
use App\Models\Employees\Employee;

use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'employee_id' => Employee::all()->random()->id,
        'user_id' => User::all()->random()->id,
        'title' => $faker->word(),
        'description' => $faker->word(),
        'start_date' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+4 days', $timezone = null),
        'end_date' => $faker->dateTimeBetween($startDate = '+4 days', $endDate = '+7 days', $timezone = null),
    ];
});
