<?php

namespace Modules\Setting\Http\Livewire\Establishment;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetEstablishment;

class EstablishmentEdit extends Component
{
    public $address;
    public $phone;
    public $email;
    public $establishment;

    public function mount($establishment_id){
        $this->establishment = SetEstablishment::find($establishment_id);
        $this->address = $this->establishment->address;
        $this->email = $this->establishment->email;
        $this->phone = $this->establishment->phone;
    }
    public function render()
    {
        return view('setting::livewire.establishment.establishment-edit');
    }

    public function save(){

        $this->validate([
            'address' => 'required|max:255'
        ]);

        $this->establishment->update([
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
        $this->dispatchBrowserEvent('set-establishmente-update', ['msg' => Lang::get('setting::labels.msg_update')]);
    }
}
