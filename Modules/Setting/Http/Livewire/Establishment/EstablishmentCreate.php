<?php

namespace Modules\Setting\Http\Livewire\Establishment;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
use Modules\Setting\Entities\SetEstablishment;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\Province;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
class EstablishmentCreate extends Component
{
    public $companies;
    public $company_id;
    public $address;
    public $phone;
    public $email;
    public $country_id = 'PE';
    public $department_id = null;
    public $province_id;
    public $district_id;
    public $web_page;
    public $latitude;
    public $longitude;
    public $observation;
    public $map;

    public $countries = [];
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $state;

    public function mount(){
        $this->companies = SetCompany::all();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
    }

    public function render()
    {
        return view('setting::livewire.establishment.establishment-create');
    }

    public function save(){

        $this->validate([
            'address' => 'required|max:255'
        ]);

        $establishment = SetEstablishment::create([
            'address' => $this->address,
            'phone' => $this->phone,
            'observation' => $this->observation,
            'company_id' => $this->company_id,
            'country_id' => $this->country_id,
            'department_id' => $this->department_id,
            'province_id' => $this->province_id,
            'district_id' => $this->district_id,
            'web_page' => $this->web_page,
            'email' => $this->email,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'map' => html_entity_decode($this->map, ENT_QUOTES | ENT_XML1, 'UTF-8'),
            'state' => $this->state ? true : false
        ]);

        $activity = new Activity;
        $activity->modelOn(SetEstablishment::class,$establishment->id,'set_establishments');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_establishment_create'));
        $activity->logType('create');
        $activity->log('creó un nuevo establecimiento');
        $activity->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('set-establishmente-save', ['msg' => Lang::get('setting::labels.msg_success')]);
    }

    public function clearForm(){
        $this->address = null;
        $this->email = null;
        $this->phone = null;
        $this->address 
        $this->department_id = null;
        $this->province_id = null;
        $this->district_id = null;
        $this->web_page = null;
        $this->latitude = null;
        $this->longitude = null;
        $this->observation = null;
        $this->map = null;
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
