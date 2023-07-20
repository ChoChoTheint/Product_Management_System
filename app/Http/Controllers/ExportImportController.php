<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Imports\ItemsOneImport;
use App\Http\Requests\ExcelRequest;
use App\Exports\ExcelDownloadExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ItemAndCategoryExport;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;

/**
 * To handle export and import
 *
 * @author Cho Cho Theint
 *
 * @create date 21-06-2023
 *
 */

class ExportImportController extends Controller
{
    protected $itemInterface;
    protected $categoryInterface;
         /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 23/06/2023
     * 
     */
    public function __construct(ItemRepositoryInterface $itemInterface, CategoryRepositoryInterface $categoryInterface)
    {
        $this->itemInterface = $itemInterface;
        $this->categoryInterface = $categoryInterface;
    }
    /**
     * Handle export
     * @author Cho Cho Theint
     * @create date 23-06-2023
     *
     * @return excel download
     */
    public function exportData()
    {
        $category = $this->categoryInterface->getCategoryExcel();
        return Excel::download(new ItemAndCategoryExport($category), 'Item List.xlsx');
    }
    /**
     * Handle import
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @param  Request
     * @return redirect
     */
    public function importData(ExcelRequest $request)
    {
        try {
            $file = $request->file('file');
            Excel::import(new ItemsOneImport(), $file);
            return redirect()
                ->route('index')
                ->with('success', 'Excel Import successfully');
        } catch (\Exception $e) {
            return redirect()
                ->route('excelUpload')
                ->withErrors(['message' => $e->getMessage()]);
        }
    }
    /**
     * Download excel for search item
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return download excel
     */
    public function generateExcel(Request $request)
    {
        $itemId = $request->input('item_id');
        $itemCode = $request->input('item_code');
        $itemName = $request->input('item_name');
        $category = $request->input('category_name');
         //check search item and all items for excel download
        if ($itemId == "" && $itemCode == "" && $itemName == "" && $category == "") {
            $getAllItems = $this->itemInterface->getAllItemsForDownload();
            $export = new ExcelDownloadExport($getAllItems);
        } else {
            $getSearchItems = $this->itemInterface->getSearchItemForDownload();
            $export = new ExcelDownloadExport($getSearchItems);
        }
        return Excel::download($export, 'Item.xlsx');
    }
}
