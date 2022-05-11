<?php

namespace Modules\Restaurant\Http\Livewire\Brands;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvBrand;

class BrandsList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('restaurant::livewire.brands.brands-list', ['brands' => $this->getBrands()]);
    }

    public function brandSearch()
    {
        $this->resetPage();
    }

    public function getBrands()
    {
        return InvBrand::where('description', 'like', '%' . $this->search . '%')
            ->paginate($this->show);
    }

    public function deleteBrand($id)
    {
        try {
            InvBrand::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-brand-delete', ['res' => $res]);
    }
}
