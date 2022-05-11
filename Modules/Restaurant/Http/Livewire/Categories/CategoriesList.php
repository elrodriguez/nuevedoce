<?php

namespace Modules\Restaurant\Http\Livewire\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvCategory;
use Modules\Setting\Entities\SetModule;

class CategoriesList extends Component
{
    public $show;
    public $search;
    public $module_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->module_id = SetModule::where('uuid', 'rest')->value('id');
        $this->show = 10;
    }

    public function render()
    {
        return view('restaurant::livewire.categories.categories-list', ['categories' => $this->getCategories()]);
    }

    public function categorySearch()
    {
        $this->resetPage();
    }

    public function getCategories()
    {
        return InvCategory::where('description', 'like', '%' . $this->search . '%')
            ->where('module_id', $this->module_id)
            ->paginate($this->show);
    }

    public function deleteCategory($id)
    {
        try {
            InvCategory::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-category-delete', ['res' => $res]);
    }
}
