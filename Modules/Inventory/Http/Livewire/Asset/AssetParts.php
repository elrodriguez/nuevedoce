<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvItemPartAsset;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvAssetParts;

class AssetParts extends Component
{
    public $show;
    public $search;
    public $id_item;
    public $name_item;
    public $parts_item;
    public $weight_item;
    public $count_items;
    public $search_parent;
    public $asset_id;
    public $item_part_id;

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
        return view('inventory::livewire.asset.asset-parts', ['item_parts' => $this->getItemParts(), 'item_name' => $this->name_item]);
    }

    public function getItemParts(){
        return InvItemPart::join('inv_items AS part','inv_item_parts.part_id','part.id')
            ->where('part.name','like','%'.$this->search.'%')
            ->leftJoin('inv_categories', 'category_id', 'inv_categories.id')
            ->leftJoin('inv_brands', 'brand_id', 'inv_brands.id')
            ->join('inv_assets as asset','asset.item_id','inv_item_parts.item_id')
            ->select(
                'part.id',
                'part.name',
                'part.description',
                'part.part',
                'part.weight',
                'part.width',
                'part.high',
                'part.long',
                'part.number_parts',
                'part.status',
                'inv_item_parts.id AS item_part_id',
                'inv_item_parts.quantity',
                'inv_item_parts.part_id',
                'asset.id AS asset_id',
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


    public function openModalCodes($name,$item_id,$quantity,$item_part_id,$asset_id){

        $this->modal_title  = $name;
        $this->max_quantity = $quantity;
        $this->item_part_id = $item_part_id;
        $this->asset_id     = $asset_id;

        $this->getArrayCodes($item_id,$item_part_id);
        $this->dispatchBrowserEvent('set-item-part-open-model', ['success' => true]);
    }

    public function saveItemPartAsset($asset_part_id,$item_id){
        
        $this->validate([
            'asset_id' => 'unique:inv_asset_parts,asset_id,NULL,id,asset_part_id,' . $asset_part_id
        ]);

        $quantity = InvAssetParts::where('asset_id',$this->asset_id)
                    ->count('asset_part_id');

        if($quantity < $this->max_quantity){
            InvAssetParts::create([
                'asset_id'      => $this->asset_id,
                'asset_part_id' => $asset_part_id,
                'state'         => true
            ]);
            $this->getArrayCodes($item_id,$this->item_part_id);
        }else{
            $this->dispatchBrowserEvent('set-item-part-asset-save', ['msg' => 'Solo puede Agregar '.$this->max_quantity.' códigos']);
        }
    }

    public function getArrayCodes($item_id,$item_part_id){
        $asset_id = $this->asset_id;
        $array_codes = InvAsset::select(
                            'inv_assets.id',
                            'inv_assets.patrimonial_code',
                            'inv_assets.item_id',
                            'inv_assets.state',
                            'inv_assets.location_id'
                        )
                        ->selectSub(function($query) use ($asset_id,$item_id) {
                            $query->from('inv_asset_parts')
                                ->selectRaw('COUNT(inv_asset_parts.asset_part_id)')
                                ->whereColumn('inv_asset_parts.asset_part_id','inv_assets.id')
                                ->where('inv_asset_parts.asset_id',$asset_id);
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
        InvAssetParts::where('asset_id',$this->asset_id)
            ->where('asset_part_id',$asset_id)
            ->delete();
            
        $this->getArrayCodes($item_id,$this->item_part_id);
    }
}
