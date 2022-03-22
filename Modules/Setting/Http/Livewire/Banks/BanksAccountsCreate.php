<?php

namespace Modules\Setting\Http\Livewire\Banks;

use App\Models\Bank;
use App\Models\BankAccount;
use App\Models\CurrencyType;
use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class BanksAccountsCreate extends Component
{
    public $banks = [];
    public $currency_types = [];
    public $bank_id;
    public $coin_id;
    public $description;
    public $number;

    public function mount(){
        $this->banks = Bank::all();
        $this->currency_types = CurrencyType::all();
    }
    public function render()
    {
        return view('setting::livewire.banks.banks-accounts-create');
    }

    public function save(){
        $this->validate([
            'bank_id' => 'required',
            'coin_id' => 'required',
            'description' => 'required|string|max:255',
            'number' => 'required|string|max:255'
        ]);

        $account = BankAccount::create([
            'bank_id' => $this->bank_id,
            'description' => $this->description,
            'number' => $this->number,
            'currency_type_id' => $this->coin_id
        ]);

        $activity = new Activity;
        $activity->modelOn(BankAccount::class, $account->id,'bank_accounts');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_banks_accounts_create'));
        $activity->logType('create');
        $activity->log('Se creó una nueva cuenta de banco');
        $activity->save();

        $this->bank_id = null;
        $this->description = null;
        $this->number = null;
        $this->coin_id = null;
        $this->dispatchBrowserEvent('set-bank-account-save', ['msg' => Lang::get('setting::labels.msg_success')]);
    }
}
