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
            $table->string('id');
            $table->string("name");
            $table->string("abbreviation", 20);
            $table->boolean('state')->default(true); //Estado
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });

        DB::table('inv_unit_measures')->insert([
            [ 'id' => 'ZZ','name' => 'UNIDAD (SERVICIOS)', 'abbreviation' => 'S', 'person_create' => '0', 'state' => true],
            [ 'id' => 'NIU','name' => 'UNIDAD', 'abbreviation' => 'U', 'person_create' => '0', 'state' => true],
            [ 'id' => 'DZN','name' => 'DOCENA', 'abbreviation' => '12U', 'person_create' => '0', 'state' => true],
            [ 'id' => 'PR','name' => 'PAR', 'abbreviation' => '2U', 'person_create' => '0', 'state' => true],
            [ 'id' => 'BJ','name' => 'BALDE', 'abbreviation' => 'BAL', 'person_create' => '0', 'state' => true],
            [ 'id' => 'BG','name' => 'BOLSA', 'abbreviation' => 'BLS', 'person_create' => '0', 'state' => true],
            [ 'id' => 'BO','name' => 'BOTELLAS', 'abbreviation' => 'BOT', 'person_create' => '0', 'state' => true],
            [ 'id' => 'BX','name' => 'CAJA', 'abbreviation' => 'CAJ', 'person_create' => '0', 'state' => true],
            [ 'id' => 'CY','name' => 'CILINDRO', 'abbreviation' => 'CIL', 'person_create' => '0', 'state' => true],
            [ 'id' => 'CT','name' => 'CARTONES', 'abbreviation' => 'CRT', 'person_create' => '0', 'state' => true],
            [ 'id' => 'BE','name' => 'FARDO', 'abbreviation' => 'FDO', 'person_create' => '0', 'state' => true],
            [ 'id' => 'GRM','name' => 'GRAMO', 'abbreviation' => 'GR', 'person_create' => '0', 'state' => true],
            [ 'id' => 'KGM','name' => 'KILOGRAMO', 'abbreviation' => 'KG', 'person_create' => '0', 'state' => true],
            [ 'id' => 'KTM','name' => 'KILOMETRO', 'abbreviation' => 'KM', 'person_create' => '0', 'state' => true],
            [ 'id' => 'LTR','name' => 'LITRO', 'abbreviation' => 'L', 'person_create' => '0', 'state' => true],
            [ 'id' => 'MTR','name' => 'METRO', 'abbreviation' => 'M', 'person_create' => '0', 'state' => true],
            [ 'id' => 'CMK','name' => 'CENTIMETRO CUADRADO  ', 'abbreviation' => 'CMK', 'person_create' => '0', 'state' => true],
            [ 'id' => 'MTK','name' => 'METRO CUADRADO', 'abbreviation' => 'M2', 'person_create' => '0', 'state' => true],
            [ 'id' => 'MTQ','name' => 'METRO CUBICO', 'abbreviation' => 'M3', 'person_create' => '0', 'state' => true],
            [ 'id' => 'MIL','name' => 'MILLARES', 'abbreviation' => 'MLL', 'person_create' => '0', 'state' => true],
            [ 'id' => 'PK','name' => 'PAQUETE', 'abbreviation' => 'PAQ', 'person_create' => '0', 'state' => true],
            [ 'id' => 'SET','name' => 'JUEGO', 'abbreviation' => 'SET', 'person_create' => '0', 'state' => true],
            [ 'id' => 'KT','name' => 'KIT', 'abbreviation' => 'KIT', 'person_create' => '0', 'state' => true],
            [ 'id' => 'YRD','name' => 'YARDA', 'abbreviation' => 'YRD', 'person_create' => '0', 'state' => true]
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
