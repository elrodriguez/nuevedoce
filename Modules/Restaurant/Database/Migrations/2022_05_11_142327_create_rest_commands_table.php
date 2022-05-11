<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rest_commands', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->decimal('price', 8, 2);
            $table->string('image')->nullable();
            $table->decimal('stock', 8, 2);
            $table->string('internal_id');
            $table->boolean('has_igv')->default(true);
            $table->boolean('web_show')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rest_commands');
    }
}
