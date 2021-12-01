<?php

namespace Modules\Lend\Http\Livewire\Customers;

use Livewire\Component;
use App\Models\Customer;

class CustomersQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = Customer::count();
    }

    public function render()
    {
        return view('lend::livewire.customers.customers-quantity');
    }
}
