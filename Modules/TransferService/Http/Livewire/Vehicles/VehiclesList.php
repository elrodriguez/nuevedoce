<?php

namespace Modules\TransferService\Http\Livewire\Vehicles;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\TransferService\Entities\SerVehicle;
use Illuminate\Support\Facades\Lang;

class VehiclesList extends Component
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
        return view('transferservice::livewire.vehicles.vehicles-list', ['vehicles' => $this->getVehicles()]);
    }

    public function getVehicles(){
        return SerVehicle::where('license_plate','like','%'.$this->search.'%')
            ->join('ser_vehicle_types', 'vehicle_type_id', 'ser_vehicle_types.id')
            ->select(
                'ser_vehicles.id',
                'ser_vehicles.vehicle_type_id',
                'ser_vehicle_types.name AS vehicle_type',
                'ser_vehicles.license_plate',
                'ser_vehicles.mark',
                'ser_vehicles.model',
                'ser_vehicles.year',
                'ser_vehicles.length',
                'ser_vehicles.width',
                'ser_vehicles.high',
                'ser_vehicles.color',
                'ser_vehicles.features',
                'ser_vehicles.tare_weight',
                'ser_vehicles.net_weight',
                'ser_vehicles.gross_weight',
                'ser_vehicles.person_create',
                'ser_vehicles.person_edit',
                'ser_vehicles.state'
            )
            ->paginate($this->show);
    }

    public function vehiclesSearch()
    {
        $this->resetPage();
    }

    public function deleteVehicle($id){
        $vehicle = SerVehicle::find($id);

        $activity = new activity;
        $activity->log('Eliminó el Vehiculo');
        $activity->modelOn(SerVehicle::class,$id,'ser_vehicles');
        $activity->dataOld($vehicle);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $vehicle->delete();

        $this->dispatchBrowserEvent('ser-vehicles-delete', ['msg' => Lang::get('transferservice::messages.msg_delete')]);
    }
}
