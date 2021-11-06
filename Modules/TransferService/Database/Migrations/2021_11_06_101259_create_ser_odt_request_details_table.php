<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerOdtRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_odt_request_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('odt_request_id')->nullable()->comment('Id de la solicitud');
            $table->unsignedBigInteger('item_id')->nullable()->comment('Id del Item');
            $table->integer('amount')->default(0);
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('odt_request_id')->references('id')->on('ser_odt_requests');
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
        Schema::dropIfExists('ser_odt_request_details');
    }
}
