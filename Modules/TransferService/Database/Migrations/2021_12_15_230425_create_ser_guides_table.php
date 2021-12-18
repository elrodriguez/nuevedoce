<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerGuidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_guides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('loadorder_id')->comment('Id de la orden de carga');
            $table->string('name_document', 200)->comment('Nombre documento');
            $table->string('serie', 20)->comment('Serie de documento');
            $table->string('guide_type', 1)->default('S')->comment('Tipo de Guia si es S:Salida o I:Ingreso.');
            $table->string('number', 20)->comment('Número de guía');
            $table->string('date_of_issue', 20)->nullable()->comment('Fecha de Emisión');
            $table->string('addressee')->nullable()->comment('Nombre del destinatario');
            $table->string('document_number')->nullable()->comment('Numero Documento Destinatario');
            $table->string('shipping_type')->nullable()->comment('Tipo de envío');
            $table->string('shipping_date', 20)->nullable()->comment('Fecha de Envío');
            $table->decimal('total_gross_weight', 9, 2)->nullable()->comment('Peso Bruto total');
            $table->integer('number_of_packages')->nullable()->comment('Número de bultos');
            $table->string('starting_point')->nullable()->comment('Punto de Partida');
            $table->string('arrival_point')->nullable()->comment('Punto de Llegada');
            $table->string('type_of_transport')->nullable()->comment('Tipo de Transporte');
            $table->string('license_plate')->nullable()->comment('Placa');
            $table->string('carrier')->nullable()->comment('Transportista');
            $table->string('document_carrier')->nullable()->comment('Número documento del transportista');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('loadorder_id')->references('id')->on('ser_load_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_guides');
    }
}
