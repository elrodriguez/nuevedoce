<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_assets', function (Blueprint $table) {
            $table->id();
            $table->string('patrimonial_code');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('asset_type_id')->nullable();
            $table->char('state', 2)->default('00');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('item_id')->references('id')->on('inv_items');
            $table->foreign('asset_type_id')->references('id')->on('inv_asset_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_assets');
    }
}
