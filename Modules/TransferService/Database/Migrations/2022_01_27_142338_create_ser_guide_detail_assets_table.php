<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerGuideDetailAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_guide_detail_assets', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('guide_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('asset_id');
            $table->primary(['order_id','guide_id','item_id','asset_id'],'ser_guide_detail_assets_primary');
            $table->foreign('order_id','ser_order_id_fk')->references('id')->on('ser_load_orders')->onDelete('cascade');
            $table->foreign('guide_id','ser_guide_id_fk')->references('id')->on('ser_guides')->onDelete('cascade');
            $table->foreign('item_id','ser_item_id_fk')->references('id')->on('inv_items')->onDelete('cascade');
            $table->foreign('asset_id','ser_asset_id_fk')->references('id')->on('inv_assets')->onDelete('cascade');
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
            $table->dropForeign('ser_guide_id_fk');
            $table->dropForeign('ser_item_id_fk');
            $table->dropForeign('ser_asset_id_fk');
            $table->dropForeign('ser_order_id_fk');
            $table->dropPrimary('ser_guide_detail_assets_primary');
        });

        Schema::dropIfExists('ser_guide_detail_assets');
    }
}
