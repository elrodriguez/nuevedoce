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
    public $date_start;
    public $date_end;
    public $description;
    public $additional_information;
    public $file;
    public $extension = '';
    public $state = true;
    public $backus_id;
    public $internal_id;

    public $companies = [];
    public $supervisors = [];
    public $customers = [];
    public $locals = [];
    public $wholesalers = [];

    public function mount(){
        $this->locals       = SerLocal::where('state', true)->get();
        $this->wholesalers  = Person::where('identity_document_type_id', '6')->get();
    }

    public function render()
    {

        $this->companies    = Person::where('identity_document_type_id', '6')
            ->select('id', 'full_name AS name', 'number')
            ->get();

        $this->supervisors  = PerEmployee::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select('per_employees.id', 'people.full_name')
            ->get();

        $anio = date('Y');
        $code = SerOdtRequest::whereRaw('LEFT(internal_id,4) = ?',[$anio])
            ->max('internal_id');
        
        if($code){
            $this->internal_id = $code + 1;
        }else{
            $this->internal_id = $anio.substr(str_repeat(0, 6).'1', - 6);
        }

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
            'date_start' => 'required',
            'date_end' => 'required',
            'description' => 'required|min:3|max:255',
            'backus_id' => 'required|unique:ser_odt_requests,backus_id',
            'file' => 'nullable|mimes:jpg,bmp,png,pdf|max:2048'
        ]);

        $date_start = null;
        if($this->date_start){
            list($d,$m,$y) = explode('/', $this->date_start);
            $date_start = $y.'-'.$m.'-'. $d;
        }

        $date_end = null;
        if($this->date_end){
            list($d,$m,$y) = explode('/', $this->date_end);
            $date_end = $y.'-'.$m.'-'. $d;
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
            'date_start'                => $date_start,
            'date_end'                  => $date_end,
            'description'               => $this->description,
            'additional_information'    => $this->additional_information,
            'file'                      => $this->extension,
            'state'                     => $this->state,
            'backus_id'                 => $this->backus_id,
            'internal_id'               => $this->internal_id,
            'person_create'             => Auth::user()->person_id
        ]);

        if($this->file){
            $resul = $this->file->storeAs('requests_odt_file/'.$odtRequest->id, $odtRequest->id.'.'.$this->extension, 'public');
        }

        $activity = new Activity;
        $activity->modelOn(SerOdtRequest::class, $odtRequest->id,'ser_odt_requests');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_odt_requests_create'));
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
        $this->date_start              = null;
        $this->date_end                = null;
        $this->description             = null;
        $this->additional_information  = null;
        $this->file                    = null;
        $this->extension               = '';
        $this->state                   = true;
        $this->backus_id               = null;
    }
}
