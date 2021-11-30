<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLenPaymentSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('len_payment_schedules', function (Blueprint $table) {
            $table->id();
            $table->integer('sequence')->default(1)->comment('Secuencia de Cuota');
            $table->char('contract_id', 10);
            $table->decimal('amount_to_pay', 9, 2)->default(0.00)->comment('Importe a Pagar');
            $table->date('date_to_pay', 9, 2)->comment('Fecha a Pagar');
            $table->decimal('amount_paid', 9, 2)->default(0.00)->comment('Importe Pagado');
            $table->dateTime('payment_date')->nullable()->comment('Fecha de Pago');
            $table->decimal('capital', 9, 2)->default(0.00)->comment('Capital');
            $table->decimal('interest', 9, 2)->default(0.00)->comment('Interés');
            $table->decimal('additional', 9, 2)->default(0.00)->comment('Importe adicional: Mora');
            $table->char('state',1)->default('P')->comment('P: Pendiente de pago, A: Pagado, V: Vencido');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->foreign('contract_id')->references('id')->on('len_contracts');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('len_payment_schedules');
    }
}
