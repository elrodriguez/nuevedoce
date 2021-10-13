<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\User;
use App\Models\UserSession;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Elrod\UserActivity\Activity;
class UserActivities extends Component
{
    public $user_id;
    public $user;
    public $start;
    public $end;
    public $sessions = [];
    public $session_id;
    public $activities = [];
    public $user_sessions;

    public function mount($user_id){
        $this->user_id = $user_id;

        if($this->user_id){
            $this->user = User::find($this->user_id)->pluck('id', 'name');
        }else{
            $this->user = ['id' => null,'name' => null];
        }

        $this->start = date('Y-m-d');
        $this->end = date('Y-m-d');
    }

    public function render()
    {
        return view('setting::livewire.user.user-activities');
    }

    public function getSessions(){
        $this->sessions = UserSession::select(
                'id',
                DB::raw('DATE_FORMAT(created_at,"%Y/%m/%d %h:%i:%s") AS hour_session')
            )
            ->where('user_id',$this->user_id)
            ->whereRaw('DATE(created_at) >= ? AND DATE(created_at) <= ?',[$this->start,$this->end])
            ->get();
    }

    public function getActivities(){
        $this->user_Sessions = UserSession::find($this->session_id);

        $activity = new Activity;

        $this->activities = $activity->getByUserAndDate($this->user_id,$this->start,$this->end);

    }


}
