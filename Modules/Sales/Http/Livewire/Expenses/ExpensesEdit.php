<?php

namespace Modules\Sales\Http\Livewire\Expenses;

use App\CoreBilling\Billing;
use App\Models\ExpenseMethodType;
use App\Models\ExpenseType;
use App\Models\GlobalPayment;
use App\Models\Person;
use App\Models\UserEstablishment;
use Carbon\Carbon;
use Livewire\Component;
use Modules\Sales\Entities\SalExpenseReason;
use Illuminate\Support\Str;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Sales\Entities\SalCash;
use Modules\Sales\Entities\SalCashDocument;
use Modules\Sales\Entities\SalExpense;
use Modules\Sales\Entities\SalExpenseItem;
use Modules\Sales\Entities\SalExpensePayment;
use Modules\Setting\Entities\SetCompany;

class ExpensesEdit extends Component
{
    protected $listeners = ['funSupplierIdEdit' => 'setSupplierIdEdit'];
    
    public $voucher_types = [];
    public $expense_reasons = [];
    public $payment_method_types = [];
    public $expense_method_types = [];
    public $destination_types = [];
    public $box_items = [];

    public $voucher_type_id;
    public $number;
    public $f_issuance;
    public $reason_id;
    public $supplier_id;
    public $description;
    public $amount;
    public $total;
    public $expense_id;
    public $establishment_id;
    public $supplier;
    public $supplier_value;
    public $supplier_text;

    public function mount($expense_id){
        $this->voucher_types = ExpenseType::all();
        $this->expense_reasons = SalExpenseReason::all();

        $this->expense_id = $expense_id;
        $this->expense = SalExpense::where('external_id',$expense_id)->first();
        $this->voucher_type_id = $this->expense->expense_type_id;
        $this->establishment_id = $this->expense->establishment_id;
        $this->number = $this->expense->number;
        $this->f_issuance = Carbon::parse($this->expense->date_of_issue)->format('d/m/Y');
        $this->supplier = $this->expense->supplier;
        $this->total = $this->expense->total;
        $this->reason_id = $this->expense->expense_reason_id;

        foreach($this->expense->items as $item){
            $box_item = [
                'id' => $item->id,
                'description' => $item->description,
                'amount' => $item->total
            ];
            array_push($this->box_items,$box_item);
        }

        foreach($this->expense->expense_payments as $payment){
            $data = [
                'id' => $payment->id,
                'method' => $payment->expense_method_type_id,
                'destination' => $payment->expense_destination_id,
                'date_of_payment' => $payment->date_of_payment,
                'reference' => $payment->reference,
                'amount' => $payment->payment
            ];
            array_push($this->payment_method_types,$data);
        }
        $this->supplier_id = json_decode($this->expense->supplier)->id;
        $this->supplier_value = json_decode($this->expense->supplier)->id;
        $this->supplier_text = json_decode($this->expense->supplier)->full_name;
    }

    public function render()
    {
        $this->expense_method_types = ExpenseMethodType::all();
        $billing = new Billing();
        $this->destination_types = $billing->getPaymentDestinations();
        return view('sales::livewire.expenses.expenses-edit');
    }

    public function newPaymentMethodTypes(){
        $data = [
            'id' => null,
            'method' => '01',
            'destination' => 'cash',
            'date_of_payment' => Carbon::now()->format('Y-m-d'),
            'reference' => null,
            'amount' => null
        ];
        array_push($this->payment_method_types,$data);
    }
    public function removePaymentMethodTypes($key){
        $payment_id = $this->payment_method_types[$key]['id'];
        if($payment_id){
            SalExpensePayment::find($payment_id)->delete();
            GlobalPayment::where('payment_type',SalExpensePayment::class)
                ->where('payment_id',$payment_id)
                ->delete();
        }
        unset($this->payment_method_types[$key]);
    }

    public function addDetail(){
        $this->validate([
            'description' => 'required',
            'amount' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/'
        ]);

        $box_item = [
            'id' => null,
            'description' => $this->description,
            'amount' => $this->amount
        ];

        array_push($this->box_items,$box_item);
        $this->total = $this->total + $this->amount;

        if(count($this->payment_method_types) == 0){
            $data = [
                'id' => null,
                'method' => '01',
                'destination' => 'cash',
                'date_of_payment' => Carbon::now()->format('Y-m-d'),
                'reference' => null,
                'amount' => $this->total
            ];
            array_push($this->payment_method_types,$data);
        }else{
            $this->payment_method_types[0]['amount'] = $this->total;
        }

        $this->description = null;
        $this->amount = null;
        
    }

    public function removeItem($key){
        $amount = $this->box_items[$key]['amount'];
        $item_id = $this->box_items[$key]['id'];
        if($item_id){
            SalExpenseItem::find($item_id)->delete();
        }
        $this->total = $this->total - $amount;
        $this->payment_method_types[0]['amount'] = $this->total;
        unset($this->box_items[$key]);
    }

