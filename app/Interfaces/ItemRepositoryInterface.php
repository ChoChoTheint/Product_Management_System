<?php

namespace App\Interfaces;
/**
 *Interface for items
 * @author Cho Cho Theint
 * @create date 28-06-2023
 *
 */
interface ItemRepositoryInterface
{
    public function getAllItems();
    /**
     * Search item
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @return
     */
    public function getSearchItem();
     /**
     * Get id for detail
     * @author Cho Cho Theint
     * @create date 28-06-2023
     * @param $id
     */
    public function getDetailItem($id);
     /**
     * Get id for edit
     * @author Cho Cho Theint
     * @create date 03-07-2023
     * @param $id
     */
    public function editItem($id);
      /**
     * store item
     * @author Cho Cho Theint
     * @create date 03-07-2023
     * @param $request,$id
     */
    public function getUpdateItem($request,$id);
      /**
     * Get all item for pdf download
     * @author Cho Cho Theint
     * @create date 03-07-2023
     * @param $id
     */
    public function getAllItemsForDownload();
         /**
     * Get search item for download
     * @author Cho Cho Theint
     * @create date 17-07-2023
     * 
     */
    public function getSearchItemForDownload();
}
