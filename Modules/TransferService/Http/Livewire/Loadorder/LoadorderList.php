<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Modules\Inventory\Entities\InvItemPart;
use Modules\TransferService\Entities\SerLoadOrder;
use Modules\TransferService\Entities\SerLoadOrderDetail;
use Modules\TransferService\Entities\SerOdtRequest;
use Modules\TransferService\Entities\SerOdtRequestDetail;

class LoadorderList extends Component
{
    public $show;
    public $search;
    public $loadorderdetails = [];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('transferservice::livewire.loadorder.loadorder-list',['loadorders' => $this->getLoadOrder()]);
    }

    public function getLoadOrder(){
        return SerLoadOrder::where('ser_load_orders.uuid','like','%'.$this->search.'%')
            ->join('ser_vehicles','vehicle_id','ser_vehicles.id')
            ->join('ser_vehicle_types','vehicle_type_id','ser_vehicle_types.id')
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
            ->orderBy('ser_load_orders.id','DESC')
            ->paginate($this->show);
    }

    public function loadorderSearch(){
        $this->resetPage();
    }

    public function deleteLoadOrder($id){
        $odtLoadOrder_s = SerLoadOrder::find($id);

        //Consultando los items para Cambiar su estado y eliminar
        $loadOrderDetail = SerLoadOrderDetail::where('load_order_id', '=', $id)->get();
        foreach ($loadOrderDetail as $key=>$row){
            $detail_sr = SerLoadOrderDetail::find($row->id);
            $detail_srodt = SerOdtRequestDetail::find($row->odt_request_detail_id);
            $detail_srodt->update([
                'state'             => 'P',
                'quantity_served'   => ($detail_srodt->quantity_served - $detail_sr->amount),
                'person_edit'       => Auth::user()->person_id
            ]);

            $detail_sr->delete();

            $odt_sr = SerOdtRequest::find($row->odt_request_id);
            $odt_sr->update([
                'state'         => 'P',
                'person_edit'   => Auth::user()->person_id
            ]);
        }

        $activity = new activity;
        $activity->log('Se eliminó la Orden de Carga correctamente');
        $activity->modelOn(SerLoadOrder::class,$id,'ser_load_orders');
        $activity->dataOld($odtLoadOrder_s);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $odtLoadOrder_s->delete();


        $this->dispatchBrowserEvent('ser-load-order-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
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
