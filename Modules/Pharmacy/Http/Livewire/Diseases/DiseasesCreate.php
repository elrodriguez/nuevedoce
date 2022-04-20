<?php

namespace Modules\Pharmacy\Http\Livewire\Diseases;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Pharmacy\Entities\PharDisease;

class DiseasesCreate extends Component
{
    public $name;
    public $description;
    public $causes;
    public $fracture;

    public function render()
    {
        return view('pharmacy::livewire.diseases.diseases-create');
    }

    public function saveDisease(){
        $this->validate([
            'name' => 'required|max:300',
            'description' => 'required',
            'causes' => 'required'
        ]);

        PharDisease::create([
            'name' => $this->name,
            'description' => htmlentities($this->description),
            'causes' => htmlentities($this->causes),
            'fracture' => $this->fracture ? false : true
        ]);

        $this->name = null;
        $this->description = null;
        $this->causes = null;
        $this->fracture = false;

        $this->dispatchBrowserEvent('phar-diseases-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }
}
