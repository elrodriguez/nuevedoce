<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Modules\Setting\Entities\SetCompany;

class Welcome extends Component
{
    public $company;
    public function mount(){
        $this->company = SetCompany::where('main',true)->first();
    }
    public function render()
    {
        return view('livewire.welcome');
    }
}
