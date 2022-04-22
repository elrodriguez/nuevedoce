<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInvTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_transactions', function (Blueprint $table) {
            $table->string('id');
            $table->string('description');
            $table->enum('type',['input','output']);
        });

        DB::table('inv_transactions')->insert([
            ['id' => '02', 'description' => 'Compra nacional', 'type' => 'input'],
            ['id' => '03', 'description' => 'Consignación recibida', 'type' => 'input'],
            ['id' => '05', 'description' => 'Devolución recibida', 'type' => 'input'], 
            ['id' => '16', 'description' => 'Inventario inicial', 'type' => 'input'],
            ['id' => '18', 'description' => 'Entrada de importación', 'type' => 'input'],
            ['id' => '19', 'description' => 'Ingreso de producción', 'type' => 'input'], 
            ['id' => '20', 'description' => 'Entrada por devolución de producción', 'type' => 'input'],
            ['id' => '21', 'description' => 'Entrada por transferencia entre almacenes', 'type' => 'input'],
            ['id' => '22', 'description' => 'Entrada por identificación erronea', 'type' => 'input'], 
            ['id' => '24', 'description' => 'Entrada por devolución del cliente', 'type' => 'input'],
            ['id' => '26', 'description' => 'Entrada para servicio de producción', 'type' => 'input'],
            ['id' => '29', 'description' => 'Entrada de bienes en prestamo', 'type' => 'input'], 
            ['id' => '31', 'description' => 'Entrada de bienes en custodia', 'type' => 'input'],
            ['id' => '50', 'description' => 'Ingreso temporal', 'type' => 'input'],
            ['id' => '52', 'description' => 'Ingreso por transformación', 'type' => 'input'], 
            ['id' => '54', 'description' => 'Ingreso de producción', 'type' => 'input'],
            ['id' => '55', 'description' => 'Entrada de importación', 'type' => 'input'],
            ['id' => '57', 'description' => 'Entrada por conversión de medida', 'type' => 'input'], 
            ['id' => '91', 'description' => 'Ingreso por transformación', 'type' => 'input'],
            ['id' => '93', 'description' => 'Ingreso temporal', 'type' => 'input'],
            ['id' => '96', 'description' => 'Entrada por conversión de medida', 'type' => 'input'], 
            ['id' => '99', 'description' => 'Otros', 'type' => 'input'], 
            ['id' => '01', 'description' => 'Venta nacional', 'type' => 'output'], 
            ['id' => '04', 'description' => 'Consignación entregada', 'type' => 'output'], 
            ['id' => '06', 'description' => 'Devolución entregada', 'type' => 'output'], 
            ['id' => '07', 'description' => 'Bonificación', 'type' => 'output'], 
            ['id' => '08', 'description' => 'Premio', 'type' => 'output'], 
            ['id' => '09', 'description' => 'Donación', 'type' => 'output'], 
            ['id' => '10', 'description' => 'Salida a producción', 'type' => 'output'], 
            ['id' => '11', 'description' => 'Salida por transferencia entre almacenes', 'type' => 'output'], 
            ['id' => '12', 'description' => 'Retiro', 'type' => 'output'], 
            ['id' => '13', 'description' => 'Mermas', 'type' => 'output'], 
            ['id' => '14', 'description' => 'Desmedros', 'type' => 'output'], 
            ['id' => '15', 'description' => 'Destrucción', 'type' => 'output'], 
            ['id' => '17', 'description' => 'Exportación', 'type' => 'output'], 
            ['id' => '23', 'description' => 'Salida por identificación erronea', 'type' => 'output'], 
            ['id' => '25', 'description' => 'Salida por devolución al proveedor', 'type' => 'output'], 
            ['id' => '27', 'description' => 'Salida por servicio de producción', 'type' => 'output'], 
            ['id' => '28', 'description' => 'Ajuste por diferencia de inventario', 'type' => 'output'], 
            ['id' => '30', 'description' => 'Salida de bienes en prestamo', 'type' => 'output'], 
            ['id' => '32', 'description' => 'Salida de bienes en custodia', 'type' => 'output'], 
            ['id' => '33', 'description' => 'Muestras médicas', 'type' => 'output'], 
            ['id' => '34', 'description' => 'Publicidad', 'type' => 'output'], 
            ['id' => '35', 'description' => 'Gastos de representación', 'type' => 'output'], 
            ['id' => '36', 'description' => 'Retiro para entrega a trabajadores', 'type' => 'output'], 
            ['id' => '37', 'description' => 'Retiro por convenio colectivo', 'type' => 'output'], 
            ['id' => '38', 'description' => 'Retiro por sustitución de bien siniestrado', 'type' => 'output'], 
            ['id' => '51', 'description' => 'Salida temporal', 'type' => 'output'], 
            ['id' => '53', 'description' => 'Salida para servicios terceros', 'type' => 'output'], 
            ['id' => '56', 'description' => 'Salida por conversión de medida', 'type' => 'output'], 
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_transactions');
    }
}
