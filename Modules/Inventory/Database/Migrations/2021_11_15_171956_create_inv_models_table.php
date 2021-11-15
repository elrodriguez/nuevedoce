<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_models', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        Schema::table('inv_items', function (Blueprint $table) {
            $table->unsignedBigInteger('model_id')->nullable();
            $table->foreign('model_id','inv_items_model_id_fk')->references('id')->on('inv_models');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_items', function (Blueprint $table) {
            $table->dropForeign('inv_items_model_id_fk');
            $table->dropColumn('model_id');
        });

        Schema::dropIfExists('inv_models');
    }
}
