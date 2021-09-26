<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->char('country_id',2);
            $table->char('department_id',2);
            $table->char('province_id',4);
            $table->char('district_id',6);
            $table->string('identity_document_type_id');
            $table->string('number');
            $table->string('names');
            $table->string('last_name_father')->nullable();
            $table->string('last_name_mother')->nullable();
            $table->string('full_name',500)->nullable();
            $table->string('trade_name',500)->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->char('sex',1)->default('M');
            $table->date('birth_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('identity_document_type_id')->references('id')->on('identity_document_types');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('person_id')->nullable();
            $table->foreign('person_id','users_person_id_foreign')->references('id')->on('people');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_person_id_foreign');
            $table->dropColumn('person_id');
        });

        Schema::dropIfExists('people');
    }
}
