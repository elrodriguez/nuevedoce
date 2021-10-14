<?php

namespace Modules\TransferService\Http\Livewire\Vehicles;

use Livewire\Component;
use Modules\TransferService\Entities\SerVehicleCrewman;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;

class VehiclesCrew extends Component
{
    public $vehicle_id;
    public $employee_id;
    public $description;
    public $crew = [];

    public function mount($vehicle_id){
        $this->vehicle_id = $vehicle_id;
    }

    public function render()
    {
        $this->crew = SerVehicleCrewman::join('per_employees','employee_id','per_employees.id')
            ->join('people','person_id','people.id')
            ->join('per_occupations','occupation_id','per_occupations.id')
            ->select(
                'ser_vehicle_crewmen.id',
                'people.number',
                'people.full_name',
                'per_occupations.name AS ocupation',
                'ser_vehicle_crewmen.description'
            )
            ->where('vehicle_id',$this->vehicle_id)
            ->get();

        return view('transferservice::livewire.vehicles.vehicles-crew');
    }

    public function addEmployee(){
        $this->validate([
            'employee_id' => 'required|unique:ser_vehicle_crewmen,employee_id,NULL,id,vehicle_id,' . $this->vehicle_id //validando campo unico compuesto
        ]);

        $crewman = SerVehicleCrewman::create([
            'vehicle_id' => $this->vehicle_id,
            'employee_id' => $this->employee_id,
            'description' => $this->description
        ]);

        $activity = new Activity;
        $activity->modelOn(SerVehicleCrewman::class,$crewman->id,'ser_vehicle_crewmen');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_vehicles_crew',$this->vehicle_id));
        $activity->logType('create');
        $activity->log('Agregó un tripulante al viculo');
        $activity->save();

        $this->employee_id = null;
        $this->description = null;


    }

    public function deleteEmployee($id){
        $crewman = SerVehicleCrewman::find($id);
        
        $activity = new activity;
        $activity->log('Elimino un tripulante');
        $activity->modelOn(SerVehicleCrewman::class,$id,'set_establishments');
        $activity->dataOld($crewman); 
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $crewman->delete();

        $this->dispatchBrowserEvent('ser-crewman-delete', ['msg' => 'Datos eliminados correctamente.']);
    }
}
