<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Setting\Entities\SetModule;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Role;

class Dashboard extends Component
{
    public $modules = [];

    public function mount(){
        $this->modulesUser();
        //$this->modules = SetModule::where('status',true)->get();
        $this->modules = $this->modulesUser();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function modulesUser(){

        $user = User::find(Auth::id());
        $role = Role::where('name',$user->getRoleNames())->first();
        $role_id = $role->id;

        return SetModulePermission::join('permissions','set_module_permissions.permission_id','permissions.id')
            ->join('role_has_permissions','role_has_permissions.permission_id','permissions.id')
            ->join('model_has_roles','model_has_roles.role_id','role_has_permissions.role_id')
            ->join('set_modules','module_id','set_modules.id')
            ->select(
                'set_modules.uuid',
                'set_modules.logo',
                'set_modules.label',
                'set_modules.destination_route'
            )
            ->where('role_has_permissions.role_id',$role_id)
            ->where('set_module_permissions.status', true)
            ->where('model_has_roles.model_type', User::class)
            ->where('model_has_roles.model_id',$user->id)
            ->where('set_modules.status',true)
            ->groupBy([
                'set_modules.uuid',
                'set_modules.logo',
                'set_modules.label',
                'set_modules.destination_route'
            ])->get();

    }
}
