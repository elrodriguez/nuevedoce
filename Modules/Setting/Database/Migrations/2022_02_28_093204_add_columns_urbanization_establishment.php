<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsUrbanizationEstablishment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('set_establishments', function (Blueprint $table) {
            $table->string('urbanization',500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('set_establishments', function (Blueprint $table) {
            $table->dropColumn('urbanization');
        });
    }
}
