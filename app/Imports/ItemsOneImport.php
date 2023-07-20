<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
/**
 * To handle data imported from excel
 *
 * @author Cho Cho Theint
 *
 * @create date 23-06-2023
 *
 */

class ItemsOneImport implements WithMultipleSheets
{
    /**
     * 
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return array
     *
     *
     */
    public function sheets(): array
    {
        return [
            0 => new ItemsImport()
        ];
    }
}
