<?php

namespace Modules\Setting\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
class UserRoles extends Component
{
    public $user_name;
    public $user;
    public $roles;
    public $checked = [];

    public function mount($user_id){
        $this->user = User::find($user_id);
        $this->user_name = $this->user->name;
        $this->roles = Role::select('id','name')
                        ->selectRaw('(SELECT COUNT(role_id) FROM role_has_permissions WHERE role_id = roles.id) AS quantity')
                        ->selectSub(function($query) use($user_id) {
                            $query->from('model_has_roles')
                                ->select('model_has_roles.role_id')
                                ->whereColumn('model_has_roles.role_id','roles.id')
                                ->where('model_has_roles.model_id',$user_id)
                                ->where('model_has_roles.model_type', User::class);
                        }, 'state')
                        ->get();
        if($this->roles){
            foreach ($this->roles as $role){
                $this->checked[$role->id] = ($role->state ? true : false);
            }
        }
    }

    public function render()
    {
        return view('setting::livewire.user.user-roles');
    }

    public function assignRole($id,$name){
        $activity = new Activity;
        $msg = '';
        if($this->checked[$id]){
            $this->user->assignRole($name);
            
            $msg = 'Se le asigna el rol '.$name;
        }else{
            $this->user->removeRole($name);

            $msg = 'Se le quito el rol '.$name;
        }

        $activity->modelOn(User::class,$this->user->id,'users');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_users_roles',$this->user->id));
        $activity->logType('assign');
        $activity->log($msg);
        $activity->save();
    }
}
