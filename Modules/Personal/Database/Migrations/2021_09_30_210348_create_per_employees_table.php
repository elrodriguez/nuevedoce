<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('per_employees', function (Blueprint $table) {
            $table->id();
            $table->date('admission_date')->nullable(); // Fecha de ingreso
            $table->unsignedBigInteger('person_id')->nullable(); //Persona
            $table->unsignedBigInteger('company_id')->nullable(); //Compañia
            $table->unsignedBigInteger('occupation_id')->nullable(); //Ocupacion
            $table->unsignedBigInteger('employee_type_id')->nullable(); //Tipo de empleado
            $table->string('cv')->default(''); //Curriculum vitae
            $table->string('photo')->default(''); //Foto usuario
            $table->boolean('state')->default(true); //Estado
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('person_id')->references('id')->on('people');
            $table->foreign('company_id')->references('id')->on('people');
            $table->foreign('occupation_id')->references('id')->on('per_occupations');
            $table->foreign('employee_type_id')->references('id')->on('per_employee_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('per_employees');
    }
}
