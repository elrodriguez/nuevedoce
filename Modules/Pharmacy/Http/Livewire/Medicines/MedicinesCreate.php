<?php

namespace Modules\Pharmacy\Http\Livewire\Medicines;

use Livewire\Component;

class MedicinesCreate extends Component
{
    public $symptoms = [];
    public $product_id;
    public $disease_id;

    public function render()
    {
        return view('pharmacy::livewire.medicines.medicines-create');
    }

    


}
