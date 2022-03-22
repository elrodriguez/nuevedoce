<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalSummaryDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_summary_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('summary_id');
            $table->unsignedBigInteger('document_id');
            $table->string('description',300)->nullable();
            $table->timestamps();
            $table->foreign('summary_id','summary_documents_summary_id_fk')->references('id')->on('sal_summaries')->onDelete('cascade');
            $table->foreign('document_id','summary_documents_document_id_fk')->references('id')->on('sal_documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sal_summary_documents', function (Blueprint $table) {
            $table->dropForeign('summary_documents_document_id_fk');
            $table->dropForeign('summary_documents_summary_id_fk');
        });
        Schema::dropIfExists('sal_summary_documents');
    }
}
