<?php

namespace Modules\Inventory\Http\Livewire\Brand;

use Livewire\Component;
use Modules\Inventory\Entities\InvBrand;

class BrandQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = InvBrand::count();
    }

    public function render()
    {
        return view('inventory::livewire.brand.brand-quantity');
    }
}
