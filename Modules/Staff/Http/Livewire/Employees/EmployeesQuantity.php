<?php

namespace Modules\Staff\Http\Livewire\Employees;

use App\Models\Person;
use Livewire\Component;

class EmployeesQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = Person::join('sta_employees','sta_employees.person_id','people.id')->count();
    }

    public function render()
    {
        return view('staff::livewire.employees.employees-quantity');
    }
}
