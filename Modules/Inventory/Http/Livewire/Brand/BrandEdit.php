<?php

namespace Modules\Inventory\Http\Livewire\Brand;

use Livewire\Component;
use Modules\Inventory\Entities\InvBrand;

class BrandEdit extends Component
{
    public $brand;
    public $description;
    public $status;

    public function mount($brand_id){
        $this->brand = InvBrand::find($brand_id);
        $this->description = $this->brand->description;
        $this->status = $this->brand->status;
    }

    public function render()
    {
        return view('inventory::livewire.brand.brand-edit');
    }

    public function save(){

        $this->validate([
            'description' => 'required',
            'status' => 'required'
        ]);

        $this->brand->update([
            'description' => $this->description,
            'status' => $this->status
        ]);
        
        $this->dispatchBrowserEvent('set-brand-save', ['msg' => 'Datos Actualizados correctamente.']);
    }
}
