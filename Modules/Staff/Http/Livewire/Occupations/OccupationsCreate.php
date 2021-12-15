<?php

namespace Modules\Staff\Http\Livewire\Occupations;

use Elrod\UserActivity\Activity;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Staff\Entities\StaOccupation;

class OccupationsCreate extends Component
{
    public $name;
    public $description;
    public $state = true;

    public function render()
    {
        return view('staff::livewire.occupations.occupations-create');
    }

    public function save(){
        $this->validate([
            'name' => 'required|max:255',
            //'description' => 'required|max:255'
        ]);

        $occupation = StaOccupation::create([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
            'person_create' => Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(StaOccupation::class, $occupation->id,'per_occupations');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('staff_occupation_create'));
        $activity->logType('create');
        $activity->log('Se creó una nueva ocupación');
        $activity->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('per-occupations-save', ['msg' => Lang::get('staff::labels.msg_success')]);
    }

    public function  clearForm(){
        $this->name = '';
        $this->description = '';
        $this->state = true;
    }
}
