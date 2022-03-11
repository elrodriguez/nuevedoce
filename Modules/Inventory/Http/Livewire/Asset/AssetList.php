<?php

namespace Modules\Inventory\Http\Livewire\Asset;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvAsset;

class AssetList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('inventory::livewire.asset.asset-list',['assets'=>$this->getAssets()]);
    }
    public function assetSearch()
    {
        $this->resetPage();
    }

    public function getAssets(){
        return InvAsset::where('inv_assets.patrimonial_code','like','%'.$this->search.'%')
            ->orWhere('inv_items.name','like','%'.$this->search.'%')
            ->leftJoin('inv_asset_types', 'asset_type_id', 'inv_asset_types.id')
            ->join('inv_items', 'inv_assets.item_id', 'inv_items.id')
            ->leftJoin('inv_locations', 'inv_assets.location_id', 'inv_locations.id')
            ->select(
                'inv_assets.id',
                'inv_assets.patrimonial_code',
                'inv_items.name AS name_item',
                'inv_items.description',
                'inv_items.part',
                'inv_asset_types.name AS name_type_asset',
                'inv_assets.state',
                'inv_locations.name AS location_name',
                'inv_assets.item_id'
            )
            ->paginate($this->show);
    }

    public function deleteAsset($id){
        try {
            InvAsset::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-asset-delete', ['res' => $res]);
    }
}
