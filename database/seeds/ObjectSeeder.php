<?php

use Illuminate\Database\Seeder;
use App\Models\Objects\CObject;
class ObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Objects\CObject::class, 5)->create()->each(function($object) {
            for ($i = 0; $i < 3; $i++) {
                $object->infoparts()->save(factory(App\Models\Objects\InfoPart::class)->make());
                $object->persons()->save(factory(App\Models\Objects\Person::class)->make());
            }
        });

    }
}
