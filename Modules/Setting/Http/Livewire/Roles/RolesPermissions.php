<?php

namespace Modules\Setting\Http\Livewire\Roles;

use Livewire\Component;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Elrod\UserActivity\Activity;
use Illuminate\Support\Facades\Lang;
class RolesPermissions extends Component
{
    public $role_name;
    public $modules_permissions = [];
    public $permissions = [];
    public $input_all = [];
    public $role_id;

    public function mount($role_id){
        $this->role_id = $role_id;
        $this->role = Role::find($role_id);
        $this->role_name = $this->role->name;
        $this->getModulesPermissions($this->role_id);
    }
    
    public function render()
    {
        
        return view('setting::livewire.roles.roles-permissions');
    }

    public function savePermission($module_id){
       
        if (array_key_exists($module_id, $this->permissions)) {
            $array = $this->permissions[$module_id];
            if($array){
                $this->role->revokePermissionTo(array_keys($array));
                foreach($array as $key => $item){
                    if($item){
                        $this->role->givePermissionTo($key);
                    }
                }
            }else{
                $permissions = SetModulePermission::join('permissions','permission_id','permissions.id')
                ->where('set_module_permissions.module_id', $module_id)
                ->pluck('permissions.name');
                foreach($permissions as $permission){
                    $this->role->revokePermissionTo($permission);
                }
            }
        }else{
            $permissions = SetModulePermission::join('permissions','permission_id','permissions.id')
                ->where('set_module_permissions.module_id', $module_id)
                ->pluck('permissions.name');
            foreach($permissions as $permission){
                $this->role->revokePermissionTo($permission);
            }
        }

        $activity = new Activity;
        $activity->modelOn(Role::class,$this->role->id,'roles');
        $activity->causedBy(Auth::user());
        $activity->routeOn(route('setting_roles_permissions',$this->role_id));
        $activity->logType('update');
        $activity->log('agrego permisos al rol: '.$this->role->name);
        $activity->save();

        $this->dispatchBrowserEvent('set-role-save-add-permission', ['msg' => Lang::get('setting::labels.msg_update')]);
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

    public function getModulesPermissions($role_id){
        $permissions = SetModulePermission::join('permissions','permission_id','permissions.id')
            ->join('set_modules','module_id','set_modules.id')
            ->select(
                'set_module_permissions.module_id',
                'set_modules.label',
                'permissions.name',
                'permissions.id'
            )
            ->selectSub(function($query) use($role_id) {
                $query->from('role_has_permissions')
                    ->select('role_has_permissions.permission_id')
                    ->whereColumn('role_has_permissions.permission_id','permissions.id')
                    ->where('role_has_permissions.role_id',$role_id);
            }, 'state')
            ->where('set_module_permissions.status', true)
            ->orderBy('set_modules.label')
            ->get();
        if($permissions){
            $this->modules_permissions = $permissions->toArray();
        }
        $module = '';
        foreach($this->modules_permissions as $modules){
            if($module != $modules['label']){
                $data  = [];
                $active = false;
                foreach($this->modules_permissions as $permissions){
                    if($modules['label'] == $permissions['label']){
                        $data[$permissions['name']] = ($permissions['state'] ? $permissions['id'] : false);
                        if($permissions['state']){
                            $active = $permissions['module_id'];
                        }
                    }
                }
                $this->input_all[$modules['module_id']] = $active;
                $this->permissions[$modules['module_id']] = $data;
            }
            $module = $modules['label'];
        }
    }
}
