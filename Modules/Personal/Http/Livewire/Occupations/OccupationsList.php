<?php

namespace Modules\Personal\Http\Livewire\Occupations;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Personal\Entities\PerOccupation;

class OccupationsList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){ //$activities_id
        $this->show = 10;
    }

    public function render()
    {
        return view('personal::livewire.occupations.occupations-list', ['occupations' => $this->getOccupations()]);
    }

    public function getOccupations(){
        return PerOccupation::where('name','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function occupationsSearch()
    {
        $this->resetPage();
    }

    public function deleteOccupations($id){
        PerOccupation::find($id)->delete();

        $this->dispatchBrowserEvent('per-occupations-delete', ['msg' => Lang::get('personal::labels.msg_delete')]);
    }
}
