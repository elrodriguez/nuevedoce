<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SalesDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call([
            ModulePermissionsTableSeeder::class,
            CashSeederTableSeeder::class,
        ]);
    }
}
