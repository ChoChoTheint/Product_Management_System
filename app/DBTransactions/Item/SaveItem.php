<?php

namespace App\DBTransactions\Item;

use App\Model\Item;
use App\Model\ItemUpload;
use App\Classes\DBTransaction;

/**
 * Create Class For Save Item From database
 * @author Cho Cho Theint
 * @create 28/06/2023
 *
 */

class SaveItem extends DBTransaction
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
     * Save Item
     * @author Cho Cho Theint
     * @create 28/06/2023
     *
     */
    public function process()
    {
        $request = $this->request;

        $items = Item::create([
            'item_id' => $request->input('item_id'),
            'item_code' => $request->input('item_code'),
            'item_name' => $request->input('item_name'),
            'category_id' => $request->input('category_id'),
            'safety_stock' => $request->input('stock'),
            'received_date' => $request->input('date'),
            'description' => $request->input('description') ?? null,
        ]);
        if ($request->file) {
            //image file get
            $imageName = time() . '.' . $request->file->extension();
            $file = $request->file->move(public_path('file'), $imageName);
            $fileSize = $file->getSize();
            $image = new ItemUpload();
            $image->file_path = $file;
            $image->file_type = pathinfo($file, PATHINFO_EXTENSION);
            $image->file_size = $fileSize;
            $image->item_id = $items->id;
            $image->save();
        }
        $items->save();
        if (!$items) {
            return ['status' => false, 'error' => 'Failed!'];
        }
        return ['status' => true, 'error' => ''];
    }
}
