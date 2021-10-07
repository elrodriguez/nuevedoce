<?php

namespace Modules\Inventory\Http\Livewire\Category;

use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;

class CategoryCreate extends Component
{
    public $description;
    public $status = true;

    public function mount(){
    }

    public function render()
    {
        return view('inventory::livewire.category.category-create');
    }

    public function save(){

        $this->validate([
            'description' => 'required'
        ]);
       
        
        InvCategory::create([
            'description' => $this->description,
            'status' => $this->status
        ]);

        $this->clearForm();
        $this->dispatchBrowserEvent('set-category-save', ['msg' => 'Datos guardados correctamente.']);
    }
    
    
    
    public function clearForm(){
        $this->description = null;
        $this->status = true;
        
    }
    
}










