<?php

namespace Modules\Lend\Http\Livewire\Quota;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Modules\Lend\Entities\LenQuota;

class QuotaIndex extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render(){
        return view('lend::livewire.quota.quota-index', ['quotas' => $this->getQuotas()]);
    }

    public function getQuotas(){
        return LenQuota::where('amount','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function quotasSearch()
    {
        $this->resetPage();
    }

    public function deleteQuota($id){
        $quota = LenQuota::find($id);

        $activity = new activity;
        $activity->log('Se eliminó en número de cuotas');
        $activity->modelOn(LenQuota::class, $id,'len_quotas');
        $activity->dataOld($quota);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $quota->delete();

        $this->dispatchBrowserEvent('len-quota-delete', ['msg' => Lang::get('lend::messages.msg_delete')]);
    }
}
