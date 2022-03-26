<?php

namespace Modules\Sales\Http\Livewire\Expenses;

use App\Models\Department;
use App\Models\District;
use App\Models\IdentityDocumentType;
use App\Models\Person;
use App\Models\Province;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class ExpensesSupplierModal extends Component
{
    protected $listeners = ['modalSupplierCreate' => 'openModalSupplierCreate'];

    public $identity_document_types = [];
    public $identity_document_type_id;
    public $departments = [];
    public $provinces = [];
    public $districts = [];
    public $department_id;
    public $province_id;
    public $district_id;
    public $sex;
    public $last_maternal;
    public $trade_name;
    public $last_paternal;
    public $name;
    public $number_id;

    public function mount(){
        $this->identity_document_types = IdentityDocumentType::where('active',1)->get();
        $this->departments = Department::where('active',true)->get();
    }

    public function render()
    {
        return view('sales::livewire.expenses.expenses-supplier-modal');
    }

    public function openModalSupplierCreate(){
        $this->dispatchBrowserEvent('open-modal-expense-supplier-create', ['newName' => true]);
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

    public function storeSupplier(){

        $this->validate([
            'identity_document_type_id' => 'required',
            'number_id' => 'unique:people,number,null,id,identity_document_type_id,' . $this->identity_document_type_id,
            'name'          => 'required',
            // 'last_paternal' => 'required',
            // 'last_maternal' => 'required',
            'sex'           => 'required',
            'department_id' => 'required',
            'province_id'   => 'required',
            'district_id'   => 'required'
        ]);

        $supplier = Person::create([
            'identity_document_type_id' => $this->identity_document_type_id,
            'number' => $this->number_id,
            'names' => $this->name,
            'country_id' => 'PE',
            'trade_name' => ($this->trade_name == null ? $this->name.' '.$this->last_paternal.' '.$this->last_maternal : $this->trade_name),
            'last_paternal' => $this->last_paternal,
            'last_maternal' => $this->last_maternal,
            'full_name'=> ($this->identity_document_type_id == '6'? $this->name : $this->name.' '.$this->last_paternal.' '.$this->last_maternal),
            'department_id' => $this->department_id,
            'province_id'   => $this->province_id,
            'district_id'   => $this->district_id,
            'sex' => $this->sex
        ]);

        $this->emit('funSupplierId',$supplier->id);
        
        $this->identity_document_type_id = null;
        $this->number_id = null;
        $this->name = null;
        $this->trade_name = null;
        $this->last_paternal = null;
        $this->last_maternal = null;
        $this->department_id = null;
        $this->province_id = null;
        $this->district_id = null;
        $this->sex = null;

        $this->dispatchBrowserEvent('response_success_supplier_store', ['idperson' => $supplier->id,'nameperson' => ($supplier->number.' - '.$supplier->trade_name),'message' => Lang::get('labels.successfully_registered')]);
    }
}
