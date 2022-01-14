<?php

namespace Modules\Inventory\Http\Livewire\Itempart;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvItemPartAsset;

class ItemPartList extends Component
{
    public $show;
    public $search;
    public $id_item;
    public $name_item;
    public $parts_item;
    public $weight_item;
    public $count_items;
    public $search_parent;

    public $modal_title;
    public $array_codes;
    public $max_quantity;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount($item_id){
        $item = InvItem::find($item_id);
        if($item){
            $this->search_parent = $item;
            $this->show = 10;
            $this->id_item = $item_id;
            $this->name_item = $item->name;
            $this->parts_item = $item->number_parts;
            $this->weight_item = $item->weight;
        }
        
    }

    public function render()
    {
        $this->count_items = count($this->getItemParts());
        return view('inventory::livewire.itempart.item-part-list', ['item_parts' => $this->getItemParts(), 'item_name' => $this->name_item]);
    }

    public function getItemParts(){
        return InvItemPart::join('inv_items','inv_item_parts.part_id','inv_items.id')
            ->where('inv_items.name','like','%'.$this->search.'%')
            ->leftJoin('inv_categories', 'category_id', 'inv_categories.id')
            ->leftJoin('inv_brands', 'brand_id', 'inv_brands.id')
            ->select(
                'inv_items.id',
                'inv_items.name',
                'inv_items.description',
                'inv_items.part',
                'inv_items.weight',
                'inv_items.width',
                'inv_items.high',
                'inv_items.long',
                'inv_items.number_parts',
                'inv_items.status',
                'inv_item_parts.id AS item_part_id',
                'inv_item_parts.quantity',
                'inv_item_parts.part_id',
                'inv_item_parts.show_guides',
                'inv_categories.description AS name_category',
                'inv_brands.description AS name_brand'
            )
            ->where('inv_item_parts.item_id', '=', $this->id_item)
            ->paginate($this->show);
    }

    public function itemPartsSearch()
    {
        $this->resetPage();
    }

    public function deleteItemPart($id){
        
        $deletePart = InvItemPart::where('item_id',$this->id_item)->where('part_id',$id)->first();
        $itemPart   = InvItem::find($id);

        $activity   = new activity;
        $activity->log('Se eliminó la parte del item');
        $activity->modelOn(InvItem::class,$id,'inv_item');
        $activity->dataOld($itemPart);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        //Update weight parent
        $weight_parent = $this->search_parent->weight - ($itemPart->weight * $deletePart->quantity);

        $this->search_parent->update([
            'weight' => $weight_parent,
            'person_edit' => Auth::user()->person_id
        ]);

        InvItemPart::find($deletePart->id)->delete();

        $this->dispatchBrowserEvent('set-item-part-delete', ['msg' => Lang::get('inventory::labels.msg_delete')]);
    }

    public function openModalCodes($name,$item_id,$quantity,$item_part_id){

        $this->modal_title  = $name;
        $this->max_quantity = $quantity;
        $this->item_part_id = $item_part_id;

        $this->getArrayCodes($item_id,$item_part_id);
        $this->dispatchBrowserEvent('set-item-part-open-model', ['success' => true]);
    }

    public function saveItemPartAsset($asset_id,$item_id){

        $quantity = InvItemPartAsset::where('item_part_id',$this->item_part_id)
                    ->where('item_id',$item_id)
                    ->count('item_id');
        if($quantity < $this->max_quantity){
            InvItemPartAsset::create([
                'item_part_id'  => $this->item_part_id,
                'item_id'       => $item_id,
                'asset_id'      => $asset_id
            ]);
            $this->getArrayCodes($item_id,$this->item_part_id);
        }else{
            $this->dispatchBrowserEvent('set-item-part-asset-save', ['msg' => 'Solo puede Agregar '.$this->max_quantity.' códigos']);
        }
    }

    public function getArrayCodes($item_id,$item_part_id){

        $array_codes = InvAsset::select(
                            'inv_assets.id',
                            'inv_assets.patrimonial_code',
                            'inv_assets.item_id',
                            'inv_assets.state',
                            'inv_assets.location_id'
                        )
                        ->selectSub(function($query) use ($item_part_id,$item_id) {
                            $query->from('inv_item_part_assets')
                                ->selectRaw('COUNT(inv_item_part_assets.asset_id)')
                                ->whereColumn('inv_item_part_assets.asset_id','inv_assets.id')
                                ->where('inv_item_part_assets.item_part_id',$item_part_id)
                                ->where('inv_item_part_assets.item_id',$item_id);
                        }, 'used')
                        ->where('item_id',$item_id)
                        ->get();

        if($array_codes){
            $this->array_codes = $array_codes->toArray();
        }else{
            $this->array_codes = [];
        }
    }

    public function removeItemPartAsset($asset_id,$item_id){
        InvItemPartAsset::where('item_part_id',$this->item_part_id)
            ->where('item_id',$item_id)
            ->where('asset_id',$asset_id)
            ->delete();
            
        $this->getArrayCodes($item_id,$this->item_part_id);
    }

    public function showGuidesActive($id){
        InvItemPart::find($id)->update([
            'show_guides' => true
        ]);
    }

    public function showGuidesInactive($id){
        InvItemPart::find($id)->update([
            'show_guides' => false
        ]);
    }
}
