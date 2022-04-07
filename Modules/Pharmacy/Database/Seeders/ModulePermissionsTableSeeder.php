<?php

namespace Modules\Pharmacy\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\SetModule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Permission;

class ModulePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Role::create(['name' => 'Vendedor','guard_name' => 'sanctum']);

        $module = SetModule::create([
            'uuid' => Str::uuid(),
            'logo' => 'fal fa-book-medical',
            'label' => 'Farmacia',
            'destination_route' => 'pharmacy_dashboard',
            'status' => true
        ]);

        $permissions = [];
        
        array_push($permissions,Permission::create(['name' => 'farmacia_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'farmacia_administracion','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'farmacia_administracion_productos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'farmacia_administracion_productos_relacionados','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'farmacia_administracion_productos_ofertas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'farmacia_ventas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'farmacia_ventas_nuevo','guard_name' => 'sanctum']));

        $role = Role::find(1);

        foreach($permissions as $permission){
            SetModulePermission::create([
                'module_id' => $module->id,
                'permission_id' => $permission->id
            ]);
            $role->givePermissionTo($permission->name);
        }
    }
}
