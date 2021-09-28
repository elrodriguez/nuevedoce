<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateSetModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_modules', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('logo');
            $table->string('label');
            $table->string('destination_route')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('set_modules')->insert([
            [
                'uuid'=> Str::uuid(),
                'logo'=>'fal fa-cogs',
                'label'=>'Configuraciones',
                'destination_route' => 'setting_dashboard'
            ],
            [
                'uuid'=> Str::uuid(),
                'logo'=>'fal fa-restroom',
                'label'=>'Personal',
                'destination_route' => null
            ],
            [
                'uuid'=> Str::uuid(),
                'logo'=>'fal fa-cubes',
                'label'=>'Inventario',
                'destination_route' => null
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
        Schema::dropIfExists('set_modules');
    }
}
