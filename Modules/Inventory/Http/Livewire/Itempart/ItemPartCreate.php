<?php

namespace Modules\Inventory\Http\Livewire\Itempart;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;

class ItemPartCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $part = false;
    public $weight;
    public $width;
    public $amount;
    public $high;
    public $long;
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

    public function mount($item_id){
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();

        $item = InvItem::find($item_id);
        $this->id_item = $item_id;
        $this->name_item = $item->name;
    }

    public function render()
    {
        return view('inventory::livewire.itempart.item-part-create');
    }

    public function save(){
        $this->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'amount' => 'required|integer',
            'images.*' => 'image|max:1024'
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

        $activity = new Activity;
        $activity->modelOn(InvItem::class, $this->item_save->id,'inv_items');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_item_part_create'));
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
        $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
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
