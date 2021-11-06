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
use Modules\Inventory\Entities\InvKarkex;

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
    public $amount = 1;
    public $part_id;
    public $part_weight;
    public $parts_item_count;

    //kardex
    public $quantity;

    public $parts_item = [];

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
            'quantity' => 'required',
            'weight' => 'required',
            'width' => 'required',
            'high' => 'required',
            'long' => 'required',
            'images.*' => 'image|max:1024'
        ]);
        if($this->part){
            $this->number_parts = 0;
        }

        $this->item_save = InvItem::create([
            'name' => $this->name,
            'description' => $this->description,
            'part' => $this->part,
            'weight' => $this->weight,
            'width' => $this->width,
            'high' => $this->high,
            'long' => $this->long,
            'number_parts' => ($this->number_parts == null?0:$this->number_parts),
            'status' => $this->status,
            'item_id' => $this->item_id,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'person_create'=> Auth::user()->person_id
        ]);

        InvKarkex::create([
            'date_of_issue' => Carbon::now()->format('Y-m-d'),
            'establishment_id' => 1,
            'item_id' => $this->item_save->id,
            'quantity' => $this->quantity,
            'detail' => 'stock inicial'
        ]);

        #Save item parts
        if(count($this->parts_item) > 0){
            foreach ($this->parts_item as $row){
                $search_part = InvItem::find($row['id']);
                $search_part->update([
                    'item_id'       => $this->item_save->id,
                    'amount'        => $row['amount'],
                    'person_edit'   => Auth::user()->person_id
                ]);
            }
        }

        $this->parts_item = [];

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

        $this->clearForm();
        $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
    }

    public function savePart(){
        $this->validate([
            'part_text' => 'required|min:3',
            'part_id' => 'required',
            'amount' => 'required|integer|between:1,9999'
        ]);
        if($this->number_parts > count($this->parts_item)) {
            if (!$this->part) {
                $existe = false;
                if (count($this->parts_item) > 0) {
                    foreach ($this->parts_item as $row) {
                        if ($row['id'] == $this->part_id) {
                            $existe = true;
                            break;
                        }
                    }
                }
                if (!$existe) {
                    $this->parts_item[] = array(
                        'id' => $this->part_id,
                        'amount' => $this->amount,
                        'weight' => $this->part_weight,
                        'name' => $this->part_text
                    );
                    $this->weight += $this->part_weight * $this->amount;
                }

                $this->parts_item_count = count($this->parts_item);

                $this->part_text = '';
                $this->part_id = '';
                $this->part_weight = '';
                $this->amount = 1;

                if ($existe) {
                    $this->dispatchBrowserEvent('set-item-save-not', ['msg' => Lang::get('inventory::labels.msg_0009'), 'part_count' => $this->parts_item_count]);
                } else {
                    $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('inventory::labels.msg_update'), 'part_count' => $this->parts_item_count]);
                }
            } else {
                $this->parts_item = [];
                $this->part_text = '';
                $this->part_id = '';
                $this->part_weight = '';
                $this->amount = 1;
                $this->dispatchBrowserEvent('set-item-save-not', ['msg' => Lang::get('inventory::labels.msg_0008'), 'part_count' => $this->parts_item_count]);
            }
        }else{
            $this->dispatchBrowserEvent('set-item-save-not', ['msg' => Lang::get('inventory::labels.msg_0010'), 'part_count' => $this->parts_item_count]);
        }
    }

    public function deletePart($id){
        if(!$this->part){
            $parts_item_aux = [];
            if(count($this->parts_item) > 0){
                foreach ($this->parts_item as $row) {
                    if ($row['id'] != $id) {
                        $parts_item_aux[] = $row;
                    }else{
                        $this->weight = $this->weight - ($row['weight'] * $row['amount']);
                    }
                }
            }
            $this->parts_item = $parts_item_aux;
            $this->parts_item_count = count($this->parts_item);
            $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('inventory::labels.msg_delete'), 'part_count'=> $this->parts_item_count]);
        }
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
        $this->quantity = null;
    }
}