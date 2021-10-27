<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Modules\TransferService\Entities\SerVehicle;

class LoadorderCreate extends Component
{
    public $vehicles = [];
    public $vehicle_id;
    public $vehicle_load;

    public function mount(){
        $this->vehicles = SerVehicle::where('state',true)->get();
    }

    public function render()
    {
        return view('transferservice::livewire.loadorder.loadorder-create');
    }
}
