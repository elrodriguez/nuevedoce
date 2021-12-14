<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvItemPart;
use Modules\Inventory\Entities\InvKardex;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;

class LoadorderReturn extends Component
{
    public $show;
    public $search;
    public $date_upload;
    public $license_plate;
    public $loadorderdetails = [];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('transferservice::livewire.loadorder.loadorder-return', ['load_orders' => $this->getLoadOrders()]);
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
            ->where('ser_load_orders.upload_date', '=', $date)
            //->where('ser_load_orders.state', '=', 'E')
            ->select(
                'ser_vehicles.license_plate',
                'ser_vehicle_types.name',
                'ser_load_orders.id',
                'ser_load_orders.charge_maximum',
                'ser_load_orders.charge_weight',
                'ser_load_orders.upload_date',
                'ser_load_orders.charging_time',
                'ser_load_orders.departure_date',
                'ser_load_orders.departure_time',
                'ser_load_orders.return_date',
                'ser_load_orders.return_time',
                'ser_load_orders.uuid',
                'ser_load_orders.state'
            )
            ->orderBy('ser_load_orders.upload_date', 'DESC')
            ->paginate($this->show);

        return $data;
    }

    public function acceptReturn($id){
        $loar_order_search = SerLoadOrder::find($id);
        $load_order_detail = SerLoadOrderDetail::where('load_order_id', '=', $id)->get();
        $date_of_issue = Carbon::now()->format('Y-m-d');

        foreach ($load_order_detail as $row){
            InvKardex::create([
                'date_of_issue'     => $date_of_issue,
                'establishment_id'  => 1,
                'location_id'       => 1,
                'item_id'           => $row->item_id,
                'quantity'          => $row->amount,
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
                        'quantity'          => $part->quantity,
                        'kardexable_id'     => $id,
                        'kardexable_type'   => SerLoadOrder::class,
                        'detail'            => 'Salida para servicios terceros'
                    ]);
                }
            }
        }
        $loar_order_search->update([
            'state'         => 'A', //Retornado
            'return_date'   => Carbon::now()->format('Y-m-d'),
            'return_time'   => date("H:i:s"),
            'person_edit'   => Auth::user()->person_id
        ]);
        $this->dispatchBrowserEvent('ser-load-order-return', ['msg' => Lang::get('transferservice::messages.msg_success')]);
    }

    public function loadOrderSearch(){
        $this->resetPage();
    }

    public function clearInput(){
        $this->search = null;
        $this->date_upload = null;
        $this->license_plate = null;
    }

    public function getLoadOrderDetails($id){
        $this->loadorderdetails = [];

        $this->loadorderdetails = InvItemPart::join('inv_items AS part','inv_item_parts.part_id','part.id')
                                    ->join('inv_items AS asset','inv_item_parts.item_id','asset.id')
                                    ->join('inv_categories','asset.category_id','inv_categories.id')
                                    ->join('ser_load_order_details','asset.id','ser_load_order_details.item_id')
                                    ->select(
                                        'inv_categories.description AS category_name',
                                        'asset.name AS asset_name',
                                        'asset.description AS asset_description',
                                        'part.name AS part_name',
                                        'inv_item_parts.quantity'
                                    )
                                    ->where('ser_load_order_details.load_order_id',$id)
                                    ->get();

        $this->dispatchBrowserEvent('ser-load-order-details', ['success' => true]);

    }
}
