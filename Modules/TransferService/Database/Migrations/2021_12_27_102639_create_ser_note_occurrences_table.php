<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerNoteOccurrencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_note_occurrences', function (Blueprint $table) {
            $table->string('id',10);
            $table->string('year_created',8);
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->unsignedBigInteger('load_order_id');
            $table->text('additional_information')->nullable();
            $table->timestamps();
            $table->primary('id');
            $table->foreign('load_order_id')->references('id')->on('ser_load_orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_note_occurrences');
    }
}
