<?php

namespace Modules\Pharmacy\Http\Livewire\Symptom;

use Livewire\Component;
use Modules\Pharmacy\Entities\PharSymptom;
use Livewire\WithPagination;

class SymptomList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function searchSymptom()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pharmacy::livewire.symptom.symptom-list',['symptom' => $this->getSymptom()]);
    }

    public function getSymptom(){
        return PharSymptom::where('description','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function destroyDisease($id){
        try {
            PharSymptom::where('id',$id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('phar-disease-delete', ['res' => $res]);
    }
}
