<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalExpensePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_expense_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expense_id');
            $table->date('date_of_payment');
            $table->unsignedBigInteger('expense_method_type_id');
            $table->boolean('has_card')->default(false);
            $table->string('reference')->nullable();
            $table->decimal('payment', 12, 2);
            $table->timestamps();
            $table->foreign('expense_id')->references('id')->on('sal_expenses')->onDelete('cascade');
            $table->foreign('expense_method_type_id')->references('id')->on('expense_method_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_expense_payments');
    }
}
