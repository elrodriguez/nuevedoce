<?php

namespace Modules\Inventory\Http\Livewire\Transfers;

use Livewire\Component;

class TransfersList extends Component
{
    public $show;
    public $search;

    public function render()
    {
        return view('inventory::livewire.transfers.transfers-list', ['transfers' => $this->getTransfers()]);
    }

    public function getTransfers()
    {
        return [];
    }
}
