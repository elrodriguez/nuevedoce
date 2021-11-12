<?php

namespace Modules\Inventory\Http\Livewire\Itempart;

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

class ItemPartCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $part = false;
    public $weight = 0;
    public $width = 0;
    public $amount = 0;
    public $high = 0;
    public $long = 0;
    public $number_parts = 0;
    public $status = true;
    public $brand_id;
    public $category_id;
    //images
    public $images = [];
    public $image;
    public $extension_photo;
    //Brand
    public $brands;
    //Category
    public $categories;
    public $item_save;

    public $id_item;
    public $name_item;
    public $parts_item;
    public $weight_item;
    public $search_parent;
    public $observations;
    public $stock_initial;

    public function mount($item_id){
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();

        $item = InvItem::find($item_id);
        $this->search_parent = $item;
        $this->id_item = $item_id;
        $this->name_item = $item->name;
        $this->parts_item = $item->number_parts;
        $this->weight_item = $item->weight;
    }

    public function render()
    {
        return view('inventory::livewire.itempart.item-part-create');
    }

    public function save(){
        $this->validate([
            'name'          => 'required|min:3|max:255',
            'description'   => 'required',
            'amount'        => 'required|integer',
            'weight'        => 'required|between:0,9999.99',
            'images.*'      => 'image|max:1024',
            'stock_initial' => 'required'
        ]);

        $this->item_save = InvItem::create([
            'name' => $this->name,
            'description' => $this->description,
            'part' => $this->part,
            'weight' => $this->weight,
            'width' => $this->width,
            'high' => $this->high,
            'long' => $this->long,
            'number_parts' => $this->number_parts,
            'amount' => $this->amount,
            'status' => $this->status,
            'item_id' => $this->id_item,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'person_create'=> Auth::user()->person_id
        ]);

        InvKardex::create([
            'date_of_issue'     => Carbon::now()->format('Y-m-d'),
            'establishment_id'  => 1,
            'location_id'       => 1,
            'item_id'           => $this->item_save->id,
            'quantity'          => $this->stock_initial,
            'detail'            => 'stock inicial'
        ]);

        //Update weight parent
        $weight_parent = $this->search_parent->weight + ($this->weight * $this->amount);
        $parent_item = $this->search_parent->update([
            'weight' => $weight_parent,
            'person_edit' => Auth::user()->person_id
        ]);

        InvItemPart::create([
            'item_id'           => $this->id_item,
            'part_id'           => $this->item_save->id,
            'state'             => true,
            'quantity'          => $this->amount,
            'observations'      => $this->observations
        ]);

        $activity = new Activity;
        $activity->modelOn(InvItem::class, $this->item_save->id,'inv_items');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_item_part_create', $this->id_item));
        $activity->logType('create');
        $activity->log('Se creó una nueva parte de Item');
        $activity->save();

        if($this->image){
            $this->extension_photo = $this->image->extension();
            InvItemFile::create([
                'name' => $this->image->getClientOriginalName(),
                'route' => 'items_images/'.$this->name.'/',
                'extension' => $this->extension_photo,
                'item_id' => $this->item_save->id
            ]);

            $this->image->storeAs('items_images/'.$this->name.'/', $this->item_save->id.'.'.$this->extension_photo,'public');
        }

        $this->clearForm();
        $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('inventory::labels.msg_success'), 'id_item_jj' => $this->id_item ]);
    }


    public function clearForm(){
        $this->name = null;
        $this->description = null;
        $this->part = false;
        $this->weight = null;
        $this->width = null;
        $this->high = null;
        $this->long = null;
        $this->number_parts = null;
        $this->status = true;
        $this->brand_id = null;
        $this->category_id = null;
        $this->image = '';
    }
}
