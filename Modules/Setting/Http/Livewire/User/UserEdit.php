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
class UserEdit extends Component
{
    use WithFileUploads;

    public $user;
    public $person;
    public $person_id;
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
    public $photo_view;

    public function mount($user_id){
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();

        $this->user = User::find($user_id);
        $this->person = Person::find($this->user->person_id);
        if($this->person){
            $ddate = null;
            if($this->person->birth_date){
                list($Y,$m,$d) = explode('-',$this->person->birth_date);
                $ddate = $d.'/'.$m.'/'. $Y;
            }

            $this->names = $this->person->names;
            $this->last_name_father = $this->person->last_name_father;
            $this->last_name_mother= $this->person->last_name_mother;
            $this->address = $this->person->address;
            $this->telephone = $this->person->telephone;
            $this->email = $this->person->email;
            $this->sex = $this->person->sex;
            $this->birth_date = $ddate;
            $this->country_id = $this->person->country_id;
            $this->department_id = $this->person->department_id;
            $this->province_id = $this->person->province_id;
            $this->district_id = $this->person->district_id;
            $this->identity_document_type_id = $this->person->identity_document_type_id;
            $this->number = $this->person->number;
        }
        
        if(file_exists(public_path('storage/person/'.$this->person->id.'/'.$this->person->id.'.png'))){
            $this->photo_view = url('storage/person/'.$this->person->id.'/'.$this->person->id.'.png');
        }

        $this->getProvinves();
        $this->getPDistricts();
    }

    public function render()
    {
        return view('setting::livewire.user.user-edit');
    }

    public function save(){

        $this->validate([
            'names' => 'required|min:3|max:255',
            'country_id' => 'required',
            'department_id' => 'required',
            'province_id' => 'required',
            'district_id' => 'required',
            'identity_document_type_id' => 'required',
            'number' => 'required|numeric|unique:people,number,'.$this->person->id,
            'last_name_father' => 'required|min:3|max:255',
            'last_name_mother' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email,'.$this->user->id,
            //'telephone' => 'required|min:3|max:255',
            'sex' => 'required',
            'birth_date' => 'required'
        ]);
        $ddate = null;
        if($this->birth_date){
            list($d,$m,$y) = explode('/',$this->birth_date);
            $ddate = $y.'-'.$m.'-'. $d;
        }

        $activity = new Activity;
        $activity->dataOld(['user' => User::find($this->user->id), 'person' => Person::find($this->person->id)]);

        $this->person->update([
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
        
        if($this->user->id != 1){
            $this->user->update([
                'name' => $this->names.' '.$this->last_name_father,
                'email' => $this->email,
                'password' => Hash::make('12345678'),
                'username' => $this->number
            ]);
        }
        $msg = 'Actualizo datos del usuario';
        if($this->photo){
            $this->photo->storeAs('person/'.$this->person->id.'/', $this->person->id.'.png','public');
            $msg .= ' y cambio de foto';
        }

        
        $activity->modelOn(User::class,$this->user->id,'users');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_users_edit',$this->user->id));
        $activity->dataUpdated(['user'=> $this->user,'person' => $this->person]);
        $activity->logType('edit');
        $activity->log($msg);
        $activity->save();

        $this->dispatchBrowserEvent('set-user-save', ['msg' => 'Datos Actualizados correctamente.']);
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
