<?php

namespace App\Imports;

use Exception;
use App\Model\Item;
use App\Model\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

/**
 * To handle data imported from excel
 *
 * @author Cho Cho Theint
 *
 * @create date 23-06-2023
 *
 */
class ItemsImport implements ToCollection
{
    /**
     * Storing data from Excel file
     *
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @param Collection $rows
     *
     *
     */
    public function collection(Collection $rows)
    {
        $dataRows = $rows->slice(2); // Exclude the first row (header row)
        //Data empty
        if ($dataRows->isEmpty()) {
            $errors = ['No records found.'];
            throw new Exception(implode($errors));
        }
        // Excel row must be 100
        if ($dataRows->count() > 100) {
            $errors = ['The maximum number of records allowed is 100.'];
            throw new Exception(implode($errors));
        }
        foreach ($dataRows as $index =>$row) {
            $rowArray = $row->toArray();
        
            $validator = Validator::make($rowArray, [
                '0' => 'required',
                '1' => 'required',
                '2' => 'required|exists:categories,category_name',
                '3' => 'required|integer',
                '4' => 'required',
            ]);
        
            $customMessages = [
                '0.required' => 'Item Code is required!.',
                '1.required' => 'Item Name is required!.',
                '2.required' => 'Category Name is required!.',
                '2.exists' => 'The selected Category Name is invalid!.',
                '3.required' => 'Safety Stock is required!.',
                '3.integer' => 'Safety Stock must be integer!.',
                '4.required' => 'Received Date is required!.',
            ];
        
            $validator->setCustomMessages($customMessages);
        
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                Log::info($errors);
                
                $rowNumber = $index + 1; 
                $errorMessage = 'Row ' . $rowNumber . ': ' . implode(', ', $errors);
                throw new \Exception($errorMessage);
            }
            $id = Item::latest('id')->value('id');
            if (!$id) {
                $id = 0;
            }
            $itemId = $id + 10001;
            
            $newItem = new Item();
            $newItem->item_id = $itemId;
            $newItem->item_code = $row[0];
            $newItem->item_name = $row[1];
            $categories = Category::where('category_name', '=', $row[2])
                ->select('id')
                ->get();
            foreach ($categories as $category ) { //get category id
                $newItem->category_id = $category->id;
            }

            $newItem->safety_stock = (int) $row[3];
            $newItem->received_date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4])->format('Y-m-d');
            $newItem->description = $row[5];
            $newItem->save();
        }
    
    }

}
