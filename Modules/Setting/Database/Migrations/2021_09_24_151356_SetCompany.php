<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SetCompany extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number');
            $table->string('email');
            $table->string('tradename')->nullable();
            $table->string('logo')->nullable();
            $table->string('logo_store')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('representative_name')->nullable();
            $table->string('representative_number')->nullable();
            $table->boolean('main')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('set_companies')->insert([
            'name' => 'nueve 12',
            'number' => '12345678901',
            'email' => 'nueve@gmail.com',
            'tradename' => 'nueve 12',
            'logo' => null,
            'logo_store' => null,
            'phone' => '123456',
            'phone_mobile' => '123456789',
            'representative_name' => 'Ivan Gerente',
            'representative_number' => '12345678',
            'main' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('set_companies');
    }
}
