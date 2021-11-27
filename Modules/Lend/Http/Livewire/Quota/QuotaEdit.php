<?php

namespace Modules\Lend\Http\Livewire\Quota;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenQuota;

class QuotaEdit extends Component
{
    public $amount;
    public $state;
    public $quota;

    public function mount($quota_id){
        $this->quota = LenQuota::find($quota_id);
        $this->amount = $this->quota->amount;
        $this->state = $this->quota->state;
    }

    public function render(){
        return view('lend::livewire.quota.quota-edit');
    }

    public function save(){
        $this->validate([
            'amount'   => 'required|numeric|unique:len_quotas,amount,'.$this->quota->id
        ]);

        $activity = new Activity;
        $activity->dataOld(LenQuota::find($this->quota->id));

        $this->quota->update([
            'amount'         => $this->amount,
            'state'          => $this->state,
            'person_edit'    => Auth::user()->person_id
        ]);

        $activity->modelOn(LenQuota::class,$this->quota->id,'len_quotas');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_quota_edit', $this->quota->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->quota);
        $activity->log('Se actualizo datos del numero de cuotas');
        $activity->save();

        $this->dispatchBrowserEvent('len-quota-update', ['msg' => Lang::get('lend::messages.msg_update')]);
    }
}
