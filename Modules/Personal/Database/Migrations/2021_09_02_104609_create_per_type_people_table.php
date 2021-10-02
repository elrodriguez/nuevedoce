<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerTypePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->down();
        Schema::create('per_type_people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->boolean('state')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('per_type_people')->insert([
            [
                'name' => 'Natural',
                'person_create' => '0',
                'state' => true
            ],
            [
                'name' => 'Jurídica',
                'person_create' => '0',
                'state' => true
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('per_type_people');
    }
}
