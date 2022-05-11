<?php

namespace Modules\Restaurant\Http\Livewire\Brands;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvBrand;

class BrandsCreate extends Component
{
    public $description;
    public $status = true;

    public function render()
    {
        return view('restaurant::livewire.brands.brands-create');
    }

    public function save()
    {

        $this->validate([
            'description' => 'required'
        ]);



        InvBrand::create([
            'description' => $this->description,
            'status' => $this->status ? true : false
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
