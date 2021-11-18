<?php

namespace Modules\Inventory\Http\Livewire\Purchase;

use Livewire\Component;
use App\Models\DocumentType;
use App\Models\Person;
use Carbon\Carbon;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvLocation;
use Modules\Inventory\Entities\InvPurchase;
use Modules\Inventory\Entities\InvPurchaseItem;
use Modules\Setting\Entities\SetEstablishment;

class PurchaseEdit extends Component
{
    public $id_purchase;
    public $purchase_search;
    public $document_type_id;
    public $date_of_issue;
    public $serie;
    public $number;
    public $total;
    public $supplier_id;

    public $items = [];
    public $suppliers = [];
    public $document_types = [];
    public $establishments = [];
    public $stores = [];

    public $item_id;
    public $item_text;
    public $item_amount = 1;
    public $item_price;
    public $establishment_id;
    public $store_id;

    public $search_item_edit;
    public $btn_save_item = false;

    public function mount($purchase_id){
        $this->id_purchase = $purchase_id;
        $this->document_types = DocumentType::whereIn('id',['01','03','GU75'])
            ->select(
                'id',
                'description'
            )
            ->get();

        $this->suppliers = Person::where('identity_document_type_id', '=', '6')
            ->select(
                'id',
                'full_name'
            )
            ->get();

        $this->establishments = SetEstablishment::where('state',true)
            ->select(
                'id',
                'name'
            )
            ->get();

        $this->purchase_search = InvPurchase::find($purchase_id);
        $this->document_type_id = $this->purchase_search->document_type_id;

        $date_issue = null;
        if($this->purchase_search->date_of_issue){
            list($Y,$m,$d) = explode('-', $this->purchase_search->date_of_issue);
            $date_issue = $d.'/'.$m.'/'. $Y;
        }

        $this->date_of_issue = $date_issue;
        $this->serie = $this->purchase_search->serie;
        $this->number = $this->purchase_search->number;
        $this->total = $this->purchase_search->total;
        $this->supplier_id = $this->purchase_search->supplier_id;
        $this->getPurchaseItem();

        if(count($this->items) > 0){
            $kardex_data = InvKardex::where('kardexable_id', '=', $this->id_purchase)
                ->where('item_id', '=', $this->items[0]->item_id)
                ->get();
            foreach ($kardex_data as $row){
                $this->establishment_id = $row->establishment_id;
                $this->store_id = $row->location_id;
                break;
            }
        }
        $this->getStores();
    }

    public function getStores(){
        $this->stores = InvLocation::where('establishment_id',$this->establishment_id)
            ->where('state', true)->get();
    }

    public function getPurchaseItem(){
        $this->items = InvPurchaseItem::where('purchase_id', '=', $this->purchase_search->id)
            ->join('inv_items', 'inv_purchase_items.item_id', 'inv_items.id')
            ->select(
                'inv_purchase_items.id',
                'inv_purchase_items.quantity AS amount',
                'inv_purchase_items.price',
                'inv_items.name AS item_text',
                'inv_purchase_items.item_id'
            )
            ->get();
    }

    public function render(){
        $this->getPurchaseItem();
        return view('inventory::livewire.purchase.purchase-edit');
    }

    public function save(){
        $this->validate([
            'supplier_id' => 'required',
            'document_type_id' => 'required',
            'date_of_issue' => 'required',
            'serie' => 'required|min:3|max:255',
            'number' => 'required|integer|between:1,9999999999',
            'total' => 'required|between:0,99999.99',
            'establishment_id' => 'required',
            'store_id' => 'required'
        ]);

        $date_issue = null;
        if($this->date_of_issue){
            list($d,$m,$y) = explode('/', $this->date_of_issue);
            $date_issue = $y.'-'.$m.'-'. $d;
        }

        $activity = new Activity;
        $activity->dataOld(InvPurchase::find($this->purchase_search->id));

        $this->purchase_search->update([
            'document_type_id'  => $this->document_type_id,
            'date_of_issue'     => $date_issue,
            'serie'             => $this->serie,
            'number'            => $this->number,
            'total'             => $this->total,
            'supplier_id'       => $this->supplier_id,
            'person_edit'       => Auth::user()->person_id
        ]);

        $activity->modelOn(InvPurchase::class, $this->purchase_search->id,'inv_purchases');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_purchase_edit', $this->purchase_search->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->purchase_search);
        $activity->log('Se actualizó datos de la Compra');
        $activity->save();

        $this->dispatchBrowserEvent('inv-purchase-edit', ['msg' => Lang::get('inventory::labels.msg_update')]);
    }

