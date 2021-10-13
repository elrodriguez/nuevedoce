<?php

namespace Modules\Personal\Http\Livewire\EmployeesType;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Personal\Entities\PerEmployeeType;

class EmployeesTypeCreate extends Component
{
    public $name;
    public $description;
    public $state = true;

    public function render()
    {
        return view('personal::livewire.employees_type.employees-type-create');
    }

    public function save(){
        $this->validate([
            'name' => 'required|max:255',
            'description' => 'max:255'
        ]);

        $type_employee = PerEmployeeType::create([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
            'person_create' => Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(PerEmployeeType::class, $type_employee->id,'per_employee_types');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('personal_employee-type_create'));
        $activity->logType('create');
        $activity->log('Se creó un nuevo tipo de empleado');
        $activity->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('per-employees-type-save', ['msg' => Lang::get('personal::labels.msg_success')]);
    }

    public function  clearForm(){
        $this->name = '';
        $this->description = '';
        $this->state = true;
    }
}
