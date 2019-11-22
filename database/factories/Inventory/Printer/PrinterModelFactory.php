<?php

use Faker\Generator as Faker;
use App\Models\Inventory\Printer\PModel;

$factory->define(PModel::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
    ];
});
