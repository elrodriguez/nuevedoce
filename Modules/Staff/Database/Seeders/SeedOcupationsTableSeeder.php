<?php

namespace Modules\Staff\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SeedOcupationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sta_occupations')->insert([
            ['name' => 'Albañil'],
            ['name' => 'Almacenero'],
            ['name' => 'Ayudante'],
            ['name' => 'Carpintero'],
            ['name' => 'Chapero'],
            ['name' => 'Chofer'],
            ['name' => 'Electricista'],
            ['name' => 'Soldador'],
            ['name' => 'Pintor'],
            ['name' => 'Plomero'],
            ['name' => 'Practicante'],
            ['name' => 'Recepcionista'],
            ['name' => 'Supervisor de ventas especiales'],
            ['name' => 'Vendedor'],
            ['name' => 'Vidriero'],
            ['name' => 'Vigilante']
        ]);
    }
}
