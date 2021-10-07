<?php

namespace Modules\Inventory\Http\Livewire\Category;

use Livewire\Component;
use Modules\Inventory\Entities\InvCategory;


class CategoryEdit extends Component
{
    public $category;
    public $description;
    public $status;

    public function mount($category_id){
        $this->category = InvCategory::find($category_id);
        $this->description = $this->category->description;
        $this->status = $this->category->status;
    }

    public function render()
    {
        return view('inventory::livewire.category.category-edit');

    }
    public function save(){

        $this->validate([
            'description' => 'required'
        ]);
       
        $this->category->update([
            'description' => $this->description,
            'status' => $this->status
        ]);
        
        $this->dispatchBrowserEvent('set-category-save', ['msg' => 'Datos Actualizados correctamente.']);
    }

}