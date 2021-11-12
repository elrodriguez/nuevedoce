<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerLoadOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_load_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('load_order_id');
            $table->unsignedBigInteger('odt_request_detail_id');
            $table->unsignedBigInteger('odt_request_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('load_order_id')->references('id')->on('ser_load_orders');
            $table->foreign('odt_request_detail_id')->references('id')->on('ser_odt_request_details');
            $table->foreign('odt_request_id')->references('odt_request_id')->on('ser_odt_request_details');
            $table->foreign('item_id')->references('item_id')->on('ser_odt_request_details');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_load_order_details');
    }
}
