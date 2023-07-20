<?php

namespace App\DBTransactions\Category;

use App\Classes\DBTransaction;
use App\Model\Category;

/**
 * Create Class For Save Category From database
 * @author Cho Cho Theint
 * @create 28/06/2023
 *
 */
class SaveCategory extends DBTransaction
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
     * Save Category
     * @author Cho Cho Theint
     * @create 28/06/2023
     *
     */
    public function process()
    {
        $request = $this->request;
        $categoryName = $request->input('category_name');
        $category = new Category();

        $category->category_name = $categoryName;
        $category->save();
        if (!$category) {
            return ['status' => false, 'error' => 'Failed!'];
        }
        return ['status' => true, 'error' => ''];
    }
}
