<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Setting\Entities\SetEstablishment;

class CreateUserEstablishmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_establishments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('establishment_id');
            $table->string('main')->default(false);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('establishment_id')->references('id')->on('set_establishments');
        });

        DB::table('user_establishments')->insert([
            'user_id'           => 1,
            'establishment_id'  => 1,
            'main'              => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_establishments');
    }
}
