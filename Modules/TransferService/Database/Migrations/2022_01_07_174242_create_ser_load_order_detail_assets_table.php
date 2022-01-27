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
            $table->primary(['item_id','asset_id','load_order_id'],'ser_loda_asset_id_primary');
            $table->foreign('item_id','ser_loda_item_id_fk')->references('id')->on('inv_items');
            $table->foreign('asset_id','ser_loda_asset_id_fk')->references('id')->on('inv_assets');
            $table->foreign('load_order_id','ser_loda_load_order_id_fk')->references('id')->on('ser_load_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ser_load_order_detail_assets', function (Blueprint $table){
            $table->dropForeign('ser_loda_load_order_id_fk');
            $table->dropForeign('ser_loda_asset_id_fk');
            $table->dropForeign('ser_loda_item_id_fk');
            $table->dropPrimary('ser_loda_asset_id_primary');
        });

        Schema::dropIfExists('ser_load_order_detail_assets');
    }
}
