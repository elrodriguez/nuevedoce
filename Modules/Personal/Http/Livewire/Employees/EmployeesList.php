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
        return view('personal::livewire.employees.employees-list', ['employees' => $this->getEmployees()]);
    }

    public function getEmployees(){
        return PerEmployee::where('admission_date','like','%'.$this->search.'%')
            ->join('people', 'person_id', 'people.id')
            ->join('per_occupations', 'occupation_id', 'per_occupations.id')
            ->join('set_companies', 'company_id', 'set_companies.id')
            ->join('per_employee_types', 'employee_type_id', 'per_employee_types.id')
            ->select(
                'per_employees.id',
                'people.full_name',
                'people.number',
                'per_employees.admission_date',
                'per_occupations.name AS name_occupation',
                'set_companies.name AS name_company',
                'per_employee_types.name AS name_employee_type',
                'per_employees.state',
                'per_employees.cv',
                'per_employees.photo'
            )->paginate($this->show);
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
        #Person::find($person_id)->delete();

        $this->dispatchBrowserEvent('per-employees-delete', ['msg' => Lang::get('personal::labels.msg_delete')]);
    }
}
