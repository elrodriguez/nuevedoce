<?php

namespace Modules\Pharmacy\Http\Livewire\Symptom;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Pharmacy\Entities\PharSymptom;

class SymptomEdit extends Component
{
    public $description;
    public $symptom;

    public function mount($symptom_id){
        $this->symptom = PharSymptom::find($symptom_id);
        $this->description = $this->symptom->description;
    }

    public function render()
    {
        return view('pharmacy::livewire.symptom.symptom-edit');
    }

    public function updateSymptom(){
        $this->validate([
            'description' => 'required'
        ]);

        $this->symptom->update([
            'description' => $this->description
        ]);

        $this->dispatchBrowserEvent('phar-symptom-update', ['msg' => Lang::get('labels.was_successfully_updated')]);
    }
}
