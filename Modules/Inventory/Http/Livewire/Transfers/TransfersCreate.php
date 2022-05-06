<?php

namespace Modules\Inventory\Http\Livewire\Transfers;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvLocation;

class TransfersCreate extends Component
{
    public $product_id;
    public $warehouse_id;
    public $destination_warehouse_id;
    public $quantity;
    public $quantity_move = 0;
    public $warehouses;
    public $warehouse_description;
    public $product_description;
    public $detail;
    public $products = [];

    public function render()
    {
        $this->warehouses = InvLocation::join('set_establishments', 'inv_locations.establishment_id', 'set_establishments.id')
            ->select(
                'inv_locations.id',
                'set_establishments.name',
                'inv_locations.name AS description'
            )
            ->get();
        return view('inventory::livewire.transfers.transfers-create');
    }

    public function addProduct($id)
    {
        $this->validate([
            'warehouse_id' => 'required'
        ]);

        $item  = InvAsset::join('inv_items', 'inv_assets.item_id', 'inv_items.id')
            ->where('location_id', $this->warehouse_id)
            ->where('item_id', $id)
            ->select(
                'inv_items.id',
                DB::raw('CONCAT(inv_items.name,IF(inv_items.description IS NOT NULL,CONCAT(" - ",inv_items.description),"")) AS name'),
                'inv_assets.stock'
            )
            ->first();

        array_push(
            $this->products,
            [
                'id' => $item->id,
                'description' => $item->name,
                'stock' => $item->stock,
                'quantity' => 1
            ]
        );
    }
    public function store()
    {

        $this->validate([
            'warehouse_id' => 'required',
            'destination_warehouse_id' => 'required'
        ]);

        if ($this->warehouse_id === $this->destination_warehouse_id) {
            $pass = false;
            $title = 'Error';
            $icon = 'error';
            $msg = 'El almacén destino no puede ser igual al de origen';
        }

        $inventoriestransfer = InventoriesTransf::create([
            'description' => $this->detail,
            'warehouse_id' => $this->warehouse_id,
            'warehouse_destination_id' => $this->destination_warehouse_id,
            'quantity' =>  count($this->products),
        ]);

        $inventory = null;

        foreach ($this->products as $key => $product) {

            if ($product['stock'] > $product['quantity']) {
                $inventory = Inventory::create([
                    'type' => 2,
                    'description' => 'Traslado',
                    'item_id' => $product['id'],
                    'warehouse_id' => $this->warehouse_id,
                    'warehouse_destination_id' => $this->destination_warehouse_id,
                    'quantity' => $product['quantity'],
                    'detail' => $this->detail,
                    'inventories_transfer_id' => $inventoriestransfer->id
                ]);

                $itemwarehouse_destination = ItemWarehouse::where('item_id', '=', $product['id'])
                    ->where('warehouse_id', '=', $this->destination_warehouse_id)
                    ->first();

                if ($itemwarehouse_destination) {
                    $itemwarehouse_destination->increment('stock', $product['quantity']);
                } else {
                    ItemWarehouse::create([
                        'item_id' => $product['id'],
                        'warehouse_id' => $this->destination_warehouse_id,
                        'stock' => $product['quantity']
                    ]);
                }

                ItemWarehouse::where('item_id', '=', $product['id'])
                    ->where('warehouse_id', '=', $this->warehouse_id)
                    ->decrement('stock', $product['quantity']);

                InventoryKardex::create([
                    'date_of_issue' => Carbon::now()->format('Y-m-d'),
                    'item_id' => $product['id'],
                    'inventory_kardexable_id' => $inventory->id,
                    'inventory_kardexable_type' => Inventory::class,
                    'warehouse_id' => $this->warehouse_id,
                    'quantity' => (-$product['quantity'])
                ]);

                InventoryKardex::create([
                    'date_of_issue' => Carbon::now()->format('Y-m-d'),
                    'item_id' => $product['id'],
                    'inventory_kardexable_id' => $inventory->id,
                    'inventory_kardexable_type' => Inventory::class,
                    'warehouse_id' => $this->destination_warehouse_id,
                    'quantity' => $product['quantity']
                ]);
            }
        }

        if ($inventory) {
            $title = Lang::get('messages.congratulations');
            $icon = 'success';
            $msg = 'Traslado creado con éxito';

            $user = Auth::user();
            $activity = new Activity;
            $activity->modelOn(Inventory::class, $inventory->id);
            $activity->causedBy($user);
            $activity->routeOn(route('inventory_transfers_create'));
            $activity->componentOn('inventory::transfers.transfers-create');
            $activity->dataOld($inventory);
            $activity->logType('transfer');
            $activity->log($msg);
            $activity->save();
        }
        $this->dispatchBrowserEvent('response_transfer_store', ['message' => $msg, 'title' => $title, 'icon' => $icon]);
    }

    public function removeProduct($key)
    {
        unset($this->products[$key]);
    }
}
