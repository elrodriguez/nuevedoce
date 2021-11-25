<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Livewire\Component;
use Modules\Inventory\Entities\InvAsset;

class AssetQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = InvAsset::count();
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-quantity');
    }
}
