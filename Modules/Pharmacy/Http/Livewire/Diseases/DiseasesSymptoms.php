<?php

namespace Modules\Pharmacy\Http\Livewire\Diseases;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Pharmacy\Entities\PharDisease;
use Modules\Pharmacy\Entities\PharDiseaseSymptom;
use Modules\Pharmacy\Entities\PharSymptom;

class DiseasesSymptoms extends Component
{
    public $symptom_id;
    public $disease_id;
    public $disease_name;
    public $symptoms = [];

    public function mount($disease_id){
        $this->disease_id = $disease_id;

        $disease = PharDisease::find($disease_id);

        if($disease){
            $this->disease_name = $disease->name;
        }
        
    }

    public function render()
    {
        $this->getDiseasesSymptoms();
        return view('pharmacy::livewire.diseases.diseases-symptoms');
    }

    public function addSymptoms(){
        $this->validate([
            'symptom_id' => 'required|unique:phar_disease_symptoms,symptom_id,NULL,id,disease_id,' . $this->disease_id
        ]);

        PharDiseaseSymptom::create([
            'disease_id'    => $this->disease_id,
            'symptom_id'    => $this->symptom_id
        ]);

        $this->symptom_id = null;

        $this->dispatchBrowserEvent('phar-diseases-symptoms-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }

    public function getDiseasesSymptoms(){
        $this->symptoms = PharSymptom::join('phar_disease_symptoms','phar_disease_symptoms.symptom_id','phar_symptoms.id')
                ->select(
                    'phar_disease_symptoms.disease_id',
                    'phar_disease_symptoms.symptom_id',
                    'phar_symptoms.description'
                )
                ->where('phar_disease_symptoms.disease_id',$this->disease_id)
                ->get();
    }

    public function deleteSymptoms($id){
        PharDiseaseSymptom::where('symptom_id',$id)
            ->where('disease_id',$this->disease_id)
            ->delete();
        $res = 'success';
        $this->dispatchBrowserEvent('phar-diseases-symptoms-delete', ['res' => $res]);
    }
}
