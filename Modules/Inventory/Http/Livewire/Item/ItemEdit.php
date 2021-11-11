<?php

namespace Modules\Inventory\Http\Livewire\Item;

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

class ItemEdit extends Component
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
    public $number_parts;
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
    public $part_text = '';
    public $part_id = '';
    public $part_weight;
    public $observations;

    public $partAsigned_text = 'editando un asignado';
    public $amount_asigned;

    public $amount = 1;
    public $item_aa;

    public $parts_item;
    public $parts_item_count = 0;

    public function mount($item_id){
        $this->categories = InvCategory::where('status',true)->get();
        $this->brands = InvBrand::where('status',true)->get();

        $this->item = InvItem::find($item_id);
        $this->name = $this->item->name;
        $this->description = $this->item->description;
        $this->part = $this->item->part;
        $this->weight = $this->item->weight;
        $this->width = $this->item->width;
        $this->high = $this->item->high;
        $this->long = $this->item->long;
        $this->number_parts = $this->item->number_parts;
        $this->status = $this->item->status;
        $this->amount_asigned = $this->item->amount;
        $this->id_item = $this->item->item_id == null ? 0 : $this->item->item_id;
        
        $this->brand_id = $this->item->brand_id;
        $this->category_id = $this->item->category_id;

        $this->item_aa = $item_id;
        
        

        if($this->id_item > 0) {
            $item_parent = InvItem::find($this->id_item);
            $this->partAsigned_text = $item_parent->name;
        }
    }

    public function render()
    {
        $this->getParts();
        return view('inventory::livewire.item.item-edit');
    }

    public function save(){
        if($this->id_item>0){
            $this->validate([
                'name' => 'required|min:3|max:255',
                'description' => 'required',
                'images.*' => 'image|max:1024',
                'amount_asigned' => 'required|integer'
            ]);
        }else{
            $this->validate([
                'name' => 'required|min:3|max:255',
                'description' => 'required',
                'images.*' => 'image|max:1024'
            ]);
        }

        $activity = new Activity;
        $activity->dataOld(InvItem::find($this->item->id));

        if($this->part){
            $this->number_parts = 0;
        }

        $this->item->update([
            'name' => $this->name,
            //'description' => $this->description,
            'part' => $this->part,
            'weight' => $this->weight,
            'width' => $this->width,
            'high' => $this->high,
            'long' => $this->long,
            'number_parts' => ($this->number_parts == null?0:$this->number_parts),
            'status' => $this->status,
            'amount' => ($this->id_item>0?$this->amount_asigned:0),
            #'item_id' => $this->item_id,
            'brand_id' => $this->brand_id,
            'category_id' => $this->category_id,
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

    public function savePart(){

        $this->validate([
            'part_text' => 'required|min:3',
            'part_id' => 'required',
            'amount' => 'required|integer'
        ]);
        
        if($this->number_parts > count($this->parts_item)) {
            $search_part = InvItem::find($this->part_id);

            $exists = InvItemPart::where('item_id',$this->item_aa)
                        ->where('part_id',$this->part_id)
                        ->exists();
            if(!$exists){
                InvItemPart::create([
                    'item_id'       => $this->item_aa,
                    'part_id'       => $this->part_id,
                    'state'         => true,
                    'quantity'      => $this->amount,
                    'observations'   => $this->observations
                ]);
                $this->weight = $this->weight+($search_part->weight * $this->amount);
                //Actualizando Peso Item
                $search_item_parent =  InvItem::find($this->item_aa);
    
                $parent_item = $search_item_parent->update([
                    'weight' => $this->weight,
                    'number_parts' => $this->number_parts,
                    'person_edit' => Auth::user()->person_id
                ]);
    
                $this->parts_item = InvItem::where('item_id', $this->item_aa)->get();
                $this->parts_item_count = count($this->parts_item);
    
                $this->part_text = '';
                $this->part_id = '';
                $this->amount = 1;

                $this->dispatchBrowserEvent('inv-item-edit', ['msg' => Lang::get('inventory::labels.msg_update'), 'part_count' => $this->parts_item_count, 'id_item' => $this->id_item]);
            }else{
                $this->dispatchBrowserEvent('set-item-add-not', ['msg' => Lang::get('inventory::labels.msg_0009'), 'part_count' => $this->parts_item_count]);
            }
          
        }else{
            $this->dispatchBrowserEvent('set-item-save-not', ['msg' => Lang::get('inventory::labels.msg_0010'), 'part_count' => $this->parts_item_count]);
        }
    }

    public function deletePartItem($id){
        try {
            $deletePart= InvItemPart::find($id);
            $delete_aa = InvItem::find($deletePart->part_id);

            $this->weight = $this->weight - ($delete_aa->weight * $delete_aa->amount);
            //Actualizando Peso Item
            $search_item_parent =  InvItem::find($this->item_aa);
            $search_item_parent->update([
                'weight' => $this->weight,
                'person_edit' => Auth::user()->person_id
            ]);

            $deletePart->delete();

            $this->parts_item = InvItemPart::where('item_id', $this->item_aa)->get();
            $this->parts_item_count = count($this->parts_item);

            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-item-part-delete', ['res' => $res, 'part_count'=> $this->parts_item_count, 'id_item' => $this->id_item]);
    }

    public function getParts(){
        $this->parts_item = InvItemPart::join('inv_items','inv_item_parts.part_id','inv_items.id')
                            ->select(
                                'inv_items.id AS item_id',
                                'inv_item_parts.id',
                                'inv_items.name',
                                'inv_item_parts.quantity',
                                'inv_items.weight',
                                'inv_item_parts.observations'
                            )
                            ->where('inv_item_parts.item_id', $this->item_aa)
                            ->get();

        $this->parts_item_count = count($this->parts_item);
    }
}
