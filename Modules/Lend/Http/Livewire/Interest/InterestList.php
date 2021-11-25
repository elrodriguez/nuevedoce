<?php

namespace Modules\Lend\Http\Livewire\Interest;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Modules\Lend\Entities\LenInterest;

class InterestList extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render(){
        return view('lend::livewire.interest.interest-list', ['interests' => $this->getInterests()]);
    }

    public function getInterests(){
        return LenInterest::where('description','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function interestsSearch()
    {
        $this->resetPage();
    }

    public function deleteInterest($id){
        $interest = LenInterest::find($id);

        $activity = new activity;
        $activity->log('Se eliminó el interés');
        $activity->modelOn(LenInterest::class, $id,'len_interests');
        $activity->dataOld($interest);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $interest->delete();

        $this->dispatchBrowserEvent('len-interest-delete', ['msg' => Lang::get('lend::messages.msg_delete')]);
    }
}
