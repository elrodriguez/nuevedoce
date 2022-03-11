<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use Livewire\Component;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
class UserCreate extends Component
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
    public $photo;
    public $number_search;
    public $personSearch;
    public $xopen = false;
    
    public function mount(){
        
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
    }

    public function render()
    {
        return view('setting::livewire.user.user-create');
    }

    public function searchPerson(){
        $this->validate([
            'number_search' => 'required|min:8'
        ]);

        $this->personSearch = Person::where('number',$this->number_search)->first();

        $this->xopen = true;
        $encuentra = '';

        if($this->personSearch){
            $encuentra = $this->personSearch->id;
            $this->country_id = $this->personSearch->country_id;
            $this->department_id = $this->personSearch->department_id;
            $this->province_id = $this->personSearch->province_id;
            $this->district_id = $this->personSearch->district_id;
            $this->identity_document_type_id = $this->personSearch->identity_document_type_id;
            $this->number = $this->personSearch->number;
            $this->names = $this->personSearch->names;
            $this->last_name_father = $this->personSearch->last_name_father;
            $this->last_name_mother = $this->personSearch->last_name_mother;
            $this->address = $this->personSearch->address;
            $this->email = $this->personSearch->email;
            $this->telephone = $this->personSearch->telephone;
            $this->sex = $this->personSearch->sex;

            list($y,$m,$d) = explode('-',$this->personSearch->birth_date);

            $this->birth_date = $d.'/'.$m.'/'.$y;

        }
        
        if($encuentra == ''){
            $this->dispatchBrowserEvent('per-employees-search_a', ['msg' => Lang::get('staff::labels.msg_search_not'), 'numberPerson' => $this->number_search]);
        }else{
            $this->dispatchBrowserEvent('per-employees-search_b', ['msg' => Lang::get('staff::labels.msg_search_ok_a'), 'personId' => $this->personSearch->id]);
        }
    }

    public function save(){

        $this->validate([
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email'
        ]);
        
        $ddate = null;
        if($this->birth_date){
            list($d,$m,$y) = explode('/',$this->birth_date);
            $ddate = $y.'-'.$m.'-'. $d;
        }

        if($this->personSearch){
            $person = $this->personSearch;
        }else{

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
        }
        

        $user = User::create([
            'name' => $this->names.' '.$this->last_name_father,
            'email' => $this->email,
            'password' => Hash::make('12345678'),
            'username' => $this->number,
            'person_id' => $person->id
        ]);

        if($this->photo){
            $this->photo->storeAs('person/'.$person->id.'/', $person->id.'.png','public');
        }

        $activity = new Activity;
        $activity->modelOn(User::class,$user->id,'users');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_users_create'));
        $activity->logType('create');
        $activity->log('creó un nuevo usuario');
        $activity->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('set-user-save', ['msg' => 'Datos guardados correctamente.']);
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
        $this->photo = null;
    }
}
