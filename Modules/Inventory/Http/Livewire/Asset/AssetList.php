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
        return InvAsset::where('description','like','%'.$this->search.'%')
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
