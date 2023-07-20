<?php

namespace App\Interfaces;

use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\F;

/**
 *Interface for category
 * @author Cho Cho Theint
 * @create date 28-06-2023
 *
 */
interface CategoryRepositoryInterface
{   
    /**
     * Get all categories
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @return
     */
    public function getAllCategory();
     /**
     * delete category
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @param $request
     */
    public function getCategoryExcel();
}
