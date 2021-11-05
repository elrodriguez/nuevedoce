<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateInvAssetTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_asset_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->boolean('state')->default(true); //Estado
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('inv_asset_types')->insert([
            [ 'name' => 'FIJO', 'person_create' => '0', 'state' => true],
            [ 'name' => 'PASIVO', 'person_create' => '0', 'state' => true]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_asset_types');
    }
}
