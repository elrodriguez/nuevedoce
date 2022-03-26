<?php

namespace Modules\Sales\Http\Livewire\Expenses;

use App\Models\ExpenseMethodType;
use App\Models\ExpenseType;
use Carbon\Carbon;
use Livewire\Component;
use Modules\Sales\Entities\SalExpenseReason;
use App\CoreBilling\Billing;
use App\Models\GlobalPayment;
use App\Models\Person;
use App\Models\UserEstablishment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Sales\Entities\SalExpense;
use Illuminate\Support\Str;
use Elrod\UserActivity\Activity;
use Modules\Sales\Entities\SalCash;
use Modules\Sales\Entities\SalCashDocument;
use Modules\Sales\Entities\SalExpenseItem;
use Modules\Sales\Entities\SalExpensePayment;
use Modules\Setting\Entities\SetCompany;

class ExpensesCreate extends Component
{
    
    protected $listeners = ['funSupplierId' => 'setSupplierId'];
    
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

    public function mount(){
        $this->f_issuance = Carbon::now()->format('d/m/Y');
        $this->voucher_types = ExpenseType::all();
        $this->expense_reasons = SalExpenseReason::all();
        $this->total = 0;
    }
    public function render()
    {
        $this->expense_method_types = ExpenseMethodType::all();
        $billing = new Billing();
        $this->destination_types = $billing->getPaymentDestinations();
        return view('sales::livewire.expenses.expenses-create');
    }
    public function newPaymentMethodTypes(){
        $data = [
            'method' => '01',
            'destination' => 'cash',
            'date_of_payment' => Carbon::now()->format('Y-m-d'),
            'reference' => null,
            'amount' => null
        ];
        array_push($this->payment_method_types,$data);
    }
    public function removePaymentMethodTypes($key){
        unset($this->payment_method_types[$key]);
    }

    public function addDetail(){
        $this->validate([
            'description' => 'required',
            'amount' => 'required|numeric|regex:/^[\d]{0,11}(\.[\d]{1,2})?$/'
        ]);

        $box_item = [
            'description' => $this->description,
            'amount' => $this->amount
        ];

        array_push($this->box_items,$box_item);
        $this->total = $this->total + $this->amount;

        if(count($this->payment_method_types) == 0){
            $data = [
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
        $this->total = $this->total - $amount;
        $this->payment_method_types[0]['amount'] = $this->total;
        unset($this->box_items[$key]);
    }

    public function store(){
        $this->validate([
            'voucher_type_id' => 'required',
            'number' => 'required',
            'f_issuance' => 'required',
            'reason_id' => 'required',
            'supplier_id' => 'required',
        ]);

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
            $external_id = Str::uuid()->toString();
            $person = Person::where('id',$this->supplier_id)->first();

            $expense = SalExpense::create([
                'user_id' => Auth::id(),
                'expense_type_id' => $this->voucher_type_id,
                'establishment_id' => $establishment_id,
                'person_id' => Auth::user()->person_id,
                'currency_type_id' => 'PEN',
                'external_id' => $external_id,
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
                SalExpenseItem::create([
                    'expense_id' => $expense->id,
                    'description' => $item['description'],
                    'total' => $item['amount']
                ]);
            }

            $this->savePayments($expense->id);
            $this->saveCashDocument($expense->id);
            $this->clearForm();
            $user = Auth::user();
            $activity = new Activity;
            $activity->modelOn(SalExpense::class,$expense->id);
            $activity->causedBy($user);
            $activity->routeOn(route('sales_expenses_create'));
            $activity->componentOn('sales::expenses.expenses-create');
            $activity->dataOld($expense);
            $activity->logType('create');
            $activity->log('Registro nuevo gasto');
            $activity->save();

            $this->dispatchBrowserEvent('response_expenses_store', ['msg' => Lang::get('labels.successfully_registered')]);
        }else{
            $this->dispatchBrowserEvent('response_payment_total_different', ['message' => Lang::get('labels.msg_totaldtc')]);
        }
    }

    public function savePayments($id){
        // list($di,$mi,$yi) = explode('/',$this->f_issuance);
        // $date_of_issue = $yi.'-'.$mi.'-'.$di;

        foreach($this->payment_method_types as $key => $value){
            if($value['amount'] > 0){
                $payment = SalExpensePayment::create([
                    'expense_id' => $id,
                    'date_of_payment' => $value['date_of_payment'],
                    'expense_method_type_id' => $value['method'],
                    'reference' => $value['reference'],
                    'payment' => $value['amount'],
                    'expense_destination_id' => $value['destination']
                ]);
                $this->createGlobalPayment($payment->id,$value['destination']);
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

    public function setSupplierId($id){
        $this->supplier_id = $id;
    }
}
