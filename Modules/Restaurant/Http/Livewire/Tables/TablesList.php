<?php

namespace Modules\Restaurant\Http\Livewire\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Restaurant\Entities\RestTable;

class TablesList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('restaurant::livewire.tables.tables-list', ['tables' => $this->getTables()]);
    }

    public function tableSearch()
    {
        $this->resetPage();
    }

    public function getTables()
    {
        return RestTable::where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->show);
    }

    public function deleteTable($id)
    {
        try {
            RestTable::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-category-delete', ['res' => $res]);
    }
}
