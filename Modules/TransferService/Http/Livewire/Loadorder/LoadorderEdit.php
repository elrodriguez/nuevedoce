<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerOdtRequest;
use Modules\TransferService\Entities\SerOdtRequestDetail;
use Modules\TransferService\Entities\SerVehicle;

class LoadorderEdit extends Component
{
    public $vehicles = [];
    public $uuid;
    public $vehicle_id;
    public $charge_maximum;
    public $charge_weight;
    public $vehicle_load;
    public $upload_date;
    public $charging_time;
    public $departure_date;
    public $departure_time;
    public $return_date;
    public $return_time;
    public $additional_information;

    public $odt_pending = [];
    public $oc_registers = [];
    public $oc_registers_new = [];
    public $odt_number_aux = '';
    public $odt_add_aux = '';
    public $items_selected = '';
    public $count_items = 0;

    public $loadOrder_id;
    public $loadOrder_search;

    public function mount($id){
        $this->vehicles = SerVehicle::where('state',true)->get();
        $this->loadOrder_id = $id;
        $this->loadOrder_search = SerLoadOrder::find($id);
        $this->uuid = $this->loadOrder_search->uuid;
        $this->vehicle_id = $this->loadOrder_search->vehicle_id;
        $this->charge_maximum = $this->loadOrder_search->charge_maximum;
        $this->charge_weight = $this->loadOrder_search->charge_weight;
        $this->upload_date = date('d/m/Y', strtotime($this->loadOrder_search->upload_date));
        $this->charging_time = $this->loadOrder_search->charging_time;
        $this->departure_date = $this->loadOrder_search->departure_date;
        $this->departure_time = $this->loadOrder_search->departure_time;
        $this->return_date = $this->loadOrder_search->return_date;
        $this->return_time = $this->loadOrder_search->return_time;
        $this->additional_information = $this->loadOrder_search->additional_information;
        //Listado items registrados
    }

    public function render(){
        $this->getItemsODT();
        $this->getItemsODTAdd();
        return view('transferservice::livewire.loadorder.loadorder-edit');
    }

    public function selWeight(){
        $this->charge_maximum = isset(SerVehicle::find($this->vehicle_id)->net_weight)?SerVehicle::find($this->vehicle_id)->net_weight:'';
    }

    public function getItemsODT(){
        $this->odt_pending = SerOdtRequestDetail::where('ser_odt_request_details.state', 'P')
            ->join('ser_odt_requests','odt_request_id','ser_odt_requests.id')
            ->join('customers','ser_odt_requests.customer_id','customers.id')
            ->join('people','customers.person_id','people.id')
            ->join('inv_items','ser_odt_request_details.item_id','inv_items.id')
            ->select(
                'ser_odt_request_details.id AS id',
                'ser_odt_requests.internal_id',
                'ser_odt_requests.description AS name_evento',
                'people.full_name AS name_customer',
                'ser_odt_requests.date_start',
                'ser_odt_requests.date_end',
                'inv_items.name AS name_item',
                'ser_odt_request_details.amount'
            )
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();
    }

    public function getItemsODTAdd(){
        $this->oc_registers = SerLoadOrderDetail::where('ser_load_order_details.load_order_id', $this->loadOrder_id)
            ->join('ser_odt_requests','odt_request_id','ser_odt_requests.id')
            ->join('customers','ser_odt_requests.customer_id','customers.id')
            ->join('people','customers.person_id','people.id')
            ->join('inv_items','ser_load_order_details.item_id','inv_items.id')
            ->select(
                'ser_load_order_details.id AS id',
                'ser_load_order_details.odt_request_detail_id AS odt_request_detail_id',
                'ser_load_order_details.odt_request_id AS odt_request_id',
                'ser_load_order_details.item_id AS item_id',
                'ser_odt_requests.internal_id',
                'ser_odt_requests.description AS name_evento',
                'people.full_name AS name_customer',
                'ser_odt_requests.date_start',
                'ser_odt_requests.date_end',
                'inv_items.name AS name_item',
                'ser_load_order_details.amount',
                'inv_items.weight'
            )
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_load_order_details.id', 'asc')
            ->get();
        $this->count_items = count($this->oc_registers);
    }

    public function getItemsODTNewAdd($register){
        $this->oc_registers_new = SerOdtRequestDetail::where('ser_odt_request_details.state', 'P')
            ->join('ser_odt_requests','odt_request_id','ser_odt_requests.id')
            ->join('customers','ser_odt_requests.customer_id','customers.id')
            ->join('people','customers.person_id','people.id')
            ->join('inv_items','ser_odt_request_details.item_id','inv_items.id')
            ->select(
                'ser_odt_request_details.id AS id',
                'ser_odt_request_details.odt_request_id AS odt_request_id',
                'ser_odt_request_details.item_id AS item_id',
                'ser_odt_requests.internal_id',
                'ser_odt_requests.description AS name_evento',
                'people.full_name AS name_customer',
                'ser_odt_requests.date_start',
                'ser_odt_requests.date_end',
                'inv_items.name AS name_item',
                'ser_odt_request_details.amount',
                'inv_items.weight'
            )
            ->whereIn('ser_odt_request_details.id', explode('|', $register))
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();
    }

