<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnShowGuidesItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inv_item_parts', function (Blueprint $table) {
            $table->boolean('show_guides')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inv_item_parts', function (Blueprint $table) {
            $table->dropColumn('show_guides');
        });
    }
}
