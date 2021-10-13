<?php

namespace Modules\Setting\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class RolesQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = Role::count();
    }

    public function render()
    {
        return view('setting::livewire.roles.roles-quantity');
    }
}
