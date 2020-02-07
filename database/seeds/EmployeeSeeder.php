<?php

use Illuminate\Database\Seeder;
use App\Models\Employees\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        factory(Employee::class, 1)->create();
    }
}
