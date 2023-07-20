<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * To handle employees table's data retreiving and manipulation
 *
 * @author Cho Cho Theint
 *
 * @create date 21-06-2023
 *
 */
class Employee extends Model
{
    protected $table = 'employees';
    protected $guarded = [];
}
