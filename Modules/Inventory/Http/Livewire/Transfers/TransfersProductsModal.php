<?php

namespace Modules\Inventory\Http\Livewire\Transfers;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvTransfer;

class TransfersProductsModal extends Component
{
    protected $listeners = ['openModalProductsTransfer' => 'openModalProducts'];

    public $products = [];

    public function render()
    {
        return view('inventory::livewire.transfers.transfers-products-modal');
    }

    public function openModalProducts($id)
    {
        $this->products = InvKardex::join('inv_items', 'item_id', 'inv_items.id')
            ->select(
                DB::raw('CONCAT(inv_items.name,IF(inv_items.description IS NOT NULL,CONCAT(" - ",inv_items.description),"")) AS name'),
                'inv_kardexes.quantity'
            )
            ->where('kardexable_id', $id)
            ->where('kardexable_type', InvTransfer::class)
            ->get();

        $this->dispatchBrowserEvent('open-modal-products-transfer', ['success' => true]);
    }
}
