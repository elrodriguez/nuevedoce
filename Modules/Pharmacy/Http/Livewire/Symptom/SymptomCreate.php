<?php

namespace Modules\Pharmacy\Http\Livewire\Symptom;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Pharmacy\Entities\PharSymptom;

class SymptomCreate extends Component
{
    public $description;

    public function render()
    {
        return view('pharmacy::livewire.symptom.symptom-create');
    }

    public function saveSymptom(){
        $this->validate([
            'description' => 'required'
        ]);

        PharSymptom::create([
            'description' => $this->description
        ]);

        $this->description = null;

        $this->dispatchBrowserEvent('phar-symptom-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }
}
