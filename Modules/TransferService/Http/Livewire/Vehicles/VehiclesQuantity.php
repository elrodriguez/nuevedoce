<?php

namespace Modules\TransferService\Http\Livewire\Vehicles;

use Livewire\Component;
use Modules\TransferService\Entities\SerVehicle;

class VehiclesQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = SerVehicle::count();
    }

    public function render()
    {
        return view('transferservice::livewire.vehicles.vehicles-quantity');
    }
}
