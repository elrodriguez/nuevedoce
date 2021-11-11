<?php

namespace Modules\Inventory\Http\Livewire\Location;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvLocation;

class LocationList extends Component
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
        return view('inventory::livewire.location.location-list',['locations'=>$this->getLocation()]);
    }

    public function locationSearch()
    {
        $this->resetPage();
    }

    public function getLocation(){
        return InvLocation::join('set_establishments','establishment_id','set_establishments.id')
            ->select(
                'set_establishments.name AS establishment_name',
                'inv_locations.name',
                'inv_locations.id',
                'inv_locations.establishment_id',
                'inv_locations.state'
            )
            ->where('inv_locations.name','like','%'.$this->search.'%')
            ->paginate($this->show);
    }

    public function deleteLocation($id){
        try {
            InvLocation::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-location-delete', ['res' => $res]);

    }
}
