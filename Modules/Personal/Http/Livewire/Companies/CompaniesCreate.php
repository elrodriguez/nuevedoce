<?php

namespace Modules\Personal\Http\Livewire\Companies;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use Livewire\WithFileUploads;
use Modules\Personal\Entities\PerTypePerson;

class CompaniesCreate extends Component
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
    public $identity_document_type_id = '6';
    public $number;
    public $document_types;
    public $countries = [];
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $type_people = [];
    public $type_person_id;

    //Combos Data:
    public $companies;
    public $occupations;
    public $person_search;
    public $search;
    public $option;

    public $number_search;

    public function mount($id){
        $this->number_search = $id;
        $this->number = $id;
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
        $this->type_people = PerTypePerson::where('state',true)->get();

        $this->getProvinves();
        $this->getPDistricts();
    }

    public function render()
    {
        return view('personal::livewire.companies.companies-create');
    }

    public function save(){
        $this->validate([
            'names' => 'required|min:3|max:255',
            //'country_id' => 'required',
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'identity_document_type_id' => 'required',
            'number' => 'required|numeric|unique:people,number',
            'address' => 'required|min:3|max:255',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email',
            //'telephone' => 'required|min:3|max:255',
            //'sex' => 'required',
            'type_person_id' => 'required'
        ]);

        Person::create([
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'identity_document_type_id' => $this->identity_document_type_id,
            'number' => $this->number,
            'names' => $this->names,
            'last_name_father' => '',
            'last_name_mother' => '',
            'full_name' => $this->names,
            'trade_name' => null,
            'address' => $this->address,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'sex' => $this->sex,
            'type_person_id' => $this->type_person_id,
            'birth_date' => null
        ]);

        $this->dispatchBrowserEvent('per-companies-type-save', ['msg' => Lang::get('personal::labels.msg_success')]);
        $this->clearForm();
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
        $this->last_name_father = '';
        $this->last_name_mother= '';
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
        $this->type_person_id = null;
    }
}
