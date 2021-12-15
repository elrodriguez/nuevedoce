<?php

namespace Modules\Staff\Http\Livewire\Occupations;

use Elrod\UserActivity\Activity;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Staff\Entities\StaOccupation;

class OccupationsEdit extends Component
{
    public $name;
    public $description;
    public $occupation;
    public $state;

    public function mount($occupation_id){
        $this->occupation = StaOccupation::find($occupation_id);
        $this->name = $this->occupation->name;
        $this->description = $this->occupation->description;
        $this->state = $this->occupation->state;
    }

    public function render()
    {
        return view('staff::livewire.occupations.occupations-edit');
    }

    public function save(){
        $this->validate([
            'name' => 'required|max:255',
            //'description' => 'required|max:255'
        ]);

        $activity = new Activity;
        $activity->dataOld(StaOccupation::find($this->occupation->id));

        $this->occupation->update([
            'name'           => $this->name,
            'description'    => $this->description,
            'state'          => $this->state,
            'person_edit'      => Auth::user()->person_id
        ]);

        $activity->modelOn(StaOccupation::class,$this->occupation->id,'per_occupations');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('staff_occupation_edit',$this->occupation->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->occupation);
        $activity->log('Se actualizo datos de la ocupación');
        $activity->save();

        $this->dispatchBrowserEvent('per-occupations-update', ['msg' => Lang::get('staff::labels.msg_update')]);
    }
}
