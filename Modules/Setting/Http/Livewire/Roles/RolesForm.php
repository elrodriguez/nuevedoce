<?php

namespace Modules\Setting\Http\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

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
        Role::create(['name' => $this->name]);
    }

    public function removeRole($id){
        try {
            Role::find($id)->delete();
            $res = 'success';
        } catch (\Illuminate\Database\QueryException $e) {
            $res = 'error';
        }

        $this->dispatchBrowserEvent('set-role-delete', ['res' => $res]);
    }
}
