<?php

namespace Modules\Sales\Http\Livewire\Document;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\Sales\Entities\SalCash;
use Modules\Sales\Entities\SalDocument;
use Modules\Sales\Entities\SalDocumentPayment;
use Elrod\UserActivity\Activity;

class DocumentModalPayments extends Component
{
    protected $listeners = ['openModalDocumentPayments' => 'openModalPayments'];
    public $payments = [];
    public $document_id;

    public function render()
    {
        return view('sales::livewire.document.document-modal-payments');
    }
    public function openModalPayments($id){
        $this->document_id = $id;
        $this->document = SalDocument::find($this->document_id);
        $vaucher = $this->document->series.'-'.str_pad($this->document->number, 8, "0", STR_PAD_LEFT);
        $this->paymentsByDocument($id);
        $this->dispatchBrowserEvent('modal-sales-vaucher-payments', ['vaucher' => $vaucher]);
    }
    public function paymentsByDocument($document_id){
        $userActivity = new Activity;
        $userActivity->causedBy(Auth::user());
        $userActivity->routeOn(route('sales_document_list'));
        $userActivity->componentOn('sales.document.document-list');
        $userActivity->dataOld(SalDocument::find($document_id));
        $userActivity->log('visualizar los pagos del documento');
        $userActivity->save();

        $this->payments = SalDocumentPayment::join('cat_payment_method_types','sal_document_payments.payment_method_type_id','cat_payment_method_types.id')
            ->join('global_payments',function($query){
                $query->on('global_payments.payment_id','sal_document_payments.id')
                    ->where('global_payments.payment_type','=',SalDocumentPayment::class);
            })
            ->leftjoin('sal_cashes',function($query){
                $query->on('global_payments.destination_id','sal_cashes.id')
                    ->where('global_payments.destination_type','=',SalCash::class);
            })
            ->leftjoin('bank_accounts',function($query){
                $query->on('global_payments.destination_id','bank_accounts.id')
                    ->where('global_payments.destination_type','=',BankAccount::class);
            })
            ->select(
                'sal_cashes.user_id',
                'sal_cashes.reference_number',
                DB::raw('(select description from banks where banks.id = bank_accounts.bank_id) AS bank_name'),
                DB::raw('CONCAT(bank_accounts.description," - ",bank_accounts.number," - ",bank_accounts.currency_type_id) AS back_account_description'),
                'cat_payment_method_types.description',
                'sal_document_payments.date_of_payment',
                'sal_document_payments.reference',
                'sal_document_payments.payment'
            )
            ->where('document_id',$document_id)
            ->get();
    }
}
