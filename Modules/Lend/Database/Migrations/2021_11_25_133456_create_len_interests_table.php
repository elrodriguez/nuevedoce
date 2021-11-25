<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
