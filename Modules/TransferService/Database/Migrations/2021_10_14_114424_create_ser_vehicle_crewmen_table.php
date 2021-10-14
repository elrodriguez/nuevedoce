<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerVehicleCrewmenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_vehicle_crewmen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('description',400)->nullable();
            $table->timestamps();
            $table->index(['vehicle_id', 'employee_id']);
            $table->foreign('vehicle_id')->references('id')->on('ser_vehicles');
            $table->foreign('employee_id')->references('id')->on('per_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ser_vehicle_crewmen');
    }
}
