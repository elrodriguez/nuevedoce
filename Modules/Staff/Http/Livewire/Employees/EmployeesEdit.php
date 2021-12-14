<?php

namespace Modules\Staff\Http\Livewire\Employees;

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
use Modules\Staff\Entities\StaEmployee;
use Modules\Staff\Entities\StaEmployeeType;
use Modules\Staff\Entities\StaOccupation;
use Livewire\WithFileUploads;
use Modules\Setting\Entities\SetCompany;

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
    public $extension_photo;

    //Combos Data:
    public $companies;
    public $occupations;
    public $employees_types;
    public $person_search;
    public $employee_search;
    public $search;
    public $option;
    public $cv_view;
    public $photo_view;

    public function mount($id){
        $this->document_types = IdentityDocumentType::where('active',true)->get();
        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();
        //$this->companies = SetCompany::all();
        $this->companies = Person::where('identity_document_type_id', '6')->get(); #codigo-> 6:RUC
        $this->occupations = StaOccupation::where('state',true)->get();
        $this->employees_types = StaEmployeeType::where('state',true)->get();
        $this->language = Lang::locale();

        //Data Of Employee
        $this->employee_id = $id;
        $this->employee_search = StaEmployee::find($id);
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
        $this->extension_photo = $this->employee_search->photo;
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

        if(file_exists(public_path('storage/employees_photo/'.$this->employee_id.'/'.$this->employee_id.'.'.$this->extension_photo))){
            $this->photo_view = url('storage/employees_photo/'.$this->employee_id.'/'.$this->employee_id.'.'.$this->extension_photo);
        }

        $this->getProvinves();
        $this->getPDistricts();

    }

    public function render()
    {
        return view('staff::livewire.employees.employees-edit');
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
            'photo' => 'nullable|image|max:1024',

            'employee_type_id' => 'required',
            'occupation_id' => 'required',
            //'company_id' => 'required',
            'admission_date' => 'required',
            'cv' => 'nullable|mimes:pdf|max:5120'
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

        $activity = new Activity;
        $activity->dataOld(StaEmployee::find($this->employee_search->id));

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

        //Validando si empleado es Interno no vaya con empresa
        if($this->employee_type_id == '1'){
            $this->company_id = SetCompany::where('main',true)->first()->id;
        }

        if($this->photo){
            $this->extension_photo = $this->photo->extension();
        }

        $this->employee_search->update([
            'admission_date' => $ddate_ad,
            'person_id' => $this->person_id,
            'company_id' => $this->company_id,
            'occupation_id' => $this->occupation_id,
            'employee_type_id' => $this->employee_type_id,
            'cv' => '',
            'photo' => $this->extension_photo,
            'state' => $this->state
        ]);

        $activity->modelOn(StaEmployee::class,$this->employee_search->id,'sta_employees');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('staff_employees_edit',$this->employee_search->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->employee_search);
        $activity->log('Se actualizo datos del empleado');
        $activity->save();

        if($this->cv){
            $this->cv->storeAs('employee_cv/'.$this->employee_id.'/', $this->employee_id.'.pdf','public');
        }

        if($this->photo){
            $this->photo->storeAs('employees_photo/'.$this->employee_id.'/', $this->employee_id.'.'.$this->extension_photo,'public');
        }

        $this->dispatchBrowserEvent('per-employees-type-edit', ['msg' => Lang::get('Staff::labels.msg_update')]);
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

    public function deletePhotoEmployee(){
        if(file_exists(public_path('storage/employees_photo/'.$this->employee_id.'/'.$this->employee_id.'.'.$this->extension_photo))){
            $result = unlink('storage/employees_photo/'.$this->employee_id.'/'.$this->employee_id.'.'.$this->extension_photo);
            if($result){
                $this->photo_view = '';
                $this->extension_photo = '';
                $this->photo = '';
                $this->employee_search->update([
                    'photo' => ''
                ]);
                $this->dispatchBrowserEvent('per-employees-delete-photo');
            }
        }
    }
}
