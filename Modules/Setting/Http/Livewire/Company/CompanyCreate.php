<?php

namespace Modules\Setting\Http\Livewire\Company;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Setting\Entities\SetCompany;
use Livewire\WithFileUploads;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
class CompanyCreate extends Component
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
    public $main;

    public function render()
    {
        return view('setting::livewire.company.company-create');
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
        'logo' => 'required|image|max:2048', // 1MB Max
        'logo_store' => 'required|image|max:2048'
    ];

    public function save(){

        $this->validate();

        $logo_name = 'company'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR;
        $logo_store_name = 'company'.DIRECTORY_SEPARATOR.'logos'.DIRECTORY_SEPARATOR;

        $this->logo->storeAs($logo_name,'logo.jpg','public');
        $this->logo_store->storeAs($logo_store_name,'logo_store.jpg','public');

        if($this->main){
            SetCompany::where('main',true)->update(['main' => false]);
        }

        $company = SetCompany::create([
            'name' => $this->name,
            'number' => $this->number,
            'email' => $this->email,
            'tradename' => $this->tradename,
            'phone' => $this->phone,
            'phone_mobile' => $this->phone_mobile,
            'representative_name' => $this->representative_name,
            'representative_number' => $this->representative_number,
            'logo' => $logo_name.DIRECTORY_SEPARATOR.'logo.jpg',
            'logo_store' => $logo_store_name.DIRECTORY_SEPARATOR.'logo_store.jpg',
            'main' => ($this->main ? true : false)
        ]);

        $activity = new Activity;
        $activity->modelOn(SetCompany::class,$company->id,'set_companies');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_company_create'));
        $activity->logType('create');
        $activity->log('creó una nueva empresa');
        $activity->save();

        $this->dispatchBrowserEvent('set-company-save', ['msg' => Lang::get('setting::labels.msg_success')]);
    }

}
