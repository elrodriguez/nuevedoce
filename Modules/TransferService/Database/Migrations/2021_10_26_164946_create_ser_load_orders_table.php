<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerLoadOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_load_orders', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 8)->unique();
            $table->unsignedBigInteger('vehicle_id');
            $table->decimal('charge_maximum',12,2)->default(0);
            $table->decimal('charge_weight',12,2)->default(0);
            $table->date('upload_date')->nullable()->comment('Fecha de carga');
            $table->time('charging_time')->nullable()->comment('Hora de carga');
            $table->date('departure_date')->nullable()->comment('Fecha de Salida');
            $table->time('departure_time')->nullable()->comment('Hora de Salida');
            $table->date('return_date')->nullable()->comment('Fecha de Retorno');
            $table->time('return_time')->nullable()->comment('Hora de Retorno');
            $table->string('additional_information')->nullable();
            $table->string('state', 1)->default('P')->comment('P= Pendiente Carga, E = En servicio, A=Retornado, B Pendiente retorno');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('vehicle_id')->references('id')->on('ser_vehicles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_load_orders');
    }
}
