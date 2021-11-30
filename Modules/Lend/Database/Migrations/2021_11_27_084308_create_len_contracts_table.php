<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLenContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('len_contracts', function (Blueprint $table) {
            $table->char('id',10);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('referred_id')->nullable();
            $table->unsignedBigInteger('interest_id');
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('quota_id');
            $table->date('date_start');
            $table->date('date_end');
            $table->boolean('penalty')->default(false);
            $table->decimal('amount_penalty_day',10,2)->default(0);
            $table->decimal('amount_capital',10,2);
            $table->decimal('amount_interest',10,2);
            $table->decimal('amount_total',10,2);
            $table->text('additional_information')->nullable();
            $table->char('state','A')->default(true)->comment('A=Activo,T=Terminado,D=Dejo de pagar');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('people');
            $table->foreign('referred_id')->references('id')->on('people');
            $table->foreign('interest_id')->references('id')->on('len_interests');
            $table->foreign('payment_method_id')->references('id')->on('len_payment_methods');
            $table->foreign('quota_id')->references('id')->on('len_quotas');
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('len_contracts');
    }
}
