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
            $table->unsignedBigInteger('company_id')->nullable()->comment('Empresa id');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('Cliente id');
            $table->unsignedBigInteger('local_id')->nullable()->comment('Local id');
            $table->unsignedBigInteger('wholesaler_id')->nullable()->comment('Mayorista id');
            $table->date('date_start')->nullable()->comment('Fecha inicio del evento');
            $table->date('date_end')->nullable()->comment('Fecha finaliza el evento');
            $table->string('description')->nullable()->comment('Descripcion del Evento');
            $table->string('additional_information')->nullable()->comment('Información Adicional');
            $table->string('file')->nullable()->comment('Archivo Ajunto img|pdf');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->char('state',1)->default('P')->comment('P=pendiente,O= Orden de Carga, A=atendido,R=rechazado');
            $table->string('backus_id')->nullable()->comment('elcodigo que backus o la empresa solicitante maneja');
            $table->string('internal_id')->nullable()->comment('conformado por el año y un correlativo 2021000001');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('people');
            $table->foreign('customer_id')->references('id')->on('customers');
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
