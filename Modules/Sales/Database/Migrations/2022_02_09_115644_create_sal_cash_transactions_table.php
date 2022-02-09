<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalCashTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_cash_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_id');
            $table->char('payment_method_type_id',2)->nullable();
            $table->string('description');
            $table->decimal('payment',14,4);
            $table->timestamps();
            $table->foreign('cash_id')->references('id')->on('sal_cashes');
            $table->foreign('payment_method_type_id')->references('id')->on('cat_payment_method_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_cash_transactions');
    }
}
