<?php

namespace Modules\Sales\Http\Livewire\Document;

use App\Models\BankAccount;
use App\Models\CatPaymentMethodType;
use App\Models\GlobalPayment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Sales\Entities\SalCash;
use Modules\Sales\Entities\SalSaleNote;
use Modules\Sales\Entities\SalSaleNotePayment;
use App\CoreBilling\Billing;
use Illuminate\Support\Facades\Auth;
use Modules\Setting\Entities\SetCompany;
use Elrod\UserActivity\Activity;

class SaleNotesModalPayments extends Component
{
    protected $listeners = ['openModalNotePayments' => 'openModalPayments'];

    public $note_id;
    public $paid;
    public $payments = [];
    public $reference;
    public $payment;
    public $total_note;
    public $date_of_payment;
    public $method_type_id;
    public $destination_id;
    public $note_number;
    public $note;
    public $total_payments;

    public $cat_payment_method_types;
    public $cat_expense_method_types;

    public function mount(){
        $this->date_of_payment = Carbon::now()->format('d/m/Y');
        $this->method_type_id = '01';
        $this->destination_id = 'cash';
        $this->total_payments = 0;
    }

    public function render()
    {   
        $this->cat_payment_method_types = CatPaymentMethodType::all();
        $this->cat_expense_method_types = $this->getPaymentDestinations();

        return view('sales::livewire.document.sale-notes-modal-payments');
    }

    public function openModalPayments($id){
        $this->note_id = $id;
        $this->note = SalSaleNote::find($this->note_id);
        $vaucher = $this->note->series.'-'.str_pad($this->note->number, 8, "0", STR_PAD_LEFT);
        $this->paid = $this->note->paid;
        $this->note_number = $this->note->series.'-'.$this->note->number;
        $this->total_note = $this->note->total;
        $this->listPayments();
        $this->dispatchBrowserEvent('modal-sales-note-payments', ['vaucher' => $vaucher]);
    }

    public function getCash(){

        $cash =  SalCash::where([['user_id',auth()->user()->id],['state',true]])->first();
        $data = [];

        if($cash){
            $data = [
                'id' => 'cash',
                'cash_id' => $cash->id,
                'description' => ($cash->reference_number) ? "CAJA CHICA - {$cash->reference_number}" : "CAJA CHICA",
            ];
        }

        return $data;
    }

    private static function getBankAccounts(){

        return BankAccount::get()->transform(function($row) {
            return [
                'id' => $row->id,
                'cash_id' => null,
                'description' => "{$row->bank->description} - {$row->currency_type_id} - {$row->description}",
            ];
        });

    }

    public function getPaymentDestinations(){
        
        $bank_accounts = self::getBankAccounts();
        $cash = $this->getCash();

        return collect($bank_accounts)->push($cash);

    }

    public function deletePayment($id){
        GlobalPayment::where('global_payments.payment_id',$id)
            ->where('global_payments.payment_type',SalSaleNotePayment::class)
            ->delete();

        $payment = SalSaleNotePayment::find($id);

        $user = Auth::user();
        $activity = new Activity;
        $activity->modelOn(SalSaleNote::class,$id);
        $activity->causedBy($user);
        $activity->routeOn(route('sales_documents_sale_notes'));
        $activity->componentOn('sales::document.sale-notes-modal-payments');
        $activity->dataOld($payment);
        $activity->logType('delete');
        $activity->log('Elimino el pago de '.$payment->payment.' a nota de venta: '.$this->note_number);
        $activity->save();

        $payment->delete();

        $this->listPayments();

        if($this->paid == true){
            $p = $this->total_note - $this->total_payments;
            if($p > 0){
                $this->note->update([
                    'paid' => false
                ]);
                $this->paid = false;
            }
        }
        $this->emit('refreshlistSaleNotes');
        $this->dispatchBrowserEvent('actions-sales-note-payments', ['msg' => Lang::get('labels.was_successfully_removed')]);
    }

