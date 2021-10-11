<?php

namespace App\Http\Livewire;

use App\Models\UserSession;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
class LoginForm extends Component
{
    public $username;
    public $password;
    public $rememberme;

    public function render()
    {
        return view('livewire.login-form');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::attempt(array('username' => $this->username, 'password' => $this->password),$this->rememberme)){
            UserSession::create([
                'user_id' => Auth::id(),
                'ip_address' => request()->ip(),
                'user_agent' => request()->header('User-Agent')
            ]);
            $this->redirect('dashboard');
        }else{
            $this->dispatchBrowserEvent('login-error', ['msg' => 'email and password are wrong.']);
        }
    }

}
