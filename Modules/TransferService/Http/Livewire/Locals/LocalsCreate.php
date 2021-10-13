<?php

namespace Modules\TransferService\Http\Livewire\Locals;

use Elrod\UserActivity\Activity;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLocal;

class LocalsCreate extends Component
{
    public $name;
    public $address;
    public $reference;
    public $longitude = '';
    public $latitude = '';
    public $state = true;

    public function render()
    {
        return view('transferservice::livewire.locals.locals-create');
    }

    public function save(){
        $this->validate([
            'name' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'reference' => 'required|min:3|max:255'
        ]);

        $local = SerLocal::create([
            'name' => $this->name,
            'address' => $this->address,
            'reference' => $this->reference,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'state' => $this->state,
            'person_create' =>  Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(SerLocal::class,$local->id,'ser_locals');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_locals_create'));
        $activity->logType('create');
        $activity->log('creó un nuevo Local');
        $activity->save();

        $this->dispatchBrowserEvent('ser-locals-save', ['msg' => Lang::get('transferservice::messages.msg_success')]);
        $this->clearForm();
    }

    public function clearForm(){
        $this->name = null;
        $this->address = null;
        $this->reference = null;
        $this->longitude = '';
        $this->latitude = '';
        $this->state = true;
    }
}
