<?php

namespace Modules\TransferService\Http\Livewire;

use Livewire\Component;
use Modules\Setting\Entities\SetCompany;

class Sidebar extends Component
{
    public $company;

    public function mount(){
        $this->company = SetCompany::first();
    }
    
    public function render()
    {
        return view('transferservice::livewire.sidebar');
    }
}
