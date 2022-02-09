<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSalExpenseReasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_expense_reasons', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('sal_expense_reasons')->insert([
            ['id' => '1', 'description' => 'Varios'],
            ['id' => '2', 'description' => 'Representación de la organización'],
            ['id' => '3', 'description' => 'Trabajo de campo'],
        ]);

        Schema::table('sal_expenses',function (Blueprint $table){
            $table->boolean('state')->default(true);
            $table->unsignedBigInteger('expense_reason_id')->nullable();
            $table->foreign('expense_reason_id','expenses_expense_reason_id_fk')->references('id')->on('sal_expense_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sal_expenses',function (Blueprint $table){
            $table->dropForeign('expenses_expense_reason_id_fk');
            $table->dropColumn('expense_reason_id');
            $table->dropColumn('state');
        });

        Schema::dropIfExists('sal_expense_reasons');
    }
}
