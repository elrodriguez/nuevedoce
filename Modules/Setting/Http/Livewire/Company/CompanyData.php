<?php

namespace Modules\Setting\Http\Livewire\Company;

use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
use Livewire\WithFileUploads;

class CompanyData extends Component
{
    use WithFileUploads;

    public $company_id;
    public $name;
    public $number;
    public $email;
    public $tradename;
    public $logo;
    public $logo_store;
    public $phone;
    public $phone_mobile;
    public $representative_name;
    public $representative_number;
    public $logo_store_view;
    public $logo_view;

    public function render()
    {
        $company = SetCompany::first();

        if($company){
            $this->company_id = $company->id;
            $this->name = $company->name;
            $this->number = $company->number;
            $this->email = $company->email;
            $this->tradename = $company->tradename;
            $this->phone = $company->phone;
            $this->phone_mobile = $company->phone_mobile;
            $this->representative_name = $company->representative_name;
            $this->representative_number = $company->representative_number;
            if($company->logo){
                $this->logo_view = $company->logo;
            }
            if($company->logo_store){
                $this->logo_store_view = $company->logo_store;
            }
        }
        return view('setting::livewire.company.company-data');
    }
    protected $rules = [
        'name' => 'required|min:6',
        'number' => 'required|min:8|max:25',
        'email' => 'required|email',
        'tradename' => 'required|min:6|max:255',
        'phone' => 'required|max:12',
        'phone_mobile' => 'required|max:12',
        'representative_name' => 'required|min:6',
        'representative_number' => 'required|min:8',
        'logo' => 'required|image|max:1024', // 1MB Max
        'logo_store' => 'required|image|max:1024'
    ];

    public function save(){

        $this->validate();

        $logo_name = 'company'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR;
        $logo_store_name = 'company'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR;

        $this->logo->storeAs($logo_name,'logo.jpg','public');
        $this->logo_store->storeAs($logo_store_name,'logo_store.jpg','public');
        
        if($this->company_id){
            SetCompany::where('id',$this->company_id)->update([
                'name' => $this->name,
                'number' => $this->number,
                'email' => $this->email,
                'tradename' => $this->tradename,
                'phone' => $this->phone,
                'phone_mobile' => $this->phone_mobile,
                'representative_name' => $this->representative_name,
                'representative_number' => $this->representative_number,
                'logo' => $logo_name.DIRECTORY_SEPARATOR.'logo.jpg',
                'logo_store' => $logo_store_name.DIRECTORY_SEPARATOR.'logo_store.jpg'
            ]);
        }else{
            SetCompany::create([
                'name' => $this->name,
                'number' => $this->number,
                'email' => $this->email,
                'tradename' => $this->tradename,
                'phone' => $this->phone,
                'phone_mobile' => $this->phone_mobile,
                'representative_name' => $this->representative_name,
                'representative_number' => $this->representative_number,
                'logo' => $this->logo,
                'logo_store' => $this->logo_store
            ]);
        }

        $this->dispatchBrowserEvent('set-company-save', ['msg' => 'Datos guardados correctamente.']);
    }
}
