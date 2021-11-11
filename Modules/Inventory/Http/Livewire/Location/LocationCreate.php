<?php

namespace Modules\Inventory\Http\Livewire\Location;

use Livewire\Component;
use Modules\Inventory\Entities\InvLocation;
use Modules\Setting\Entities\SetEstablishment;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;

class LocationCreate extends Component
{
    public $establisments;
    public $establishment_id;
    public $name;
    public $state = true;

    public function mount(){
        $this->establisments = SetEstablishment::where('state',true)->get();
    }

    public function render()
    {
        return view('inventory::livewire.location.location-create');
    }

    public function save(){

        $this->validate([
            'name'       => 'required',
            'establishment_id'  => 'required'
        ]);
       
        
        $location = InvLocation::create([
            'establishment_id'  => $this->establishment_id,
            'name'              => $this->name,
            'state'            => $this->state
        ]);

        $activity = new Activity;
        $activity->modelOn(InvLocation::class, $location->id,'inv_locations');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('inventory_asset_create'));
        $activity->logType('create');
        $activity->log('Se creó una nueva ubicacion');
        $activity->save();

        $this->clearForm();
        $this->dispatchBrowserEvent('set-location-save', ['msg' => Lang::get('inventory::labels.msg_success')]);
    }
    
    
    
    public function clearForm(){
        $this->establishment_id     =  null;
        $this->name          = null;
        $this->state               = true;
        
    }
}
