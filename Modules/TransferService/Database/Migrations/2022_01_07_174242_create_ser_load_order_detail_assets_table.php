<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerLoadOrderDetailAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_load_order_detail_assets', function (Blueprint $table) {
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('load_order_id');
            $table->primary(['item_id','asset_id','load_order_id']);
            $table->foreign('item_id')->references('id')->on('inv_items');
            $table->foreign('asset_id')->references('id')->on('inv_assets');
            $table->foreign('load_order_id')->references('id')->on('ser_load_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_load_order_detail_assets');
    }
}
