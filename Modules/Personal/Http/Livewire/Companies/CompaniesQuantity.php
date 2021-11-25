<?php

namespace Modules\Personal\Http\Livewire\Companies;

use App\Models\Person;
use Livewire\Component;

class CompaniesQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = Person::where('identity_document_type_id','6')->count();
    }

    public function render()
    {
        return view('personal::livewire.companies.companies-quantity');
    }
}
