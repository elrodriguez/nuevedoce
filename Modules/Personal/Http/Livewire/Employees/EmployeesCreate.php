<?php

namespace Modules\Personal\Http\Livewire\Employees;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Modules\Personal\Entities\PerEmployee;
use Modules\Personal\Entities\PerEmployeeType;
use Modules\Personal\Entities\PerOccupation;
use Modules\Setting\Entities\SetCompany;

class EmployeesCreate extends Component
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

    public function mount(){
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
        #$this->companies = SetCompany::where('status',true)->get();
        $this->companies = SetCompany::all();
        $this->occupations = PerOccupation::where('state',true)->get();
        $this->employees_types = PerEmployeeType::where('state',true)->get();
        $this->language = Lang::locale();
    }

    public function render()
    {
        return view('personal::livewire.employees.employees-create');
    }

    public function save(){

        $this->validate([
            'names' => 'required|min:3|max:255',
            'country_id' => 'required',
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'identity_document_type_id' => 'required',
            'number' => 'required|numeric|unique:people,number',
            'last_name_father' => 'required|min:3|max:255',
            'last_name_mother' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email',
            //'telephone' => 'required|min:3|max:255',
            'sex' => 'required',
            'birth_date' => 'required'
        ]);
        $ddate = null;
        if($this->birth_date){
            list($d,$m,$y) = explode('/',$this->birth_date);
            $ddate = $y.'-'.$m.'-'. $d;
        }
        $person = Person::create([
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'identity_document_type_id' => $this->identity_document_type_id,
            'number' => $this->number,
            'names' => $this->names,
            'last_name_father' => $this->last_name_father,
            'last_name_mother' => $this->last_name_mother,
            'full_name' => $this->last_name_father.' '.$this->last_name_mother.' '.$this->names,
            'trade_name' => null,
            'address' => $this->address,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'sex' => $this->sex,
            'birth_date' => $ddate
        ]);

        PerEmployee::create([
            'admission_date' => $this->names.' '.$this->last_name_father,
            'person_id' => $person->id,
            'company_id' => $this->company,
            'occupation_id' => $this->occupation,
            'employee_type_id' => $this->employee_type,
            'cv' => '',
            'photo' => '',
            'state' => $this->state
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-user-save', ['msg' => Lang::get('personal::labels.msg_success')]);
    }

    public function getProvinves(){
        $this->provinces = Province::where('department_id',$this->department_id)
            ->where('active',true)->get();
        $this->districts = [];
    }
    public function getPDistricts(){
        $this->districts = District::where('province_id',$this->province_id)
            ->where('active',true)->get();
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
