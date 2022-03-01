<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCurrencyTypeItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_items', function (Blueprint $table) {
            $table->string('currency_type_id')->nullable();
            $table->string('digemid')->nullable();
            $table->string('sale_affectation_igv_type_id')->nullable();
            $table->char('item_type_id ',2)->nullable();
            $table->decimal('stock ',8,2)->nullable();
            $table->string('unit_type_id')->nullable();
            $table->string('internal_id')->nullable();
            $table->string('item_code')->nullable();
            $table->string('')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_items', function (Blueprint $table) {
            $table->dropColumn('item_code_gs1');
            $table->dropColumn('item_code');
            $table->dropColumn('internal_id');
            $table->dropColumn('unit_type_id');
            $table->dropColumn('stock');
            $table->dropColumn('item_type_id');
            $table->dropColumn('sale_affectation_igv_type_id');
            $table->dropColumn('digemid');
            $table->dropColumn('currency_type_id');
        });
    }
}
