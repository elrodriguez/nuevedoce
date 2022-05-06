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
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvUnitMeasure;

class ItemCreateGeneric extends Component
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
    public $item_type_id = '01';

    //images
    public $images = [];
    public $image;
    public $extension_photo;
    //Brand
    public $brands;
    //Category
    public $categories;
    public $unit_measures = [];

    public function mount()
    {
        $this->categories = InvCategory::where('status', true)->get();
        $this->brands = InvBrand::where('status', true)->get();
        $this->unit_measures = InvUnitMeasure::where('state', true)->get();
    }

    public function render()
    {
        return view('inventory::livewire.item.item-create-generic');
    }

    public function save()
    {
        //dd($this->image->getClientOriginalName());
        $this->validate([
            'name' => 'required|min:3|max:255',
            'stock' => 'required',
            'price' => 'required',
            'brand_id' => 'required',
            'purchase_price' => 'required',
            'internal_id' => 'required|unique:inv_items,internal_id',
            'stock_min' => 'required',
            'unit_measure_id' => 'required',
            'image' => 'image|mimes:jpg,jpeg,bmp,png|max:2048'
        ]);

        $this->item_save = InvItem::create([
            'name' => $this->name,
            'description' => $this->description,
            'sale_price' => $this->price,
            'purchase_price' => $this->purchase_price,
            'internal_id' => $this->internal_id,
            'item_code' => $this->sunat_code,
            'stock' => $this->stock,
            'stock_min' => $this->stock_min,
            'status' => $this->status,
            'digemid' => $this->digemid,
            'category_id' => $this->category_id,
            'unit_measure_id' => $this->unit_measure_id,
            'brand_id' => $this->brand_id,
            'currency_type_id' => $this->currency_id,
            'person_create' => Auth::user()->person_id,
            'sale_affectation_igv_type_id' => $this->affectation_igv_type_id,
            'item_type_id' => $this->item_type_id
        ]);

        InvKardex::create([
            'date_of_issue'     => Carbon::now()->format('Y-m-d'),
            'establishment_id'  => 1,
            'location_id'       => 1,
            'item_id'           => $this->item_save->id,
            'quantity'          => $this->stock,
            'detail'            => 'Stock Inicial'
        ]);

        InvAsset::create([
            'patrimonial_code' => $this->internal_id,
            'item_id' => $this->item_save->id,
            'state' => true,
            'person_create' => Auth::user()->person_id,
            'location_id' => 1,
            'stock' => $this->stock
        ]);

        $activity = new Activity;
        $activity->modelOn(InvItem::class, $this->item_save->id, 'inv_items');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_item_create'));
        $activity->logType('create');
        $activity->log('Se creó un nuevo Item');
        $activity->save();

        if ($this->image) {
            $imagen_name = $this->image->getClientOriginalName();
            $this->extension_photo = $this->image->extension();
            InvItemFile::create([
                'name' => $imagen_name,
                'route' => 'storage/items_images/' . $this->item_save->id . '/' . $imagen_name,
                'extension' => $this->extension_photo,
                'item_id' => $this->item_save->id
            ]);

            $this->image->storeAs('items_images/' . $this->item_save->id . '/', $imagen_name, 'public');
        }

        $this->clearForm();
        $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
    }

    public function clearForm()
    {
        $this->name = null;
        $this->description = null;
        $this->price = null;
        $this->purchase_price = null;
        $this->internal_id = null;
        $this->sunat_code = null;
        $this->stock = null;
        $this->stock_min = 1;
        $this->status = true;
        $this->digemid = null;
        $this->category_id = null;
        $this->unit_measure_id = 'NIU';
        $this->brand_id = 1;
        $this->currency_id = 'PEN';
        $this->image = null;
    }
}
