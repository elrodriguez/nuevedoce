<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_type_id')->nullable(); //Tipo de Vehiculo
            $table->string('license_plate', 30);//Placa vehicular
            $table->string('mark'); //Marca
            $table->string('model');//Modelo
            $table->string('year', 4); //Año
            $table->decimal('length', 9, 2); //Longitud
            $table->decimal('width', 9, 2); //Anchura
            $table->decimal('high', 9, 2); //Alto
            $table->string('color'); //Color
            $table->string('features'); //Caracteristicas
            $table->decimal('tare_weight', 9, 2); //Peso Tara: Peso del vehiculo vacio
            $table->decimal('net_weight', 9, 2); //Peso Neto: Peso solo de la carga
            $table->decimal('gross_weight', 9, 2); //Peso Bruto: Peso total de vihuculo y camion
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehicle_type_id')->references('id')->on('ser_vehicle_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_vehicles');
    }
}
