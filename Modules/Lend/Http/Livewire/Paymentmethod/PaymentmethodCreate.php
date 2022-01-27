<?php

namespace Modules\Lend\Http\Livewire\Paymentmethod;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Lend\Entities\LenPaymentMethod;

class PaymentMethodCreate extends Component
{
    public $description;
    public $state = true;

    public function render(){
        return view('lend::livewire.paymentmethod.paymentmethod-create');
    }

    public function save(){
        $this->validate([
            'description'   => 'required|max:255'
        ]);

        $payment_method = LenPaymentMethod::create([
            'description'   => $this->description,
            'state'         => $this->state,
            'person_create' => Auth::user()->person_id
        ]);

        $activity = new Activity;
        $activity->modelOn(LenPaymentMethod::class, $payment_method->id,'len_payment_methods');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('lend_paymentmethod_create'));
        $activity->logType('create');
        $activity->log('Se creó una nueva forma de pago');
        $activity->save();

        $this->dispatchBrowserEvent('len-payment-method-save', ['msg' => Lang::get('lend::messages.msg_success')]);
        $this->clearForm();
    }

    public function  clearForm(){
        $this->description  = '';
        $this->state        = true;
    }
}
