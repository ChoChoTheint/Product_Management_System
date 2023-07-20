<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations for employees table
     *
     * @author Cho Cho Theint
     *
     * @create date 21-06-2023
     *
     */

    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->unsignedBigInteger('id', 6);
            $table->integer('emp_id');
            $table->string('emp_name', 50);
            $table->string('password', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
