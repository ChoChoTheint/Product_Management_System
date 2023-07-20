<?php

namespace App\Http\Controllers;

use App\Model\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use App\DBTransactions\Item\SaveItem;
use App\Http\Requests\RegisterRequest;
use App\DBTransactions\Item\DeleteItem;
use App\DBTransactions\Item\UpdateItem;
use Illuminate\Support\Facades\Session;
use App\Interfaces\ItemRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;

/**
 * To handle item
 *
 * @author Cho Cho Theint
 *
 * @create date 21-06-2023
 *
 */
class ItemController extends Controller
{
    protected $itemInterface;
    protected $categoryInterface;
         /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 21/06/2023
     * 
     */
    public function __construct(ItemRepositoryInterface $itemInterface, CategoryRepositoryInterface $categoryInterface)
    {
        $this->itemInterface = $itemInterface;
        $this->categoryInterface = $categoryInterface;
    }

    /**
     * Show list page.
     * @author Cho Cho Theint
     * @create 21/06/2023
     * @return view
     */
    public function index()
    {
        $getAllItems = $this->itemInterface->getAllItems();
        $totalCount = $getAllItems->total();
        $getAllCategories = $this->categoryInterface->getAllCategory();
      
        return view('product.itemList', compact('getAllItems', 'getAllCategories', 'totalCount'));
    }
    /**
     * Generate item id.
     * @author Cho Cho Theint
     * @create 21/06/2023
     * @return view
     */
    public function create()
    {
        $id = Item::latest('id')->value('id');
        // $id = Item::find('id');
        if (!$id) {
            $id = 1;
        }
        $itemId = $id + 10000;
        $getAllCategories = $this->categoryInterface->getAllCategory();
        return view('product.normalRegister', compact(['itemId', 'getAllCategories']));
    }
    /**
     * create new register with normal register form
     * @author Cho Cho Theint
     * @create 21/06/2023
     * @param  RegisterRequest
     * @return redirect
     */
    public function store(RegisterRequest $request)
    {
        $saveItem = new SaveItem($request);

        $saveItem = $saveItem->executeProcess();
        //item add
        if ($saveItem) {
            return redirect()
                ->route('index')
                ->with('success', 'Item Added Successfully!');
        } else {
            return redirect()
                ->back()
                ->with('fail', 'Something was Wrong!Please Try Again');
        }
    }
    /**
     * Show excel upload register
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @return view
     */

    public function excelDownload()
    {
        return view('product.excelUploadRegister');
    }
    /**
     * Search Data
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @return search list
     */
    public function search(Request $request)
    {
        $itemId = $request->input('item_id');
        $itemCode = $request->input('item_code');
        $itemName = $request->input('item_name');
        $category = $request->input('category_name');

        $getAllItems = $this->itemInterface->getSearchItem();
        $totalCount = $getAllItems->total();
        $getAllCategories = $this->categoryInterface->getAllCategory();
        return view('product.itemList', compact('getAllItems', 'getAllCategories','totalCount'));
    }

    /**
     * Delete Data
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @return search list
     */
    public function destory($deleteItem)
    {
    $item = Item::withTrashed()->find($deleteItem);
    $delete = new DeleteItem($deleteItem);
    $deleteItem = $delete->executeProcess();
    //delete item
    if ($deleteItem) {
        session()->flash('success', 'Item Deleted Successfully!');
        return response()->json([
            'success' => true,
        ]);
    } else {
        session()->flash('error', 'Something was Wrong!Please Try Again');
        return response()->json([
            'success' => true,
        ]);
    }

    }
    /**
     * inactive btn
     * @author Cho Cho Theint
     * @create date 03-07-2023
     * @return item
     */
    public function toggleInactive(Request $request)
    {
        $itemId = $request->itemId;
        $item = Item::withTrashed()->findOrFail($itemId);

        if ($item) {
            if ($item->deleted_at == null) {
                $item->deleted_at = now();
                $item->save();

                session()->flash('success', 'Item Inactive Successfully!');
                return response()->json([
                    'success' => true,
                ]);
            } else {
                session()->flash('error', 'Item is already Inactive!');
                return response()->json([
                    'success' => false,
                ]);
            }
        }
    }
    /**
     * active btn
     * @author Cho Cho Theint
     * @create date 03-07-2023
     * @return item
     */
    public function toggleActive(Request $request)
    {
        $itemId = $request->itemId;
        $item = Item::withTrashed()->findOrFail($itemId);
        if ($item) {
            if ($item->deleted_at != null) {
                $item->deleted_at = null; // Restore deleted_at to null
                $item->save();
                session()->flash('success', 'Item Aactive Successfully!');
                return response()->json([
                    'success' => true,
                ]);
            } else {
                session()->flash('error', 'Item is already Active!');
                return response()->json([
                    'success' => false,
                ]);
            }
        }
    }
    /**
     * Item detail
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @param $id
     * @return view
     */
    public function showDetail($id)
    {
        $getDetailItem = $this->itemInterface->getDetailItem($id);
        return view('product.detailItem', compact('getDetailItem'));
    }
    /**
     * Item Edit
     * @author Cho Cho Theint
     * @create date 04-07-2023
     * @param $id
     * @return view
     */
    public function editItem($id)
    {
        $item = Item::find($id);
        $items = $this->itemInterface->editItem($id);
        $getAllCategories = $this->categoryInterface->getAllCategory();

        if ($items === null) {
            // Handle the case when the edited item is already inaactivated
            return redirect()
                ->back()
                ->with('error', 'Item cannot be edited because it is already inactivated');
        } else {
            return view('product.editItem', compact('items', 'getAllCategories'));
        }
    }
    /**
     * Item update
     * @author Cho Cho Theint
     * @create date 04-07-2023
     * @param $request,$id
     * @return view
     */
    public function updateItem(RegisterRequest $request, $id)
    {
        $item = Item::withTrashed()->find($id);
        $updateItem = $this->itemInterface->getUpdateItem($request, $id);
        if ($updateItem) {
            if ($item->deleted_at === null) {
                return redirect(Session::get('requestReferrer'))->with(['success' => __('Item Updated Successfully')]);
            } else {
                return redirect(Session::get('requestReferrer'))->with('error', 'Item cannot be updated because it is already inactivated');
            }
        }
    }
}
