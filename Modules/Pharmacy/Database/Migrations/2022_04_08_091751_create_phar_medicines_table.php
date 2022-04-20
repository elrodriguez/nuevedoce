<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phar_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('disease_id')->nullable();
            $table->unsignedBigInteger('symptom_id')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('disease_id')->references('id')->on('phar_diseases');
            $table->foreign('symptom_id')->references('id')->on('phar_symptoms');
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
        Schema::dropIfExists('phar_medicines');
    }
}
