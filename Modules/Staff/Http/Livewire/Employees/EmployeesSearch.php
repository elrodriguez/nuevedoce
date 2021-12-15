<?php

namespace Modules\Staff\Http\Livewire\Employees;

use App\Models\Person;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Staff\Entities\StaEmployee;

class EmployeesSearch extends Component
{
    public $names;
    public $last_name_father;
    public $last_name_mother;
    public $address;
    public $telephone;
    public $email;
    public $sex = 'H';
    public $birth_date;
    public $country_id = 'PE';
    public $department_id = null;
    public $province_id;
    public $district_id;
    public $identity_document_type_id;
    public $number;
    public $number_search;
    public $document_types;
    public $countries = [];
    public $departments = [];
    public $provinces = [];
    public $districts = [];

    //For Employee
    public $state = true;
    public $employee_id;
    public $admission_date;
    public $person_id;
    public $company_id;
    public $occupation_id;
    public $employee_type_id;
    public $cv;
    public $photo;
    public $language;

    //Combos Data:
    public $companies;
    public $occupations;
    public $employees_types;
    public $person_search;
    public $employee_search;
    public $search;

    public function render()
    {
        return view('staff::livewire.employees.employees-search');
    }

    public function searchPerson(){
        $this->validate([
            'number_search' => 'required|numeric|min:3'
        ]);
        $this->person_search = Person::where('number',$this->number_search)->get();
        $encuentra = '';
        $encuentra_e = '';
        foreach ($this->person_search as $key => $personSearch){
            $encuentra = $personSearch->id;

            $this->person_id = $personSearch->id;
            $this->names = $personSearch->names;
            $this->last_name_father = $personSearch->last_name_father;
            $this->last_name_mother= $personSearch->last_name_mother;
            $this->address = $personSearch->address;
            $this->telephone = $personSearch->telephone;
            $this->email = $personSearch->email;
            $this->sex = $personSearch->sex;
            $this->birth_date = $personSearch->birth_date;
            $this->country_id = $personSearch->country_id;
            $this->department_id = $personSearch->department_id;
            $this->province_id = $personSearch->province_id;
            $this->district_id = $personSearch->district_id;
            $this->identity_document_type_id = $personSearch->identity_document_type_id;
            $this->number = $personSearch->number;

            //dd($this->person_id);
            $this->employee_search = StaEmployee::where('person_id', $this->person_id)->get();

            foreach ($this->employee_search as $key => $employeeSearch){
                $encuentra_e = $employeeSearch->id;
                $this->employee_id = $employeeSearch->id;
                $this->admission_date = $employeeSearch->admission_date;
                $this->person_id = $employeeSearch->person_id;
                $this->company_id = $employeeSearch->company_id;
                $this->employee_type_id = $employeeSearch->employee_type_id;
                $this->occupation_id = $employeeSearch->occupation_id;
                $this->cv = $employeeSearch->cv;
                $this->photo = $employeeSearch->photo;
            }
        }
        if($encuentra == ''){
            $this->dispatchBrowserEvent('per-employees-search_a', ['msg' => Lang::get('staff::labels.msg_search_not'), 'numberPerson' => $this->number_search]);
        }elseif($encuentra != '' && $encuentra_e == ''){
            $this->dispatchBrowserEvent('per-employees-search_b', ['msg' => Lang::get('staff::labels.msg_search_ok_a'), 'personId' => $this->person_id]);
        }else{
            $this->dispatchBrowserEvent('per-employees-search_c', ['msg' => Lang::get('staff::labels.msg_search_ok_b'), 'employeeId' => $this->employee_id]);
        }
    }

    public function clearForm(){
        $this->names = null;
        $this->last_name_father = null;
        $this->last_name_mother= null;
        $this->address = null;
        $this->telephone = null;
        $this->email = null;
        $this->sex = 'H';
        $this->birth_date = null;
        $this->country_id = 'PE';
        $this->department_id = null;
        $this->province_id = null;
        $this->district_id = null;
        $this->identity_document_type_id = null;
        $this->number = null;

        //Employee:
        $this->admission_date = null;
        $this->person_id = null;
        $this->company_id = null;
        $this->employee_type_id = null;
        $this->occupation_id = null;
        $this->cv = '';
        $this->photo = '';
    }
}
