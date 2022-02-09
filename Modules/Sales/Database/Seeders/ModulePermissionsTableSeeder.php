<?php

namespace Modules\Sales\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Setting\Entities\SetModule;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ModulePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = SetModule::create([
            'uuid' => Str::uuid(),
            'logo' => 'fal fa-store-alt',
            'label' => 'Ventas',
            'destination_route' => 'sales_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions,Permission::create(['name' => 'ventas_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'ventas_administracion','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'ventas_administracion_caja_chica','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'ventas_administracion_caja_chica_cerrar','guard_name' => 'sanctum']));

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
