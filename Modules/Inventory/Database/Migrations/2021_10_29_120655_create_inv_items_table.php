<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->boolean('part')->default(false);
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('high', 10, 2)->nullable();
            $table->decimal('long', 10, 2)->nullable();
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->integer('number_parts')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('person_create')->nullable();
            $table->unsignedBigInteger('person_edit')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('brand_id')->references('id')->on('inv_brands');
            $table->foreign('category_id')->references('id')->on('inv_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_items');
    }
}
