<?php

namespace Modules\Pharmacy\Http\Livewire\Diseases;

use Livewire\Component;
use Modules\Pharmacy\Entities\PharDisease;
use Livewire\WithPagination;
class DiseasesList extends Component
{
    public $show;
    public $search;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function searchDisease()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('pharmacy::livewire.diseases.diseases-list',['diseases' => $this->getDisease()]);
    }

    public function getDisease(){
        return PharDisease::where('name','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function destroyDisease($id){
        try {
            PharDisease::where('id',$id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('phar-disease-delete', ['res' => $res]);
    }
}
