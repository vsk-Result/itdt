<?php

use Faker\Generator as Faker;
use App\Models\Inventory\Printer\Printer;
use App\Models\Objects\CObject;

$factory->define(Printer::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->company,
        'object_id' => CObject::all()->random()->id,
    ];
});
