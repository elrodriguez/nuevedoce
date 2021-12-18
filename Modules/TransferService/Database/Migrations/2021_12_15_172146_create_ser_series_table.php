<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_series', function (Blueprint $table) {
            $table->id();
            $table->string('document_type_id', 255);
            $table->string('serie', 10)->comment('Numero de serie');
            $table->char('year', 4)->comment('Año de registro');
            $table->integer('start_number')->default(0)->comment('Número de Inicio');
            $table->integer('current_number')->default(0)->comment('Número Actual');
            $table->integer('final_number')->default(999999)->comment('Número Final');
            $table->integer('number_digits')->default(6)->comment('Número de dígitos');
            $table->char('state',1)->default('1')->comment("Estado");
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('document_type_id')->references('id')->on('document_types');
        });

        DB::table('ser_series')->insert([
            [
                'document_type_id'  => '09',
                'serie'             => 'G001',
                'year'              => date('Y'),
                'start_number'      => 1,
                'current_number'    => 0,
                'final_number'      => 999999,
                'number_digits'     => 6,
                'state'             => '1'
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
        Schema::dropIfExists('ser_series');
    }
}
