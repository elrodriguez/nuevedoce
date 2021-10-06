<?php

namespace Modules\TransferService\Http\Livewire\Customers;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use App\Models\Country;
use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use Livewire\WithFileUploads;
use Modules\TransferService\Entities\SerCustomer;

class CustomersEdit extends Component
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

    //For Customer
    public $state = true;
    public $customer_id;
    public $direct;
    public $person_id;
    public $photo;
    public $extension_photo;

    //Combos Data:
    public $person_search;
    public $customer_search;
    public $search;
    public $option;
    public $photo_view;

    public function mount($id){
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();

        //Data Of Customer
        $this->customer_id = $id;
        $this->customer_search = SerCustomer::find($id);

        $this->person_id = $this->customer_search->person_id;
        $this->extension_photo = $this->customer_search->photo;
        $this->direct = $this->customer_search->direct;
        $this->state = $this->customer_search->state;

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

        if(file_exists(public_path('storage/customers_photo/'.$this->customer_id.'/'.$this->customer_id.'.'.$this->extension_photo))){
            $this->photo_view = url('storage/customers_photo/'.$this->customer_id.'/'.$this->customer_id.'.'.$this->extension_photo);
        }

        $this->getProvinves();
        $this->getPDistricts();

    }

    public function render()
    {
        return view('transferservice::livewire.customers.customers-edit');
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
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|min:3|max:255|unique:users,email,'.$this->person_search->id,
            //'telephone' => 'required|min:3|max:255',
            'sex' => 'required',
            'birth_date' => 'required',
            'photo' => 'nullable|image|max:1024'
        ]);

        $ddate = null;
        if($this->birth_date){
            list($d,$m,$y) = explode('/',$this->birth_date);
            $ddate = $y.'-'.$m.'-'. $d;
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

        if($this->photo){
            $this->extension_photo = $this->photo->extension();
        }

        $this->customer_search->update([
            'person_id'     => $this->person_id,
            'direct'        => $this->direct,
            'photo'         => $this->extension_photo,
            'state'         => $this->state,
            'person_edit'   =>  Auth::user()->person_id
        ]);

        if($this->photo){
            $this->photo->storeAs('customers_photo/'.$this->customer_id.'/', $this->customer_id.'.'.$this->extension_photo,'public');
        }

        $this->dispatchBrowserEvent('ser-customers-type-edit', ['msg' => Lang::get('personal::labels.msg_update')]);
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

    public function deletePhotoCustomer(){
        if(file_exists(public_path('storage/customers_photo/'.$this->customer_id.'/'.$this->customer_id.'.'.$this->extension_photo))){
            $result = unlink('storage/customers_photo/'.$this->customer_id.'/'.$this->customer_id.'.'.$this->extension_photo);
            if($result){
                $this->photo_view = '';
                $this->extension_photo = '';
                $this->photo = '';
                $this->customer_search->update([
                    'photo' => ''
                ]);
                $this->dispatchBrowserEvent('ser-customers-delete-photo');
            }
        }
    }
}
