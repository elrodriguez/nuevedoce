<?php

namespace Modules\Sales\Http\Livewire\Expenses;

use App\Models\BankAccount;
use Livewire\Component;
use Modules\Sales\Entities\SalExpense;
use Illuminate\Support\Facades\DB;
use Modules\Sales\Entities\SalCash;
use Modules\Sales\Entities\SalExpensePayment;

class ExpensesPaymentsModal extends Component
{
    protected $listeners = ['modalPayment' => 'openModalPayment'];

    public $payments = [];
    public $total_payments;
    public $total_expenses;
    public $expense_id;

    public function render()
    {
        return view('sales::livewire.expenses.expenses-payments-modal');
    }

    public function openModalPayment($id){
        
        $expense = SalExpense::find($id);
        $this->expense_id = $expense->id;
        $this->total_expenses = $expense->total;
        $this->listPayments();
        $this->dispatchBrowserEvent('open-modal-expense-payments-1', ['title' => 'Pago: '.$expense->number]);
    }

    public function listPayments(){
        $this->payments = [];
        $this->total_payments = 0;
        $payments = SalExpensePayment::join('expense_method_types','expense_method_type_id','expense_method_types.id')
                            ->join('global_payments',function($query){
                                $query->on('global_payments.payment_id','sal_expense_payments.id')
                                    ->where('global_payments.payment_type',SalExpensePayment::class);
                            })
                            ->leftJoin('sal_cashes', function($query){
                                $query->on('global_payments.destination_id','sal_cashes.id')
                                    ->where('global_payments.destination_type', SalCash::class);
                            })
                            ->leftJoin('bank_accounts', function($query){
                                $query->on('global_payments.destination_id','bank_accounts.id')
                                    ->where('global_payments.destination_type', BankAccount::class);
                            })
                            ->leftJoin('banks','bank_accounts.bank_id','banks.id')
                            ->select(
                                'sal_expense_payments.id',
                                'expense_method_types.description',
                                'sal_expense_payments.expense_id',
                                'sal_expense_payments.date_of_payment',
                                'sal_expense_payments.reference',
                                'sal_expense_payments.payment',
                                'global_payments.destination_type',
                                DB::raw('CONCAT("CAJA CHICA",IF(sal_cashes.reference_number IS NULL,"",CONCAT(" - ",sal_cashes.reference_number))) AS cash_name'),
                                DB::raw('CONCAT(banks.description," - ",bank_accounts.currency_type_id," - ",banks.description) AS banck_name')
                            )
                            ->where('expense_id',$this->expense_id)
                            ->get();
        
        //dd($payments);
        foreach($payments as $payment){
            $this->total_payments = $this->total_payments + $payment->payment;
        }
        $this->payments = $payments;
    }
}
