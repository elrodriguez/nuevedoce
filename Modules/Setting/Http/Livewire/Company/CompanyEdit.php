<?php

namespace Modules\Setting\Http\Livewire\Company;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
use Livewire\WithFileUploads;

class CompanyEdit extends Component
{
    use WithFileUploads;

    public $company;
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
    public $main;

    public function mount($company_id){
        $this->company_id = $company_id;
        $this->company = SetCompany::find($this->company_id);
        $this->name = $this->company->name;
        $this->number = $this->company->number;
        $this->email = $this->company->email;
        $this->tradename = $this->company->tradename;
        $this->phone = $this->company->phone;
        $this->phone_mobile = $this->company->phone_mobile;
        $this->representative_name = $this->company->representative_name;
        $this->representative_number = $this->company->representative_number;
        $this->main = $this->company->main;

        if($this->company->logo){
            $this->logo_view = $this->company->logo;
        }
        if($this->company->logo_store){
            $this->logo_store_view = $this->company->logo_store;
        }

    }

    public function render()
    {
        

        return view('setting::livewire.company.company-edit');
    }

    protected $rules = [
        'name' => 'required|min:6',
        'number' => 'required|min:8|max:25',
        'email' => 'required|email',
        'tradename' => 'required|min:6|max:255',
        'phone' => 'required|max:12',
        'phone_mobile' => 'required|max:12',
        'representative_name' => 'required|min:6',
        'representative_number' => 'required|min:8'
    ];

    public function save(){

        $this->validate();
        $logo = $this->logo_view;
        $logo_store = $this->logo_store_view;

        if($this->logo){
            $logo_name = 'company'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR;
            $this->logo->storeAs($logo_name,'logo.jpg','public');
            $logo = $logo_name.DIRECTORY_SEPARATOR.'logo.jpg';
        }

        if($this->logo_store){
            $logo_store_name = 'company'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR;
            $this->logo_store->storeAs($logo_store_name,'logo_store.jpg','public');
            $logo_store = $logo_store_name.DIRECTORY_SEPARATOR.'logo_store.jpg';
        }
        
        if($this->main){
            SetCompany::where('main',true)->update(['main' => false]);
        }

        $this->company->update([
            'name' => $this->name,
            'number' => $this->number,
            'email' => $this->email,
            'tradename' => $this->tradename,
            'phone' => $this->phone,
            'phone_mobile' => $this->phone_mobile,
            'representative_name' => $this->representative_name,
            'representative_number' => $this->representative_number,
            'logo' => $logo,
            'logo_store' => $logo_store,
            'main' => ($this->main ? true : false)
        ]);
        
        $this->dispatchBrowserEvent('set-company-update', ['msg' => Lang::get('setting::labels.msg_update')]);
    }
}
