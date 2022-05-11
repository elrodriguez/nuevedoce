<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_recipes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('command_id');
            $table->string('unit_measure_id');
            $table->decimal('quantity', 8, 2);
            $table->foreign('item_id')->references('id')->on('inv_items');
            $table->foreign('command_id')->references('id')->on('rest_commands');
            $table->foreign('unit_measure_id')->references('id')->on('inv_unit_measures');
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
        Schema::dropIfExists('rest_recipes');
    }
}
