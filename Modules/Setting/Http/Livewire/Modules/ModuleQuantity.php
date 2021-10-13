<?php

namespace Modules\Setting\Http\Livewire\Modules;

use Livewire\Component;
use Modules\Setting\Entities\SetModule;

class ModuleQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = SetModule::count();
    }

    public function render()
    {
        return view('setting::livewire.modules.module-quantity');
    }
}
