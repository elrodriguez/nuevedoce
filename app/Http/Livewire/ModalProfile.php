<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;
use Livewire\Component;

class ModalProfile extends Component
{
    public $name;
    public $email;
    public $password;
    public $username;

    public function mount(){
        $user = User::find(Auth::id());

        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;

    }

    public function render()
    {
        return view('livewire.modal-profile');
    }

    public function save(){
        $this->validate([
            'email' => 'required'
        ]);

        if($this->password){
            $this->validate([
                'password' => 'required|min:8'
            ]);

            User::find(Auth::id())->update([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password)
            ]);
        }else{
            User::find(Auth::id())->update([
                'name' => $this->name,
                'email' => $this->email
            ]);
        }
        $this->password = null;
        $this->dispatchBrowserEvent('save-changes-user', ['msg' => Lang::get('labels.was_successfully_updated')]);
    }
}
