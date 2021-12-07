<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvKardex;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerOdtRequest;
use Modules\TransferService\Entities\SerVehicle;

class LoadorderExit extends Component
{
    public $show;
    public $search;
    public $date_upload;
    public $license_plate;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render(){
        return view('transferservice::livewire.loadorder.loadorder-exit', ['load_orders' => $this->getLoadOrders()]);
    }

    public function getLoadOrders(){
        $date = null;

        if($this->date_upload){
            list($ds,$ms,$ys) = explode('/',$this->date_upload);
            $date =  $ys.'-'.$ms.'-'.$ds;
        }

        $license_plate  = $this->license_plate;
        $search    = $this->search;

        $data = SerLoadOrder::join('ser_vehicles', 'vehicle_id', 'ser_vehicles.id')
            ->join('ser_vehicle_types', 'vehicle_type_id', 'ser_vehicle_types.id')
            ->when($search, function ($query) use ($search) {
                return $query->where('ser_load_orders.uuid', '=', $search);
            })
            ->when($license_plate, function ($query) use ($license_plate) {
                return $query->where('ser_vehicles.license_plate', '=', $license_plate);
            })
            ->leftjoin('ser_vehicle_crewmen', 'ser_vehicles.id', 'ser_vehicle_crewmen.vehicle_id')
            ->leftjoin('sta_employees', 'ser_vehicle_crewmen.employee_id', 'sta_employees.id')
            ->leftjoin('people', 'sta_employees.person_id', 'people.id')
            ->where('ser_load_orders.upload_date', '=', $date)
            ->select(DB::raw("
               ser_vehicles.license_plate,
               ser_vehicle_types.name,
               ser_load_orders.id,
               ser_load_orders.charge_maximum,
               ser_load_orders.charge_weight,
               ser_load_orders.upload_date,
               ser_load_orders.charging_time,
               ser_load_orders.departure_date,
               ser_load_orders.departure_time,
               ser_load_orders.return_date,
               ser_load_orders.return_time,
               ser_load_orders.uuid,
               ser_load_orders.state,
               ser_vehicles.id AS vehicle_id,
               IF(LENGTH(people.telephone) = 9, people.telephone, '') AS telephone
            "))
            ->orderBy('ser_load_orders.upload_date', 'DESC')
            ->paginate($this->show);
        return $data;
    }

    public function acceptExit($id){
        $loar_order_search = SerLoadOrder::find($id);
        $load_order_detail = SerLoadOrderDetail::where('load_order_id', '=', $id)->get();
        $date_of_issue = Carbon::now()->format('Y-m-d');

        $aux_odt = '';
        foreach ($load_order_detail as $row){
            if($aux_odt != $row->odt_request_id){
                $search_odt = SerOdtRequest::find($row->odt_request_id);
                $search_odt->update([
                    'state'         => 'A', //Atendido
                    'person_edit'   => Auth::user()->person_id
                ]);
            }

            InvKardex::create([
                'date_of_issue'     => $date_of_issue,
                'establishment_id'  => 1,
                'location_id'       => 1,
                'item_id'           => $row->item_id,
                'quantity'          => -($row->amount),
                'kardexable_id'     => $id,
                'kardexable_type'   => SerLoadOrder::class,
                'detail'            => 'Salida para servicios terceros'
            ]);

            $parts = InvItemPart::where('item_id', $row->item_id)->get();

            if($parts){
                foreach($parts as $part){
                    InvKardex::create([
                        'date_of_issue'     => $date_of_issue,
                        'establishment_id'  => 1,
                        'location_id'       => 1,
                        'item_id'           => $row->item_id,
                        'quantity'          => -($part->quantity),
                        'kardexable_id'     => $id,
                        'kardexable_type'   => SerLoadOrder::class,
                        'detail'            => 'Salida para servicios terceros'
                    ]);
                }
            }

            $aux_odt = $row->odt_request_id;
        }
        $loar_order_search->update([
            'state'         => 'E', //En servicio
            'departure_date'=> Carbon::now()->format('Y-m-d'),
            'departure_time'=> date("H:i:s"),
            'person_edit'   => Auth::user()->person_id
        ]);
        $this->dispatchBrowserEvent('ser-load-order-accept', ['msg' => Lang::get('transferservice::messages.msg_success')]);
    }

    public function loadOrderSearch(){
        $this->resetPage();
    }

    public function clearInput(){
        $this->search = null;
        $this->date_upload = null;
        $this->license_plate = null;
    }

    public function openModalDetails($id, $telephone){
        $body = '';
        $orderDetail = SerLoadOrderDetail::where('load_order_id', '=', $id)
            ->join('ser_odt_requests', 'odt_request_id', 'ser_odt_requests.id')
            ->join('ser_locals', 'ser_odt_requests.local_id', 'ser_locals.id')
            ->select(
                'ser_odt_requests.local_id',
                'ser_locals.name',
                'ser_locals.address',
                'ser_locals.reference',
                'ser_locals.longitude',
                'ser_locals.latitude'
            )
            ->get();
        $array_aux = array();
        $local_aux = '';
        foreach ($orderDetail as $row){
            if($local_aux != $row->local_id){
                array_push($array_aux, $row);
            }
            $local_aux = $row->local_id;
        }

        $cantidad   = count($array_aux);
        $label      = '';
        $address    = '';
        $reference  = '';
        $lat        = '';
        $lng        = '';
        $array_data = array();
        $a = 0;
        $route_map_w = '';
        foreach ($array_aux as $row){
            if($a == 0){
                $label = $row->name;
                $address = $row->address;
                $reference = $row->reference;
                $route_map_w = 'https://maps.google.com/?q='.$row->latitude.','.$row->longitude;
            }else{
                $label = $label.', '.$row->name;
                $address = $address.', '.$row->address;
                $reference = $reference.', '.$row->reference;
                $route_map_w = $route_map_w.' https://maps.google.com/?q='.$row->latitude.','.$row->longitude;
            }
            $lat = (double) $row->latitude;
            $lng = (double) $row->longitude;
            array_push($array_data, array('title'=>$row->name, 'lat'=>(double) $row->latitude, 'lon'=>(double) $row->longitude));
            $a++;
        }
        $body .= '
        <dl class="row">
            <dt class="col-sm-2">'.Lang::get('labels.address').'</dt>
            <dd class="col-sm-10">'.$address.'</dd>
            <dt class="col-sm-2">'.Lang::get('transferservice::labels.lbl_reference').'</dt>
            <dd class="col-sm-10">'.$reference.'</dd>
        </dl>
        <div>
            <div id="map" style="height: 300px;" wire:ignore></div>
        </div>';

        $map_whatsapp = '';
        if($telephone != ''){
            $map_whatsapp = 'https://wa.me/51'.$telephone.'/?text=Ruta '.$route_map_w;
        }

        $this->dispatchBrowserEvent('ser-load-exit-details', ['body' => $body,'label' => $label,'lat' => $lat,'lng' => $lng, 'data'=>$array_data, 'whatsapp'=>$map_whatsapp]);
    }
}
