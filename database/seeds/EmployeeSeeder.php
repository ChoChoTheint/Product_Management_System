<?php

use App\Model\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        factory(Employee::class,2)->create();
    }
}
