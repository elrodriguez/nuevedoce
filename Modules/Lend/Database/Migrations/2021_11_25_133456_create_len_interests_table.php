<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateLenInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('len_interests', function (Blueprint $table) {
            $table->id();
            $table->string('description', 20);
            $table->decimal('value', 9, 2);
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('len_interests')->insert([
            ['description' => '20%','value' => '0.20'],
            ['description' => '18%','value' => '0.18'],
            ['description' => '15%','value' => '0.15'],
            ['description' => '10%','value' => '0.10']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('len_interests');
    }
}
