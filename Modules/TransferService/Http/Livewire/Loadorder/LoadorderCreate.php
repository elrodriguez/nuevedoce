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

class LoadorderCreate extends Component
{
    public $vehicles = [];
    public $uuid;
    public $vehicle_id;
    public $vehicle_load;
    public $upload_date;
    public $charging_time;
    public $charge_weight;
    public $additional_information;
    public $odt_pending = [];
    public $oc_registers = [];
    public $odt_number_aux = '';
    public $odt_add_aux = '';
    public $items_selected = '';
    public $count_items = 0;

    public function mount(){
        $this->vehicles = SerVehicle::where('state',true)->get();
    }

    public function render(){
        $this->getItemsODT();
        $this->getItemsODTAdd();
        return view('transferservice::livewire.loadorder.loadorder-create');
    }

    public function selWeight(){
        $this->vehicle_load = isset(SerVehicle::find($this->vehicle_id)->net_weight)?SerVehicle::find($this->vehicle_id)->net_weight:'';
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
            ->whereNotIn('ser_odt_request_details.id', explode('|', $this->items_selected))
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();
    }

    public function getItemsODTAdd(){
        $this->oc_registers = SerOdtRequestDetail::where('ser_odt_request_details.state', 'P')
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
            ->whereIn('ser_odt_request_details.id', explode('|', $this->items_selected))
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();
    }

    public function saveItemsODT($register){
        if($this->items_selected == '')
            $this->items_selected = $register;
        else
            $this->items_selected = $this->items_selected.'|'.$register;
        $this->getItemsODT();
        $this->getItemsODTAdd();
        $this->count_items = count(explode('|', $this->items_selected));
        $sum_weight = 0;
        foreach ($this->oc_registers as $key => $odt){
            $sum_weight += $odt->amount * $odt->weight;
        }
        $this->charge_weight = $sum_weight;
    }

    public function deleteItemODT($id){
        $items = explode('|', $this->items_selected);
        $aux = '';
        $a = 0;
        foreach ($items as $r){
            if($r != $id){
                if($a == 0){
                    $aux = $r;
                }else{
                    $aux = $aux.'|'.$r;
                }
            }
            $a++;
        }
        $this->items_selected = $aux;
        $this->count_items = $aux==''?0:count(explode('|', $this->items_selected));
        $this->getItemsODT();
        $this->getItemsODTAdd();
        $sum_weight = 0;
        foreach ($this->oc_registers as $key => $odt){
            $sum_weight += $odt->amount * $odt->weight;
        }
        $this->charge_weight = $sum_weight;
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
            //'departure_date'            => date('Y-m-d'),
            //'departure_time'            => date('H:i:s'),
            'additional_information'    => $this->additional_information,
            'person_create'             => Auth::user()->person_id
        ]);

        //Save Datail
        foreach ($this->oc_registers as $key => $odt){
            $save_detail_oc = SerLoadOrderDetail::create([
                'load_order_id'         => $save_oc->id,
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
        }

        $activity = new Activity;
        $activity->modelOn(SerLoadOrder::class, $save_oc->id,'ser_load_orders');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_load_order_create'));
        $activity->logType('create');
        $activity->log('Se creó una nueva Orden de Carga');
        $activity->save();

        $this->dispatchBrowserEvent('ser-load-order-save', ['msg' => Lang::get('transferservice::messages.msg_success')]);
        $this->clearForm();
    }

    public function clearForm(){
        $this->uuid = null;
        $this->vehicle_id = null;
        $this->vehicle_load = null;
        $this->charge_weight = null;
        $this->upload_date = null;
        $this->charging_time = null;
        $this->additional_information = null;
        $this->items_selected = '';
        $this->count_items = 0;
        $this->odt_pending = [];
        $this->oc_registers = [];
        $this->getItemsODT();
        $this->getItemsODTAdd();
    }
}
