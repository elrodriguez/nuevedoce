<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEntityCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_cards', function (Blueprint $table) {
            $table->string('id');
            $table->string('description');
            $table->boolean('state');
            $table->timestamps();
            $table->primary('id');
        });

        DB::table('entity_cards')->insert([
            ['id'=>'01','description'=>'Visa','state'=>true],
            ['id'=>'02','description'=>'Mastercard','state'=>true]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity_cards');
    }
}
