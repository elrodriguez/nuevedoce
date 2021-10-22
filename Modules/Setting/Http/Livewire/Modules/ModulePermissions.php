<?php

namespace Modules\Setting\Http\Livewire\Modules;

use Illuminate\Support\Facades\DB;
use Modules\Setting\Entities\SetModule;
use Spatie\Permission\Models\Permission;
use Livewire\Component;
use Modules\Setting\Entities\SetModulePermission;

class ModulePermissions extends Component
{
    public $permissions = [];
    public $module_id;
    public $name;
    public $module;
    public $module_name;
    public $permission_name;

    public function mount($module_id){
        $this->module_id = $module_id;
        $this->module = SetModule::find($this->module_id);
        $this->module_name = cctom($this->module->label).'_';
        $permissions = SetModulePermission::join('permissions','permission_id','permissions.id')
            ->select(
                'set_module_permissions.id',
                'permissions.name',
                'set_module_permissions.status',
                'set_module_permissions.permission_id'
            )
            ->where('module_id', $this->module_id)
            ->get();
        if($permissions){
            $this->permissions = $permissions->toArray();
        }
    }
    public function render()
    {
        return view('setting::livewire.modules.module-permissions');
    }
    public function addPermission(){

        $this->permission_name = $this->module_name.str_replace(' ','_',$this->name);

        $this->validate([
            'permission_name' => 'required|unique:permissions,name'
        ]);

        
        $permission = Permission::create(['name' => $this->permission_name]);
        $res = SetModulePermission::create([
            'module_id' => $this->module_id,
            'permission_id' => $permission->id,
            'status' => true
        ]);

        $data = [
            'id' => $res->id,
            'name' => $this->permission_name,
            'status'  => true,
            'permission_id' => $permission->id
        ];
        array_push($this->permissions,$data);

        $this->name = null;
    }

    public function removePermission($key,$id,$permission_id){
        try {
            Permission::find($permission_id)->delete();
            SetModulePermission::find($id)->delete();
            unset($this->permissions[$key]);
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }

        $this->dispatchBrowserEvent('set-module-permission-delete', ['res' => $res]);
    }

    public function changeState($key,$id){
        $per = $this->permissions[$key];
        SetModulePermission::find($id)->update(['status'=>$per['status']]);
    }
}
