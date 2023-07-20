<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsUploadTable extends Migration
{
    /**
     * Run the migrations for items-upload table
     *
     * @author Cho Cho Theint
     *
     * @create date 21-06-2023
     *
     */
    public function up()
    {
        Schema::create('items_upload', function (Blueprint $table) {
            $table->id();
            $table->string('file_path', 100);
            $table->string('file_type', 10);
            $table->integer('file_size')->unsigned();
            $table->unsignedBigInteger('item_id');
            $table->foreign('item_id')->references('id')->on('items');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_upload');
    }
}
