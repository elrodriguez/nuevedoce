<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sta_employees', function (Blueprint $table) {
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
            $table->foreign('occupation_id')->references('id')->on('sta_occupations');
            $table->foreign('employee_type_id')->references('id')->on('sta_employee_types');
        });

        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('type_person_id')->nullable(); //Type Person
            $table->foreign('type_person_id','people_type_person_id_fk')->references('id')->on('sta_person_types');
        });

        Schema::table('ser_odt_requests', function (Blueprint $table) {
            $table->unsignedBigInteger('supervisor_id')->nullable()->comment('Supervisor id');
            $table->foreign('supervisor_id','odt_requests_supervisor_id_fk')->references('id')->on('sta_employees');
        });

        Schema::table('ser_vehicle_crewmen', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->index(['vehicle_id', 'employee_id']);
            $table->foreign('employee_id','vehicle_crewmen_employee_id_fk')->references('id')->on('sta_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('people', function (Blueprint $table) {
            $table->dropForeign('people_type_person_id_fk');
            $table->dropColumn('type_person_id');
        });

        Schema::table('ser_odt_requests', function (Blueprint $table) {
            $table->dropForeign('odt_requests_supervisor_id_fk');
            $table->dropColumn('supervisor_id');
        });

        Schema::table('ser_vehicle_crewmen', function (Blueprint $table) {
            $table->dropForeign('vehicle_crewmen_employee_id_fk');
            $table->dropColumn('employee_id');
        });

        Schema::dropIfExists('sta_employees');
    }

    
}
