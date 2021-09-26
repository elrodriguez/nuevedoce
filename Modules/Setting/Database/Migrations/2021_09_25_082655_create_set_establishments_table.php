<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_establishments', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone');
            $table->string('observation');
            $table->boolean('state')->default(true);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->char('country_id',2)->nullable();
            $table->char('department_id',2)->nullable();
            $table->char('province_id',4)->nullable();
            $table->char('district_id',6)->nullable();
            $table->string('web_page');
            $table->string('email');
            $table->text('map');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('set_companies');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_establishments');
    }
}
