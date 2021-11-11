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
            $table->id();
            $table->unsignedBigInteger('item_part_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('asset_id');
            $table->timestamps();
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
