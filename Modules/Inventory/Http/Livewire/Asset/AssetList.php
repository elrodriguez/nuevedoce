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
    public function userSearch()
    {
        $this->resetPage();
    }

    public function getAssets(){
        return InvAsset::where('inv_assets.description','like','%'.$this->search.'%')
            ->join('inv_categories', 'category_id', 'inv_categories.id')
            ->join('inv_brands', 'brand_id', 'inv_brands.id')
            ->select(
                'inv_assets.id',
                'inv_assets.name',
                'inv_assets.description',
                'inv_assets.part',
                'inv_assets.weight',
                'inv_assets.width',
                'inv_assets.high',
                'inv_assets.long',
                'inv_assets.number_parts',
                'inv_assets.status',
                'inv_categories.description AS name_category',
                'inv_brands.description AS name_brand'
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
