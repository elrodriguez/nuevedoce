<?php

namespace Modules\Inventory\Http\Livewire\Location;

use Livewire\Component;
use Modules\Inventory\Entities\InvLocation;

class LocationQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = InvLocation::count();
    }

    public function render()
    {
        return view('inventory::livewire.location.location-quantity');
    }
}
