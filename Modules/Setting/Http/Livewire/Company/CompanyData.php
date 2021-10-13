<?php

namespace Modules\Setting\Http\Livewire\Company;

use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
class CompanyData extends Component
{

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
        $company = SetCompany::where('main',true)->first();

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
}
