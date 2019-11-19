<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filling = [
            ['slug'=>'objects', 'name'=> 'Объекты', 'route'=>'objects'],
            ['slug'=>'task_manager', 'name'=> 'Менеджер задач', 'route'=>'tasks'],
            ['slug'=>'consumables', 'name'=> 'Расходные материалы', 'route'=>'inventory'],
            ['slug'=>'knowledge', 'name'=> 'База знаний', 'route'=>'knowledge'],
            ['slug'=>'keys', 'name'=> 'Лицензии', 'route'=>'keys'],
            ['slug'=>'users', 'name'=> 'Пользователи', 'route'=>'users'],
        ];

        Permission::insert($filling);
    }
}
