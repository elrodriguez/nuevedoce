<?php

namespace Modules\Setting\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Auth;
class RolesForm extends Component
{
    public $roles = [];
    public $name;

    public function render()
    {
        $this->roles = Role::all();
        return view('setting::livewire.roles.roles-form');
    }

    public function addRole(){
        $this->validate([
            'name' => 'required|unique:roles,name'
        ]);
        $role = Role::create(['name' => $this->name]);

        $activity = new Activity;
        $activity->modelOn(Role::class,$$role->id,'roles');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_roles'));
        $activity->logType('create');
        $activity->log('creó un nuevo rol '.$this->name);
        $activity->save();
    }

    public function removeRole($id){
        try {
            $role = Role::find($id);
            $activity = new activity;
            $activity->log('Elimino un rol');
            $activity->modelOn(Role::class,$id,'set_establishments');
            $activity->dataOld($role); 
            $activity->logType('delete');
            $activity->causedBy(Auth::user());
            $activity->save();

            $role->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }

        $this->dispatchBrowserEvent('set-role-delete', ['res' => $res]);
    }
}
