<?php

namespace Modules\Setting\Http\Livewire\Roles;

use Livewire\Component;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Role;

class RolesPermissions extends Component
{
    public $role_name;
    public $modules_permissions = [];
    public $permissions = [];
    public $input_all = [];

    public function mount($role_id){
        $this->role = Role::find($role_id);
        $this->role_name = $this->role->name;
        
        $permissions = SetModulePermission::join('permissions','permission_id','permissions.id')
            ->join('set_modules','module_id','set_modules.id')
            ->select(
                'set_module_permissions.module_id',
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
    public function savePermission($module_id){
        dd($this->permissions);
    }
    public function selectAll($module_id){
        $data = [];
        $sele = $this->input_all[$module_id];
        
        if($sele){
            foreach($this->modules_permissions as $item){
                if($item['module_id'] == $module_id){
                    $data[$item['name']] = $item['id'];
                }
            }
        }else{
            $data = [];
        }
        $this->permissions[$module_id] = $data;
    }
}
