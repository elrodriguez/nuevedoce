<?php

namespace Modules\Personal\Http\Livewire\Employees;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Personal\Entities\PerEmployee;
use App\Models\Person;
use Illuminate\Support\Facades\Lang;

class EmployeesList extends Component
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
        dd($this->getEmployees());
        return view('personal::livewire.employees.employees-list', ['employees' => $this->getEmployees()]);
    }

    public function getEmployees(){
        return PerEmployee::where('admission_date','like','%'.$this->search.'%')
            ->join('people', 'person_id', 'people.id')
            ->join('per_activities', 'activitie_id', 'per_activities.id')
            ->select('people.full_name')
            ->paginate($this->show);
    }

    public function people(){
        return $this->hasOne(Person::class); #belongsTo
    }

    public function employeesSearch()
    {
        $this->resetPage();
    }

    public function deleteEmployee($id){
        $employee = PerEmployee::find($id);
        $person_id = $employee->person_id;
        $employee->delete();
        Person::find($person_id)->delete();

        $this->dispatchBrowserEvent('per-employees-delete', ['msg' => Lang::get('personal::labels.msg_delete')]);
    }
}
