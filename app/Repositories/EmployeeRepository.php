<?php

namespace App\Repositories;

use App\Model\Category;
use Illuminate\Support\Facades\DB;
use App\Interfaces\EmployeeRepositoryInterface;
/**
 *Repository for category
 * @author Cho Cho Theint
 * @create date 28-06-2023
 *
 */

class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * get employee
     * @author Cho Cho Theint
     * @create date 28-06-2023
     *@return $employee
     */
    public function getEmpolyee($request)
    {
        $employeeId = $request->emp_id;
        $employee = DB::table('employees')
            ->where('emp_id', $employeeId)
            ->first();
        return $employee;
    
    }
}
