<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\UserSession;
use Livewire\Component;

class UserSessions extends Component
{
    public $sessions = [];

    public function mount(){
        $today = date('Y-m-d');
        $this->sessions = UserSession::join('users','user_id','users.id')
            ->select(
                'users.name',
                'users.person_id'
            )
            ->whereRaw('DATE(user_sessions.created_at) = ?',[$today])
            ->get();
    }

    public function render()
    {
        return view('setting::livewire.user.user-sessions');
    }
}
