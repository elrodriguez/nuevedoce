<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HeaderNavigation extends Component
{
    public function render()
    {
        return view('livewire.header-navigation');
    }

    public function logout(){
        Auth::guard();

        //return redirect()->route('login');
    }
}
