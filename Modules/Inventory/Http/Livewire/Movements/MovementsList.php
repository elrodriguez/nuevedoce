<?php

namespace Modules\Inventory\Http\Livewire\Movements;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvAsset;

class MovementsList extends Component
{
    public $show;
    public $search;
    public $searchType;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['invItemsList' => 'itemsSearch'];

    public function mount(){
        $this->show = 10;
        $this->searchType = 1;
    }

    public function render()
    {
        return view('inventory::livewire.movements.movements-list',['items'=>$this->getItems()]);
    }

    public function itemsSearch()
    {
        $this->resetPage();
    }

    public function getItems(){
        $t = $this->searchType;
        $search =  $this->search;
        return InvAsset::join('inv_items','inv_assets.item_id','inv_items.id')
            ->join('inv_locations','inv_assets.location_id','inv_locations.id')
            ->select(
                'inv_items.name AS item_name',
                'inv_locations.name AS location_name',
                'inv_assets.patrimonial_code',
                'inv_assets.stock',
                'inv_assets.id',
                'inv_assets.item_id',
                'inv_assets.location_id'
            )
            ->when($t == 1, function ($query) use ($search) {
                $query->where('inv_items.name','like','%'.$search.'%');
            })
            ->when($t == 2, function ($query) use ($search) {
                $query->where('inv_assets.patrimonial_code','=',$search);
            })
            ->when($t == 3, function ($query) use ($search) {
                $query->where('inv_locations.name','like','%'.$search.'%');
            })
            ->paginate($this->show);
    }
}
