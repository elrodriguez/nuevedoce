<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnLocationIdKardex extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_kardexes', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id','inv_kardexes_location_id_fk')->references('id')->on('inv_locations');
        });

        Schema::table('inv_assets', function (Blueprint $table) {
            $table->unsignedBigInteger('location_id')->nullable();
            $table->foreign('location_id','inv_assets_location_id_fk')->references('id')->on('inv_locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_kardexes', function (Blueprint $table) {
            $table->dropForeign('inv_kardexes_location_id_fk');
            $table->dropColumn('location_id');
        });
        Schema::table('inv_assets', function (Blueprint $table) {
            $table->dropForeign('inv_assets_location_id_fk');
            $table->dropColumn('location_id');
        });
    }
}
