<?php

namespace Modules\Sales\Http\Livewire\Expenses;

use Livewire\Component;
use Modules\Sales\Entities\SalExpense;

class ExpensesList extends Component
{
    public $show;
    public $search;

    public function render()
    {
        return view('sales::livewire.expenses.expenses-list',['expenses' => $this->getExpenses()]);
    }

    public function getExpenses(){
        return SalExpense::orderBy('id','DESC')->paginate($this->show);
    }
}
