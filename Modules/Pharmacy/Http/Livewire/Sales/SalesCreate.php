<?php

namespace Modules\Pharmacy\Http\Livewire\Sales;

use App\Models\AffectationIgvType;
use App\Models\CatPaymentMethodType;
use App\Models\Country;
use App\Models\IdentityDocumentType;
use App\Models\Parameter;
use App\Models\Person;
use App\Models\UserEstablishment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvBrand;
use Modules\Inventory\Entities\InvCategory;
use Livewire\WithPagination;
use Modules\Inventory\Entities\InvItem;
use Modules\Inventory\Entities\InvKardex;
use Modules\Inventory\Entities\InvLocation;
use Modules\Pharmacy\Entities\PharProductRelated;
use Modules\Pharmacy\Entities\PharProductRelatedDetail;
use Modules\Setting\Entities\SetCompany;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Str;
use App\CoreBilling\Template;
use App\CoreBilling\Helpers\Storage\StorageDocument;
use App\Models\GlobalPayment;
use App\CoreBilling\Billing;
use App\CoreBilling\Helpers\Number\NumberLetter as NumberNumberLetter;
use App\Models\Customer;
use App\Models\Department;
use App\Models\District;
use App\Models\DocumentType;
use App\Models\Province;

class SalesCreate extends Component
{
    public $category_id;
    public $brand_id;
    public $products = [];
    public $search;
    public $categories = [];
    public $brands = [];

    public $document_type_id = '80';
    public $document_types = [];
    public $identity_document_types = [];
    public $series;
    public $f_issuance;
    public $f_expiration;
    public $serie_id;
    public $correlative;
    public $customer_id;
    public $item_id;
    public $box_items = [];
    public $total = 0;
    public $payment_method_types = [];
    public $cat_payment_method_types;
    public $cat_expense_method_types;
    public $external_id;
    public $value_icbper;
    public $additional_information;
    public $igv;

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
    public $establishment_id;
    public $establishments = [];

    public $identity_document_type_id = 1;
    public $sex;
    public $number_id;
    public $name;
    public $last_paternal;
    public $last_maternal;
    public $trade_name;
    public $xgenerico;
    public $department_id;
    public $province_id;
    public $district_id;
    public $countries = [];
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $soap_type_id;
    public $stock_notes;

    use WithPagination;

    public function mount(){
        $this->value_icbper = Parameter::where('id_parameter','PRT006ICP')->value('value_default');
        $this->igv = (int) Parameter::where('id_parameter','PRT002IGV')->value('value_default');
        $this->stock_notes = (boolean) Parameter::where('id_parameter','PRT008DSN')->value('value_default');
    
        $this->establishment_id = UserEstablishment::where('user_id',Auth::id())
            ->where('main',1)
            ->value('establishment_id');

        $this->warehouse_id = InvLocation::where('establishment_id',$this->establishment_id)->value('id');
        
        $this->f_issuance = Carbon::now()->format('d/m/Y');
        $this->f_expiration = Carbon::now()->format('d/m/Y');

        $this->soap_type_id = SetCompany::where('main',true)->first()->soap_type_id;

        $this->countries = Country::where('active',true)->get();
        $this->departments = Department::where('active',true)->get();

        $this->getBrand();
        $this->getCategories();
    }
    public function render()
    {
        $this->recalculateAll();
        $this->cat_payment_method_types = CatPaymentMethodType::all();
        $billing = new Billing();
        $this->cat_expense_method_types = $billing->getPaymentDestinations();

        $this->identity_document_types = IdentityDocumentType::where('active',1)->get();
        $this->document_types = DocumentType::whereIn('id',['01','03','80'])->get();

        $this->xgenerico = Person::where('trade_name','like','%Clientes Varios%')
            ->where('identity_document_type_id',0)
            ->select('people.id AS value',DB::raw('CONCAT(people.number," - ",people.trade_name) AS text'))
            ->first();
        if($this->xgenerico){
            if(!$this->customer_id){
                $this->customer_id = $this->xgenerico->value;
            }
        }
        return view('pharmacy::livewire.sales.sales-create');
    }

