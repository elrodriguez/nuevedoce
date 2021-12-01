<?php

namespace Modules\TransferService\Http\Livewire\Odtrequests;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithFileUploads;
use App\Models\Person;
use Modules\Inventory\Entities\InvItem;
use Modules\Staff\Entities\StaEmployee;
use Modules\Setting\Entities\SetCompany;
use App\Models\Customer;
use Modules\TransferService\Entities\SerLocal;
use Modules\TransferService\Entities\SerOdtRequest;
use Modules\TransferService\Entities\SerOdtRequestDetail;

class OdtrequestsEdit extends Component
{
    use WithFileUploads;

    public $odt_id;
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

    public $odtRequest_search;
    public $companies = [];
    public $supervisors = [];
    public $customers = [];
    public $locals = [];
    public $wholesalers = [];
    public $file_view;
    public $backus_id;
    public $internal_id;

    public $item_text;
    public $item_id;
    public $amount = 1;
    public $items_data = [];

    public function mount($id){
        $this->odt_id = $id;
        $this->locals       = SerLocal::where('state', true)->get();
        $this->wholesalers  = Person::where('identity_document_type_id', '6')->get();
        $this->items_data  = SerOdtRequestDetail::where('odt_request_id', $id)
            ->join('inv_items', 'ser_odt_request_details.item_id', 'inv_items.id')
            ->select(
                'ser_odt_request_details.id AS id',
                'ser_odt_request_details.item_id',
                'ser_odt_request_details.amount AS amount',
                'inv_items.name AS name'
            )
            ->get();

        $this->odtRequest_search = SerOdtRequest::find($id);
        $this->company_id = $this->odtRequest_search->company_id;
        $this->supervisor_id = $this->odtRequest_search->supervisor_id;
        $this->customer_id = $this->odtRequest_search->customer_id;
        $customer_search    = Customer::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select(
                'customers.id AS value',
                DB::raw("CONCAT(people.number, ' - ', people.full_name) AS full_name")
            )
            ->find($this->customer_id);
        if($customer_search->full_name != '')
            $this->customer_text = $customer_search->full_name;

        $this->local_id = $this->odtRequest_search->local_id;
        $this->wholesaler_id = $this->odtRequest_search->wholesaler_id;

        $date_start = null;
        if($this->odtRequest_search->date_start){
            list($Y,$m,$d) = explode('-', $this->odtRequest_search->date_start);
            $date_start = $d.'/'.$m.'/'. $Y;
        }
        $this->date_start = $date_start;

        $date_end = null;
        if($this->odtRequest_search->date_end){
            list($Y,$m,$d) = explode('-', $this->odtRequest_search->date_end);
            $date_end = $d.'/'.$m.'/'. $Y;
        }
        $this->date_end = $date_end;

        $this->description = $this->odtRequest_search->description;
        $this->additional_information = $this->odtRequest_search->additional_information;
        $this->extension = $this->odtRequest_search->file;
        $this->state = $this->odtRequest_search->state;
        $this->backus_id = $this->odtRequest_search->backus_id;
        $this->internal_id = $this->odtRequest_search->internal_id;

        if(file_exists(public_path('storage/requests_odt_file/'.$id.'/'.$id.'.'.$this->extension))){
            $this->file_view = url('storage/requests_odt_file/'.$id.'/'.$id.'.'.$this->extension);
        }
    }

    public function render()
    {
        //$this->companies    = SetCompany::all();
        $this->companies    = Person::where('identity_document_type_id', '6')
            ->select('id', 'full_name AS name', 'number')
            ->get();

        $this->supervisors  = PerEmployee::where('state', true)
            ->join('people', 'person_id', 'people.id')
            ->select('sta_employees.id', 'people.full_name')
            ->get();

        return view('transferservice::livewire.odtrequests.odtrequests-edit');
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
            'backus_id' => 'required|unique:ser_odt_requests,backus_id,'.$this->odtRequest_search->id,
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

        $activity = new Activity;
        $activity->dataOld(SerOdtRequest::find($this->odtRequest_search->id));

        $this->odtRequest_search->update([
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
            'person_edit'               =>  Auth::user()->person_id,
            'backus_id'                 => $this->backus_id,
        ]);

        if($this->file){
            $this->file->storeAs('requests_odt_file/'.$this->odtRequest_search->id, $this->odtRequest_search->id.'.'.$this->extension,'public');
        }

        $activity->modelOn(SerOdtRequest::class, $this->odtRequest_search->id,'ser_odt_requests');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_odt_requests_edit', $this->odtRequest_search->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->odtRequest_search);
        $activity->log('Se actualizó datos de la Solicitud ODT');
        $activity->save();

        if(file_exists(public_path('storage/requests_odt_file/'.$this->odtRequest_search->id.'/'.$this->odtRequest_search->id.'.'.$this->extension))){
            $this->file_view = url('storage/requests_odt_file/'.$this->odtRequest_search->id.'/'.$this->odtRequest_search->id.'.'.$this->extension);
        }

        $this->dispatchBrowserEvent('ser-odtrequests-edit', ['msg' => Lang::get('transferservice::messages.msg_update')]);
    }

    public function saveItem(){
        $this->validate([
            'item_text' => 'required|min:3',
            'item_id'   => 'required',
            'amount'    => 'required|integer|between:1,9999'
        ]);

        $data_exist  = SerOdtRequestDetail::where('odt_request_id', $this->odt_id)
            ->where('item_id', $this->item_id)->get();

        if(count($data_exist) == 0){
            SerOdtRequestDetail::create([
                'odt_request_id'    => $this->odt_id,
                'item_id'           => $this->item_id,
                'amount'            => $this->amount,
                'person_create'     => Auth::user()->person_id
            ]);

            $this->items_data  = SerOdtRequestDetail::where('odt_request_id', $this->odt_id)
                ->join('inv_items', 'ser_odt_request_details.item_id', 'inv_items.id')
                ->select(
                    'ser_odt_request_details.id AS id',
                    'ser_odt_request_details.item_id AS id',
                    'ser_odt_request_details.amount AS amount',
                    'inv_items.name AS name'
                )
                ->get();

            $this->item_text = '';
            $this->item_id = '';
            $this->amount = 1;

            $this->dispatchBrowserEvent('inv-item-edit', ['msg' => Lang::get('transferservice::messages.msg_0003')]);
        }else{
            $this->dispatchBrowserEvent('inv-item-edit-not', ['msg' => Lang::get('transferservice::messages.msg_0004')]);
        }
    }

    public function deleteOdtItem($id){
        try {
            $delete_aa = SerOdtRequestDetail::find($id);
            $delete_aa->delete();

            $this->items_data  = SerOdtRequestDetail::where('odt_request_id', $this->odt_id)
                ->join('inv_items', 'ser_odt_request_details.item_id', 'inv_items.id')
                ->select(
                    'ser_odt_request_details.id AS id',
                    'ser_odt_request_details.item_id AS id',
                    'ser_odt_request_details.amount AS amount',
                    'inv_items.name AS name'
                )
                ->get();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-odt-item-delete', ['res' => $res]);
    }
}
