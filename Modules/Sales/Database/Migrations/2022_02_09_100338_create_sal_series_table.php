<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_series', function (Blueprint $table) {
            $table->string('id',10);
            $table->integer('correlative');
            $table->unsignedBigInteger('establishment_id');
            $table->unsignedBigInteger('user_id');
            $table->string('document_type_id');
            $table->boolean('state');
            $table->timestamps();
            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_series');
    }
}
