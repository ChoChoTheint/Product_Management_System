<?php

namespace App\Repositories;

use App\Model\Item;
use App\Model\ItemUpload;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ItemRepositoryInterface;

/**
 *Repository for item
 * @author Cho Cho Theint
 * @create date 28-06-2023
 *
 */
class ItemRepository implements ItemRepositoryInterface
{
    /**
     *Get all item
     * @author Cho Cho Theint
     * @create date 28-06-2023
     *
     */
    public function getAllItems()
    {
        $data = Item::join('categories', 'items.category_id', '=', 'categories.id')
            ->withTrashed()
            ->select('items.*', 'categories.category_name')
            ->orderby('items.id')
            ->paginate(20);
        return $data;
    }
    /**
     *Get all item for download
     * @author Cho Cho Theint
     * @create date 17-07-2023
     *
     */
    public function getAllItemsForDownload()
    {
        $data = Item::join('categories', 'items.category_id', '=', 'categories.id')
            ->select('items.item_id', 'items.item_code', 'items.item_name', 'categories.category_name', 'items.safety_stock', 'items.received_date', 'items.description')
            ->orderby('items.id')
            ->get();
        return $data;
    }
    /**
     *Search item
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @param \Illuminate\Http\Request  $request
     */
    public function getSearchItem()
    {
        $query = DB::table('items')
            ->join('categories', 'categories.id', '=', 'items.category_id')
            ->select('items.id', 'items.item_id', 'items.item_code', 'items.item_name', 'categories.category_name', 'items.safety_stock', 'items.received_date', 'items.description', 'items.deleted_at')
            ->orderBy('items.id');
        // search for item_id
        if (request()->input('item_id')) {
            $query->where('items.item_id', 'LIKE', '%' . request()->input('item_id') . '%');
        }
        //search for item_code
        if (request()->input('item_code')) {
            $query->where('items.item_code', 'LIKE', '%' . request()->input('item_code') . '%');
        }
        //search for item_name
        if (request()->input('item_name')) {
            $query->where('items.item_name', 'LIKE', '%' . request()->input('item_name') . '%');
        }
        //search for category_name
        if (request()->input('category_name')) {
            $query->where('items.category_id', '=', request()->input('category_name'))->get();
        }
        $items = $query->paginate(20);
        return $items;
    }
     /**
     *Search item for download
     * @author Cho Cho Theint
     * @create date 17-07-2023
     *
     */
    public function getSearchItemForDownload()
    {
       
        $query = DB::table('items')
            ->join('categories', 'categories.id', '=', 'items.category_id')
            ->select('items.item_id', 'items.item_code', 'items.item_name', 'categories.category_name', 'items.safety_stock', 'items.received_date', 'items.description')
            ->orderBy('items.id');
        // search for item_id
        if (request()->input('item_id')) {
            $query->where('items.item_id', 'LIKE', '%' . request()->input('item_id') . '%');
        }
        //search for item_code
        if (request()->input('item_code')) {
            $query->where('items.item_code', 'LIKE', '%' . request()->input('item_code') . '%');
        }
        //search for item_name
        if (request()->input('item_name')) {
            $query->where('items.item_name', 'LIKE', '%' . request()->input('item_name') . '%');
        }
        //search for category_name
        if (request()->input('category_name')) {
            $query->where('items.category_id', '=', request()->input('category_name'))->get();
        }
        $items = $query->get();
        return $items;
    }


    /**
     *Detail for item
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @param id
     */
    public function getDetailItem($id)
    {

        $itemId = ItemUpload::where('item_id', '=', "$id")
            ->select('item_id', 'file_path')
            ->first();
        // Check image file 
        if ($itemId) {
            $file_name = pathinfo($itemId, PATHINFO_BASENAME);
            $file_name = parse_url($file_name, PHP_URL_PATH);

            // Remove the leading forward slash (/) from the path
            $file_name = ltrim($file_name, '/');
            $file_name = str_replace('"}', '', $file_name);
            $file_name = $file_name;
            $item = Item::join('categories', 'categories.id', 'items.category_id')
                ->join('items_upload', 'items_upload.item_id', 'items.id')
                ->withTrashed()
                ->select('items.*','categories.category_name', DB::raw("'{$file_name}' as file_path"))
                ->find($id);
        } else {
            $item = Item::join('categories', 'categories.id', 'items.category_id')
                ->withTrashed()
                ->select('items.*', 'categories.category_name')
                ->find($id);
        }
        return $item;
    }
    /**
     *Edit for item
     * @author Cho Cho Theint
     * @create date 04-07-2023
     * @param id
     */
    public function editItem($id)
    {
        $itemId = Item::find($id);
        return $itemId;
    }
    /**
     *Update for item
     * @author Cho Cho Theint
     * @create date 04-07-2023
     * @param $request,$id
     */
    public function getUpdateItem($request, $id)
    {
        $items = Item::withTrashed()->find($id);
        $items->item_id = $request->item_id;
        $items->item_code = $request->item_code;
        $items->item_name = $request->item_name;
        $items->category_id = $request->category_id;
        $items->received_date = $request->date;
        $items->description = $request->description;
        $items->safety_stock = $request->stock;
        $items->save();

        if ($request->file) { //get image file
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
        return redirect();
    }
}
