<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Interfaces\ItemRepositoryInterface;

/**
 * To handle pdf download
 *
 * @author Cho Cho Theint
 *
 * @create date 28-06-2023
 *
 */
class PdfController extends Controller
{
    protected $itemInterface;
         /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 23/06/2023
     * 
     */
    public function __construct(ItemRepositoryInterface $itemInterface)
    {
        $this->itemInterface = $itemInterface;
    }
    /**
     * Download pdf
     * @author Cho Cho Theint
     * @create date 23-06-2023
     *@param $request
     * @return excel download
     */
    public function generatePDF(Request $request)
    {
        
        $itemId = $request->input('item_id');
        $itemCode = $request->input('item_code');
        $itemName = $request->input('item_name');
        $category = $request->input('category_name');
        //check search item and all items for pdf download
        if ($itemId == "" && $itemCode == "" && $itemName == "" && $category == "") {
            
            $getAllItems = $this->itemInterface->getAllItemsForDownload();
            $pdf = app(PDF::class); 
            $pdf->loadView('product.pdfDownload', compact('getAllItems'));
        }else{
            $getAllItems = $this->itemInterface->getSearchItemForDownload();
            $pdf = app(PDF::class);
            $pdf->loadView('product.pdfDownload', compact('getAllItems'));  
        }
        return $pdf->download('file.pdf');
    }
}
