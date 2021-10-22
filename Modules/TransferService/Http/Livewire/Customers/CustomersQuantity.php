<?php

namespace Modules\TransferService\Http\Livewire\Customers;

use Livewire\Component;
use Modules\TransferService\Entities\SerCustomer;

class CustomersQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = SerCustomer::count();
    }

    public function render()
    {
        return view('transferservice::livewire.customers.customers-quantity');
    }
}
