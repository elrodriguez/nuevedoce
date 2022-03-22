<?php

namespace Modules\Setting\Http\Livewire\Banks;

use App\Models\Bank;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class BanksCreate extends Component
{
    public $description;

    public function render()
    {
        return view('setting::livewire.banks.banks-create');
    }

    public function save(){

        $this->validate([
            'description' => 'required'
        ]);

        Bank::create([
            'description' => $this->description
        ]);

        $this->description = null;
        $this->dispatchBrowserEvent('set-bank-save', ['msg' => Lang::get('setting::labels.msg_success')]);
    }
    
}
