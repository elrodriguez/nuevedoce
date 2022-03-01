<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSoapTypeIdCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('set_companies', function (Blueprint $table) {
            $table->char('soap_type_id')->default('01');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('set_companies', function (Blueprint $table) {
            $table->dropColumn('soap_type_id');
        });
    }
}
