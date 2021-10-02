<?php

namespace Modules\Personal\Http\Livewire\Employees;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use Modules\Personal\Entities\PerEmployee;
use Modules\Personal\Entities\PerEmployeeType;
use Modules\Personal\Entities\PerOccupation;
use Modules\Setting\Entities\SetCompany;
use Livewire\WithFileUploads;

class EmployeesEdit extends Component
{
    use WithFileUploads;
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
    public $option;
    public $cv_view;

    public function mount($id){
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
        //$this->companies = SetCompany::all();
        $this->companies = Person::where('identity_document_type_id', '6')->get(); #codigo-> 6:RUC
        $this->occupations = PerOccupation::where('state',true)->get();
        $this->employees_types = PerEmployeeType::where('state',true)->get();
        $this->language = Lang::locale();

        //Data Of Employee
        $this->employee_id = $id;
        $this->employee_search = PerEmployee::find($id);
        $ddate_ad = null;
        if($this->employee_search->admission_date){
            list($Y,$m,$d) = explode('-',$this->employee_search->admission_date);
            $ddate_ad = $d.'/'.$m.'/'. $Y;
        }
        $this->admission_date = $ddate_ad;
        $this->person_id = $this->employee_search->person_id;
        $this->company_id = $this->employee_search->company_id;
        $this->occupation_id = $this->employee_search->occupation_id;
        $this->employee_type_id = $this->employee_search->employee_type_id;
        $this->cv = $this->employee_search->cv;
        $this->photo = $this->employee_search->photo;
        $this->state = $this->employee_search->state;

        //Data Person
        $this->person_search = Person::find($this->person_id);
        $ddate = null;
        if($this->person_search->birth_date){
            list($Y,$m,$d) = explode('-',$this->person_search->birth_date);
            $ddate = $d.'/'.$m.'/'. $Y;
        }

        $this->names = $this->person_search->names;
        $this->last_name_father = $this->person_search->last_name_father;
        $this->last_name_mother= $this->person_search->last_name_mother;
        $this->address = $this->person_search->address;
        $this->telephone = $this->person_search->telephone;
        $this->email = $this->person_search->email;
        $this->sex = $this->person_search->sex;
        $this->birth_date = $ddate;
        $this->country_id = $this->person_search->country_id;
        $this->department_id = $this->person_search->department_id;
        $this->province_id = $this->person_search->province_id;
        $this->district_id = $this->person_search->district_id;
        $this->identity_document_type_id = $this->person_search->identity_document_type_id;
        $this->number = $this->person_search->number;

        if(file_exists(public_path('storage/employee_cv/'.$this->employee_id.'/'.$this->employee_id.'.pdf'))){
            $this->cv_view = url('storage/employee_cv/'.$this->employee_id.'/'.$this->employee_id.'.pdf');
        }

        $this->getProvinves();
        $this->getPDistricts();

    }

    public function render()
    {
        return view('personal::livewire.employees.employees-edit');
    }

    public function save(){
        $this->validate([
            'names' => 'required|min:3|max:255',
            'country_id' => 'required',
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'identity_document_type_id' => 'required',
            'number' => 'required|numeric|unique:people,number,'.$this->person_search->id,
            'last_name_father' => 'required|min:3|max:255',
            'last_name_mother' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email',
            //'telephone' => 'required|min:3|max:255',
            'sex' => 'required',
            'birth_date' => 'required',

            'employee_type_id' => 'required',
            'occupation_id' => 'required',
            //'company_id' => 'required',
            'admission_date' => 'required'
        ]);

        $ddate = null;
        if($this->birth_date){
            list($d,$m,$y) = explode('/',$this->birth_date);
            $ddate = $y.'-'.$m.'-'. $d;
        }

        $ddate_ad = null;
        if ($this->admission_date) {
            list($d, $m, $y) = explode('/', $this->admission_date);
            $ddate_ad = $y . '-' . $m . '-' . $d;
        }

        $this->person_search->update([
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'identity_document_type_id' => $this->identity_document_type_id,
            //'number' => $this->number,
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

        $this->employee_search->update([
            'admission_date' => $ddate_ad,
            'person_id' => $this->person_id,
            'company_id' => $this->company_id,
            'occupation_id' => $this->occupation_id,
            'employee_type_id' => $this->employee_type_id,
            'cv' => '',
            'photo' => '',
            'state' => $this->state
        ]);

        if($this->cv){
            $this->cv->storeAs('employee_cv/'.$this->employee_id.'/', $this->employee_id.'.pdf','public');
        }

        $this->dispatchBrowserEvent('per-employees-type-edit', ['msg' => Lang::get('personal::labels.msg_update')]);
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
}
