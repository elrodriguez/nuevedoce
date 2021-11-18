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

class PurchaseCreate extends Component
{
    public $document_type_id = 'GU75';
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

    public function mount(){
        $this->document_types = DocumentType::where('active',true)
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
                'observation'
            )
            ->get();

        $this->getStores();
    }

    public function getStores(){
        $this->stores = InvLocation::where('establishment_id',$this->establishment_id)
            ->where('state', true)->get();
    }

    public function render()
    {
        return view('inventory::livewire.purchase.purchase-create');
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

        $purchase_save = InvPurchase::create([
            'document_type_id'  => $this->document_type_id,
            'date_of_issue'     => $date_issue,
            'serie'             => $this->serie,
            'number'            => $this->number,
            'total'             => $this->total,
            'supplier_id'       => $this->supplier_id,
            'person_create'     => Auth::user()->person_id
        ]);

        #Save items
        if(count($this->items) > 0){
            foreach ($this->items as $row){
                InvPurchaseItem::create([
                    'purchase_id'   => $purchase_save->id,
                    'item_id'       => $row['item_id'],
                    'quantity'      => $row['amount'],
                    'price'         => $row['price'],
                    'person_create' => Auth::user()->person_id
                ]);

                InvKardex::create([
                    'date_of_issue'     => Carbon::now()->format('Y-m-d'),
                    'establishment_id'  => $this->establishment_id,
                    'location_id'       => $this->store_id,
                    'item_id'           => $row['item_id'],
                    'quantity'          => $row['amount'],
                    'kardexable_id'     => $purchase_save->id,
                    'kardexable_type'   => InvPurchase::class,
                    'detail'            => 'Compra'
                ]);
            }
        }

        $this->items = [];

        $activity = new Activity;
        $activity->modelOn(InvPurchase::class, $purchase_save->id,'inv_purchases');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_purchase_create'));
        $activity->logType('create');
        $activity->log('Se creó un nueva compra');
        $activity->save();

        $this->dispatchBrowserEvent('inv-purchase-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
        $this->clearForm();
    }

    public function saveItem(){
        $this->validate([
            'item_text' => 'required|min:3',
            'item_id' => 'required',
            'item_amount' => 'required|integer|between:1,99999',
            'item_price' => 'required|between:0,99999.99'
        ]);

        $existe = false;
        if (count($this->items) > 0) {
            foreach ($this->items as $row) {
                if ($row['item_id'] == $this->item_id) {
                    $existe = true;
                    break;
                }
            }
        }
        if (!$existe) {
            $item = array(
                'item_id'       => $this->item_id,
                'item_text'     => $this->item_text,
                'amount'        => $this->item_amount,
                'price'         => $this->item_price
            );
            array_push($this->items, $item);
        }

        $this->item_id = null;
        $this->item_text = null;
        $this->item_amount = 1;
        $this->item_price = null;

        if ($existe) {
            $this->dispatchBrowserEvent('inv-purchase-save-not', ['msg' => Lang::get('inventory::labels.msg_0009')]);
        } else {
            $this->dispatchBrowserEvent('inv-purchase-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
        }
    }

    public function deleteItem($id){
        $items_aux = [];
        if(count($this->items) > 0){
            foreach ($this->items as $row) {
                if ($row['item_id'] != $id) {
                    $items_aux[] = $row;
                }
            }
        }
        $this->items = $items_aux;
        $this->dispatchBrowserEvent('inv-purchase-save', ['msg' => Lang::get('inventory::labels.msg_delete')]);
    }

    public function clearForm(){
        $this->document_type_id = 'GU75';
        $this->date_of_issue = null;
        $this->serie = null;
        $this->number = null;
        $this->total = null;
        $this->supplier_id = null;

        $this->items = [];
        $this->item_id = null;
        $this->item_text = null;
        $this->item_amount = 1;
        $this->item_price = null;
        $this->establishment_id = null;
        $this->store_id = null;
    }
}
