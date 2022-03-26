<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDestinationExpensesPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sal_expense_payments', function (Blueprint $table) {
            $table->string('expense_destination_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sal_expense_payments', function (Blueprint $table) {
            $table->dropColumn('expense_destination_id');
        });
    }
}
