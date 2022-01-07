<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvAsset;
use Modules\Inventory\Entities\InvAssetParts;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvItemPart;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerLoadOrderDetailAsset;
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
    public $items_selected_add = '';
    public $items_add_save = [];
    public $count_items = 0;
    public $items_loadorder = [];
    public $asset_codes = [];
    public $asset_items = [];

    public function mount(){
        $this->vehicles = SerVehicle::where('state',true)->get();
        $this->getItemsODT();
        $this->getItemsODTAdd();
    }

    public function calcAmountAdd($id){
        $id_s = array_search($id, array_column($this->items_add_save, 'id'));
        $amount_add = 0;
        if($id_s === false){

        }else{
            $amount_add = $this->items_add_save[$id_s]['amount_select'];
        }

        return (int) $amount_add;
    }

    public function render(){
        
        return view('transferservice::livewire.loadorder.loadorder-create');
    }

    public function selWeight(){
        $this->vehicle_load = isset(SerVehicle::find($this->vehicle_id)->net_weight)?SerVehicle::find($this->vehicle_id)->net_weight:'';
        $this->dispatchBrowserEvent('ser-load-order-weight', ['vehicle_w' => $this->vehicle_load]);
    }

    public function getItemsODT(){
        $odt_pending_detail = SerOdtRequestDetail::where('ser_odt_request_details.state', 'P')
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
                CONCAT(inv_items.name,' ',inv_items.description) AS name_item,
                ser_odt_request_details.amount,
                (ser_odt_request_details.amount - ser_odt_request_details.quantity_served) AS amount_pending,
                ser_odt_request_details.quantity_served
            "))
            ->whereNotIn('ser_odt_request_details.id', explode('|', $this->items_selected))
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();
        $pending_odt = [];
        foreach ($odt_pending_detail as $key=>$row){
            $detail_p['id'] = $row->id;
            $detail_p['internal_id'] = $row->internal_id;
            $detail_p['name_evento'] = $row->name_evento;
            $detail_p['name_customer'] = $row->name_customer;
            $detail_p['date_start'] = $row->date_start;
            $detail_p['date_end'] = $row->date_end;
            $detail_p['name_item'] = $row->name_item;
            $detail_p['amount'] = $row->amount;
            $detail_p['amount_pending'] = $row->amount_pending - $this->calcAmountAdd($row->id);
            $detail_p['quantity_served'] = $row->quantity_served;
            $pending_odt[] = $detail_p;
        }
        $this->odt_pending = $pending_odt;
    }

    public function getItemsODTAdd(){

        $ocd_register_detail = SerOdtRequestDetail::where('ser_odt_request_details.state', 'P')
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
                DB::raw('CONCAT(inv_items.name," ",inv_items.description) AS name_item'),
                'ser_odt_request_details.amount',
                'ser_odt_request_details.quantity_served',
                'inv_items.weight'
            )
            ->whereIn('ser_odt_request_details.id', explode('|', $this->items_selected_add))
            ->orderBy('ser_odt_requests.internal_id', 'asc')
            ->orderBy('ser_odt_request_details.id', 'asc')
            ->get();

        $detail_odt = [];

        foreach ($ocd_register_detail as $key => $row){
            $assets = InvAsset::where('item_id',$row->item_id)->select('id','patrimonial_code')->get();
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
            $detail_a['amount_select']      = $this->calcAmountAdd($row->id);
            $detail_a['weight']             = $row->weight;
            $detail_a['assets']             = $assets ? $assets->toArray() : [];
            $detail_a['codes']              = [];
            $detail_odt[] = $detail_a;
        }

        $this->oc_registers = $detail_odt;
        
        $this->dispatchBrowserEvent('ser-load-order-select-assets', ['success' => true]);
    }

    public function saveItemsODT($register){
        $params         = explode('|', $register);
        $array_aux      = $this->items_add_save;
        $a = 0;
        foreach ($params as $item){
            $vals           = explode('#', $item);
            $id_detail_odt  = isset($vals[0])?$vals[0]:0;
            $amount_total   = isset($vals[1])?$vals[1]:0;
            $amount_select  = isset($vals[2])?$vals[2]:0;
            if($id_detail_odt > 0 && $amount_total > 0 && $amount_select > 0){
                $id = array_search($id_detail_odt, array_column($array_aux, 'id'));

                if($id === false){
                    array_push($array_aux, array('id'=>$id_detail_odt, 'total'=>$amount_total, 'amount_select'=> $amount_select, 'validate_item'=>($amount_total == $amount_select?1:0)));
                }else{
                    $amount_exist = $array_aux[$id]['amount_select'];
                    $array_aux[$id]['amount_select'] = $amount_exist + $amount_select;
                    if($array_aux[$id]['amount_select']  == $array_aux[$id]['total'] ){
                        $array_aux[$id]['validate_item'] = 1;
                    }
                }
            }
        }

        $this->items_add_save = $array_aux;

        $a = 0;
        $b = 0;

        foreach ($this->items_add_save as $item){
            if($item['validate_item'] == 1){
                if($a == 0){
                    $this->items_selected = $item['id'];
                }else{
                    $this->items_selected = $this->items_selected.'|'.$item['id'];
                }
                $a++;
            }
            if($b == 0){
                $this->items_selected_add = $item['id'];
            }else{
                $this->items_selected_add = $this->items_selected_add.'|'.$item['id'];
            }
            $b++;
        }

        $this->getItemsODT();
        $this->getItemsODTAdd();
        $this->count_items = count($this->items_add_save);
        $sum_weight = 0;
        foreach ($this->oc_registers as $key => $odt){
            $id = array_search($odt['id'], array_column($this->items_add_save, 'id'));
            $amount_select = $this->items_add_save[$id]['amount_select'];
            $sum_weight += $amount_select * $odt['weight'];
        }
        $this->charge_weight = $sum_weight;
        $this->dispatchBrowserEvent('ser-load-order-select-weight', ['select_w' => $this->charge_weight]);
    }

    public function deleteItemODT($id){
        //para hacer el not in
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
        //Para listar los add:
        $items_add = explode('|', $this->items_selected_add);
        $aux_add = '';
        $a = 0;
        $array_add_aux = array();
        foreach ($items_add as $r){
            if($r != $id){
                if($a == 0){
                    $aux_add = $r;
                }else{
                    $aux_add = $aux_add.'|'.$r;
                }
            }else{
                $array_add = $this->items_add_save;
                foreach ($array_add as $row){
                    if($r != $row['id']){
                        $dataNew['id']              = $row['id'];
                        $dataNew['total']           = $row['total'];
                        $dataNew['amount_select']   = $row['amount_select'];
                        $dataNew['validate_item']   = $row['validate_item'];
                        $array_add_aux[]            = $dataNew;
                    }
                }
            }
            $a++;
        }
        $this->items_selected_add = $aux_add;
        $this->items_add_save = $array_add_aux;
        //Fin

        $this->count_items = count($this->items_add_save);
        $this->getItemsODT();
        $this->getItemsODTAdd();
        $sum_weight = 0;
        foreach ($this->oc_registers as $key => $odt){
            $id = array_search($odt['id'], array_column($this->items_add_save, 'id'));
            $amount_select = $this->items_add_save[$id]['amount_select'];
            $sum_weight += $amount_select * $odt['weight'];
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

        //dd($this->oc_registers);

        foreach ($this->oc_registers as $key => $odt){
            $id = array_search($odt['id'], array_column($this->items_add_save, 'id'));
            $amount_select = $this->items_add_save[$id]['amount_select'];

            $save_detail_oc = SerLoadOrderDetail::create([
                'load_order_id'         => $save_oc->id,
                'odt_request_detail_id' => $odt['id'],
                'odt_request_id'        => $odt['odt_request_id'],
                'item_id'               => $odt['item_id'],
                'amount'                => $amount_select,
                'person_create'         => Auth::user()->person_id
            ]);

            ///se guardan los activos con codigos para los items de las oc
            foreach($odt['codes'] as $codes){
                SerLoadOrderDetailAsset::create([
                    'item_id'       => $odt['item_id'],
                    'asset_id'      => $codes,
                    'load_order_id' => $save_oc->id
                ]);
            }

            //Actualizando el estado en ODT detalle
            $odt_detail_u = SerOdtRequestDetail::find($odt['id']);

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

            //Consultando si ODT Detalle hay Pendiente si no para cambiar estado del padre (ODT)
            $cantidad_odt_p = SerOdtRequestDetail::where('odt_request_id','=', $odt['odt_request_id'])
                ->where('state', '=', 'P')
                ->get();
            if(count($cantidad_odt_p) == 0){
                $odt_head_u = SerOdtRequest::find($odt['odt_request_id']);
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
        $this->items_selected_add = '';
        $this->count_items = 0;
        $this->odt_pending = [];
        $this->oc_registers = [];
        $this->items_add_save = [];
        $this->getItemsODT();
        $this->getItemsODTAdd();
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
