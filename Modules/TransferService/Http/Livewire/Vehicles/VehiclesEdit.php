<?php

namespace Modules\TransferService\Http\Livewire\Vehicles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerVehicle;
use Elrod\UserActivity\Activity;
use Modules\TransferService\Entities\SerVehicleType;

class VehiclesEdit extends Component
{
    public $vehicle_type_id;
    public $license_plate;
    public $mark;
    public $model;
    public $year;
    public $length;
    public $width;
    public $high;
    public $color;
    public $features;
    public $tare_weight;
    public $net_weight;
    public $gross_weight;
    public $state;
    public $vehicle_search;

    public $vehicle_types = [];

    public function mount($id){
        $this->vehicle_types = SerVehicleType::where('state',true)->get();
        $this->vehicle_search = SerVehicle::find($id);
        $this->vehicle_type_id = $this->vehicle_search->vehicle_type_id;
        $this->license_plate = $this->vehicle_search->license_plate;
        $this->mark = $this->vehicle_search->mark;
        $this->model = $this->vehicle_search->model;
        $this->year = $this->vehicle_search->year;
        $this->length = $this->vehicle_search->length;
        $this->width = $this->vehicle_search->width;
        $this->high = $this->vehicle_search->high;
        $this->color = $this->vehicle_search->color;
        $this->features = $this->vehicle_search->features;
        $this->tare_weight = $this->vehicle_search->tare_weight;
        $this->net_weight = $this->vehicle_search->net_weight;
        $this->gross_weight = $this->vehicle_search->gross_weight;
        $this->state = $this->vehicle_search->state;
    }

    public function render()
    {
        return view('transferservice::livewire.vehicles.vehicles-edit');
    }

    public function save(){
        $this->validate([
            'vehicle_type_id' => 'required',
            'license_plate' => 'required|min:3|max:255',
            'mark' => 'required|min:3|max:255',
            'model' => 'required|min:3|max:255',
            'year' => 'required|numeric|min:4',
            'length' => 'required|numeric|between:0,9999999.99',
            'width' => 'required|numeric|between:0,9999999.99',
            'high' => 'required|numeric|between:0,9999999.99',
            'color' => 'required|min:4',
            'features' => 'min:5',
            'tare_weight' => 'required|numeric|between:0,9999999.99',
            'net_weight' => 'required|numeric|between:0,9999999.99',
            'gross_weight' => 'required|numeric|between:0,9999999.99'
        ]);

        $activity = new Activity;
        $activity->dataOld(SerVehicle::find($this->vehicle_search->id));

        $this->vehicle_search->update([
            'vehicle_type_id' => $this->vehicle_type_id,
            'license_plate' => $this->license_plate,
            'mark'          => $this->mark,
            'model'         => $this->model,
            'year'          => $this->year,
            'length'        => $this->length,
            'width'         => $this->width,
            'high'          => $this->high,
            'color'         => $this->color,
            'features'      => $this->features,
            'tare_weight'   => $this->tare_weight,
            'net_weight'    => $this->net_weight,
            'gross_weight'  => $this->gross_weight,
            'state'         => $this->state,
            'person_edit'   =>  Auth::user()->person_id
        ]);

        $activity->modelOn(SerVehicle::class,$this->vehicle_search->id,'ser_vehicles');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_vehicles_edit',$this->vehicle_search->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->vehicle_search);
        $activity->log('se actualizo datos del Vehículo');
        $activity->save();

        $this->dispatchBrowserEvent('ser-vehicles-edit', ['msg' => Lang::get('transferservice::messages.msg_update')]);
    }
}
