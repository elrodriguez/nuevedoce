<?php

namespace Modules\Inventory\Http\Livewire\Movements;

use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvLocation;

class MovementsRemoveModal extends Component
{
    protected $listeners = ['openModalRemoveInventory' => 'openModalRemove'];

    public $item_id;
    public $item_name;
    public $location_id;
    public $location_name;
    public $item;
    public $current_amount;
    public $quantity_remove;
    public $asset;
    public $location;

    public function render()
    {
        return view('inventory::livewire.movements.movements-remove-modal');
    }

    public function openModalRemove($item_id,$location_id){

        $this->item = InvItem::find($item_id);
        $this->asset = InvAsset::where('item_id',$item_id)->where('location_id',$location_id)->first();
        $this->current_amount = $this->asset->stock;
        $this->item_name = $this->item->name;
        $this->item_id = $item_id;
        $this->location_id = $location_id;
        $this->location = InvLocation::find($location_id);
        $this->location_name = $this->location->name;
        
        $this->dispatchBrowserEvent('open-movements-remove-modal', ['success' => true]);
    }

    public function saveMovementRemove(){
        $this->validate([
            'item_id' => 'required',
            'location_id' => 'required',
            'current_amount' => 'required',
            'quantity_remove' => 'required'
        ]);

        if($this->current_amount < $this->quantity_remove) {
            $msg = 'La cantidad a retirar no puede ser mayor al que se tiene en el almacén.';
            $this->dispatchBrowserEvent('inv-movements-remove-alert-error', ['msg' => $msg]);
        }else{
            $this->asset->decrement('stock', $this->quantity_remove);
            $this->item->decrement('stock',$this->quantity_remove);

            InvKardex::create([
                'date_of_issue' => Carbon::now()->format('Y-m-d'),
                'establishment_id' => $this->location->establishment_id,
                'item_id' => $this->item_id,
                'quantity' => -($this->quantity_remove),
                'detail' => 'Retirar',
                'location_id' => $this->location_id
            ]);

            $this->quantity_remove = null;

            $this->emit('invItemsList');
            $this->dispatchBrowserEvent('inv-remove-save', ['msg' => Lang::get('labels.successfully_registered')]);
        }

    }
}
