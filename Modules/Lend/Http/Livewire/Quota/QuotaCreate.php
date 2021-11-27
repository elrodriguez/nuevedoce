<?php

namespace Modules\Lend\Http\Livewire\Quota;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenQuota;

class QuotaCreate extends Component
{
    public $amount;
    public $state = true;

    public function render(){
        return view('lend::livewire.quota.quota-create');
    }

    public function save(){
        $this->validate([
            'amount'   => 'required|numeric|unique:len_quotas,amount'
        ]);

        $quota = LenQuota::create([
            'amount'        => $this->amount,
            'state'         => $this->state,
            'person_create' => Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(LenQuota::class, $quota->id,'len_quotas');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_quota_create'));
        $activity->logType('create');
        $activity->log('Se creó un nuevo numero de cuotas');
        $activity->save();

        $this->dispatchBrowserEvent('len-quota-save', ['msg' => Lang::get('lend::messages.msg_success')]);
        $this->clearForm();
    }

    public function  clearForm(){
        $this->amount       = '';
        $this->state        = true;
    }
}
