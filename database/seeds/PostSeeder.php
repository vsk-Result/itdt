<?php

use App\Models\Employees\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
=======
    /**
     * Run the database seeds.
     *
     * @return void
     */
>>>>>>> писос
=======
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
    public function run()
    {
        factory(Post::class, 5)->create();
    }
}
