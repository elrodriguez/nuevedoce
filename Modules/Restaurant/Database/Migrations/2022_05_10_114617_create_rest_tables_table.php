<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRestTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('floor_id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('chairs')->default(2);
            $table->boolean('occupied')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        DB::table('rest_tables')->insert([
            ['floor_id' => 1, 'name' => 'M1', 'description' => 'Cerca a la entrada'],
            ['floor_id' => 1, 'name' => 'M2', 'description' => 'En el centro del salon'],
            ['floor_id' => 1, 'name' => 'M3', 'description' => 'En el centro del salon'],
            ['floor_id' => 1, 'name' => 'M4', 'description' => 'Cerca a la entrada'],
            ['floor_id' => 1, 'name' => 'M5', 'description' => 'Cerca a la baño'],
            ['floor_id' => 1, 'name' => 'M6', 'description' => 'Cerca a la escaleras']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rest_tables');
    }
}
