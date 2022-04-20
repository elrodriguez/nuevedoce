<?php

namespace Modules\Pharmacy\Http\Livewire\Diseases;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Pharmacy\Entities\PharDisease;

class DiseasesEdit extends Component
{
    public $name;
    public $description;
    public $causes;
    public $fracture;
    public $disease_id;
    public $disease;

    public function mount($disease_id){
        $this->disease_id = $disease_id;

        $this->disease = PharDisease::find($this->disease_id);
        $this->name = $this->disease->name;
        $this->description = html_entity_decode($this->disease->description);
        $this->fracture = $this->disease->fracture;
        $this->causes = html_entity_decode($this->disease->causes);
        $this->fracture = $this->disease->fracture ? false : true;
    }
    public function render()
    {
        return view('pharmacy::livewire.diseases.diseases-edit');
    }

    public function updateDisease(){
        $this->validate([
            'name' => 'required|max:300',
            'description' => 'required',
            'causes' => 'required'
        ]);

        $this->disease->update([
            'name' => $this->name,
            'description' => htmlentities($this->description),
            'causes' => htmlentities($this->causes),
            'fracture' => $this->fracture ? false : true
        ]);

        $this->dispatchBrowserEvent('phar-diseases-save', ['msg' => Lang::get('labels.was_successfully_updated')]);
    }
}
