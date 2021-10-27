<?php

namespace Modules\TransferService\Http\Livewire\Loadorder;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLoadOrder;

class LoadorderList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render()
    {
        return view('transferservice::livewire.loadorder.loadorder-list',['loadorders' => $this->getLoadOrder() ]);
    }

    public function getLoadOrder(){
        return SerLoadOrder::join('ser_vehicles','vehicle_id','ser_vehicles.id')
            ->join('ser_vehicle_types','vehicle_type_id','ser_vehicle_types.id')
            ->select(
                'ser_vehicles.license_plate',
                'ser_vehicle_types.name',
                'ser_load_orders.charge_maximum',
                'ser_load_orders.charge_weight',
                'ser_load_orders.departure_date',
                'ser_load_orders.departure_time',
                'ser_load_orders.return_date',
                'ser_load_orders.return_time',
                'ser_load_orders.uuid'
            )
            ->paginate($this->show);
    }

    public function loadorderSearch()
    {
        $this->resetPage();
    }
}
