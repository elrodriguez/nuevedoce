<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SalesTablesTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soap_types', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('soap_types')->insert([
            ['id' => '01', 'description' => 'Demo'],
            ['id' => '02', 'description' => 'Producción'],
        ]);

        Schema::create('groups', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('groups')->insert([
            ['id' => '01', 'description' => 'Facturas'],
            ['id' => '02', 'description' => 'Boletas'],
        ]);

        Schema::create('item_types', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
        });

        DB::table('item_types')->insert([
            ['id' => '01', 'description' => 'Producto'],
            ['id' => '02', 'description' => 'Servicio']
        ]);

        Schema::create('currency_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->boolean('active');
            $table->string('symbol')->nullable();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('currency_types')->insert([
            ['id' => 'PEN', 'active' => true, 'symbol' => 'S/', 'description' => 'Soles'],
            ['id' => 'USD', 'active' => true, 'symbol' => '$',  'description' => 'Dólares Americanos'],
        ]);

        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('banks')->insert([
            ['id' => 1, 'description' => 'BANCO SCOTIABANK'],
            ['id' => 2, 'description' => 'BANCO DE CREDITO DEL PERU'],
            ['id' => 3, 'description' => 'BANCO DE COMERCIO'],
            ['id' => 4, 'description' => 'BANCO PICHINCHA'],
            ['id' => 5, 'description' => 'BBVA CONTINENTAL'],
            ['id' => 6, 'description' => 'INTERBANK'],
        ]);

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('bank_id');
            $table->string('description');
            $table->string('number');
            $table->string('currency_type_id')->nullable();

            $table->foreign('bank_id')->references('id')->on('banks');
            $table->foreign('currency_type_id')->references('id')->on('currency_types');
        });

        Schema::create('exchange_rates', function (Blueprint $table) {
            $table->date('date')->primary();
            $table->decimal('buy', 13, 3);
            $table->decimal('sell', 13, 3);
            $table->date('date_original');
            $table->timestamps();
        });

        Schema::create('system_isc_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->boolean('active');
            $table->string('description');
        });

        DB::table('system_isc_types')->insert([
            ['id' => '01', 'active' => true, 'description' => 'Sistema al valor'],
            ['id' => '02', 'active' => true, 'description' => 'Aplicación del Monto Fijo'],
            ['id' => '03', 'active' => true, 'description' => 'Sistema de Precios de Venta al Público'],
        ]);

        Schema::create('affectation_igv_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->boolean('active');
            $table->boolean('exportation')->nullable();
            $table->boolean('free')->nullable();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('affectation_igv_types')->insert([
            ['id' => '10', 'active' => true,  'exportation' => false, 'free' => false, 'description' => 'Gravado - Operación Onerosa'],
            ['id' => '11', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Gravado – Retiro por premio'],
            ['id' => '12', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Gravado – Retiro por donación'],
            ['id' => '13', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Gravado – Retiro'],
            ['id' => '14', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Gravado – Retiro por publicidad'],
            ['id' => '15', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Gravado – Bonificaciones'],
            ['id' => '16', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Gravado – Retiro por entrega a trabajadores'],
            ['id' => '17', 'active' => false, 'exportation' => false, 'free' => true,  'description' => 'Gravado – IVAP'],
            ['id' => '20', 'active' => true,  'exportation' => false, 'free' => false, 'description' => 'Exonerado - Operación Onerosa'],
            ['id' => '21', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Exonerado – Transferencia Gratuita'],
            ['id' => '30', 'active' => true,  'exportation' => false, 'free' => false, 'description' => 'Inafecto - Operación Onerosa'],
            ['id' => '31', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto – Retiro por Bonificación'],
            ['id' => '32', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto – Retiro'],
            ['id' => '33', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto – Retiro por Muestras Médicas'],
            ['id' => '34', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto - Retiro por Convenio Colectivo'],
            ['id' => '35', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto – Retiro por premio'],
            ['id' => '36', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto - Retiro por publicidad'],
            ['id' => '37', 'active' => true,  'exportation' => false, 'free' => true,  'description' => 'Inafecto - Transferencia gratuita'],
            ['id' => '40', 'active' => true,  'exportation' => true,  'free' => false, 'description' => 'Exportación de bienes o servicios'],
        ]);

        Schema::create('price_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->boolean('active');
            $table->string('description');
            $table->timestamps();
        });

        DB::table('price_types')->insert([
            ['id' => '01', 'active' => true, 'description' => 'Precio unitario (incluye el IGV)'],
            ['id' => '02', 'active' => true, 'description' => 'Valor referencial unitario en operaciones no onerosas'],
        ]);

        Schema::create('state_types', function (Blueprint $table) {
            $table->char('id', 2)->index();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('state_types')->insert([
            ['id' => '01', 'description' => 'Registrado'],
            ['id' => '03', 'description' => 'Enviado'],
            ['id' => '05', 'description' => 'Aceptado'],
            ['id' => '07', 'description' => 'Observado'],
            ['id' => '09', 'description' => 'Rechazado'],
            ['id' => '11', 'description' => 'Anulado'],
            ['id' => '13', 'description' => 'Porsi anular'],
        ]);

        Schema::create('cat_payment_method_types', function (Blueprint $table) {
            $table->string('id')->index();
            $table->string('description');
            $table->boolean('has_card')->default(true);
            $table->decimal('charge',12,2)->nullable();
            $table->integer('number_days')->nullable();
            $table->timestamps();
        });

        DB::table('cat_payment_method_types')->insert([
            ['id'=>'01','description' => 'Efectivo','has_card'=>0,'charge' => null,'number_days'=> null],
            ['id'=>'02','description' => 'Tarjeta de crédito','has_card'=> 1,'charge' => null,'number_days'=> null],
            ['id'=>'03','description' => 'Tarjeta de débito','has_card'=> 1,'charge' => null,'number_days'=> null],
            ['id'=>'04','description' => 'Transferencia','has_card'=> 0,'charge' => null,'number_days'=> null],
            ['id'=>'05','description' => 'Factura a 30 días','has_card'=> 0,'charge' => null,'number_days'=> 30],
            ['id'=>'06','description' => 'Tarjeta crédito visa','has_card'=> 1,'charge' => '3.68','number_days'=> null],
            ['id'=>'07','description' => 'Contado contraentrega','has_card'=> 0,'charge' => null,'number_days'=> null],
            ['id'=>'08','description' => 'A 30 días','has_card'=> 0,'charge' => null, 'number_days'=> 30],
            ['id'=>'09','description' => 'Crédito','has_card'=> 1,'charge' => null,'number_days'=> null],
            ['id'=>'10','description' => 'Contado','has_card'=> 0,'charge' => null,'number_days'=> null]
        ]);

        Schema::create('expense_method_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->boolean('has_card')->default(false);
            $table->timestamps();
        });

        DB::table('expense_method_types')->insert([
            ['id' => '1', 'description' => 'Efectivo', 'has_card' => false],
            ['id' => '2', 'description' => 'Tarjeta de crédito', 'has_card' => true],
            ['id' => '3', 'description' => 'Tarjeta de débito',  'has_card' => true],
        ]);

        Schema::create('expense_types', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->timestamps();
        });

        DB::table('expense_types')->insert([
            ['id' => '1', 'description' => 'PLANILLA', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '2', 'description' => 'RECIBO POR HONORARIO', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '3', 'description' => 'SERVICIO PÚBLICO', 'created_at' => now(), 'updated_at' => now()],
            ['id' => '4', 'description' => 'OTROS', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_types');
        Schema::dropIfExists('expense_method_types');
        Schema::dropIfExists('cat_payment_method_types');
        Schema::dropIfExists('state_types');
        Schema::dropIfExists('price_types');
        Schema::dropIfExists('affectation_igv_types');
        Schema::dropIfExists('currency_types');
        Schema::dropIfExists('system_isc_types');
        Schema::dropIfExists('exchange_rates');
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('banks');
        Schema::dropIfExists('item_types');
        Schema::dropIfExists('groups');
        Schema::dropIfExists('soap_types');
    }
}
