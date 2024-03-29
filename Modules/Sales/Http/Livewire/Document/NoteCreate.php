<?php

namespace Modules\Sales\Http\Livewire\Document;

use App\Models\AffectationIgvType;
use App\Models\CatPaymentMethodType;
use App\Models\Parameter;
use App\Models\UserEstablishment;
use Carbon\Carbon;
use Livewire\Component;
use App\CoreBilling\Helpers\Number\NumberLetter as NumberNumberLetter;
use Exception;
use App\CoreBilling\Billing;
use App\Models\DocumentType;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Modules\Sales\Entities\SalDocument;
use Modules\Sales\Entities\SalNoteTypes;
use Modules\Sales\Entities\SalSerie;
use Modules\Setting\Entities\SetCompany;
use Modules\Setting\Entities\SetEstablishment;
use Illuminate\Support\Str;
class NoteCreate extends Component
{
    public $document_type_id = '07';
    public $document;
    public $document_types = [];
    public $cdt;
    public $series;
    public $f_issuance;
    public $f_expiration;
    public $serie_id;
    public $correlative;
    public $customer_id;
    public $establishment_id;
    public $customer;
    public $box_items = [];
    public $total;
    public $payment_method_types = [];
    public $cat_payment_method_types;
    public $cat_expense_method_types;
    public $external_id;
    public $igv;
    public $note_type_id;
    public $note_types;
    public $note_description;
    public $total_exportation;
    public $total_taxed;
    public $total_exonerated;
    public $total_unaffected;
    public $total_free;
    public $total_igv;
    public $total_value;
    public $total_taxes;
    public $total_plastic_bag_taxes;
    public $total_prepayment = 0;
    public $currencyTypeIdActive = 'PEN';
    public $exchangeRateSale = 0;
    public $total_discount = 0;
    public $total_isc = 0;
    public $warehouse_id;
    public $soap_type_id;
    public $ubl_version;

    public function mount($external_id){
        $this->external_id = $external_id;
        $this->establishment_id = UserEstablishment::where('user_establishments.user_id',Auth::id())
                                        ->where('main',true)
                                        ->value('establishment_id');
        $this->soap_type_id = SetCompany::where('main',true)->first()->soap_type_id;
        $this->igv = (int) Parameter::where('id_parameter','PRT002IGV')->value('value_default');
        $this->ubl_version = Parameter::where('id_parameter','PRT009VUL')->value('value_default');

        $activity = new Activity;
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('sales_notes',$this->external_id));
        $activity->componentOn('sales::document.note-create');
        $activity->log('ingresó a la vista nueva nota (credito o debito)');
        $activity->save();

