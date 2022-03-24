<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parameters', function (Blueprint $table) {
            $table->id();
            $table->string('type',20);
            $table->text('code_sql')->nullable();
            $table->string('id_parameter')->unique();
            $table->string('description',500);
            $table->string('value_default')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('parameters')->insert([
            [
                'type' => '2',
                'code_sql'=>'1,hotel|2,Restaurante|3,Almacen|4,Pesquero|5,Colegio|6,Educacion Superior|7,farmacia o botica|8,Servicio de Transporte',
                'id_parameter'=>'PRT0001GN',
                'description'=>'En este parametro definimos en que rubro se desempeña la empresa, este paramtro ajusta ciertos campos y criterios del sistema, en la interfaz y los procesos de registro',
                'value_default'=>'7'
            ],
            [
                'type' => '1',
                'code_sql'=>null,
                'id_parameter'=>'PRT002IGV',
                'description'=>'Valor del ivg',
                'value_default'=>'18'
            ],
            [
                'type' => '2',
                'code_sql'=>'1,default|2,default2',
                'id_parameter'=>'PRT003THM',
                'description'=>'El formato para la impresión de documentos',
                'value_default'=>'default'
            ],
            [
                'type' => '1',
                'code_sql'=> null,
                'id_parameter'=>'PRT004SRS',
                'description'=>'Servidor Alternativo sunat',
                'value_default'=>'0'
            ],
            [
                'type' => '3',
                'code_sql'=> 'SELECT id,description FROM soap_types',
                'id_parameter'=>'PRT005SOP',
                'description'=>'SOAP Tipo (Entorno del Sistema)',
                'value_default'=>'01'
            ],
            [
                'type' => '1',
                'code_sql'=> null,
                'id_parameter'=>'PRT006CSE',
                'description'=>'config_system_env',
                'value_default'=>'1'
            ],
            [
                'type' => '1',
                'code_sql'=> null,
                'id_parameter'=>'PRT006ICP',
                'description'=>'Valor de icvper (inpuesto a la bolsa plastica)',
                'value_default'=>'0.2'
            ],
            [
                'type' => '1',
                'code_sql'=> null,
                'id_parameter'=>'PRT007PAG',
                'description'=>'Cantidad de registros a mostrar en la paginación',
                'value_default'=>'10'
            ],
            [
                'type' => '4',
                'code_sql' => '0,NO|1,SI',
                'id_parameter' => 'PRT008DSN',
                'description' => 'Descontar stock al emitir notas de venta',
                'value_default' => '1'
            ],
            [
                'type' => '1',
                'code_sql' => null,
                'id_parameter' => 'PRT009VUL',
                'description' => 'Versión de UBL',
                'value_default' => '2.0'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parameters');
    }
}
