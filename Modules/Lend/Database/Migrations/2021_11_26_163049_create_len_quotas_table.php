<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
class CreateLenQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('len_quotas', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('len_quotas')->insert([
            ['amount' => 1],
            ['amount' => 2],
            ['amount' => 3],
            ['amount' => 4],
            ['amount' => 5],
            ['amount' => 6],
            ['amount' => 7],
            ['amount' => 8],
            ['amount' => 9],
            ['amount' => 10],
            ['amount' => 11],
            ['amount' => 12],
            ['amount' => 13],
            ['amount' => 14],
            ['amount' => 15],
            ['amount' => 16],
            ['amount' => 17],
            ['amount' => 18],
            ['amount' => 19],
            ['amount' => 20],
            ['amount' => 21],
            ['amount' => 22],
            ['amount' => 23],
            ['amount' => 24],
            ['amount' => 25],
            ['amount' => 26],
            ['amount' => 27],
            ['amount' => 28],
            ['amount' => 29],
            ['amount' => 30],
            ['amount' => 31],
            ['amount' => 60],
            ['amount' => 100]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('len_quotas');
    }
}
