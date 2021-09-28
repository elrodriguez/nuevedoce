<?php

namespace Modules\Setting\Http\Livewire\Roles;

use Livewire\Component;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Role;

class RolesPermissions extends Component
{
    public $role_name;
    public $modules_permissions = [];

    public function mount($role_id){
        $this->role = Role::find($role_id);
        $this->role_name = $this->role->name;
        
        $permissions = SetModulePermission::join('permissions','permission_id','permissions.id')
            ->join('set_modules','module_id','set_modules.id')
            ->select(
                'set_modules.label',
                'permissions.name',
                'permissions.id'
            )
            ->where('set_module_permissions.status', true)
            ->orderBy('set_modules.label')
            ->get();
        if($permissions){
            $this->modules_permissions = $permissions->toArray();
        }
    }
    public function render()
    {
        return view('setting::livewire.roles.roles-permissions');
    }
}
