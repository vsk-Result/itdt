<?php

use App\Models\Employees\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
<<<<<<< refs/remotes/origin/master
=======
    /**
     * Run the database seeds.
     *
     * @return void
     */
>>>>>>> писос
    public function run()
    {
        factory(Post::class, 5)->create();
    }
}
