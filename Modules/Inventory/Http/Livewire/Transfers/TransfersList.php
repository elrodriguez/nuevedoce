<?php

namespace Modules\Inventory\Http\Livewire\Transfers;

use Livewire\Component;
use Modules\Inventory\Entities\InvTransfer;


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
        return InvTransfer::join('inv_locations AS origin', 'warehouse_id', 'origin.id')
            ->join('inv_locations AS destination', 'warehouse_destination_id', 'destination.id')
            ->select(
                'inv_transfers.id',
                'inv_transfers.created_at',
                'origin.name AS origin_name',
                'destination.name AS destination_name',
                'inv_transfers.description',
                'inv_transfers.quantity'
            )
            ->where('description', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'DESC')
            ->paginate($this->show);
    }
}
