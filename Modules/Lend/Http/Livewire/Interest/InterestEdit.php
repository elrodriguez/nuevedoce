<?php

namespace Modules\Lend\Http\Livewire\Interest;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenInterest;

class InterestEdit extends Component
{
    public $description;
    public $value;
    public $state;
    public $interest;

    public function mount($interest_id){
        $this->interest = LenInterest::find($interest_id);
        $this->description = $this->interest->description;
        $this->value = $this->interest->value;
        $this->state = $this->interest->state;
    }

    public function render()
    {
        return view('lend::livewire.interest.interest-edit');
    }

    public function save(){
        $this->validate([
            'description'   => 'required|max:255',
            'value'         => 'required|numeric'
        ]);

        $activity = new Activity;
        $activity->dataOld(LenInterest::find($this->interest->id));

        $this->interest->update([
            'description'    => $this->description,
            'value'          => $this->value,
            'state'          => $this->state,
            'person_edit'    => Auth::user()->person_id
        ]);

        $activity->modelOn(LenInterest::class,$this->interest->id,'len_interests');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_interest_edit',$this->interest->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->interest);
        $activity->log('Se actualizo datos del interés');
        $activity->save();

        $this->dispatchBrowserEvent('len-interest-update', ['msg' => Lang::get('lend::messages.msg_update')]);
    }
}
