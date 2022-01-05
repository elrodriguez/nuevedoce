<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvAssetPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_asset_parts', function (Blueprint $table) {
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('asset_part_id');
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->primary(['asset_id','asset_part_id']);
            $table->foreign('asset_id')->references('id')->on('inv_assets');
            $table->foreign('asset_part_id')->references('id')->on('inv_assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_asset_parts');
    }
}
