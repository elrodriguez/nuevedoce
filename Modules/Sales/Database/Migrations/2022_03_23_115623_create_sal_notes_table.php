<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id')->nullable();
            $table->unsignedBigInteger('note_type_id');
            $table->string('note_description')->nullable();
            $table->unsignedBigInteger('affected_document_id')->nullable();
            $table->json('data_affected_document')->nullable();
            $table->timestamps();
            $table->foreign('document_id')->references('id')->on('sal_documents');
            $table->foreign('affected_document_id')->references('id')->on('sal_documents');
            $table->foreign('note_type_id')->references('id')->on('sal_note_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_notes');
    }
}
