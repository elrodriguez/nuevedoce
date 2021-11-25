<?php

namespace Modules\Inventory\Http\Livewire\Category;

use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;

class CategoryQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = InvCategory::count();
    }

    public function render()
    {
        return view('inventory::livewire.category.category-quantity');
    }
}
