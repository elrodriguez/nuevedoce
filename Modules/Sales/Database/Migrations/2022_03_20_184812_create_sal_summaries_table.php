<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalSummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_summaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('external_id');
            $table->char('soap_type_id',2);
            $table->char('state_type_id',2);
            $table->string('summary_status_type_id');
            $table->string('ubl_version')->nullable();
            $table->date('date_of_issue');
            $table->date('date_of_reference');
            $table->string('identifier')->nullable();
            $table->string('filename')->nullable();
            $table->string('ticket')->nullable();
            $table->boolean('has_ticket')->default(false);
            $table->boolean('has_cdr')->default(false);
            $table->json('soap_shipping_response')->nullable();
            $table->timestamps();

            $table->foreign('soap_type_id')->references('id')->on('soap_types');
            $table->foreign('state_type_id')->references('id')->on('state_types');
            $table->foreign('summary_status_type_id','summaries_status_type_id_fk')->references('id')->on('sal_summary_status_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sal_summaries', function (Blueprint $table) {
            $table->dropForeign('summaries_status_type_id_fk');
        });
        Schema::dropIfExists('sal_summaries');
    }
}