    public function paginationView()
    {
        return 'vendor.pagination.short';
    }

    public function getProvinves(){
        $this->provinces = Province::where('department_id',$this->department_id)
            ->where('active',true)->get();
        $this->districts = [];
    }

    public function getPDistricts(){
        $this->districts = District::where('province_id',$this->province_id)
            ->where('active',true)->get();
    }

    public function getCategories(){
        $this->categories = InvCategory::select('id','description')
                ->selectSub(function($query) {
                    $query->from('inv_items')
                        ->selectRaw('COUNT(category_id)')
                        ->whereColumn('category_id','inv_categories.id');
                }, 'total_items')
                ->where('status',true)
                ->get();
    }
    public function getBrand(){
        $this->brands = InvBrand::select('id','description')
            ->selectSub(function($query) {
                $query->from('inv_items')
                    ->selectRaw('COUNT(brand_id)')
                    ->whereColumn('brand_id','inv_brands.id');
            }, 'total_items')
            ->where('status',true)
            ->get();
    }

    public function searchProducts(){
        $warehouse_id = $this->warehouse_id;
        $search = $this->search;
        $category_id = $this->category_id;
        $brand_id = $this->brand_id;
        
        $products = InvItem::leftJoin('inv_brands','inv_items.brand_id','inv_brands.id')
            ->leftJoin('inv_assets','inv_assets.item_id','inv_items.id')
            ->select(
                'inv_items.id',
                'inv_assets.patrimonial_code',
                'inv_items.name',
                'inv_brands.description',
                'inv_items.has_plastic_bag_taxes',
                'inv_items.sale_price'
            )
            ->selectSub(function($query) {
                $query->from('inv_kardexes')->selectRaw('SUM(quantity)')
                ->whereColumn('inv_kardexes.item_id','inv_items.id')
                ->whereColumn('inv_kardexes.location_id','inv_assets.location_id');
            }, 'stock')
            ->selectSub(function($query) {
                $query->from('inv_item_files')->select('route')
                ->whereColumn('inv_item_files.item_id','inv_items.id')
                ->limit(1);
            }, 'image')
            ->where('inv_assets.location_id',$warehouse_id)
            ->when($category_id, function ($query, $category_id) {
                $query->where('inv_items.category_id', $category_id);
            })
            ->when($brand_id, function ($query, $brand_id) {
                $query->where('inv_items.brand_id', $brand_id);
            })
            ->where(function($query) use ($search){
                $query->where('inv_assets.patrimonial_code','=', $search)
                    ->orWhere(DB::raw("REPLACE(inv_items.name, ' ', '')"), 'like', "%" .str_replace(' ','',$search). "%");
            })
            ->orderBy('inv_items.name')
            ->limit(50)
            ->get();

        if(count($products) > 0){
            foreach($products as $k => $product){
                $this->products[$k] = [
                    'id' => $product->id,
                    'patrimonial_code' => $product->patrimonial_code,
                    'name' => $product->name,
                    'description' => $product->description,
                    'has_plastic_bag_taxes' => $product->has_plastic_bag_taxes,
                    'sale_price' => $product->sale_price,
                    'stock' => $product->stock,
                    'image' => $product->image,
                    'related' => $this->getRelatedItems($product->id)
                ];
            }
            $this->dispatchBrowserEvent('phar-products-exists', ['success' => true]);
        }
        
    }

