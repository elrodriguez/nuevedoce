<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_kardexes', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_issue');
            $table->unsignedBigInteger('establishment_id')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('kardexable_id')->nullable();
            $table->string('kardexable_type')->nullable();
            $table->decimal('quantity', 10, 2)->nullable();
            $table->string('detail')->nullable();
            $table->timestamps();
            $table->foreign('establishment_id')->references('id')->on('set_establishments');
            $table->foreign('item_id')->references('id')->on('inv_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_kardexes');
    }
}