    public function saveItem(){
        $this->validate([
            'item_text'         => 'required|min:3',
            'item_id'           => 'required',
            'item_amount'       => 'required|integer|between:1,99999',
            'item_price'        => 'required|between:0,99999.99',
            'establishment_id'  => 'required',
            'store_id'          => 'required'
        ]);

        $data_exist  = InvPurchaseItem::where('purchase_id', $this->id_purchase)
            ->where('item_id', $this->item_id)->get();

        if(count($data_exist) == 0){
            InvPurchaseItem::create([
                'purchase_id'   => $this->id_purchase,
                'item_id'       => $this->item_id,
                'quantity'      => $this->item_amount,
                'price'         => $this->item_price,
                'person_create' => Auth::user()->person_id
            ]);

            $date_issue = null;
            if($this->date_of_issue){
                list($d,$m,$y) = explode('/', $this->date_of_issue);
                $date_issue = $y.'-'.$m.'-'. $d;
            }

            InvKardex::create([
                'date_of_issue'     => $date_issue,
                'establishment_id'  => $this->establishment_id,
                'location_id'       => $this->store_id,
                'item_id'           => $this->item_id,
                'quantity'          => $this->item_amount,
                'kardexable_id'     => $this->id_purchase,
                'kardexable_type'   => InvPurchase::class,
                'detail'            => 'Compra'
            ]);

            $this->getPurchaseItem();

            $this->item_id = null;
            $this->item_text = null;
            $this->item_amount = 1;
            $this->item_price = null;

            $this->dispatchBrowserEvent('inv-purchase-edit', ['msg' => Lang::get('inventory::labels.msg_success')]);
        }else{
            $this->dispatchBrowserEvent('inv-purchase-edit-not', ['msg' => Lang::get('inventory::labels.msg_0009')]);
        }
    }

    public function saveEditItem(){
        $this->validate([
            'item_text'         => 'required|min:3',
            'item_id'           => 'required',
            'item_amount'       => 'required|between:0,99999.99',
            'item_price'        => 'required|between:0,99999.99',
            'establishment_id'  => 'required',
            'store_id'          => 'required'
        ]);

        //Creamon un nuevo registro en el Kardex en negativo con la cantidad anterior
        $kardex_search = InvKardex::where('kardexable_id', '=', $this->id_purchase)
            ->where('kardexable_type', '=', InvPurchase::class)
            ->where('item_id', '=', $this->search_item_edit->item_id)
            ->first();

        InvKardex::create([
            'date_of_issue'     => $kardex_search->date_of_issue,
            'establishment_id'  => $kardex_search->establishment_id,
            'location_id'       => $kardex_search->location_id,
            'item_id'           => $kardex_search->item_id,
            'quantity'          => -(InvPurchaseItem::find($this->search_item_edit->id)->quantity),
            'kardexable_id'     => $kardex_search->kardexable_id,
            'kardexable_type'   => $kardex_search->kardexable_type,
            'detail'            => 'Cantidad Corregida'
        ]);

        //Guardar el item editado
        $this->search_item_edit->update([
            'purchase_id'   => $this->id_purchase,
            'item_id'       => $this->item_id,
            'quantity'      => $this->item_amount,
            'price'         => $this->item_price,
            'person_edit'   => Auth::user()->person_id
        ]);

        $date_issue = null;
        if($this->date_of_issue){
            list($d,$m,$y) = explode('/', $this->date_of_issue);
            $date_issue = $y.'-'.$m.'-'. $d;
        }

        InvKardex::create([
            'date_of_issue'     => $date_issue,
            'establishment_id'  => $this->establishment_id,
            'location_id'       => $this->store_id,
            'item_id'           => $this->item_id,
            'quantity'          => $this->item_amount,
            'kardexable_id'     => $this->id_purchase,
            'kardexable_type'   => InvPurchase::class,
            'detail'            => 'Cantidad Corregida'
        ]);

        $this->getPurchaseItem();

        $this->item_id = null;
        $this->item_text = null;
        $this->item_amount = 1;
        $this->item_price = null;
        $this->btn_save_item = false;

        $this->dispatchBrowserEvent('inv-purchase-edit', ['msg' => Lang::get('inventory::labels.msg_update')]);
    }

    public function editItem($id){
        $this->search_item_edit = InvPurchaseItem::where('inv_purchase_items.id', '=', $id)
            ->join('inv_items', 'inv_purchase_items.item_id', 'inv_items.id')
            ->select(
                'inv_purchase_items.id',
                'inv_purchase_items.quantity AS amount',
                'inv_purchase_items.price',
                'inv_items.name AS item_text',
                'inv_purchase_items.item_id'
            )
            ->get();
        $id_item_search = 0;
        foreach ($this->search_item_edit as $row){
            $id_item_search = $row->id;
            $this->item_id = $row->item_id;
            $this->item_text = $row->item_text;
            $this->item_amount = $row->amount;
            $this->item_price = $row->price;
        }
        $this->search_item_edit = InvPurchaseItem::find($id_item_search);
        $this->btn_save_item = true;
     }

    public function deleteItem($id){
        $item_purchase = InvPurchaseItem::find($id);

        $kardex_search = InvKardex::where('kardexable_id', '=', $this->id_purchase)
            ->where('kardexable_type', '=', InvPurchase::class)
            ->where('item_id', '=', $item_purchase->item_id)
            ->first();

        InvKardex::create([
            'date_of_issue'     => $kardex_search->date_of_issue,
            'establishment_id'  => $kardex_search->establishment_id,
            'location_id'       => $kardex_search->location_id,
            'item_id'           => $kardex_search->item_id,
            'quantity'          => -($kardex_search->quantity),
            'kardexable_id'     => $kardex_search->kardexable_id,
            'kardexable_type'   => $kardex_search->kardexable_type,
            'detail'            => 'Anulación Compra'
        ]);

        $item_purchase->delete();
        $this->getPurchaseItem();
        $this->dispatchBrowserEvent('inv-purchase-edit', ['msg' => Lang::get('inventory::labels.msg_delete')]);
    }
}
