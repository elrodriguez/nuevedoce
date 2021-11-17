<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPricePurchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_purchases', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id', 'inv_purchases_supplier_id_fk')->references('id')->on('people');
            $table->foreign('document_type_id', 'inv_purchases_document_type_id_fk')->references('id')->on('document_types');
        });
        Schema::table('inv_purchase_items', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_purchases', function (Blueprint $table) {
            $table->dropForeign('inv_purchases_document_type_id_fk');
            $table->dropForeign('inv_purchases_supplier_id_fk');
            $table->dropColumn('supplier_id');
        });
        Schema::table('inv_purchase_items', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
