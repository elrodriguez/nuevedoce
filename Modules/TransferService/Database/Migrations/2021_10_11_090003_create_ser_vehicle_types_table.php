<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSerVehicleTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ser_vehicle_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('ser_vehicle_types')->insert([
            [
                'name'          => 'Camión',
                'description'   => 'Camiones de todo tipo',
                'person_create' => '0',
                'state'         => true
            ],
            [
                'name'          => 'Camioneta',
                'description'   => 'Camioneta',
                'person_create' => '0',
                'state'         => true
            ],
            [
                'name'          => 'Furgón',
                'description'   => 'Furgon',
                'person_create' => '0',
                'state'         => true
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
        Schema::dropIfExists('ser_vehicle_types');
    }
}
