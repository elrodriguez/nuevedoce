<?php

namespace Modules\Inventory\Http\Livewire\Item;

use Livewire\Component;
use Modules\Inventory\Entities\InvItem;

class ItemQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = InvItem::count();
    }

    public function render()
    {
        return view('inventory::livewire.item.item-quantity');
    }
}
