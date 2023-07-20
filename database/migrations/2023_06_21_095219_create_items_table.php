<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations for items table
     *
     * @author Cho Cho Theint
     *
     * @create date 21-06-2023
     *
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->integer('item_id')->unsigned();
            $table->string('item_code', 50);
            $table->string('item_name', 100);
            $table->unsignedBigInteger('category_id');
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories');
            $table->integer('safety_stock')->unsigned();
            $table->date('received_date');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
