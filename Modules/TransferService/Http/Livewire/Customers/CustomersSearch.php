<?php

namespace Modules\TransferService\Http\Livewire\Customers;

use Livewire\Component;
use Illuminate\Support\Facades\Lang;
use App\Models\Person;
use Modules\TransferService\Entities\SerCustomer;

class CustomersSearch extends Component
{
    public $number;
    public $number_search;

    //For Customer
    public $customer_id;
    public $person_id;

    public $person_search;
    public $customer_search;

    public function render()
    {
        return view('transferservice::livewire.customers.customers-search');
    }

    public function searchPerson(){
        $this->validate([
            'number_search' => 'required|numeric|min:3'
        ]);
        $this->person_search = Person::where('number',$this->number_search)->get();
        $encuentra = '';
        $encuentra_e = '';
        foreach ($this->person_search as $key => $personSearch){
            $encuentra = $personSearch->id;

            $this->person_id = $personSearch->id;
            $this->number = $personSearch->number;

            //dd($this->person_id);
            $this->customer_search = SerCustomer::where('person_id', $this->person_id)->get();

            foreach ($this->customer_search as $key => $customerSearch){
                $encuentra_e = $customerSearch->id;
                $this->customer_id = $customerSearch->id;
                $this->person_id = $customerSearch->person_id;
            }
        }
        if($encuentra == ''){
            $this->dispatchBrowserEvent('ser-customers-search_a', ['msg' => Lang::get('transferservice::messages.msg_search_not'), 'numberPerson' => $this->number_search]);
        }elseif($encuentra != '' && $encuentra_e == ''){
            $this->dispatchBrowserEvent('ser-customers-search_b', ['msg' => Lang::get('transferservice::messages.msg_search_ok_a'), 'personId' => $this->person_id]);
        }else{
            $this->dispatchBrowserEvent('ser-customers-search_c', ['msg' => Lang::get('transferservice::messages.msg_search_ok_b'), 'customerId' => $this->customer_id]);
        }
    }
}
