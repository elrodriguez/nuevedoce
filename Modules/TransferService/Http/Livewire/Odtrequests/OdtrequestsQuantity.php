<?php

namespace Modules\TransferService\Http\Livewire\Odtrequests;

use Livewire\Component;
use Modules\TransferService\Entities\SerOdtRequest;

class OdtrequestsQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = SerOdtRequest::count();
    }

    public function render()
    {
        return view('transferservice::livewire.odtrequests.odtrequests-quantity');
    }
}
