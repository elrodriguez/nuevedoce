<?php

namespace Modules\Sales\Http\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Sales\Entities\SalExpense;
use Modules\Sales\Entities\SalExpensePayment;

class TotalExpense extends Component
{
    public $total;

    public function mount(){
        $this->getTotal();
    }

    public function render()
    {
        return view('sales::livewire.dashboard.total-expense');
    }
    public function getTotal(){
        $user = User::find(Auth::id());
        $role = $user->getRoleNames();
        $roles = array('Administrador','Gerente','TI');
        $bool = in_array($role, $roles);
        $user_id = Auth::id();


        $this->total = SalExpensePayment::join('sal_expenses','expense_id','sal_expenses.id')
                            ->when($bool == false, function ($query) use ($user_id){
                                return $query->where('sal_expenses.user_id', $user_id);
                            })
                            ->where('sal_expenses.state',true)
                            ->sum('sal_expense_payments.payment');

    }
}
