<?php

namespace Modules\Lend\Http\Livewire\Paymentmethod;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenPaymentMethod;

class PaymentmethodEdit extends Component
{
    public $description;
    public $state;
    public $payment_method;

    public function mount($payment_id){
        $this->payment_method = LenPaymentMethod::find($payment_id);
        $this->description = $this->payment_method->description;
        $this->state = $this->payment_method->state;
    }

    public function render()
    {
        return view('lend::livewire.paymentmethod.paymentmethod-edit');
    }

    public function save(){
        $this->validate([
            'description'   => 'required|max:255'
        ]);

        $activity = new Activity;
        $activity->dataOld(LenPaymentMethod::find($this->payment_method->id));

        $this->payment_method->update([
            'description'    => $this->description,
            'state'          => $this->state,
            'person_edit'    => Auth::user()->person_id
        ]);

        $activity->modelOn(LenPaymentMethod::class,$this->payment_method->id,'len_payment_methods');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_paymentmethod_edit', $this->payment_method->id));
        $activity->logType('edit');
        $activity->dataUpdated($this->payment_method);
        $activity->log('Se actualizo datos de la forma de pago');
        $activity->save();

        $this->dispatchBrowserEvent('len-payment-method-update', ['msg' => Lang::get('lend::messages.msg_update')]);
    }
}
