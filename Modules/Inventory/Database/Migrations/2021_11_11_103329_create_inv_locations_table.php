<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateInvLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_locations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('establishment_id');
            $table->string('name');
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->foreign('establishment_id')->references('id')->on('set_establishments');
        });

        DB::table('inv_locations')->insert([
            'establishment_id' => 1,'name' => 'Almacen Oficina Principal','state' => true,
            'establishment_id' => 1,'name' => 'Rack 1','state' => true,
            'establishment_id' => 1,'name' => 'Rack 2','state' => true,
            'establishment_id' => 1,'name' => 'Rack 3','state' => true,
            'establishment_id' => 1,'name' => 'Rack 4','state' => true,
            'establishment_id' => 1,'name' => 'Rack 5','state' => true,
            'establishment_id' => 1,'name' => 'Rack 6','state' => true,
            'establishment_id' => 1,'name' => 'Rack 7','state' => true,
            'establishment_id' => 1,'name' => 'Rack 8','state' => true,
            'establishment_id' => 1,'name' => 'Rack 9','state' => true,
            'establishment_id' => 1,'name' => 'Rack 10','state' => true,
            'establishment_id' => 1,'name' => 'Rack 11','state' => true,
            'establishment_id' => 1,'name' => 'Rack 12','state' => true,
            'establishment_id' => 1,'name' => 'Rack 13','state' => true,
            'establishment_id' => 1,'name' => 'Rack 14','state' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_locations');
    }
}
