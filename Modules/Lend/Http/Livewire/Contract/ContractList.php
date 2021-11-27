<?php

namespace Modules\Lend\Http\Livewire\Contract;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Modules\Lend\Entities\LenContract;

class ContractList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('lend::livewire.contract.contract-list',['contracts' => $this->getContracts()]);
    }

    public function getContracts(){
        return LenContract::join('people AS customer','customer_id','customer.id')
                ->leftJoin('people AS referred','referred_id','referred.id')
                ->join('len_interests','interest_id','len_interests.id')
                ->join('len_payment_methods','payment_method_id','len_payment_methods.id')
                ->join('len_quotas','quota_id','len_quotas.id')
                ->select(
                    'len_contracts.id',
                    'customer.full_name AS customer_name',
                    'customer.number AS customer_number',
                    'referred.full_name AS referred_name',
                    'referred.number AS referred_number',
                    'len_interests.description AS interest_description',
                    'len_payment_methods.description AS payment_method_description',
                    'len_quotas.amount AS quota_amount',
                    'len_contracts.date_start',
                    'len_contracts.date_end',
                    'len_contracts.penalty',
                    'len_contracts.amount_penalty_day',
                    'len_contracts.amount_capital',
                    'len_contracts.amount_interest',
                    'len_contracts.amount_total',
                    'len_contracts.additional_information',
                    'len_contracts.state'
                )
                ->where('len_contracts.id','like','%'.$this->search.'%')
                ->paginate($this->show);
    }

    public function contractsSearch()
    {
        $this->resetPage();
    }

    // public function deleteInterest($id){
    //     $interest = LenInterest::find($id);

    //     $activity = new activity;
    //     $activity->log('Se eliminó el interés');
    //     $activity->modelOn(LenInterest::class, $id,'len_interests');
    //     $activity->dataOld($interest);
    //     $activity->logType('delete');
    //     $activity->causedBy(Auth::user());
    //     $activity->save();

    //     $interest->delete();

    //     $this->dispatchBrowserEvent('len-interest-delete', ['msg' => Lang::get('lend::messages.msg_delete')]);
    // }
}
