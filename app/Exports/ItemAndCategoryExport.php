<?php

namespace App\Exports;

use App\Exports\ItemsExport;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
/**
 * Item and Category Sheet Design
 *
 * @author Cho Cho Theint
 *
 * @create date 23-06-2023
 *
 */
class ItemAndCategoryExport implements WithMultipleSheets
{
    protected $category;

    public function __construct($category)
    {
        $this->category = $category;
    }
    /**
     * Define the multi sheet
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return array
     *
     */
    public function sheets(): array
    {
        $sheets = [new ItemsExport(), new CategoryExport($this->category)];
        return $sheets;
    }
}