    public function saveItemsODT($register){
        //Save Datail
        $this->getItemsODTNewAdd($register);
        $sum_weight = 0;
        foreach ($this->oc_registers_new as $key => $odt){
            $save_detail_oc = SerLoadOrderDetail::create([
                'load_order_id'         => $this->loadOrder_id,
                'odt_request_detail_id' => $odt->id,
                'odt_request_id'        => $odt->odt_request_id,
                'item_id'               => $odt->item_id,
                'amount'                => $odt->amount,
                'person_create'         => Auth::user()->person_id
            ]);
            //Actualizando el estado en ODT detalle
            $odt_detail_u = SerOdtRequestDetail::find($odt->id);
            $odt_detail_u->update([
                'state'         => 'O',
                'person_edit'   => Auth::user()->person_id
            ]);
            //Consultando si ODT Detalle hay Pendiente si no para cambiar estado del padre (ODT)
            $cantidad_odt_p = SerOdtRequestDetail::where('odt_request_id','=', $odt->odt_request_id)
                ->where('state', '=', 'P')
                ->get();
            if(count($cantidad_odt_p) == 0){
                $odt_head_u = SerOdtRequest::find($odt->odt_request_id);
                $odt_head_u->update([
                    'state'         => 'O',
                    'person_edit'   => Auth::user()->person_id
                ]);
            }
            $sum_weight += $odt->amount * $odt->weight;
        }
        $this->getItemsODT();
        $this->getItemsODTAdd();
        $this->charge_weight = ($this->charge_weight + $sum_weight) > 0?($this->charge_weight + $sum_weight):0;
        $this->loadOrder_search->update([
            'charge_weight' => $this->charge_weight,
            'person_edit'   => Auth::user()->person_id
        ]);
        $this->dispatchBrowserEvent('ser-load-order-save', ['msg' => Lang::get('transferservice::messages.msg_0006')]);
    }

    public function deleteItemODT($id_load){
        $item_load_delete = SerLoadOrderDetail::find($id_load);
        $id_odt_detail = $item_load_delete->odt_request_detail_id;

        $dataDelete_odt = SerOdtRequestDetail::where('ser_odt_request_details.id', '=', $id_odt_detail)
            ->join('ser_odt_requests','odt_request_id','ser_odt_requests.id')
            ->join('customers','ser_odt_requests.customer_id','customers.id')
            ->join('people','customers.person_id','people.id')
            ->join('inv_items','ser_odt_request_details.item_id','inv_items.id')
            ->select(
                'ser_odt_request_details.id AS id',
                'ser_odt_request_details.odt_request_id AS odt_request_id',
                'ser_odt_request_details.item_id AS item_id',
                'ser_odt_requests.internal_id',
                'ser_odt_requests.description AS name_evento',
                'people.full_name AS name_customer',
                'ser_odt_requests.date_start',
                'ser_odt_requests.date_end',
                'inv_items.name AS name_item',
                'ser_odt_request_details.amount',
                'inv_items.weight'
            )
            ->get();
        $sum_weight = 0;
        foreach ($dataDelete_odt as $row){
            $sum_weight = $row->amount * $row->weight;
        }

        $odt_detail_u = SerOdtRequestDetail::find($id_odt_detail);
        $odt_detail_u->update([
            'state' => 'P',
            'person_edit'   => Auth::user()->person_id
        ]);

        $odt_head_u = SerOdtRequest::find($item_load_delete->odt_request_id);
        $odt_head_u->update([
            'state'         => 'P',
            'person_edit'   => Auth::user()->person_id
        ]);

        $this->charge_weight = ($this->charge_weight - $sum_weight > 0)?$this->charge_weight - $sum_weight:0;
        $this->loadOrder_search->update([
            'charge_weight' => $this->charge_weight,
            'person_edit'   => Auth::user()->person_id
        ]);

        $this->getItemsODT();
        $this->getItemsODTAdd();
        $item_load_delete->delete();

        $this->dispatchBrowserEvent('ser-load-order-item-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
    }

    public function save(){
        $this->validate([
            'vehicle_id'    => 'required',
            'upload_date'   => 'required',
            'charging_time' => 'date_format:H:i',
            'count_items'   => 'required|integer|between:1,99999'
        ]);

        $maxValue = DB::table('ser_load_orders')->max('uuid');

        if($maxValue == null){
            $correlativo = '0001';
        }else{
            $numero = (int) substr($maxValue,4,4);
            $correlativo = str_pad($numero + 1,  4, "0", STR_PAD_LEFT);
        }
        $this->uuid = date('Y').$correlativo;

        $date_upload = null;
        if($this->upload_date){
            list($d,$m,$y) = explode('/', $this->upload_date);
            $date_upload = $y.'-'.$m.'-'. $d;
        }

        $save_oc = SerLoadOrder::create([
            'uuid'                      => $this->uuid,
            'vehicle_id'                => $this->vehicle_id,
            'charge_maximum'            => $this->vehicle_load,
            'charge_weight'             => $this->charge_weight,
            'upload_date'               => $date_upload,
            'charging_time'             => $this->charging_time,
            'departure_date'            => date('Y-m-d'),
            'departure_time'            => date('H:i:s'),
            'additional_information'    => $this->additional_information,
            'person_create'             => Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(SerLoadOrder::class, $save_oc->id,'ser_load_orders');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_load_order_create'));
        $activity->logType('create');
        $activity->log('Se creó una nueva Orden de Carga');
        $activity->save();

        $this->dispatchBrowserEvent('ser-load-order-save', ['msg' => Lang::get('transferservice::messages.msg_success')]);
    }
}
