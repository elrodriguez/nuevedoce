<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class UserQuantity extends Component
{
    public $quantity;

    public function mount(){
        $this->quantity = User::count();
    }

    public function render()
    {
        return view('setting::livewire.user.user-quantity');
    }
}
