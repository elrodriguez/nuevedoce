<?php

namespace Modules\Inventory\Http\Livewire\Purchase;

use Livewire\Component;
use Modules\Inventory\Entities\InvPurchase;

class PurchaseQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = InvPurchase::count();
    }

    public function render()
    {
        return view('inventory::livewire.purchase.purchase-quantity');
    }
}
