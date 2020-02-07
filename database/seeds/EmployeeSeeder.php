<?php

use Illuminate\Database\Seeder;
use App\Models\Employees\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
<<<<<<< refs/remotes/origin/master
<<<<<<< refs/remotes/origin/master
        factory(Employee::class, 1)->create();
=======
        factory(Employee::class, 5)->create();
>>>>>>> писос
=======
        factory(Employee::class, 1)->create();
>>>>>>> Онлайн пользователей, поиск по сотрудникам, карточка сотрудника, доступ на изменение, сотрудники (#31)
    }
}
