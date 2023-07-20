<?php

namespace App\Interfaces;

use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

/**
 *Interface for employee
 * @author Cho Cho Theint
 * @create date 28-06-2023
 *
 */
interface EmployeeRepositoryInterface
{
    /**
     * get employee
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @param $request
     */
    public function getEmpolyee($request);
}
