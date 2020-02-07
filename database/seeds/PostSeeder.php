<?php

use App\Models\Employees\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
        factory(Post::class, 5)->create();
    }
}
