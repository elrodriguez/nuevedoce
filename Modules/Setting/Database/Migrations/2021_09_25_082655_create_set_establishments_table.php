<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

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
            $table->string('name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('observation')->nullable();
            $table->boolean('state')->default(true);
            $table->unsignedBigInteger('company_id')->nullable();
            $table->char('country_id',2)->nullable();
            $table->char('department_id',2)->nullable();
            $table->char('province_id',4)->nullable();
            $table->char('district_id',6)->nullable();
            $table->string('web_page')->nullable();
            $table->string('email')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('map')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('company_id')->references('id')->on('set_companies');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('district_id')->references('id')->on('districts');
        });

        DB::table('set_establishments')->insert([
            'name' => 'Oficina principal',
            'address' => 'inicio de registros',
            'phone' => '12345678',
            'observation' => 'inicio de registros',
            'state' => true,
            'company_id' => 1,
            'country_id' => 'PE',
            'department_id' => '02',
            'province_id' => '0218',
            'district_id' => '021801',
            'email' => 'establecimiento@gmail.com'
        ]);
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
