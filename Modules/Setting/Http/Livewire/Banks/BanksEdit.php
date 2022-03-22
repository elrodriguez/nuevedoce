<?php

namespace Modules\Setting\Http\Livewire\Banks;

use App\Models\Bank;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class BanksEdit extends Component
{
    public $description;
    public $bank;

    public function mount($bank_id){
        $this->bank = Bank::find($bank_id);
        $this->description = $this->bank->description;
    }

    public function render()
    {
        return view('setting::livewire.banks.banks-edit');
    }

    public function save(){

        $this->validate([
            'description' => 'required'
        ]);

        $this->bank->update([
            'description' => $this->description
        ]);

        $this->dispatchBrowserEvent('set-bank-save', ['msg' => Lang::get('setting::labels.msg_update')]);
    }
}
