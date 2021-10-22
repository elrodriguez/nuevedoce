<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvAssetFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inv_asset_files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('route');
            $table->string('extension');
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('asset_id')->references('id')->on('inv_assets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inv_asset_files');
    }
}
