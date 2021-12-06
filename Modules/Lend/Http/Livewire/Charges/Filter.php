<?php

namespace Modules\Lend\Http\Livewire\Charges;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Modules\Lend\Entities\LenPaymentSchedule;

class Filter extends Component
{
    public $show;
    public $search;
    public $contract;
    public $date;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('lend::livewire.charges.filter',['payments' => $this->getPaymentSchedule()]);
    }

    public function getPaymentSchedule(){
        $date = $this->date;
        return LenPaymentSchedule::join('len_contracts','contract_id','len_contracts.id')
            ->join('people','customer_id','people.id')
            ->when($date, function ($query) use ($date){
                return $query->where('date_to_pay','=',$date);
            })
            ->when($date, function ($query) use ($date){
                return $query->where('date_to_pay','=',$date);
            })
            ->where('contract_id','=',$this->contract)
            ->where('people.full_name','like',$this->search.'%')
            ->paginate($this->show);
    }

    public function paymentScheduleSearch()
    {
        $this->resetPage();
    }
}
