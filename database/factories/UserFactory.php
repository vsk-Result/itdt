<?php
use App\Models\Employees\Employee;

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => 'Tester',
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
        'employee_id' => Employee::all()->random()->id,
        'username' => 'tester',
=======
        'empl_id' => Employee::all()->random()->id,
>>>>>>> писос
=======
        'employee_id' => Employee::all()->random()->id,
        'username' => 'tester',
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
        'email' => 'Tester@gmail.com',
        'password' => Hash::make('dfead68a'),
    ];
});
