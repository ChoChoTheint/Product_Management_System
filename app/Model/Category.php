<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * To handle categories table's data retreiving and manipulation
 *
 * @author Cho Cho Theint
 *
 * @create date 21-06-2023
 *
 */

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['category_name'];
    protected $guarded = [];
}
