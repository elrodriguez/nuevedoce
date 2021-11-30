<?php

namespace Modules\Setting\Http\Livewire;

use Livewire\Component;
use Modules\Setting\Entities\SetCompany;

class Sidebar extends Component
{
    public $company;

    public function mount(){
        $this->company = SetCompany::where('main',true)->first();
    }
    
    public function render()
    {
        return view('setting::livewire.sidebar');
    }
}
