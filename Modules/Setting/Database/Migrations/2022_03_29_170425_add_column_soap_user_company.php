<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnSoapUserCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('set_companies', function (Blueprint $table) {
            $table->string('detraction_account')->nullable();
            $table->string('soap_sent')->nullable();
            $table->string('soap_user')->nullable();
            $table->string('soap_password')->nullable();
            $table->string('certificate_pfx')->nullable();
            $table->string('certificate_pem')->nullable();
            $table->string('certificate_password')->nullable();
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
            $table->dropColumn('certificate_password');
            $table->dropColumn('certificate_file');
            $table->dropColumn('certificate_pfx');
            $table->dropColumn('soap_password');
            $table->dropColumn('soap_user');
            $table->dropColumn('soap_send_id');
            $table->dropColumn('detraction_account');
        });
    }
}
