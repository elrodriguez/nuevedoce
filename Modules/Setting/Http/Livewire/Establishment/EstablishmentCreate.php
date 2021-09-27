<?php

namespace Modules\Setting\Http\Livewire\Establishment;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetEstablishment;

class EstablishmentCreate extends Component
{
    public $address;
    public $phone;
    public $email;

    public function render()
    {
        return view('setting::livewire.establishment.establishment-create');
    }

    public function save(){

        $this->validate([
            'address' => 'required|max:255'
        ]);

        SetEstablishment::create([
            'address' => $this->address,
            'phone' => $this->phone,
            'observation' => 'dese',
            'company_id',
            'country_id',
            'department_id',
            'province_id',
            'district_id',
            'web_page' => 'dese',
            'email' => $this->email,
            'map' => 'ddd'
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-establishmente-save', ['msg' => Lang::get('setting::labels.msg_success')]);
    }

    public function clearForm(){
        $this->address = null;
        $this->email = null;
        $this->phone = null;
    }
}
