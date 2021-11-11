<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedInvBrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inv_brands')->insert([
            ['description' => 'SIN MARCA','status' => true],
            ['description' => 'CRISTAL','status' => true],
            ['description' => 'CRISTAL TENEMOS BARRA LA MEJOR HINCHADA','status' => true],
            ['description' => 'CRISTAL - AZUL','status' => true],
            ['description' => 'CUSQUEÑA','status' => true],
            ['description' => 'PILSEN CALLAO','status' => true]            
        ]);
    }
}
