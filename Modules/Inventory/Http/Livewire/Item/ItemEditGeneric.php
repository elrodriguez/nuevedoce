<?php

namespace Modules\Inventory\Http\Livewire\Item;

use Carbon\Carbon;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvKardex;
use Illuminate\Support\Str;
use Modules\Inventory\Entities\InvUnitMeasure;

class ItemEditGeneric extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $currency_id = 'PEN';
    public $status = true;
    public $brand_id = 1;
    public $category_id;
    public $unit_measure_id = 'NIU';
    public $price;
    public $affectation_igv_type_id = 10;
    public $internal_id;
    public $stock;
    public $stock_min = 1;
    public $digemid;
    public $purchase_price;
    public $sunat_code;
    public $item;
    public $item_id;

    //images
    public $images = [];
    public $image;
    public $extension_photo;
    //Brand
    public $brands;
    //Category
    public $categories;
    public $unit_measures = [];

    public function mount($item_id){
        $this->item_id = $item_id;
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();
        $this->unit_measures = InvUnitMeasure::where('state',true)->get();
        $this->item = InvItem::find($item_id);
        $image = InvItemFile::where('item_id',$item_id)->first();
        $this->name = $this->item->name;
        $this->description = $this->item->description;
        $this->price = $this->item->sale_price;
        $this->purchase_price = $this->item->purchase_price;
        $this->internal_id = $this->item->internal_id;
        $this->sunat_code = $this->item->item_code;
        $this->stock_min = $this->item->stock_min;
        $this->status = $this->item->status;
        $this->digemid = $this->item->digemid;
        $this->category_id = $this->item->category_id;
        $this->unit_measure_id = $this->item->unit_measure_id;
        $this->brand_id = $this->item->brand_id;
        $this->currency_id = $this->item->currency_id;
        $this->image_w = ($image ? $image->route : null) ;
    }

    public function render()
    {
        return view('inventory::livewire.item.item-edit-generic');
    }

    public function save(){
        $id = $this->item->id;

        $this->validate([
            'name' => 'required|min:3|max:255',
            'price' => 'required',
            'brand_id' => 'required',
            'purchase_price' => 'required',
            'internal_id' => 'required|unique:inv_items,internal_id,'.$id,
            'stock_min' => 'required',
            'unit_measure_id' => 'required'
        ]);

        $activity = new Activity;
        $activity->dataOld(InvItem::find($this->item->id));

        $this->item->update([
            'name' => $this->name,
            'description' => $this->description,
            'sale_price' => $this->price,
            'purchase_price' => $this->purchase_price,
            'internal_id' => $this->internal_id,
            'item_code' => $this->sunat_code,
            'stock_min' => $this->stock_min,
            'status' => $this->status,
            'digemid' => $this->digemid,
            'category_id' => $this->category_id,
            'unit_measure_id' => $this->unit_measure_id,
            'brand_id' => $this->brand_id,
            'currency_type_id' => $this->currency_id,
            'person_edit'=> Auth::user()->person_id
        ]);

        $activity->modelOn(InvItem::class, $this->item->id,'inv_items');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_item_edit', $this->item->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->item);
        $activity->log('Se actualizó datos del Item');
        $activity->save();

        if($this->image){
            $imagen_name = $this->image->getClientOriginalName();
            $this->validate([
                'image' => 'image|mimes:jpg,jpeg,bmp,png|max:2048'
            ]);
            $this->extension_photo = $this->image->extension();
            InvItemFile::create([
                'name' => $imagen_name,
                'route' => 'storage/items_images/'.$this->item_save->id.'/'.$imagen_name,
                'extension' => $this->extension_photo,
                'item_id' => $this->item_save->id
            ]);

            $this->image->storeAs('items_images/'.$this->item_save->id.'/', $imagen_name,'public');
        }

        $this->dispatchBrowserEvent('inv-item-edit', ['msg' => Lang::get('inventory::labels.msg_update')]);
    }
}
