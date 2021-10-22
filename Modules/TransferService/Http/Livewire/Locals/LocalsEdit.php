<?php

namespace Modules\TransferService\Http\Livewire\Locals;

use Elrod\UserActivity\Activity;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\TransferService\Entities\SerLocal;

class LocalsEdit extends Component
{
    public $name;
    public $address;
    public $reference;
    public $longitude = '';
    public $latitude = '';
    public $state;
    public $local_search;
    public $zoom_map;

    public function mount($id){
        $this->local_search = SerLocal::find($id);
        $this->name = $this->local_search->name;
        $this->address = $this->local_search->address;
        $this->reference = $this->local_search->reference;
        $this->longitude = $this->local_search->longitude == ''?-75.015152:$this->local_search->longitude;
        $this->latitude = $this->local_search->latitude == ''?-9.189967:$this->local_search->latitude;
        $this->zoom_map = $this->local_search->latitude == ''?5:15;
        $this->state = $this->local_search->state;
    }

    public function render()
    {
        return view('transferservice::livewire.locals.locals-edit');
    }

    public function save(){
        $this->validate([
            'name' => 'required|min:3|max:255',
            'address' => 'required|min:3|max:255',
            'reference' => 'required|min:3|max:255'
        ]);

        $activity = new Activity;
        $activity->dataOld(SerLocal::find($this->local_search->id));

        $this->local_search->update([
            'name' => $this->name,
            'address' => $this->address,
            'reference' => $this->reference,
            'longitude' => $this->longitude,
            'latitude' => $this->latitude,
            'state' => $this->state,
            'person_edit'   =>  Auth::user()->person_id
        ]);

        $activity->modelOn(SerLocal::class,$this->local_search->id,'ser_locals');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('service_locals_edit',$this->local_search->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->local_search);
        $activity->log('se actualizo datos del Local');
        $activity->save();

        $this->dispatchBrowserEvent('ser-locals-edit', ['msg' => Lang::get('transferservice::messages.msg_update')]);
    }
}
