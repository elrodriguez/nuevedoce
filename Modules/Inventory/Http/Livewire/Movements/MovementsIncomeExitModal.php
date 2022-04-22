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
use Modules\Inventory\Entities\InvTransaction;
use Modules\Setting\Entities\SetEstablishment;

class MovementsIncomeExitModal extends Component
{
    public $title;
    public $product_id;
    public $warehouse_id;
    public $reason_id;
    public $warehouses = [];
    public $transactions = [];
    public $quantity = 1;
    public $type;

    protected $listeners = ['openMovementsModalIncomeExit' => 'openModalIncomeExit'];

    public function render()
    {
        return view('inventory::livewire.movements.movements-income-exit-modal');
    }

    public function mount(){
        $this->warehouses = InvLocation::where('state',true)->get();
    }

    public function openModalIncomeExit($i){
        if($i == 1){
            $this->type = 'input';
            $this->title = Lang::get('labels.entry');
            $this->transactions = InvTransaction::where('type','input')->get();
        }else{
            $this->title = Lang::get('labels.exit');
            $this->type = 'output';
            $this->transactions = InvTransaction::where('type','output')->get();
        }
        $this->dispatchBrowserEvent('open-movements-income-exit-modal', ['success' => true]);
    }

    public function saveMovement(){

        $this->validate([
            'product_id' => 'required',
            'warehouse_id' => 'required',
            'reason_id' => 'required',
            'quantity' => 'required', 
        ]);

        $locations = InvLocation::find($this->warehouse_id);
        $product = InvItem::find($this->product_id);
        $asset = InvAsset::where('item_id',$this->product_id)
            ->where('location_id',$this->warehouse_id)
            ->first();

        if($asset){
            if($this->type == 'input'){
                $asset->increment('stock', $this->quantity);
                $product->increment('stock',$this->quantity);
            }else{
                if($this->quantity <= $asset->stock){
                    $asset->decrement('stock', $this->quantity);
                    $product->decrement('stock',$this->quantity);
                }
            }
        }else{
            if($this->type == 'input'){
                $asset = InvAsset::create([
                    'item_id' => $this->product_id,
                    'state' => true,
                    'person_create' => Auth::user()->person_id,
                    'location_id' => $this->warehouse_id,
                    'stock' => $this->quantity
                ]);
                $product->increment('stock',$this->quantity);
            }else{
                $asset = InvAsset::create([
                    'item_id' => $this->product_id,
                    'state' => true,
                    'person_create' => Auth::user()->person_id,
                    'location_id' => $this->warehouse_id,
                    'stock' => 0
                ]);
            }
        }

        $transaction = InvTransaction::findOrFail($this->reason_id);

        if($this->type == 'output' && ($this->quantity > $asset->stock)) {

            $msg = 'La cantidad no puede ser mayor a la que se tiene en el almacén.';
            $this->dispatchBrowserEvent('output-transaction-error', ['msg' => $msg]);
            
        }else{

            InvKardex::create([
                'date_of_issue' => Carbon::now()->format('Y-m-d'),
                'establishment_id' => $locations->establishment_id,
                'item_id' => $this->product_id,
                'kardexable_id' => $transaction->id,
                'kardexable_type' => InvTransaction::class,
                'quantity' => ($this->type == 'output' ? -($this->quantity) : $this->quantity),
                'detail' => $transaction->description,
                'location_id' => $this->warehouse_id
            ]);

            $this->product_id = null;
            $this->type = null;
            $this->quantity = null;
            $this->warehouse_id = null;

            $this->emit('invItemsList');
            $this->dispatchBrowserEvent('inv-transaction-save', ['msg' => Lang::get('labels.successfully_registered')]);
        }
       
    }
}