    public function update(){

        $this->validate([
            'voucher_type_id' => 'required',
            'number' => 'required',
            'f_issuance' => 'required',
            'reason_id' => 'required',
            'supplier_id' => 'required',
        ]);
        //dd($this->expense->id);
        $total_amount = 0;

        if ($this->payment_method_types > 0) {
            foreach($this->payment_method_types as $key => $val){
                $total_amount = $total_amount + $val['amount'];
            }
        }

        if($this->total == $total_amount){
            $establishment_id = UserEstablishment::where('user_establishments.user_id',Auth::id())
                                        ->where('main',true)
                                        ->value('establishment_id');

            list($di,$mi,$yi) = explode('/',$this->f_issuance);
            $date_of_issue = $yi.'-'.$mi.'-'.$di;

            $person = Person::where('id',$this->supplier_id)->first();

            $this->expense->update([
                'user_id' => Auth::id(),
                'expense_type_id' => $this->voucher_type_id,
                'establishment_id' => $establishment_id,
                'person_id' => Auth::user()->person_id,
                'currency_type_id' => 'PEN',
                'number' => $this->number,
                'date_of_issue' => $date_of_issue,
                'time_of_issue' => Carbon::now()->toDateTimeString(),
                'supplier' => $person,
                'exchange_rate_sale' => 0,
                'total' => $this->total,
                'state' => true,
                'expense_reason_id' => $this->reason_id
            ]);

            foreach($this->box_items as $item){
                if(!$item['id']){
                    SalExpenseItem::create([
                        'expense_id' => $this->expense->id,
                        'description' => $item['description'],
                        'total' => $item['amount']
                    ]);
                }
            }
            
            $this->savePayments($this->expense->id);

            $user = Auth::user();
            $activity = new Activity;
            $activity->modelOn(SalExpense::class,$this->expense->id);
            $activity->causedBy($user);
            $activity->routeOn(route('sales_expenses_create'));
            $activity->componentOn('sales::expenses.expenses-create');
            $activity->dataOld($this->expense);
            $activity->logType('create');
            $activity->log('Registro nuevo gasto');
            $activity->save();

            $this->dispatchBrowserEvent('response_expenses_update', ['msg' => Lang::get('labels.was_successfully_updated')]);
        }else{
            $this->dispatchBrowserEvent('response_payment_total_different', ['message' => Lang::get('labels.msg_totaldtc')]);
        }
    }

    public function savePayments($id){
        foreach($this->payment_method_types as $key => $value){
            // list($di,$mi,$yi) = explode('/',$value['date_of_payment']);
            // $date_of_issue = $yi.'-'.$mi.'-'.$di;
            if($value['amount'] > 0){
                if(!$value['id']){
                    $payment = SalExpensePayment::create([
                        'expense_id' => $id,
                        'date_of_payment' => $value['date_of_payment'],
                        'expense_method_type_id' => $value['method'],
                        'reference' => $value['reference'],
                        'payment' => $value['amount'],
                        'expense_destination_id' => $value['destination']
                    ]);
                    $this->createGlobalPayment($payment->id,$value['destination']);
                }else{
                    SalExpensePayment::find($value['id'])->update([
                        'date_of_payment' => $value['date_of_payment'],
                        'expense_method_type_id' => $value['method'],
                        'reference' => $value['reference'],
                        'payment' => $value['amount'],
                        'expense_destination_id' => $value['destination']
                    ]);
                    $this->updateGlobalPayment($value['id'],$value['destination']);
                }
            }
        }
    }
    public function createGlobalPayment($id, $destination){
        $row['payment_destination_id'] = $destination;
        $billing = new Billing();
        $destination = $billing->getDestinationRecord($row);
        $company = SetCompany::where('main',true)->first();

        GlobalPayment::create([
            'user_id' => Auth::id(),
            'soap_type_id' => $company->soap_type_id,
            'destination_id' => $destination['destination_id'],
            'destination_type' => $destination['destination_type'],
            'payment_id' => $id,
            'payment_type' => SalExpensePayment::class
        ]);
    }

    public function updateGlobalPayment($id, $destination){
        $row['payment_destination_id'] = $destination;
        $billing = new Billing();
        $destination = $billing->getDestinationRecord($row);

        GlobalPayment::where('payment_type',SalExpensePayment::class)
            ->where('payment_id',$id)
            ->update([
                'destination_id' => $destination['destination_id'],
                'destination_type' => $destination['destination_type'],
            ]);
    }

    public function clearForm(){
        $this->box_items = [];
        $this->payment_method_types = [];
        $this->voucher_type_id = null;
        $this->number = null;
        $this->f_issuance = Carbon::now()->format('d/m/Y');
        $this->reason_id  = null;
        $this->supplier_id  = null;
        $this->description  = null;
        $this->amount  = null;
        $this->total  = null;
    }

    public function saveCashDocument($id){
        $cash =  SalCash::where([['user_id',Auth::id()],['state',true]])->first();
        SalCashDocument::create([
            'cash_id' => $cash->id,
            'document_id' => null,
            'sale_note_id' => null,
            'expense_id' => $id
        ]);
    }

    public function setSupplierIdEdit($id){
        $this->supplier_id = $id;
    }
}
