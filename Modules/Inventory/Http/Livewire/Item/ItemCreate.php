<?php

namespace Modules\Inventory\Http\Livewire\Item;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;

class ItemCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $part = false;
    public $weight;
    public $width;
    public $high;
    public $long;
    public $number_parts;
    public $status = true;
    public $item_id;
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
    public $part_text;
    public $part_id;

    public function mount(){
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();

    }

    public function render()
    {
        return view('inventory::livewire.item.item-create');
    }

    public function save(){
        $this->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
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
            'status' => $this->status,
            'item_id' => $this->item_id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'person_create'=> Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(InvItem::class, $this->item_save->id,'inv_items');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_item_create'));
        $activity->logType('create');
        $activity->log('Se creó un nuevo Item');
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


        /*
        if($this->images){
            foreach ($this->images as $image) {
            $this->extension_photo = $image->extension();
            //dd($this->extension_photo);
                $this->image->storeAs('items_images/'.$this->employee_id.'/', $this->employee_id.'.'.$this->extension_photo,'public');
            }
        }*/

        $this->clearForm();
        $this->dispatchBrowserEvent('set-item-save', ['msg' => 'Datos guardados correctamente.']);
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
        $this->item_id = null;
        $this->brand_id = null;
        $this->category_id = null;
        $this->image = '';
    }
}
