<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvItemPartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_item_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('part_id');
            $table->boolean('state');
            $table->decimal('quantity',10,2)->nullable();
            $table->string('observations',500)->nullable();
            $table->string('internal_id')->nullable();
            $table->timestamps();
            $table->foreign('item_id','item_parts_item_id_fk')->references('id')->on('inv_items');
            $table->foreign('part_id','item_parts_part_id_fk')->references('id')->on('inv_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_item_parts');
    }
}
