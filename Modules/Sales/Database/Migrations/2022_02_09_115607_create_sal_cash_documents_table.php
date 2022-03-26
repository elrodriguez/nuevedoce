<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalCashDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_cash_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cash_id');
            $table->unsignedBigInteger('document_id')->nullable();
            $table->unsignedBigInteger('sale_note_id')->nullable();
            $table->unsignedBigInteger('expense_id')->nullable();
            $table->timestamps();
            $table->foreign('cash_id')->references('id')->on('sal_cashes');
            $table->foreign('document_id')->references('id')->on('sal_documents');
            $table->foreign('sale_note_id')->references('id')->on('sal_sale_notes');
            $table->foreign('expense_id')->references('id')->on('sal_expenses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_cash_documents');
    }
}
