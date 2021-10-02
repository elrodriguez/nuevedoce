<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Database\Seeders\SettingDatabaseSeeder;
use Modules\Inventory\Database\Seeders\InventoryDatabaseSeeder;
use Modules\Personal\Database\Seeders\PersonalDatabaseSeeder;
use Modules\TransferService\Database\Seeders\TransferServiceDatabaseSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            SettingDatabaseSeeder::class,
            InventoryDatabaseSeeder::class,
            PersonalDatabaseSeeder::class,
            TransferServiceDatabaseSeeder::class,
        ]);
    }
}
