<?php

namespace Modules\Pharmacy\Http\Livewire\Medicines;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Pharmacy\Entities\PharMedicine;

class MedicinesList extends Component
{
    public $show;
    public $search;
    public $disease;
    public $symptom;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function searchDisease()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pharmacy::livewire.medicines.medicines-list',['medicines' => $this->getMedicines()]);
    }

    public function getMedicines(){
        $disease = $this->disease;
        $symptom = $this->symptom;

        return PharMedicine::select(

        )
        ->when($disease, function ($query) use ($disease) {
            $query->where('disease_id', $disease);
        })
        ->when($symptom, function ($query) use ($symptom) {
            $query->where('symptom_id', $symptom);
        })
        ->paginate($this->show);
    }

    public function destroyDisease($id){
        try {
            PharMedicine::where('id',$id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('phar-disease-delete', ['res' => $res]);
    }
}
