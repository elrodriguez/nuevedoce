<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvAssetParts;
use Modules\Inventory\Entities\InvItemPart;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerLoadOrderDetailAsset;
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
    public $items_loadorder = [];

    public function mount($id){
        $this->vehicles = SerVehicle::where('state',true)->get();
        $this->loadOrder_id = $id;
        $this->loadOrder_search = SerLoadOrder::find($id);
        $this->uuid = $this->loadOrder_search->uuid;
        $this->vehicle_id = $this->loadOrder_search->vehicle_id;
        $this->charge_maximum = $this->loadOrder_search->charge_maximum;
        $this->charge_weight = $this->loadOrder_search->charge_weight;
        $this->upload_date = date('d/m/Y', strtotime($this->loadOrder_search->upload_date));
        $this->charging_time = substr($this->loadOrder_search->charging_time, 0, 5);
        $this->departure_date = $this->loadOrder_search->departure_date;
        $this->departure_time = $this->loadOrder_search->departure_time;
        $this->return_date = $this->loadOrder_search->return_date;
        $this->return_time = $this->loadOrder_search->return_time;
        $this->additional_information = $this->loadOrder_search->additional_information;
        //Listado items registrados

        $this->getItemsODT();
        $this->getItemsODTAdd();
    }

    public function render(){
        
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
            ->select(DB::raw("
                ser_odt_request_details.id AS id,
                ser_odt_requests.internal_id,
                ser_odt_requests.description AS name_evento,
                people.full_name AS name_customer,
                ser_odt_requests.date_start,
                ser_odt_requests.date_end,
                inv_items.name AS name_item,
                ser_odt_request_details.amount,
                (ser_odt_request_details.amount - ser_odt_request_details.quantity_served) AS amount_pending,
                ser_odt_request_details.quantity_served
            "))
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();
    }

    public function getItemsODTAdd(){

        $ocd_register_detail = SerLoadOrderDetail::where('ser_load_order_details.load_order_id', $this->loadOrder_id)
            ->join('ser_odt_requests','odt_request_id','ser_odt_requests.id')
            ->join('customers','ser_odt_requests.customer_id','customers.id')
            ->join('people','customers.person_id','people.id')
            ->join('inv_items','ser_load_order_details.item_id','inv_items.id')
            ->select(
                'ser_load_order_details.id AS id',
                'ser_load_order_details.odt_request_detail_id AS odt_request_detail_id',
                'ser_load_order_details.odt_request_id AS odt_request_id',
                'ser_load_order_details.item_id AS item_id',
                'ser_load_order_details.load_order_id',
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

        $detail_odt = [];

        foreach ($ocd_register_detail as $key => $row){
            $assets = InvAsset::where('item_id',$row->item_id)->select('id','patrimonial_code')->get();
            $codes = SerLoadOrderDetailAsset::where('load_order_id',$row->load_order_id)->pluck('asset_id');

            $detail_a['id'] = $row->id;
            $detail_a['odt_request_id']     = $row->odt_request_id;
            $detail_a['item_id']            = $row->item_id;
            $detail_a['internal_id']        = $row->internal_id;
            $detail_a['name_evento']        = $row->name_evento;
            $detail_a['name_customer']      = $row->name_customer;
            $detail_a['date_start']         = $row->date_start;
            $detail_a['date_end']           = $row->date_end;
            $detail_a['name_item']          = $row->name_item;
            $detail_a['amount']             = $row->amount;
            $detail_a['quantity_served']    = $row->quantity_served;
            $detail_a['amount_select']      = $row->amount;
            $detail_a['weight']             = $row->weight;
            $detail_a['assets']             = $assets ? $assets->toArray() : [];
            $detail_a['codes']              = $codes ? $codes->toArray() : [];
            $detail_odt[] = $detail_a;
        }

        $this->oc_registers = $detail_odt;

        $this->count_items = count($this->oc_registers);

        $this->dispatchBrowserEvent('ser-load-order-select-assets', ['success' => true]);
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
        $params = explode('|', $register);

        $list_add = "";
        $a_s = 0;
        $array_save_add = array();
        foreach ($params as $row){
            $detail_add_row = explode('#', $row);
            if($a_s == 0){
                $list_add = $detail_add_row[0];
            }else{
                $list_add = $list_add.'|'.$detail_add_row[0];
            }
            array_push($array_save_add, array('id'=>$detail_add_row[0], 'amount_total'=>$detail_add_row[1], 'amount_add'=>$detail_add_row[2]));
            $a_s++;
        }


        $this->getItemsODTNewAdd($list_add);
        $sum_weight = 0;
        foreach ($this->oc_registers_new as $key => $odt){
            $id = array_search($odt->id, array_column($array_save_add, 'id'));
            $amount_select = $array_save_add[$id]['amount_add'];

            //Buscando si el registro ya exite para modificarlo o para nuevo
            $data_exist_detail = SerLoadOrderDetail::where('load_order_id', '=', $this->loadOrder_search->id)
                ->where('odt_request_detail_id', '=', $odt->id)
                ->where('odt_request_id', '=', $odt->odt_request_id)
                ->get();

            if(count($data_exist_detail) > 0){ #Update
                foreach ($data_exist_detail as $fila){
                    $item_edit_search = SerLoadOrderDetail::find($fila->id);
                }

                $item_edit_search->update([
                    'amount'                => ($item_edit_search->amount + $amount_select),
                    'person_edit'           => Auth::user()->person_id
                ]);

                //Actualizando el estado en ODT detalle
                $odt_detail_u = SerOdtRequestDetail::find($odt->id);
                if($odt_detail_u->amount == ($odt_detail_u->quantity_served + $amount_select)){
                    $odt_detail_u->update([
                        'state'             => 'O',
                        'quantity_served'   => ($odt_detail_u->quantity_served + $amount_select),
                        'person_edit'       => Auth::user()->person_id
                    ]);
                }else{
                    $odt_detail_u->update([
                        'quantity_served'   => ($odt_detail_u->quantity_served + $amount_select),
                        'person_edit'       => Auth::user()->person_id
                    ]);
                }
            }else{ #New Insert
                $save_detail_oc = SerLoadOrderDetail::create([
                    'load_order_id'         => $this->loadOrder_id,
                    'odt_request_detail_id' => $odt->id,
                    'odt_request_id'        => $odt->odt_request_id,
                    'item_id'               => $odt->item_id,
                    'amount'                => $amount_select,
                    'person_create'         => Auth::user()->person_id
                ]);

                //Actualizando el estado en ODT detalle
                $odt_detail_u = SerOdtRequestDetail::find($odt->id);
                if($odt_detail_u->amount == ($odt_detail_u->quantity_served + $amount_select)){
                    $odt_detail_u->update([
                        'state'             => 'O',
                        'quantity_served'   => ($odt_detail_u->quantity_served + $amount_select),
                        'person_edit'       => Auth::user()->person_id
                    ]);
                }else{
                    $odt_detail_u->update([
                        'quantity_served'   => ($odt_detail_u->quantity_served + $amount_select),
                        'person_edit'       => Auth::user()->person_id
                    ]);
                }
            }

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
            $sum_weight += $amount_select * $odt->weight;
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
        SerLoadOrderDetailAsset::where('load_order_id',$item_load_delete->load_order_id)->delete();

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
                'ser_odt_request_details.quantity_served',
                'inv_items.weight'
            )
            ->get();
        $sum_weight = 0;
        foreach ($dataDelete_odt as $row){
            $sum_weight = $row->quantity_served * $row->weight;
        }

        $odt_detail_u = SerOdtRequestDetail::find($id_odt_detail);
        $odt_detail_u->update([
            'state'             => 'P',
            'quantity_served'   => 0,
            'person_edit'       => Auth::user()->person_id
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

        $item_load_delete->delete();

        $this->getItemsODT();
        $this->getItemsODTAdd();
        

        $this->dispatchBrowserEvent('ser-load-order-item-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
    }

    public function save(){

        $this->validate([
            'vehicle_id'    => 'required',
            'upload_date'   => 'required',
            'charging_time' => 'date_format:H:i',
            'count_items'   => 'required|integer|between:1,99999'
        ]);

        $date_upload = null;
        if($this->upload_date){
            list($d,$m,$y) = explode('/', $this->upload_date);
            $date_upload = $y.'-'.$m.'-'. $d;
        }

        $this->loadOrder_search->update([
            'uuid'                      => $this->uuid,
            'vehicle_id'                => $this->vehicle_id,
            'charge_maximum'            => $this->charge_maximum,
            'charge_weight'             => $this->charge_weight,
            'upload_date'               => $date_upload,
            'charging_time'             => $this->charging_time,
            'additional_information'    => $this->additional_information,
            'person_create'             => Auth::user()->person_id
        ]);

        SerLoadOrderDetailAsset::where('load_order_id',$this->loadOrder_search->id)->delete();
        
        foreach ($this->oc_registers as $odt){
            ///se guardan los activos con codigos para los items de las oc
            foreach($odt['codes'] as $codes){
                SerLoadOrderDetailAsset::create([
                    'item_id'       => $odt['item_id'],
                    'asset_id'      => $codes,
                    'load_order_id' => $this->loadOrder_search->id
                ]);
            }

        }

        $activity = new Activity;
        $activity->modelOn(SerLoadOrder::class, $this->loadOrder_search->id,'ser_load_orders');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_load_order_edit', $this->loadOrder_search->id));
        $activity->logType('update');
        $activity->log('Se modificó la Orden de Carga');
        $activity->save();

        $this->dispatchBrowserEvent('ser-load-order-save', ['msg' => Lang::get('transferservice::messages.msg_success')]);
    }

    public function showDetailsItems($id,$name,$index){
        $this->items_loadorder = [];

        $codes = $this->oc_registers[$index]['codes'];
        
        $items_loadorder = InvItemPart::join('inv_items','inv_item_parts.part_id','inv_items.id')
                    ->join('inv_assets', function ($query) use ($codes) {
                        $query->on('inv_item_parts.item_id','inv_assets.item_id')
                                ->whereIn('inv_assets.id',$codes);
                    })
                    ->select(
                        'inv_assets.id AS asset_id',
                        'inv_assets.patrimonial_code AS asset_code',
                        'inv_items.id',
                        'inv_items.name',
                        'inv_items.description',
                        'inv_item_parts.item_id'
                    )
                    ->where('inv_item_parts.item_id',$id)
                    ->orderBy('inv_assets.id')
                    ->get();
        
        if($items_loadorder){
            foreach($items_loadorder as $key => $item_loadorder){
                $assets = InvAssetParts::join('inv_assets','asset_part_id','inv_assets.id')
                                        ->where('inv_asset_parts.asset_id',$item_loadorder->asset_id)
                                        ->where('inv_assets.item_id',$item_loadorder->id)
                                        ->select('id','inv_assets.patrimonial_code')
                                        ->get();

                $this->items_loadorder[$key] = [
                    'asset_id'          => $item_loadorder->asset_id,
                    'asset_code'        => $item_loadorder->asset_code,
                    'id'                => $item_loadorder->id,
                    'name'              => $item_loadorder->name,
                    'description'       => $item_loadorder->description,
                    'assets'            => $assets ? $assets->toArray() : []
                ];
            }
        }

        $this->dispatchBrowserEvent('ser-load-order-open-modal-details', ['itemname' => $name]);
    }
}