    public function getRelatedItems($id){
        $collection =  PharProductRelatedDetail::join('phar_product_related','product_related_id','phar_product_related.id')
            ->join('inv_items','phar_product_related_details.item_id','inv_items.id')
            ->leftJoin('inv_brands','inv_items.brand_id','inv_brands.id')
            ->leftJoin('inv_assets','inv_assets.item_id','inv_items.id')
            ->select(
                'inv_items.id',
                'inv_assets.patrimonial_code',
                'inv_items.name',
                'inv_brands.description',
                'inv_items.has_plastic_bag_taxes',
                'inv_items.sale_price'
            )
            ->selectSub(function($query) {
                $query->from('inv_kardexes')->selectRaw('SUM(quantity)')
                ->whereColumn('inv_kardexes.item_id','inv_items.id')
                ->whereColumn('inv_kardexes.location_id','inv_assets.location_id');
            }, 'stock')
            ->selectSub(function($query) {
                $query->from('inv_item_files')->select('route')
                ->whereColumn('inv_item_files.item_id','inv_items.id')
                ->limit(1);
            }, 'image')
            ->where('phar_product_related.item_id',$id)
            ->get();
        $items = [];

        if($collection){
            foreach($collection as $k => $row){
                $items[$k] = [
                    'id' => $row->id,
                    'patrimonial_code' => $row->patrimonial_code,
                    'name' => $row->name,
                    'description' => $row->description,
                    'has_plastic_bag_taxes' => $row->has_plastic_bag_taxes,
                    'sale_price' => $row->sale_price,
                    'stock' => $row->stock,
                    'image' => $row->image
                ];
            }
        }

        return $items;
    }

    public function clickAddItem($id) {

        $key = array_search($id, array_column($this->box_items, 'item_id'));
        $exists_stock = InvKardex::where('item_id',$id)
            ->where('location_id',$this->warehouse_id)
            ->sum('quantity');

        $success = true;
        $showmsg = false;
        $msg = '';

        if($key === false){
            if($id){

                $item = InvItem::where('id',$id)->first()->toArray();

                if($exists_stock <= $item['stock_min']){

                    $showmsg = true;
                    $success = true;
                    $msg = Lang::get('labels.msg_product_about_out');
                }

                if($exists_stock <= 0 ){
                    $success = false;
                    $showmsg = true;
                    $msg = Lang::get('labels.msg_product_no_units');
                }

                if($success){

                    $unit_price = $item['sale_price'];
                    
                    $currencyTypeIdActive = 'PEN';
                    $exchangeRateSale = 0.01;
                    $currency_type_id_old = $item['currency_type_id'] ? $item['currency_type_id'] : 'PEN';


                    if ($currency_type_id_old === 'PEN' && $currency_type_id_old !== $currencyTypeIdActive){
                        $unit_price = $unit_price / $exchangeRateSale;
                    }

                    if ($currencyTypeIdActive === 'PEN' && $currency_type_id_old !== $currencyTypeIdActive){
                        $unit_price = $unit_price * $exchangeRateSale;
                    }

                    $affectation_igv_type = AffectationIgvType::where('id',$item['sale_affectation_igv_type_id'])->first()->toArray();
                    
                    $data = [
                        'item_id'=> $item['id'],
                        'item' => json_encode($item),
                        'currency_type_id' => $item['currency_type_id'],
                        'quantity' => 1,
                        'unit_value' => 0,
                        'affectation_igv_type_id' => $item['sale_affectation_igv_type_id'],
                        'affectation_igv_type'=> json_encode($affectation_igv_type),
                        'total_base_igv'=> 0,
                        'percentage_igv' => $this->igv,
                        'total_igv' => 0,
                        'system_isc_type_id' => null,
                        'total_base_isc'=> 0,
                        'percentage_isc'=> 0,
                        'total_isc'=> 0,
                        'total_base_other_taxes'=> 0,
                        'percentage_other_taxes'=> 0,
                        'total_other_taxes'=> 0,
                        'total_plastic_bag_taxes'=> 0,
                        'total_taxes'=> 0,
                        'price_type_id'=> '01',
                        'unit_price'=> $unit_price,
                        'input_unit_price_value' => $item['sale_price'],
                        'total_value' => 0,
                        'total_discount' => 0,
                        'total_charge' => 0,
                        'total' => 0
                    ];

                    $data = $this->calculateRowItem($data,$currencyTypeIdActive, $exchangeRateSale);

                    array_push($this->box_items,$data);

                    $this->payment_method_types[0] =[
                        'method' => '01',
                        'destination' => 'cash',
                        'date_of_payment' => Carbon::now()->format('d/m/Y'),
                        'reference' => null,
                        'amount' => $this->total
                    ];

                }
            }
        }


        $this->dispatchBrowserEvent('response_clear_select_products_alert',['showmsg' => $showmsg,'message'=>$msg]);
    }

