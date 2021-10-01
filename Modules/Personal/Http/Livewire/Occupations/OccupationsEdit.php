<?php

namespace Modules\Personal\Http\Livewire\Occupations;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Personal\Entities\PerOccupation;

class OccupationsEdit extends Component
{
    public $name;
    public $description;
    public $occupation;
    public $state;

    public function mount($occupation_id){
        $this->occupation = PerOccupation::find($occupation_id);
        $this->name = $this->occupation->name;
        $this->description = $this->occupation->description;
        $this->state = $this->occupation->state;
    }

    public function render()
    {
        return view('personal::livewire.occupations.occupations-edit');
    }

    public function save(){
        $this->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        $this->occupation->update([
            'name'           => $this->name,
            'description'    => $this->description,
            'state'          => $this->state,
            'person_edit'      => Auth::user()->person_id
        ]);
        $this->dispatchBrowserEvent('per-occupations-update', ['msg' => Lang::get('personal::labels.msg_update')]);
    }
}
