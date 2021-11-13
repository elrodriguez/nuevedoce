<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedInvCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 

        DB::table('inv_categories')->insert([
            ['description' => 'Estrado','status' => true],
            ['description' => 'Kiosko','status' => true],
            ['description' => 'Kiosko','status' => true],
            ['description' => 'Toldo','status' => true],
            ['description' => 'Cercos','status' => true],
            ['description' => 'Froster','status' => true],
            ['description' => 'Domo','status' => true],
            ['description' => 'Publicidad','status' => true],
            ['description' => 'Tribuna','status' => true],
            ['description' => 'Cables','status' => true],
            ['description' => 'E. de Electrisidad y Pintura','status' => true],
            ['description' => 'Herramientas Electricas','status' => true],
            ['description' => 'Iluminacion','status' => true],
            ['description' => 'Iluminacion de Patio delAlmacen','status' => true],
            ['description' => 'E. de Fumigacion','status' => true],
            ['description' => 'Pintura','status' => true],
            ['description' => 'Merch','status' => true],
            ['description' => 'Uniformes y EPP','status' => true],
            ['description' => 'Insumos para Reparar','status' => true],
            ['description' => 'Utiles de Oficina','status' => true],
            ['description' => 'E. de Computo','status' => true]
        ]);

    }
}
