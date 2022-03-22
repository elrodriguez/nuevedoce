<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateSalSummaryStatusTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sal_summary_status_types', function (Blueprint $table) {
            $table->string('id');
            $table->boolean('active')->default(true);
            $table->string('description');
            $table->timestamps();
            $table->primary('id');
        });

        DB::table('sal_summary_status_types')->insert([
            ['id' => 1, 'active' => true ,'description' => 'Adicionar'],
            ['id' => 2, 'active' => true ,'description' => 'Modificar'],
            ['id' => 3, 'active' => true ,'description' => 'Anulado']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sal_summary_status_types');
    }
}
