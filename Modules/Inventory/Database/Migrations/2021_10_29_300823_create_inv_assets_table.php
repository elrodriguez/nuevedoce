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
            $table->char('state', 2)->default('00');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('item_id')->references('id')->on('inv_items');
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
