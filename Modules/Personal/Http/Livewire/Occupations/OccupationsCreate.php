<?php

namespace Modules\Personal\Http\Livewire\Occupations;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Personal\Entities\PerOccupation;

class OccupationsCreate extends Component
{
    public $name;
    public $description;
    public $state = true;

    public function render()
    {
        return view('personal::livewire.occupations.occupations-create');
    }

    public function save(){
        $this->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255'
        ]);

        PerOccupation::create([
            'name' => $this->name,
            'description' => $this->description,
            'state' => $this->state,
            'person_create' => Auth::user()->person_id
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('per-occupations-save', ['msg' => Lang::get('personal::labels.msg_success')]);
    }

    public function  clearForm(){
        $this->name = '';
        $this->description = '';
        $this->state = true;
    }
}
