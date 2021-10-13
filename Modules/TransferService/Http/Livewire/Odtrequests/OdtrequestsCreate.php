<?php

namespace Modules\TransferService\Http\Livewire\Odtrequests;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithFileUploads;
use App\Models\Person;
use Modules\Personal\Entities\PerEmployee;
use Modules\Setting\Entities\SetCompany;
use Modules\TransferService\Entities\SerCustomer;
use Modules\TransferService\Entities\SerLocal;
use Modules\TransferService\Entities\SerOdtRequest;
use Illuminate\Support\Facades\DB;

class OdtrequestsCreate extends Component
{
    use WithFileUploads;

    public $company_id;
    public $supervisor_id;
    public $customer_id;
    public $customer_text;
    public $local_id;
    public $wholesaler_id;
    public $event_date;
    public $transfer_date;
    public $pick_up_date;
    public $application_date;
    public $description;
    public $additional_information;
    public $file;
    public $extension = '';
    public $state = true;

    public $companies = [];
    public $supervisors = [];
    public $customers = [];
    public $locals = [];
    public $wholesalers = [];

    public function mount(){
        $this->companies    = SetCompany::all();
        $this->locals       = SerLocal::where('state', true)->get();
        $this->wholesalers  = Person::where('identity_document_type_id', '6')->get();
    }

    public function render()
    {
        $this->supervisors  = PerEmployee::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select('per_employees.id', 'people.full_name')
            ->get();
        return view('transferservice::livewire.odtrequests.odtrequests-create');
    }

    public function save(){
        $this->validate([
            'company_id' => 'required',
            'supervisor_id' => 'required',
            'customer_id' => 'required',
            'customer_text' => 'required|min:3',
            'local_id' => 'required',
            'wholesaler_id' => 'required',
            'event_date' => 'required',
//            'transfer_date' => 'required',
//            'pick_up_date' => 'required',
//            'application_date' => 'required',
            'description' => 'required|min:3|max:255',
//            'additional_information' => 'required',
            'file' => 'nullable|mimes:jpg,bmp,png,pdf|max:2048'
        ]);

        $eventDate = null;
        if($this->event_date){
            list($d,$m,$y) = explode('/', $this->event_date);
            $eventDate = $y.'-'.$m.'-'. $d;
        }

        $transferDate = null;
        if($this->transfer_date){
            list($d,$m,$y) = explode('/', $this->transfer_date);
            $transferDate = $y.'-'.$m.'-'. $d;
        }

        $pickUpDate = null;
        if($this->pick_up_date){
            list($d,$m,$y) = explode('/', $this->pick_up_date);
            $pickUpDate = $y.'-'.$m.'-'. $d;
        }

        $applicationDate = null;
        if($this->application_date){
            list($d,$m,$y) = explode('/', $this->application_date);
            $applicationDate = $y.'-'.$m.'-'. $d;
        }

        if($this->file){
            $this->extension = $this->file->extension();
        }

        $odtRequest = SerOdtRequest::create([
            'company_id'                => $this->company_id,
            'supervisor_id'             => $this->supervisor_id,
            'customer_id'               => $this->customer_id,
            'local_id'                  => $this->local_id,
            'wholesaler_id'             => $this->wholesaler_id,
            'event_date'                => $eventDate,
            'transfer_date'             => $transferDate,
            'pick_up_date'              => $pickUpDate,
            'application_date'          => $applicationDate,
            'description'               => $this->description,
            'additional_information'    => $this->additional_information,
            'file'                      => $this->extension,
            'state'                     => $this->state,
            'person_create'             =>  Auth::user()->person_id
        ]);

        if($this->file){
            $this->file->storeAs('requests_odt_file/'.$odtRequest->id.'/', $odtRequest->id.'.'.$this->extension,'public');
        }

        $activity = new Activity;
        $activity->modelOn(SerOdtRequest::class, $odtRequest->id,'ser_odt_requests');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_odt_requests_create', ''));
        $activity->logType('create');
        $activity->log('Se creó una nueva Solicitud ODT');
        $activity->save();


        $this->dispatchBrowserEvent('ser-odtrequests-save', ['msg' => Lang::get('transferservice::messages.msg_success')]);
        $this->clearForm();
    }

    public function clearForm(){
        $this->company_id              = null;
        $this->supervisor_id           = null;
        $this->customer_id             = null;
        $this->customer_text           = null;
        $this->local_id                = null;
        $this->wholesaler_id           = null;
        $this->event_date              = null;
        $this->transfer_date           = null;
        $this->pick_up_date            = null;
        $this->application_date        = null;
        $this->description             = null;
        $this->additional_information  = null;
        $this->file                    = null;
        $this->extension               = '';
        $this->state                   = true;
    }
}
