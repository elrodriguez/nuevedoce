<?php

namespace Modules\Setting\Http\Livewire\User;

use Livewire\Component;

class UserActivities extends Component
{
    public $user_id;

    public function mount($user_id){
        $this->user_id = $user_id;
    }

    public function render()
    {
        return view('setting::livewire.user.user-activities');
    }
}
