<?php

namespace Modules\Personal\Http\Livewire\Employees;

use App\Models\Person;
use Livewire\Component;

class EmployeesQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = Person::join('per_employees','per_employees.person_id','people.id')->count();
    }

    public function render()
    {
        return view('personal::livewire.employees.employees-quantity');
    }
}
