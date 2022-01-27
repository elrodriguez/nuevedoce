<?php

namespace Modules\Lend\Http\Livewire\Paymentmthod;

use Livewire\Component;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Livewire\WithPagination;
use Modules\Lend\Entities\LenPaymentMethod;

class PaymentMethodIndex extends Component
{
    public $show;
    public $search;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount(){
        $this->show = 10;
    }

    public function render(){
        return view('lend::livewire.paymentmethod.paymentmethod-index', ['payment_methods' => $this->getPaymentMethods()]);
    }

    public function getPaymentMethods(){
        return LenPaymentMethod::where('description','like','%'.$this->search.'%')->paginate($this->show);
    }

    public function paymentMethodsSearch()
    {
        $this->resetPage();
    }

    public function deletePaymentMethod($id){
        $payment_method = LenPaymentMethod::find($id);

        $activity = new activity;
        $activity->log('Se eliminó la forma de pago');
        $activity->modelOn(LenPaymentMethod::class, $id,'len_payment_methods');
        $activity->dataOld($payment_method);
        $activity->logType('delete');
        $activity->causedBy(Auth::user());
        $activity->save();

        $payment_method->delete();

        $this->dispatchBrowserEvent('len-payment-method-delete', ['msg' => Lang::get('lend::messages.msg_delete')]);
    }
}
