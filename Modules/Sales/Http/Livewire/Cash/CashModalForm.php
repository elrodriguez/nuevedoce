<?php

namespace Modules\Sales\Http\Livewire\Cash;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Elrod\UserActivity\Activity;
use Livewire\Component;
use Modules\Sales\Entities\SalCash;
use Illuminate\Support\Facades\Lang;
class CashModalForm extends Component
{
    public $cash_id = null;
    public $title;
    public $user_id;
    public $users;
    public $initial = 0;
    public $reference;

    protected $listeners = ['updateCash'];

    public function mount(){
        $this->user_id = Auth::id();
    }

    public function render()
    {
        $user = User::find(Auth::id());

        if($user->hasRole(['TI', 'Administrador'])){
            $this->listUsers();
        }

        return view('sales::livewire.cash.cash-modal-form');
    }

    public function listUsers(){
        $this->users = User::role(['TI','Administrador','Vendedor'])->get();
    }

    public function store(){

        $this->validate([
            'user_id' => 'required',
            'initial' => 'required|numeric|between:0,99999999999.99'
        ]);

        $exists = SalCash::where('state',true)->where('user_id',$this->user_id)->exists();

        if(!$exists){
            $cash = SalCash::create([
                'user_id' => $this->user_id,
                'date_opening' => Carbon::now()->format('Y-m-d'),
                'time_opening' => Carbon::now()->format('H:i:s'),
                'beginning_balance' => $this->initial,
                'reference_number' => $this->reference
            ]);

            $userActivity = new Activity;
            $userActivity->causedBy(Auth::user());
            $userActivity->routeOn(route('sales_administration_cash'));
            $userActivity->componentOn('sales::cash.cash-modal-form');
            $userActivity->log(Lang::get('labels.successfully_registered'));
            $userActivity->dataOld($cash);
            $userActivity->logType('create');
            $userActivity->modelOn(Cash::class,$cash->id);
            $userActivity->save();

            $this->initial = 0;
            $this->reference = null;
            $this->emit('listCashReset');
            $this->dispatchBrowserEvent('response_store_cash_event', ['message' => Lang::get('labels.successfully_registered'),'title'=>Lang::get('labels.congratulations'),'icon'=>'success']);
        }else{
            $this->dispatchBrowserEvent('response_store_cash_event', ['message' => 'Debe cerrar primero la caja aperturada para este usuario','title'=>Lang::get('labels.cant_continue'),'icon'=>'info']);
        }
    }

    public function updateCash($cash_id){
        $this->cash_id = $cash_id;
        $cash = SalCash::find($cash_id);
        $this->title = 'Editar Caja chica';
        $this->user_id = $cash->user_id;
        $this->initial = $cash->beginning_balance;
        $this->reference = $cash->reference_number;

        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_administration_cash'));
        $userActivity->componentOn('sales::cash.cash-modal-form');
        $userActivity->log('abrió el modal Editar caja chica en market');
        $userActivity->save();
    }

    public function newCash(){
        $this->title = 'Aperturar Caja chica';
        $this->cash_id = null;
        $this->user_id = Auth::id();
        $this->initial = 0;
        $this->reference = null;

        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_administration_cash'));
        $userActivity->componentOn('sales::cash.cash-modal-form');
        $userActivity->log('abrió el modal Aperturar caja chica en market');
        $userActivity->save();

    }

    public function update(){

        $this->validate([
            'user_id' => 'required',
            'initial' => 'required|numeric|between:0,99999999999.99'
        ]);
        
        $cash_old = SalCash::find($this->cash_id);

        SalCash::find($this->cash_id)->update([
            'user_id'       => $this->user_id,
            'date_opening'  => Carbon::now()->format('Y-m-d'),
            'time_opening'  => Carbon::now()->format('H:i:s'),
            'beginning_balance' => $this->initial,
            'reference_number'  => $this->reference
        ]);

        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_administration_cash'));
        $userActivity->componentOn('sales::cash.cash-modal-form');
        $userActivity->log(Lang::get('labels.was_successfully_updated'));
        $userActivity->dataOld($cash_old);
        $userActivity->dataUpdated(SalCash::find($this->cash_id));
        $userActivity->logType('update');
        $userActivity->modelOn(SalCash::class,$cash_old->id);
        $userActivity->save();

        $this->emit('listCashReset');

        $this->dispatchBrowserEvent('response_store_cash_event', ['message' => Lang::get('labels.was_successfully_updated'),'title'=>Lang::get('labels.congratulations'),'icon' => 'success']);

    }
}
