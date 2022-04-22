<?php

namespace Modules\Inventory\Http\Livewire\Movements;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvLocation;

class MovementsTransferModal extends Component
{
    protected $listeners = ['openModalTransferInventory' => 'openModalTransfer'];
    public $item_id;
    public $item_name;
    public $location_id;
    public $location_name;
    public $item;
    public $location_new_id;
    public $reason_transfer;
    public $stock;
    public $quantity_move;
    public $asset;
    public $warehouses = [];
    public $location;

    public function render()
    {
        return view('inventory::livewire.movements.movements-transfer-modal');
    }

    public function openModalTransfer($item_id,$location_id){
        $this->item = InvItem::find($item_id);
        $this->asset = InvAsset::where('item_id',$item_id)->where('location_id',$location_id)->first();
        $this->stock = $this->asset->stock;
        $this->item_name = $this->item->name;
        $this->item_id = $item_id;
        $this->location_id = $location_id;
        $this->location = InvLocation::find($location_id);
        $this->location_name = $this->location->name;

        $this->warehouses = InvLocation::where('id','<>',$location_id)
                            ->where('state',true)
                            ->get();
        $this->dispatchBrowserEvent('open-movements-transfer-modal', ['success' => true]);
    }

    public function saveMovementTransfer(){

        $this->validate([
            'item_id' => 'required',
            'location_id' => 'required',
            'location_new_id' => 'required',
            'stock' => 'required',
            'quantity_move' => 'required',
            'reason_transfer' => 'required|max:255'
        ]);

        if($this->location_id === $this->location_new_id) {
            $msg = 'El almacén destino no puede ser igual al de origen';
            $this->dispatchBrowserEvent('inv-movements-transfer-alert-error', ['msg' => $msg]);
        }else{
            if($this->stock < $this->quantity_move) {
                $msg = 'La cantidad a trasladar no puede ser mayor al que se tiene en el almacén.';
                $this->dispatchBrowserEvent('inv-movements-transfer-alert-error', ['msg' => $msg]);
            }else{
                $this->asset->decrement('stock', $this->quantity_move);
                $asset_new = InvAsset::where('item_id',$this->item_id)->where('location_id',$this->location_new_id)->first();
                $location_new = InvLocation::find($this->location_new_id);

                if($asset_new){
                    $asset_new->increment('stock', $this->quantity_move);
                }else{
                    InvAsset::create([
                        'item_id' => $this->item_id,
                        'state' => true,
                        'person_create' => Auth::user()->person_id,
                        'location_id' => $this->location_new_id,
                        'stock' => $this->quantity_move
                    ]);
                }                

                InvKardex::create([
                    'date_of_issue' => Carbon::now()->format('Y-m-d'),
                    'establishment_id' => $this->location->establishment_id,
                    'item_id' => $this->item_id,
                    'quantity' => -($this->quantity_move),
                    'detail' => 'Traslado - '.$this->reason_transfer,
                    'location_id' => $this->location_id
                ]);

                InvKardex::create([
                    'date_of_issue' => Carbon::now()->format('Y-m-d'),
                    'establishment_id' => $location_new->establishment_id,
                    'item_id' => $this->item_id,
                    'quantity' => $this->quantity_move,
                    'detail' => 'Traslado - '.$this->reason_transfer,
                    'location_id' => $this->location_new_id
                ]);
    
                $this->reason_transfer = null;
                $this->location_new_id = null;
                $this->quantity_move = null;
    
                $this->emit('invItemsList');
                $this->dispatchBrowserEvent('inv-transfer-save', ['msg' => Lang::get('labels.successfully_registered')]);
            }
        }
    }
}
