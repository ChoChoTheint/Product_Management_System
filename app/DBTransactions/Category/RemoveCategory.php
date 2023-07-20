<?php

namespace App\DBTransactions\Category;

use App\Classes\DBTransaction;
use Illuminate\Support\Facades\DB;

/**
 * Create Class For Remove Category From database
 * @author Cho Cho Theint
 * @create 28/06/2023
 *
 */
class RemoveCategory extends DBTransaction
{
    /**
     * Define Constructor
     * @author Cho Cho Theint
     * @create 28/06/2023
     *
     */
    protected $request;

    public function __construct($request)
    {
        $this->request = $request;
    }
    /**
     * Remove  Category From Database
     * @author Cho Cho Theint
     * @create 28/06/2023
     */

    public function process()
    {
        $request = $this->request;
        $selectedValue = $request->input('category_name');

        $removeCategory = DB::table('categories')
            ->where('id', '=', $selectedValue)
            ->delete();

        //Check If category  remove or not
        if (!$removeCategory) {
            return ['status' => false, 'error' => 'Failed!'];
        }
        return ['status' => true, 'error' => ''];
    }
}
