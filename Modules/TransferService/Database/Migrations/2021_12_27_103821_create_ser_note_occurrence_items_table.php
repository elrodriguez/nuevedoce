<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerNoteOccurrenceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_note_occurrence_items', function (Blueprint $table) {
            $table->id();
            $table->enum('ocurrence_type',['perdida','robo','deteriorado','prestado','otros']);
            $table->string('note_occurrence_id',10);
            $table->unsignedBigInteger('item_id');
            $table->decimal('quantity',8,2);
            $table->string('description',400)->nullable();
            $table->timestamps();
            $table->foreign('note_occurrence_id')->references('id')->on('ser_note_occurrences')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_note_occurrence_items');
    }
}
