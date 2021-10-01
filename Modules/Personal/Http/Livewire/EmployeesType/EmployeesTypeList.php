<?php

namespace Modules\Personal\Http\Livewire\EmployeesType;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Personal\Entities\PerEmployeeType;
use Illuminate\Support\Facades\Lang;

class EmployeesTypeList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){ //$activities_id
        $this->show = 10;
    }

    public function render()
    {
        return view('personal::livewire.employees_type.employees-type-list', ['employees_type' => $this->getEmployeesType()]);
    }

    public function getEmployeesType(){
        return PerEmployeeType::where('name','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function activitiesSearch()
    {
        $this->resetPage();
    }

    public function deleteEmployeeType($id){

        PerEmployeeType::find($id)->delete();

        $this->dispatchBrowserEvent('per-employees-type-delete', ['msg' => Lang::get('personal::labels.msg_delete')]);
    }
}
