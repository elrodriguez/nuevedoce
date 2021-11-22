<?php

namespace Modules\Personal\Http\Livewire\Companies;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use Modules\Personal\Entities\PerTypePerson;
use Livewire\WithFileUploads;

class CompaniesEdit extends Component
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
    public $type_person_id;
    public $countries = [];
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $type_people = [];

    //Combos Data:
    public $companies;
    public $occupations;
    public $person_search;
    public $search;
    public $option;

    public function mount($id){
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
        $this->type_people = PerTypePerson::where('state',true)->get();

        //Data Person
        $this->person_search = Person::find($id);

        $this->names = $this->person_search->names;
        $this->last_name_father = null;
        $this->last_name_mother= null;
        $this->address = $this->person_search->address;
        $this->telephone = $this->person_search->telephone;
        $this->email = $this->person_search->email;
        $this->sex = $this->person_search->sex;
        $this->birth_date = null;
        $this->country_id = $this->person_search->country_id;
        $this->department_id = $this->person_search->department_id;
        $this->province_id = $this->person_search->province_id;
        $this->district_id = $this->person_search->district_id;
        $this->identity_document_type_id = $this->person_search->identity_document_type_id;
        $this->number = $this->person_search->number;
        $this->type_person_id = $this->person_search->type_person_id;

        $this->getProvinves();
        $this->getPDistricts();

    }

    public function render()
    {
        return view('personal::livewire.companies.companies-edit');
    }

    public function save(){
        $this->validate([
            'names' => 'required|min:3|max:255',
            //'country_id' => 'required',
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'identity_document_type_id' => 'required',
            'number' => 'required|numeric|unique:people,number,'.$this->person_search->id,
            //'address' => 'required|min:3|max:255',
            'email' => 'nullable|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email',
            //'telephone' => 'required|min:3|max:255',
            //'sex' => 'required',
            'type_person_id' => 'required'
        ]);

        $ddate = null;
        $activity = new Activity;
        $activity->dataOld(Person::find($this->person_search->id));

        #dd($this->identity_document_type_id);
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
            'full_name' => $this->names,
            'trade_name' => null,
            'address' => $this->address,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'sex' => $this->sex,
            'type_person_id' => $this->type_person_id,
            'birth_date' => $ddate
        ]);

        $activity->modelOn(Person::class,$this->person_search->id,'people');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('personal_companies_edit',$this->person_search->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->person_search);
        $activity->log('Se actualizo datos de la Empresa');
        $activity->save();

        $this->dispatchBrowserEvent('per-companies-type-edit', ['msg' => Lang::get('personal::labels.msg_update')]);
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
