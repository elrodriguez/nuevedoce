<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Setting\Entities\SetModule;

class Dashboard extends Component
{
    public $modules = [];

    public function mount(){
        $this->modules = SetModule::where('status',true)->get();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
