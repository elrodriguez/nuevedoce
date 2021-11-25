<?php

namespace Modules\Inventory\Http\Livewire\Item;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Inventory\Entities\InvKardex;

class ItemNumberMovements extends Component
{
    public $items_input;
    public $items_output;

    public function mount(){
        $data = InvKardex::select(
                    DB::raw('sum( case when quantity > 0 then quantity end) as  imput'),
                    DB::raw('sum( case when quantity < 0 then quantity end) as  output')   
                )->first();
        $this->items_input = $data->imput;
        $this->items_output = $data->output;
    }

    public function render()
    {
        return view('inventory::livewire.item.item-number-movements');
    }
}
