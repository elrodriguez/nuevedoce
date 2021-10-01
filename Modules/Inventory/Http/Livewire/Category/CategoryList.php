<?php

namespace Modules\Inventory\Http\Livewire\Category;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvCategory;

class CategoryList extends Component
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

        return view('inventory::livewire.category.category-list',['categories'=>$this->getCategories()]);
    }

    public function userSearch()
    {
        $this->resetPage();
    }

    public function getCategories(){
        return InvCategory::where('description','like','%'.$this->search.'%')
            ->paginate($this->show);
    }

    public function deleteCategory($id){
        try {
            InvCategory::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-category-delete', ['res' => $res]);

    }

}