    public function calculateRowItem($data) {

        $percentage_igv = $this->igv;
        $unit_value = $data['unit_price'];

        if ($data['affectation_igv_type_id'] === '10') {
            $unit_value = $data['unit_price'] / (1 + $percentage_igv / 100);
        }


        $data['unit_value'] = $unit_value;

        $quantity = 0;

        if($data['quantity']){
            $quantity = $data['quantity'];
        }else{
            $quantity = 0;
        }
        $total_value_partial = $unit_value * $quantity;
        
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
            $data['total_plastic_bag_taxes'] = number_format($quantity * $this->value_icbper, 2, '.', '');
        }

        return $data;
    }

    public function removeItem($key){
        unset($this->box_items[$key]);
        $this->calculateTotal();
        $this->payment_method_types[0]['amount'] = $this->total;
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

    public function recalculateAll(){
        if(count($this->box_items)>0){

            foreach($this->box_items as $key => $item){
                //if(is_numeric($item['quantity'])){
                    $data[$key] = $this->calculateRowItem($item);
                //}
            }

            $this->box_items = $data;
            $this->calculateTotal();
            $this->payment_method_types[0]['amount'] = $this->total;
        }
    }

    public function newPaymentMethodTypes(){
        $data = [
            'method' => '01',
            'destination' => 'cash',
            'date_of_payment' => Carbon::now()->format('d/m/Y'),
            'reference' => null,
            'amount' => null
        ];
        array_push($this->payment_method_types,$data);
    }

    public function removePaymentMethodTypes($key){
        unset($this->payment_method_types[$key]);
    }

    public function storeClient(){

        $this->validate([
            'identity_document_type_id' => 'required',
            'number_id'     => 'required|numeric',
            'name'          => 'required',
            // 'last_paternal' => 'required',
            // 'last_maternal' => 'required',
            'sex'           => 'required',
            'department_id' => 'required',
            'province_id'   => 'required',
            'district_id'   => 'required'
        ]);

        $customer = Person::create([
            'type' => 'customers',
            'identity_document_type_id' => $this->identity_document_type_id,
            'number' => $this->number_id,
            'names' => $this->name,
            'country_id' => 'PE',
            'trade_name' => ($this->trade_name == null?$this->name.' '.$this->last_paternal.' '.$this->last_maternal:$this->trade_name),
            'last_paternal' => $this->last_paternal,
            'last_maternal' => $this->last_maternal,
            'full_name'=> $this->last_paternal.' '.$this->last_maternal.' '.$this->name,
            'department_id' => $this->department_id,
            'province_id'   => $this->province_id,
            'district_id'   => $this->district_id,
            'sex' => $this->sex
        ]);

        Customer::create(['person_id' => $customer->id,'direct' => true,'person_create' => Auth::user()->person_id]);

        $this->clearFormCustomer();
        $this->dispatchBrowserEvent('response_success_customer_store', ['idperson' => $customer->id,'nameperson' => ($customer->number.' - '.$customer->trade_name),'message' => Lang::get('labels.successfully_registered')]);
    }
    public function clearFormCustomer(){
        $this->identity_document_type_id = 1;
        $this->number_id = null;
        $this->name = null;
        $this->trade_name = null;
        $this->last_paternal = null;
        $this->last_maternal = null;
        $this->sex = null;
    }
}
