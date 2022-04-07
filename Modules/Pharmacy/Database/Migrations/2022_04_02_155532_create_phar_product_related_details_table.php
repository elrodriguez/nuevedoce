<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePharProductRelatedDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phar_product_related_details', function (Blueprint $table) {
            $table->unsignedBigInteger('product_related_id');
            $table->unsignedBigInteger('item_id');
            $table->timestamps();
            $table->primary(['product_related_id','item_id'],'related_id_item_id_pk');
            $table->foreign('product_related_id','pprd_product_related_id_fk')->references('id')->on('phar_product_related');
            $table->foreign('item_id','pprd_item_id_fk')->references('id')->on('inv_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phar_product_related_details');
    }
}
