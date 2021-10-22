<?php

namespace Modules\Setting\Http\Livewire\Establishment;

use Livewire\Component;
use Modules\Setting\Entities\SetEstablishment;

class EstablishmentQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = SetEstablishment::count();
    }
    public function render()
    {
        return view('setting::livewire.establishment.establishment-quantity');
    }
}
