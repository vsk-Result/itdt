<?php

use Illuminate\Database\Seeder;
use App\Models\Knowledge\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Tag::class, 5)->create();
    }
}
