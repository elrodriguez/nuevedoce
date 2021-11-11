<?php

namespace Modules\Inventory\Http\Livewire\Location;

use Livewire\Component;
use Modules\Inventory\Entities\InvLocation;
use Modules\Setting\Entities\SetEstablishment;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LocationEdit extends Component
{
    public $establisments;
    public $establishment_id;
    public $location;
    public $name;
    public $state = true;

    public function mount($location_id){
        $this->establisments    = SetEstablishment::where('state',true)->get();
        $this->location         = InvLocation::find($location_id);
        $this->establishment_id = $this->location->establishment_id;
        $this->name             = $this->location->name;
        $this->state            = $this->location->state;
    }

    public function render()
    {
        return view('inventory::livewire.location.location-edit');
    }

    public function save(){

        $this->validate([
            'name'       => 'required',
            'establishment_id'  => 'required'
        ]);

        $activity = new Activity;
        $activity->dataOld(InvLocation::find($this->location->id));
        
        $this->location->update([
            'establishment_id'  => $this->establishment_id,
            'name'              => $this->name,
            'state'            => $this->state
        ]);

        $activity->modelOn(InvLocation::class, $this->location->id,'inv_locations');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_asset_create'));
        $activity->logType('edit');
        $activity->dataUpdated(InvLocation::find($this->location->id));
        $activity->log('Se edito los datos ubicacion');
        $activity->save();

        $this->dispatchBrowserEvent('set-location-update', ['msg' => Lang::get('inventory::labels.msg_success')]);
    }
}
