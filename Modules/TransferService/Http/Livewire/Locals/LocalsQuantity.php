<?php

namespace Modules\TransferService\Http\Livewire\Locals;

use Livewire\Component;
use Modules\TransferService\Entities\SerLocal;

class LocalsQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = SerLocal::count();
    }

    public function render()
    {
        return view('transferservice::livewire.locals.locals-quantity');
    }
}
