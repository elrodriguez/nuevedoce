<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Setting\Entities\SetShortCut;

class Shortcuts extends Component
{
    public $shortcuts = []; 

    public function mount(){
        $this->shortcuts = $this->getData();
        //dd($this->shortcuts);
    }

    public function render()
    {
        return view('livewire.shortcuts');
    }

    public function getData(){
        $user = User::find(Auth::id());
        $role = $user->getRoleNames();

        return SetShortCut::select(
                'icon',
                'name',
                'route_name'
            )
            ->whereIn('role_name', $role->toArray())
            ->groupBy([
                'icon',
                'name',
                'route_name'
            ])
            ->get();
    }
}
