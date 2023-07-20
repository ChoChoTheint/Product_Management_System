<?php

namespace App\DBTransactions\Item;

use App\Model\Item;
use App\Model\ItemUpload;
use App\Classes\DBTransaction;
use Illuminate\Support\Facades\Log;

/**
 * Create Class For Remove Item From database
 * @author Cho Cho Theint
 * @create 28/06/2023
 *
 */

class DeleteItem extends DBTransaction
{
    protected $request;
    /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 28/06/2023
     *
     */
    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * Remove Item
     * @author Cho Cho Theint
     * @create 28/06/2023
     *
     */
    public function process()
    {
        $request = $this->request;
        $deleteItem = Item::find($request);
        $itemUploads = ItemUpload::where('item_id', $request)->get();
        //check upolad file has or null
        if ($itemUploads == null) {
            $deleteItem->forceDelete();
        } else {
            foreach ($itemUploads as $deleteItem1) {
                unlink($deleteItem1['file_path']);
                $deleteItem1->forceDelete();
            }
            $deleteItem->forceDelete();
        }
        //check deleteItem
        if (!$deleteItem) {
            return ['status' => false, 'error' => 'Failed!'];
        }
        return ['status' => true, 'error' => ''];
    }
}
