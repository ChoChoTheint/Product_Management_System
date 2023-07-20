<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\DBTransactions\Category\SaveCategory;
use App\DBTransactions\Category\RemoveCategory;
use App\Interfaces\CategoryRepositoryInterface;
/**
 * To handle category
 *
 * @author Cho Cho Theint
 *
 * @create date 21-06-2023
 *
 */

class CategoryController extends Controller
{
    protected $categoryInterface;
    /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 23/06/2023
     *
     */
    public function __construct(CategoryRepositoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }
    /**
     * Handle category create
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @param  Request
     * @return collection
     */
    public function store(Request $request)
    {
        $saveCategory = new SaveCategory($request);
        $saveCategory = $saveCategory->executeProcess();

        if ($saveCategory) {
            return redirect()->back();
        } else {
            return redirect()
                ->back()
                ->with('fail', 'Something was Wrong!Please Try Again');
        }
    }
    /**
     * Handle category delete
     * @author Cho Cho Theint
     * @create date 23-06-2023
     * @param  Request
     *
     */
    public function destory(Request $request)
    {
        $removeCategory = new RemoveCategory($request);
        $removeCategory = $removeCategory->executeProcess();
        if ($removeCategory) {
            return response()->json([
                'success' => true,
            ]);
        }
    }
}
