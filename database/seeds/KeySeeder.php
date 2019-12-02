<?php

use Illuminate\Database\Seeder;
use App\Models\Keys\Usage;
use App\Models\Keys\Key;

class KeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Key::class, 5)->create()->each(function ($key) {
   $key->usages()->save(factory(Usage::class)->make());
        });
    }
}
