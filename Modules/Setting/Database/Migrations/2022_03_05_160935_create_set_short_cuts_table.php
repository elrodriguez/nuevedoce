<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSetShortCutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_short_cuts', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->string('name');
            $table->string('route_name')->nullable();
            $table->string('role_name');
            $table->string('permission',300)->nullable();
            $table->timestamps();
        });

        DB::table('set_short_cuts')->insert([
            ['icon' => 'fal fa-home', 'name' => 'Inicio', 'route_name' => 'dashboard', 'role_name' => 'TI','permission' => 'configuraciones_dashboard'],
            ['icon' => 'fal fa-puzzle-piece', 'name' => 'Parámetros', 'route_name' => 'parameters', 'role_name' => 'TI','permission' => 'configuraciones_parametros']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_short_cuts');
    }
}
