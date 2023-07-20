<?php

namespace App\Repositories;

use App\Model\Category;
use App\Interfaces\CategoryRepositoryInterface;
/**
 *Repository for category
 * @author Cho Cho Theint
 * @create date 28-06-2023
 *
 */

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * Get all categories from table
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @return $categories
     */

    public function getAllCategory()
    {
        $categories = Category::all();
        return $categories;
    }
    /**
     * create category
     * @author Cho Cho Theint
     * @create date 28-06-2023
     *@return $category
     */
    public function getCategoryExcel()
    {
        $categoryQuery = Category::select('id', 'category_name');
        $category = $categoryQuery->get();
        return $category;
    }
}
