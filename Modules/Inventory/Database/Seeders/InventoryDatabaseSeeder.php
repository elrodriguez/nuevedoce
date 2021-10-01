<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;


class InventoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            InventoryDatabaseSeeder::class
        ]);
    }
}
