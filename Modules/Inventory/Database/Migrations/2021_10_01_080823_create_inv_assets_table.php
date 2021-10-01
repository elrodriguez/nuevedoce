<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_assets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('part')->default(false);
            $table->decimal('weight', 10, 2)->nullable();
            $table->decimal('width', 10, 2)->nullable();
            $table->decimal('high', 10, 2)->nullable();
            $table->decimal('long', 10, 2)->nullable();
            $table->integer('number_parts')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('asset_id')->references('id')->on('inv_assets');
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
        Schema::dropIfExists('inv_assets');
    }
}
