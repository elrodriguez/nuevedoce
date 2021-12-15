<?php

namespace Modules\Staff\Http\Livewire\Employees;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Staff\Entities\StaEmployee;
use App\Models\Person;
use Illuminate\Support\Facades\Lang;
use Modules\Setting\Entities\SetCompany;

class EmployeesList extends Component
{
    public $show;
    public $search;
    public $company_name;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
        $this->company_name = SetCompany::where('main',true)->first()->name;
    }

    public function render()
    {
        return view('staff::livewire.employees.employees-list', ['employees' => $this->getEmployees()]);
    }

    public function getEmployees(){
        return StaEmployee::where('people.full_name','like','%'.$this->search.'%')
            ->join('people', 'person_id', 'people.id')
            ->join('sta_occupations', 'occupation_id', 'sta_occupations.id')
            ->leftJoin('people as sta_companies', 'company_id', 'sta_companies.id')
            ->join('sta_employee_types', 'employee_type_id', 'sta_employee_types.id')
            ->select(
                'sta_employees.id',
                'people.full_name',
                'people.number',
                'sta_employees.admission_date',
                'sta_occupations.name AS name_occupation',
                'sta_companies.full_name AS name_company',
                'sta_employee_types.name AS name_employee_type',
                'sta_employees.state',
                'sta_employees.cv',
                'sta_employees.photo'
            )
            ->paginate($this->show);
    }

    public function people(){
        return $this->hasOne(Person::class); #belongsTo
    }

    public function employeesSearch()
    {
        $this->resetPage();
    }

    public function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }

        if (!is_dir($dir)) {
            return unlink($dir);
        }

        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }

            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }

        }

        return rmdir($dir);
    }

    public function deleteEmployee($id){
        $employee = StaEmployee::find($id);
        $person_id = $employee->person_id;

        $activity = new activity;
        $activity->log('Se eliminó el empleado');
        $activity->modelOn(StaEmployee::class,$id,'sta_employees');
        $activity->dataOld($employee);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $employee->delete();
        #Person::find($person_id)->delete();
        //Eliminar archivos y direcctorio
        $this->deleteDirectory('storage/employees_photo/'.$id);

        $this->dispatchBrowserEvent('per-employees-delete', ['msg' => Lang::get('staff::labels.msg_delete')]);
    }
}
