<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRestFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_floors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('state')->default(true);
            $table->timestamps();
        });

        DB::table('rest_floors')->insert([
            ['name' => 'piso 1'],
            ['name' => 'piso 2']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rest_floors');
    }
}
