<?php

namespace Modules\TransferService\Http\Livewire\Vehicles;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerVehicle;
use Elrod\UserActivity\Activity;
use Modules\TransferService\Entities\SerVehicleType;

class VehiclesCreate extends Component
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
    public $state = true;

    public $vehicle_types = [];

    public function mount(){
        $this->vehicle_types = SerVehicleType::where('state',true)->get();
    }

    public function render()
    {
        return view('transferservice::livewire.vehicles.vehicles-create');
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

        $vehicle = SerVehicle::create([
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
            'person_create' =>  Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(SerVehicle::class,$vehicle->id,'ser_vehicles');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_vehicles_create'));
        $activity->logType('create');
        $activity->log('creó un nuevo vehículo');
        $activity->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('ser-vehicles-save', ['msg' => Lang::get('transferservice::messages.msg_success')]);
    }

    public function clearForm(){
        $this->vehicle_type_id = null;
        $this->license_plate = null;
        $this->mark = null;
        $this->model = null;
        $this->year = null;
        $this->length = null;
        $this->width = null;
        $this->high = null;
        $this->color = null;
        $this->features = null;
        $this->tare_weight = null;
        $this->net_weight = null;
        $this->gross_weight = null;
        $this->state = true;
    }
}
