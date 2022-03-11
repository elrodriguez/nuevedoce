<?php

namespace Modules\TransferService\Http\Livewire\Odtrequests;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithFileUploads;
use App\Models\Person;
use Modules\Staff\Entities\StaEmployee;
use Modules\Setting\Entities\SetCompany;
use App\Models\Customer;
use Modules\TransferService\Entities\SerLocal;
use Modules\TransferService\Entities\SerOdtRequest;
use Illuminate\Support\Facades\DB;
use Modules\TransferService\Entities\SerOdtRequestDetail;

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
    public $state = 'P';
    public $backus_id;
    public $internal_id;

    public $item_text;
    public $item_id;
    public $amount = 1;

    public $companies = [];
    public $supervisors = [];
    public $customers = [];
    public $locals = [];
    public $wholesalers = [];

    public $items_data = [];

    public function mount(){

    }

    public function render()
    {

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

        //Save Items:
        #Save item parts
        if(count($this->items_data) > 0){
            foreach ($this->items_data as $row){
                SerOdtRequestDetail::create([
                    'odt_request_id'    => $odtRequest->id,
                    'item_id'           => $row['item_id'],
                    'amount'            => $row['amount'],
                    'person_create'     => Auth::user()->person_id
                ]);
            }
        }
        $this->items_data = [];

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

    public function saveItem(){
        $this->validate([
            'item_text' => 'required|min:3',
            'item_id'   => 'required',
            'amount'    => 'required|integer|between:1,9999'
        ]);
        $existe = false;
        if (count($this->items_data) > 0) {
            foreach ($this->items_data as $row) {
                if ($row['item_id'] == $this->item_id) {
                    $existe = true;
                    break;
                }
            }
        }
        if (!$existe) {
            $this->items_data[] = array(
                'item_id'   => $this->item_id,
                'name'      => $this->item_text,
                'amount'    => $this->amount
            );
        }

        $this->item_text = '';
        $this->item_id = '';
        $this->amount = 1;

        if ($existe) {
            $this->dispatchBrowserEvent('set-item-save-not', ['msg' => Lang::get('transferservice::messages.msg_0004')]);
        } else {
            $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('transferservice::messages.msg_0003')]);
        }
    }

    public function deleteItem($id){
        $item_aux = [];
        if(count($this->items_data) > 0){
            foreach ($this->items_data as $row) {
                if ($row['item_id'] != $id) {
                    $item_aux[] = $row;
                }
            }
        }
        $this->items_data = $item_aux;
        $this->dispatchBrowserEvent('set-item-save', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
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
        $this->state                   = 'P';
        $this->backus_id               = null;
    }
}
