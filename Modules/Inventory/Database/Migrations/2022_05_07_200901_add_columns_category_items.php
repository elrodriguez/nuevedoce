<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsCategoryItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_categories', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('category_id', 'categories_category_id_fk')->references('id')->on('inv_categories');
            $table->foreign('module_id', 'categories_module_id_fk')->references('id')->on('set_modules');
        });
        Schema::table('inv_brands', function (Blueprint $table) {
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('module_id', 'brands_module_id_fk')->references('id')->on('set_modules');
        });
        Schema::table('inv_models', function (Blueprint $table) {
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('module_id', 'models_module_id_fk')->references('id')->on('set_modules');
        });
        Schema::table('inv_items', function (Blueprint $table) {
            $table->unsignedBigInteger('module_id')->nullable();
            $table->foreign('module_id', 'items_module_id_fk')->references('id')->on('set_modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_items', function (Blueprint $table) {
            $table->dropForeign('items_module_id_fk');
            $table->dropColumn('module_id');
        });
        Schema::table('inv_models', function (Blueprint $table) {
            $table->dropForeign('models_module_id_fk');
            $table->dropColumn('module_id');
        });
        Schema::table('inv_brands', function (Blueprint $table) {
            $table->dropForeign('brands_module_id_fk');
            $table->dropColumn('module_id');
        });
        Schema::table('inv_categories', function (Blueprint $table) {
            $table->dropForeign('categories_module_id_fk');
            $table->dropForeign('categories_category_id_fk');
            $table->dropColumn('module_id');
            $table->dropColumn('category_id');
        });
    }
}
