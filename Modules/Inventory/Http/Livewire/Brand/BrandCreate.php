<?php

namespace Modules\Inventory\Http\Livewire\Brand;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvBrand;

class BrandCreate extends Component
{
    public $description;
    public $status = true;

    public function render()
    {
        return view('inventory::livewire.brand.brand-create');
    }

    public function save()
    {

        $this->validate([
            'description' => 'required'
        ]);



        InvBrand::create([
            'description' => $this->description,
            'status' => $this->status
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-brand-save', ['msg' => Lang::get('labels.successfully_registered')]);
    }



    public function clearForm()
    {
        $this->description = null;
        $this->status = true;
    }
}
