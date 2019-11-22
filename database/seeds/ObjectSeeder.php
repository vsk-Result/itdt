<?php

use Illuminate\Database\Seeder;
use App\Models\Objects\CObject;
use App\Models\Objects\InfoPart;
use App\Models\Objects\Person;

class ObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(CObject::class, 5)->create()->each(function($object) {
            $object->infoparts()->createMany(
                factory(InfoPart::class, 3)->make()->toArray()
            );
            $object->persons()->createMany(
                factory(Person::class, 3)->make()->toArray()
            );
        });
    }
}
