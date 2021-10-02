<?php

namespace Modules\Inventory\Http\Livewire\Brand;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvBrand;

class BrandList extends Component
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
        return view('inventory::livewire.brand.brand-list',['brands'=>$this->getBrands()]);
    }

    public function userSearch()
    {
        $this->resetPage();
    }

    public function getBrands(){
        return InvBrand::where('description','like','%'.$this->search.'%')
            ->paginate($this->show);
    }

    public function deleteBrand($id){
        try {
            InvBrand::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-brand-delete', ['res' => $res]);
    }
}