        $this->document = SalDocument::where('external_id',$this->external_id)->with('items')->first();
        //dd($this->document);
        $this->currencyTypeIdActive = $this->document->currency_type_id;
        $this->exchangeRateSale = $this->document->exchange_rate_sale;
        $this->cdt = $this->document->document_type_id;
        $this->customer_id = $this->document->customer_id;
        $this->customer = $this->document->customer;
        $this->f_expiration = Carbon::now()->format('Y-m-d');
        $this->f_issuance = Carbon::now()->format('Y-m-d');
        $this->changeSeries();
        $this->addItems();
    }

    public function render()
    {
        $this->cat_payment_method_types = CatPaymentMethodType::all();
        $billing = new Billing();
        $this->cat_expense_method_types = $billing->getPaymentDestinations();
        $this->document_types = DocumentType::whereIn('id',['07','08'])->get();

        $this->recalculateAll();
        return view('sales::livewire.document.note-create');
    }

    public function changeSeries(){
        $std =  ($this->cdt == '01'?'F':'B');
        //dd($this->cdt);
        $this->series = SalSerie::where('document_type_id',$this->document_type_id)
            ->where('establishment_id',$this->establishment_id)
            ->whereRaw('LEFT(id,1)=?',[$std])
            ->get();
        
        $this->serie_id = $this->series->max('id');

        if($this->document_type_id == '07'){
            $this->note_types = SalNoteTypes::where('debit',false)->get();
        }else{
            $this->note_types = SalNoteTypes::where('debit',true)->get();
        }

        $this->selectCorrelative();
    }
    public function selectCorrelative(){
        $serie = SalSerie::where('id',$this->serie_id)->first();
        if($serie){
            $this->correlative = str_pad($serie->correlative, 8, "0", STR_PAD_LEFT);
        }else{
            $this->correlative = str_pad(0, 8, "0", STR_PAD_LEFT);
        }
    }
    public function addItems(){

        $items = $this->document->items->toArray();
        foreach ($items as $key => $item){
            $this->box_items[$key] = $this->setItems($item);
        }

        $this->calculateTotal();

    }

    public function calculateTotal() {
        $total_discount = 0;
        $total_charge = 0;
        $total_exportation = 0;
        $total_taxed = 0;
        $total_taxes = 0;
        $total_exonerated = 0;
        $total_unaffected = 0;
        $total_free = 0;
        $total_igv = 0;
        $total_value = 0;
        $total = 0;
        $total_plastic_bag_taxes = 0;
        $onerosas = array('10','20','30','40');

        foreach ($this->box_items as $key => $value) {
            $total_discount = $total_discount + 0;
            $total_charge = $total_charge + 0;
            $affectation_igv = (string) $value['affectation_igv_type_id'];

            if ($affectation_igv === '10') {
                $total_taxed = $total_taxed + $value['total_value'];
            }
            if ($affectation_igv === '20') {
                $total_exonerated = $total_exonerated + $value['total_value'];
            }
            if ($affectation_igv === '30') {
                $total_unaffected = $total_unaffected + $value['total_value'];
            }
            if ($affectation_igv === '40') {
                $total_exportation = $total_exportation + $value['total_value'];
            }
            if (array_search($affectation_igv, $onerosas) < 0) {
                $total_free = $total_free + $value['total_value'];
            }
            if (array_search($affectation_igv, $onerosas) > -1) {
                $total_igv = $total_igv + $value['total_igv'];
                $total = $total + $value['total'];
            }

            $total_value = $total_value + $value['total_value'];
            $total_plastic_bag_taxes = $total_plastic_bag_taxes + $value['total_plastic_bag_taxes'];

            if (in_array($affectation_igv, array('13', '14', '15'))) {

                $unit_value = ($value['total_value']/$value['quantity']) / (1 + $value['percentage_igv'] / 100);
                $total_value_partial = $unit_value * $value['quantity'];
                //$total_taxes = $value['total_value'] - $total_value_partial;
                $total_taxes = $total_igv;
                $this->box_items[$key]['total_igv'] = $value['total_value'] - $total_value_partial;
                $this->box_items[$key]['total_base_igv'] = $total_value_partial;
                $total_value = $total_value - $value['total_value'];

            }

        }
        //dd($affectation_igv);
        $this->total_exportation = number_format($total_exportation, 2, '.', '');
        $this->total_taxed = number_format($total_taxed, 2, '.', '');
        $this->total_exonerated = number_format($total_exonerated, 2, '.', '');
        $this->total_unaffected = number_format($total_unaffected, 2, '.', '');
        $this->total_free =number_format($total_free, 2, '.', '');
        $this->total_igv = number_format($total_igv, 2, '.', '');
        $this->total_value = number_format($total_value, 2, '.', '');
        $this->total_taxes = number_format($total_taxes, 2, '.', '');
        $this->total_plastic_bag_taxes = number_format($total_plastic_bag_taxes, 2, '.', '');

        $this->total = number_format($total+$total_plastic_bag_taxes, 2, '.', '');

        // if(this.enabled_discount_global)
        //     this.discountGlobal()

        // if(this.prepayment_deduction)
        //     this.discountGlobalPrepayment()

        // if(['1001', '1004'].includes(this.form.operation_type_id))
        //     this.changeDetractionType()

        // this.setTotalDefaultPayment()
        // this.setPendingAmount()

        // this.calculateFee();
    }

    public function setItems($item){
        $affectation_igv_type = AffectationIgvType::where('id',$item['affectation_igv_type_id'])->first();
        return [
            'item_id'=> $item['item_id'],
            'item' => $item['item'],
            'currency_type_id' => $this->document->currency_type_id,
            'quantity' => $item['quantity'],
            'unit_value' => $item['unit_value'],
            'affectation_igv_type_id' => $item['affectation_igv_type_id'],
            'affectation_igv_type'=> json_encode($affectation_igv_type),
            'total_base_igv'=> $item['total_base_igv'],
            'percentage_igv' => $item['percentage_igv'],
            'total_igv' => $item['total_igv'],
            'system_isc_type_id' => $item['system_isc_type_id'],
            'total_base_isc'=> $item['total_base_isc'],
            'percentage_isc'=> $item['percentage_isc'],
            'total_isc'=> $item['total_isc'],
            'total_base_other_taxes'=> $item['total_base_other_taxes'],
            'percentage_other_taxes'=> $item['percentage_other_taxes'],
            'total_other_taxes'=> $item['total_other_taxes'],
            'total_plastic_bag_taxes'=> $item['total_plastic_bag_taxes'],
            'total_taxes'=> $item['total_taxes'],
            'price_type_id'=> $item['price_type_id'],
            'unit_price'=> $item['unit_price'],
            'input_unit_price_value' => $item['unit_price'],
            'total_value' => $item['total_value'],
            'total_discount' => $item['total_discount'],
            'total_charge' => $item['total_charge'],
            'total' => $item['total']
        ];
    }
    public function recalculateAll(){
        if(count($this->box_items)>0){

            foreach($this->box_items as $key => $item){
                if(is_numeric($item['quantity'])){
                    $data[$key] = $this->calculateRowItem($item);
                }
            }
            $this->box_items = $data;
            $this->calculateTotal();

        }
    }
    public function calculateRowItem($data) {

        $percentage_igv = $data['percentage_igv'];
        $unit_value = $data['unit_price'];

        if ($data['affectation_igv_type_id'] === '10') {
            $unit_value = $data['unit_price'] / (1 + $percentage_igv / 100);
        }


        $data['unit_value'] = $unit_value;

        $total_value_partial = $unit_value * $data['quantity'];

        $total_isc = 0;
        $total_other_taxes = 0;
        $discount_base = 0;
        $total_discount = 0;
        $total_charge = 0;
        $total_value = $total_value_partial - $total_discount + $total_charge;
        $total_base_igv = $total_value_partial - $discount_base + $total_isc;

        $total_igv = 0;

        if ($data['affectation_igv_type_id'] === '10') {
            $total_igv = $total_base_igv * $percentage_igv / 100;
        }
        if ($data['affectation_igv_type_id'] === '20') { //Exonerated
            $total_igv = 0;
        }
        if ($data['affectation_igv_type_id'] === '30') { //Unaffected
            $total_igv = 0;
        }

        $total_taxes = $total_igv + $total_isc + $total_other_taxes;
        $total = $total_value + $total_taxes;

        $data['total_charge'] = number_format($total_charge, 2, '.', '');
        $data['total_discount'] = number_format($total_discount, 2, '.', '');
        $data['total_value'] = number_format($total_value, 2, '.', '');
        $data['total_base_igv'] = number_format($total_base_igv, 2, '.', '');
        $data['total_igv'] =  number_format($total_igv, 2, '.', '');
        $data['total_taxes'] = number_format($total_taxes, 2, '.', '');
        $data['total'] = number_format($total, 2, '.', '');
        
        if (json_decode($data['affectation_igv_type'])->free) {
            $data['price_type_id'] = '02';
            $data['unit_value'] = 0;
            $data['total'] = 0;
        }

        //impuesto bolsa
        if(json_decode($data['item'])->has_plastic_bag_taxes){
            $data['total_plastic_bag_taxes'] = number_format($data['quantity'] * $this->value_icbper, 2, '.', '');
        }

        return $data;
    }

    public function removeItem($key){
        unset($this->box_items[$key]);
        $this->calculateTotal();
        $this->payment_method_types[0]['amount'] = $this->total;
    }

    public function validateForm(){

        $this->validate([
            'document_type_id' => 'required',
            'serie_id' => 'required',
            'f_issuance' => 'required',
            'customer_id' => 'required',
            'note_description' => 'required|max:255'
        ]);



        if ($this->box_items > 0) {
            foreach($this->box_items as $key => $val)
            {
                $this->validate([
                    'box_items.'.$key.'.quantity' => 'numeric|required'
                ]);
            }
        }

        $this->store();

    }

    public function store(){

        $this->selectCorrelative($this->serie_id);

        list($di,$mi,$yi) = explode('/',$this->f_issuance);
        $date_of_issue = $yi.'-'.$mi.'-'.$di;

        $company = SetCompany::where('main',true)->first();

        $numberletters = new NumberNumberLetter();

        $legends = json_encode(["code" => 1000, "value" => $numberletters->convertToLetter($this->total)]);

        $this->external_id = Str::uuid()->toString();
        $establishment_json = SetEstablishment::where('id',$this->establishment_id)->first();
        $this->total_taxes = $this->total_igv;
        $inputDocument = [
            'establishment_id' => $this->establishment_id,
            'establishment' => $establishment_json,
            'customer' => $this->document->customer,
            'user_id' => Auth::id(),
            'document_type_id' => $this->document_type_id,
            'series' => $this->serie_id,
            'external_id' => $this->external_id,
            'number' => $this->correlative,
            'date_of_issue' => $date_of_issue,
            'time_of_issue' => Carbon::now()->format('H:i:s') ,
            'customer_id' => $this->document->customer_id,
            'currency_type_id' => $this->document->currency_type_id,
            'purchase_order' => null,
            'exchange_rate_sale' => 0,
            'total_prepayment' => 0,
            'total_charge' => 0,
            'total_discount' => $this->total_discount,
            'total_exportation' => $this->total_exportation,
            'total_free' => $this->total_free,
            'total_taxed' => $this->total_taxed,
            'total_unaffected' => $this->total_unaffected,
            'total_exonerated' => $this->total_exonerated,
            'total_igv' => $this->total_igv,
            'total_base_isc' => 0,
            'total_isc' => $this->total_isc,
            'total_base_other_taxes' => 0,
            'total_other_taxes' => 0,
            'total_plastic_bag_taxes' => $this->total_plastic_bag_taxes,
            'total_taxes' => $this->total_taxes,
            'total_value' => $this->total_taxed,
            'total' => $this->total,
            'items' => $this->box_items,
            'affected_document_id' => $this->document->id,
            'note_credit_or_debit_type_id' => $this->note_type_id,
            'note_description' => $this->note_description,
            'operation_type_id' => null,
            'type'=> ($this->document_type_id=='07'?'credit':'debit'),
            'legends' => $legends,
            'filename' => ($company->number.'-'.$this->document_type_id.'-'.$this->serie_id.'-'.((int) $this->correlative)),
            'soap_type_id' => $this->soap_type_id,
            'state_type_id' => '01',
            'ubl_version' => $this->ubl_version,
            'group_id' => ($this->cdt == '03'?'02':'01'),
            'route'=> 'sales/notes',
            'note' => [
                'note_type_id' => $this->note_type_id,
                'note_description' => $this->note_description,
                'affected_document_id' => $this->document->id,
                'data_affected_document' => $this->document
            ],
            'actions' => [
                'send_email' => false,
                'send_xml_signed' => true,
                'format_pdf' => 'a4'
            ],
            'send_server' => false
        ];

        try {
            $billing = new Billing();
            $billing->save($inputDocument);
            $billing->createXmlUnsigned();
            $billing->signXmlUnsigned();
            $billing->updateHash();
            $billing->updateQr();
            $billing->createPdf();
            $billing->senderXmlSignedBill();

        } catch (Exception $e) {
            dd($e->getMessage());
        }

        SalSerie::where('id',$this->serie_id)->increment('correlative');

        $this->selectCorrelative($this->serie_id);
        $document_old_id = SalDocument::find($this->document->id);
        $user = Auth::user();
        $activity = new Activity;
        $activity->modelOn(SalDocument::class,$document_old_id->id,'sal_document');
        $activity->causedBy($user);
        $activity->routeOn(route('sales_notes',$this->external_id));
        $activity->componentOn('sales::document.note-create');
        $activity->dataOld($inputDocument);
        $activity->logType('create');
        $activity->log('Registro el Nota de '.($this->document_type_id=='07' ? 'credito' : 'debito'));
        $activity->save();

        $this->dispatchBrowserEvent('response_success_document_note', ['message' => Lang::get('labels.successfully_registered')]);

        return redirect()->route('sales_document_list');
    }

}
