<?php

namespace App\Http\Livewire;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\Setting\Entities\SetModule;
use Modules\Setting\Entities\SetModulePermission;
use Modules\Setting\Entities\SetShortCut;
use Modules\Setting\Rules\RouteValidateExists;

class Shortcuts extends Component
{
    public $shortcuts = [];
    public $add_show = false;

    public $icon;
    public $name;
    public $route_name;
    public $role_name;
    public $permission_id;
    public $modules = [];
    public $permissions = [];
    public $module_id;

    public function mount(){
        $user = User::find(Auth::id());
        $role = $user->getRoleNames();
        $this->role_name = $role->toArray()[0];
        $this->modules = SetModule::where('status',true)->get();
    }
    public function render()
    {
        $this->shortcuts = $this->getData();
        return view('livewire.shortcuts');
    }

    public function getData(){
        return SetShortCut::select(
                'id',
                'icon',
                'name',
                'route_name',
                'permission'
            )
            // ->whereIn('role_name', $role->toArray())
            // ->groupBy([
            //     'id',
            //     'icon',
            //     'name',
            //     'route_name',
            //     'permission',
            // ])
            ->orderBy('id')
            ->get();
    }

    public function getPermissions(){
        $this->permissions = SetModulePermission::join('permissions','set_module_permissions.permission_id','permissions.id')
            ->select('permissions.name')
            ->where('module_id',$this->module_id)
            ->get();
    }

    public function saveShortCuts(){
        
        $this->validate([
            'icon' => ['required','string','max:255'],
            'name' => ['required','string','max:255'],
            'route_name' => ['required','string','max:255',new RouteValidateExists],
            'permission_id' => ['required','string','max:255']
        ]);

        

        SetShortCut::create([
            'icon' => $this->icon,
            'name' => $this->name,
            'route_name' => $this->route_name,
            'role_name' => $this->role_name,
            'permission' => $this->permission_id
        ]);   
        
        $this->icon = null;
        $this->name = null;
        $this->route_name = null;
        $this->role_name = null;
        $this->permission = null;
        $this->add_show = false;

        $this->dispatchBrowserEvent('set-short-cut-save', ['msg' => 'Datos guardados correctamente.']);
    }

    public function deleteshortcut($id){
        try {
            $delete = SetShortCut::find($id);
            if($delete){
                SetShortCut::find($id)->delete();
                $res = 'success';
            }
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }
        $this->dispatchBrowserEvent('set-short-cut-delete', ['res' => $res]);
    }
}
