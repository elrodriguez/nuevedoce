<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateInvUnitMeasuresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_unit_measures', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("abbreviation", 20);
            $table->boolean('state')->default(true); //Estado
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('inv_unit_measures')->insert([
            [ 'name' => 'UNIDAD', 'abbreviation' => 'U', 'person_create' => '0', 'state' => true],
            [ 'name' => 'DOCENA', 'abbreviation' => '12U', 'person_create' => '0', 'state' => true],
            [ 'name' => 'PAR', 'abbreviation' => '2U', 'person_create' => '0', 'state' => true],
            [ 'name' => 'BALDE', 'abbreviation' => 'BAL', 'person_create' => '0', 'state' => true],
            [ 'name' => 'BIDONES', 'abbreviation' => 'BID', 'person_create' => '0', 'state' => true],
            [ 'name' => 'BOLSA', 'abbreviation' => 'BLS', 'person_create' => '0', 'state' => true],
            [ 'name' => 'BOTELLAS', 'abbreviation' => 'BOT', 'person_create' => '0', 'state' => true],
            [ 'name' => 'CAJA', 'abbreviation' => 'CAJ', 'person_create' => '0', 'state' => true],
            [ 'name' => 'CILINDRO', 'abbreviation' => 'CIL', 'person_create' => '0', 'state' => true],
            [ 'name' => 'CARTONES', 'abbreviation' => 'CRT', 'person_create' => '0', 'state' => true],
            [ 'name' => 'FARDO', 'abbreviation' => 'FDO', 'person_create' => '0', 'state' => true],
            [ 'name' => 'FRASCOS', 'abbreviation' => 'FRC', 'person_create' => '0', 'state' => true],
            [ 'name' => 'GRAMO', 'abbreviation' => 'GR', 'person_create' => '0', 'state' => true],
            [ 'name' => 'KILOGRAMO', 'abbreviation' => 'KG', 'person_create' => '0', 'state' => true],
            [ 'name' => 'KILOMETRO', 'abbreviation' => 'KM', 'person_create' => '0', 'state' => true],
            [ 'name' => 'LITRO', 'abbreviation' => 'L', 'person_create' => '0', 'state' => true],
            [ 'name' => 'METRO', 'abbreviation' => 'M', 'person_create' => '0', 'state' => true],
            [ 'name' => 'METRO CUADRADO', 'abbreviation' => 'M2', 'person_create' => '0', 'state' => true],
            [ 'name' => 'METRO CUBICO', 'abbreviation' => 'M3', 'person_create' => '0', 'state' => true],
            [ 'name' => 'MILLARES', 'abbreviation' => 'MLL', 'person_create' => '0', 'state' => true],
            [ 'name' => 'PAQUETE', 'abbreviation' => 'PAQ', 'person_create' => '0', 'state' => true],
            [ 'name' => 'PLANCHAS', 'abbreviation' => 'PLC', 'person_create' => '0', 'state' => true],
            [ 'name' => 'SACO', 'abbreviation' => 'SAC', 'person_create' => '0', 'state' => true],
            [ 'name' => 'TONELADAS', 'abbreviation' => 'TM', 'person_create' => '0', 'state' => true]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_unit_measures');
    }
}
