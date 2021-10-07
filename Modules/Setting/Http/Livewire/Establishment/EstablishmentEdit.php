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

class EstablishmentEdit extends Component
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

    public function mount($establishment_id){
        $this->companies = SetCompany::all();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();

        $this->establishment = SetEstablishment::find($establishment_id);
        $this->email = $this->establishment->email;
        $this->phone = $this->establishment->phone;
        $this->address = $this->establishment->address;
        $this->department_id = $this->establishment->department_id;
        $this->province_id = $this->establishment->province_id;
        $this->district_id = $this->establishment->district_id;
        $this->web_page = $this->establishment->web_page;
        $this->latitude = $this->establishment->latitude;
        $this->longitude = $this->establishment->longitude;
        $this->observation = $this->establishment->observation;
        $this->map = $this->establishment->map;

        $this->getProvinves();
        $this->getPDistricts();
    }
    public function render()
    {
        return view('setting::livewire.establishment.establishment-edit');
    }

    public function save(){

        $this->validate([
            'address' => 'required|max:255'
        ]);

        $this->establishment->update([
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
        $this->dispatchBrowserEvent('set-establishmente-update', ['msg' => Lang::get('setting::labels.msg_update')]);
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
