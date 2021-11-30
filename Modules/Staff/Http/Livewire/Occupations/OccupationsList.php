<?php

namespace Modules\Staff\Http\Livewire\Occupations;

use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Staff\Entities\StaOccupation;

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
        return view('staff::livewire.occupations.occupations-list', ['occupations' => $this->getOccupations()]);
    }

    public function getOccupations(){
        return StaOccupation::where('name','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function occupationsSearch()
    {
        $this->resetPage();
    }

    public function deleteOccupations($id){
        $occupation = StaOccupation::find($id);

        $activity = new activity;
        $activity->log('Se eliminó la Ocupación');
        $activity->modelOn(StaOccupation::class,$id,'per_occupations');
        $activity->dataOld($occupation);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $occupation->delete();

        $this->dispatchBrowserEvent('per-occupations-delete', ['msg' => Lang::get('Staff::labels.msg_delete')]);
    }
}
