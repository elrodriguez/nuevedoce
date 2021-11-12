<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvItemPartAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_item_part_assets', function (Blueprint $table) {
            $table->unsignedBigInteger('item_part_id')->comment('ide de la tabla inv_item_parts se puede repetir');
            $table->unsignedBigInteger('item_id')->comment('ide de la tabla inv_items para saber que pieza es, se puede repetir');
            $table->unsignedBigInteger('asset_id')->comment('ide de la tabla inv_assets para optener el codigo patrimonial, no se puede repetir');
            $table->timestamps();
            $table->primary(['item_part_id', 'item_id','asset_id']);
            $table->foreign('item_part_id')->references('id')->on('inv_item_parts');
            $table->foreign('item_id')->references('id')->on('inv_items');
            $table->foreign('asset_id')->references('id')->on('inv_assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_item_part_assets');
    }
}
