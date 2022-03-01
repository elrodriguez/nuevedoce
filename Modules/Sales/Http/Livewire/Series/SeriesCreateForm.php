<?php

namespace Modules\Sales\Http\Livewire\Series;

use App\Models\DocumentType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

use Modules\Sales\Entities\SalSerie;
use Modules\Setting\Entities\SetEstablishment;

class SeriesCreateForm extends Component
{

    public $serie;
    public $number = 1;
    public $establishment_id;
    public $document_type_id;
    public $state = true;

    public $document_types =[];
    public $establishments;

    public function mount(){
        $this->document_types = DocumentType::where('active',true)->get();
        $this->establishments = SetEstablishment::where('state',true)->get();
    }

    public function render()
    {
        return view('sales::livewire.series.series-create-form');
    }

    public function save(){
        $this->validate([
            'serie' => 'required|string|unique:sal_series,id',
            'number' => 'required',
            'establishment_id' => 'required',
            'document_type_id' => 'required'
        ]);

        SalSerie::create([
            'id' => strtoupper($this->serie),
            'correlative' => $this->number,
            'establishment_id' => $this->establishment_id,
            'user_id' => Auth::id(),
            'document_type_id' => $this->document_type_id,
            'state' => $this->state
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-serie-save', ['msg' => 'Datos guardados correctamente.']);
    }

    
    public function clearForm(){
        $this->serie = null;
        $this->number = null;
        $this->establishment_id = null;
        $this->document_type_id = null;
        $this->state = true;
        
    }
}
