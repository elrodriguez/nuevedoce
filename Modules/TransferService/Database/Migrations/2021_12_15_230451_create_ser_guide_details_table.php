<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerGuideDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_guide_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id');
            $table->integer('quantity')->nullable()->comment('Cantidad');
            $table->string('unit', 30)->nullable()->comment('Unidad');
            $table->string('code', 20)->nullable()->comment('Código');
            $table->string('description')->default(0)->comment('Descripción');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('guide_id')->references('id')->on('ser_guides');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_guide_details');
    }
}
