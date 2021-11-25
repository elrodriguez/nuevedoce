<?php

namespace Modules\Lend\Http\Livewire\Interest;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenInterest;

class InterestCreate extends Component
{
    public $description;
    public $value;
    public $state = true;

    public function render()
    {
        return view('lend::livewire.interest.interest-create');
    }

    public function save(){
        $this->validate([
            'description'   => 'required|max:255',
            'value'         => 'required|numeric'
        ]);

        $interest = LenInterest::create([
            'description'   => $this->description,
            'value'         => $this->value,
            'state'         => $this->state,
            'person_create' => Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(LenInterest::class, $interest->id,'len_interests');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_interest_create'));
        $activity->logType('create');
        $activity->log('Se creó un nuevo interés');
        $activity->save();

        $this->dispatchBrowserEvent('len-interest-save', ['msg' => Lang::get('lend::messages.msg_success')]);
        $this->clearForm();
    }

    public function  clearForm(){
        $this->description  = '';
        $this->value        = '';
        $this->state        = true;
    }
}
