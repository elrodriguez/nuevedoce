<?php

namespace Modules\Sales\Http\Livewire\Series;

use App\Models\DocumentType;
use Livewire\Component;
use Modules\Sales\Entities\SalSerie;
use Modules\Setting\Entities\SetEstablishment;

class SeriesEditForm extends Component
{
    public $serie;
    public $number;
    public $establishment_id;
    public $document_type_id;
    public $state;
    public $series;

    public $document_types =[];
    public $establishments;

    public function mount($serie_id){
        $this->document_types = DocumentType::where('active',true)->get();
        $this->establishments = SetEstablishment::where('state',true)->get();

        $this->series = SalSerie::where('id',$serie_id)->first();
        $this->serie = $this->series->id;
        $this->number = $this->series->correlative;
        $this->establishment_id = $this->series->establishment_id;
        $this->document_type_id = $this->series->document_type_id;
        $this->state = $this->series->state;

    }

    public function render()
    {
        return view('sales::livewire.series.series-edit-form');
    }

    public function update(){
        $this->validate([
            'serie' => 'required|string|unique:sal_series,id,'.$this->serie,
            'number' => 'required',
            'establishment_id' => 'required',
            'document_type_id' => 'required'
        ]);

        $this->series->update([
            'id' => strtoupper($this->serie),
            'correlative' => $this->number,
            'establishment_id' => $this->establishment_id,
            'document_type_id' => $this->document_type_id,
            'state' => $this->state
        ]);

        $this->dispatchBrowserEvent('set-serie-update', ['msg' => 'Datos actualizados correctamente.']);
    }
}