    public function storePayment(){
        $this->validate([
            'date_of_payment' => 'required',
            'method_type_id' => 'required',
            'destination_id' => 'required',
            'reference' => 'required',
            'payment' => 'required'
        ]);

        list($d,$m,$y) = explode('/',$this->date_of_payment);
        $date = $y.'-'.$m.'-'.$d;

        $payment = SalSaleNotePayment::create([
            'sale_note_id' => $this->note_id,
            'date_of_payment' => $date,
            'payment_method_type_id' => $this->method_type_id,
            'payment_destination_id' => $this->destination_id,
            'reference' => $this->reference,
            'payment' => $this->payment
        ]);

        $row['payment_destination_id'] = $this->destination_id;
        $billing = new Billing();
        $destination = $billing->getDestinationRecord($row);
        $company = SetCompany::where('main',true)->first();

        GlobalPayment::create([
            'user_id' => Auth::id(),
            'soap_type_id' => $company->soap_type_id,
            'destination_id' => $destination['destination_id'],
            'destination_type' => $destination['destination_type'],
            'payment_id' => $payment->id,
            'payment_type' => SalSaleNotePayment::class
        ]);

        $user = Auth::user();
        $activity = new Activity;
        $activity->modelOn(SalSaleNote::class,$payment->id);
        $activity->causedBy($user);
        $activity->routeOn(route('sales_documents_sale_notes'));
        $activity->componentOn('sales::document.sale-notes-modal-payments');
        $activity->dataOld($payment);
        $activity->logType('create');
        $activity->log('Registro nuevo pago a nota de venta: '.$this->note_number);
        $activity->save();

        $this->date_of_payment = Carbon::now()->format('d/m/Y');
        $this->method_type_id = '01';
        $this->destination_id = 'cash';
        $this->reference = null;
        $this->payment = null;

        $this->listPayments();

        if($this->paid == false){
            $p = $this->total_note - $this->total_payments;
            if($p == 0){
                $this->note->update([
                    'paid' => true
                ]);
                $this->paid = true;
            }
        }
        $this->emit('refreshlistSaleNotes');
        $this->dispatchBrowserEvent('actions-sales-note-payments', ['msg' => Lang::get('labels.successfully_registered')]);
    }

    public function listPayments(){
        $this->payments = [];
        $this->total_payments = 0;
        $payments = SalSaleNotePayment::join('cat_payment_method_types','payment_method_type_id','cat_payment_method_types.id')
                            ->join('global_payments',function($query){
                                $query->on('global_payments.payment_id','sal_sale_note_payments.id')
                                    ->where('global_payments.payment_type',SalSaleNotePayment::class);
                            })
                            ->leftJoin('sal_cashes', function($query){
                                $query->on('global_payments.destination_id','sal_cashes.id')
                                    ->where('global_payments.destination_type', SalCash::class);
                            })
                            ->leftJoin('bank_accounts', function($query){
                                $query->on('global_payments.destination_id','bank_accounts.id')
                                    ->where('global_payments.destination_type', BankAccount::class);
                            })
                            ->leftJoin('banks','bank_accounts.bank_id','banks.id')
                            ->select(
                                'sal_sale_note_payments.id',
                                'cat_payment_method_types.description',
                                'sal_sale_note_payments.sale_note_id',
                                'sal_sale_note_payments.date_of_payment',
                                'sal_sale_note_payments.reference',
                                'sal_sale_note_payments.payment',
                                'global_payments.destination_type',
                                DB::raw('CONCAT("CAJA CHICA",IF(sal_cashes.reference_number IS NULL,"",CONCAT(" - ",sal_cashes.reference_number))) AS cash_name'),
                                DB::raw('CONCAT(banks.description," - ",bank_accounts.currency_type_id," - ",banks.description) AS banck_name')
                            )
                            ->where('sale_note_id',$this->note_id)
                            ->get();
        

        foreach($payments as $payment){
            $this->total_payments = $this->total_payments + $payment->payment;
        }
        $this->payments = $payments;
    }
}
