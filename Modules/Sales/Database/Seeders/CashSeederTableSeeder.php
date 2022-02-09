<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Sales\Entities\SalCash;
use Modules\Sales\Entities\SalCashTransaction;

class CashSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cash = SalCash::create([
            'user_id' => 1,
            'date_opening' => date('Y-m-d'),
            'time_opening' => date('H:i:s'),
            'beginning_balance' => 0,
            'final_balance' => 0,
            'income' => 0
        ]);

        SalCashTransaction::create([
            'cash_id' => $cash->id,
            'payment_method_type_id' => '01',
            'description' => 'Saldo inicial',
            'payment' => 0
        ]);
    }
}
