<?php

namespace Modules\Inventory\Http\Livewire\Itempart;

use Elrod\UserActivity\Activity;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvCategory;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemFile;
use Livewire\WithFileUploads;
use Illuminate\Http\Request;
use App\Http\Requests;
use Modules\Inventory\Entities\InvItemPart;

class ItemPartEdit extends Component
{
    use WithFileUploads;

    public $item;
    public $name;
    public $description;
    public $part = false;
    public $weight;
    public $width;
    public $high;
    public $long;
    public $number_parts = 0;
    public $status = true;
    public $item_id;
    public $id_item = 0; //For Parts
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
    public $amount_asigned;

    public $amount;

    public $item_id_parent;
    public $name_item_parent;

    public function mount($item_id){
        $param = explode('_', $item_id);
        $item_id = $param[0];
        $this->item_id_parent = $param[1];
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();

        $this->item = InvItem::find($item_id);
       
        $this->name = $this->item->name;
        $this->description = $this->item->description;
        $this->weight = $this->item->weight;
        $this->width = $this->item->width;
        $this->high = $this->item->high;
        $this->long = $this->item->long;
        $this->amount = $this->item->amount;
        $this->status = $this->item->status;
        $this->amount_asigned = $this->item->amount;
        $this->id_item =$this->item_id_parent == null ? 0 : $this->item_id_parent;

        $this->brand_id = $this->item->brand_id;
        $this->category_id = $this->item->category_id;

        $item_parent = InvItem::find($this->item_id_parent);
        $this->name_item_parent = $item_parent->name;
    }

    public function render()
    {
        return view('inventory::livewire.itempart.item-part-edit');
    }

    public function save(){
        $this->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'required',
            'images.*' => 'image|max:1024',
            'amount' => 'required|integer'
        ]);

        $activity = new Activity;
        $activity->dataOld(InvItem::find($this->item->id));

        $this->item->update([
            'name' => $this->name,
            'description' => $this->description,
            'part' => $this->part,
            'weight' => $this->weight,
            'width' => $this->width,
            'high' => $this->high,
            'long' => $this->long,
            'number_parts' => $this->number_parts,
            'status' => $this->status,
            'amount' => $this->amount,
            'item_id' => $this->item_id_parent,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
            'person_edit'=> Auth::user()->person_id
        ]);

        $activity->modelOn(InvItem::class, $this->item->id,'inv_items');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_item_part_edit', $this->item->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->item);
        $activity->log('Se actualizó datos de la parte del Item');
        $activity->save();

        if($this->image){
            $this->extension_photo = $this->image->extension();
            InvItemFile::update([
                'name' => $this->image->getClientOriginalName(),
                'route' => 'item_images/'.$this->name.'/',
                'extension' => $this->extension_photo,
                'item_id' => $this->item_save->id
            ]);

            $this->image->storeAs('item_images/'.$this->name.'/', $this->item_save->id.'.'.$this->extension_photo,'public');
        }

        $this->dispatchBrowserEvent('inv-item-edit', ['msg' => Lang::get('inventory::labels.msg_update')]);
    }
}
