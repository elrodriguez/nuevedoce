<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerOdtRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_odt_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->nullable(); //Empresa id
            $table->unsignedBigInteger('supervisor_id')->nullable(); //Supervisor id
            $table->unsignedBigInteger('customer_id')->nullable(); //Cliente id
            $table->unsignedBigInteger('local_id')->nullable(); //Local id
            $table->unsignedBigInteger('wholesaler_id')->nullable(); //Mayorista id
            $table->date('event_date')->nullable(); //Fecha del evento
            $table->date('transfer_date')->nullable(); //Fecha de Traslado
            $table->date('pick_up_date')->nullable(); //Fecha de Recojo
            $table->date('application_date')->nullable(); //Fecha de Solicitud
            $table->string('description')->nullable(); //Descripcion del Evento
            $table->string('additional_information')->nullable(); //Información Adicional
            $table->string('file')->nullable(); //Archivo Ajunto img|pdf
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('people');
            $table->foreign('supervisor_id')->references('id')->on('per_employees');
            $table->foreign('customer_id')->references('id')->on('ser_customers');
            $table->foreign('local_id')->references('id')->on('ser_locals');
            $table->foreign('wholesaler_id')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_odt_requests');
    }
}
