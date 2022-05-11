<?php

namespace Modules\Restaurant\Http\Livewire\Brands;

use Illuminate\Support\Facades\Lang;
use Livewire\Component;
use Modules\Inventory\Entities\InvBrand;

class BrandsEdit extends Component
{
    public $brand;
    public $description;
    public $status;

    public function mount($brand_id)
    {
        $this->brand = InvBrand::find($brand_id);
        $this->description = $this->brand->description;
        $this->status = $this->brand->status;
    }
    public function render()
    {
        return view('restaurant::livewire.brands.brands-edit');
    }

    public function update()
    {

        $this->validate([
            'description' => 'required',
            'status' => 'required'
        ]);

        $this->brand->update([
            'description' => $this->description,
            'status' => $this->status
        ]);

        $this->dispatchBrowserEvent('set-brand-save', ['msg' => Lang::get('labels.was_successfully_updated')]);
    }
}
