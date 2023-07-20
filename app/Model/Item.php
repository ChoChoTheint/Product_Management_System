<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * To handle items table's data retreiving and manipulation
 *
 * @author Cho Cho Theint
 *
 * @create date 21-06-2023
 *
 */
class Item extends Model
{
    use SoftDeletes;
    protected $table = 'items';
    protected $fillable = ['item_id', 'item_code', 'item_name', 'category_id', 'safety_stock', 'received_date', 'description'];
    protected $dates = ['deleted_at'];


}
