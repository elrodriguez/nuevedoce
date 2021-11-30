<?php

namespace Modules\Staff\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Setting\Entities\SetModule;
use Illuminate\Support\Str;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SeedModulePermissionsTableSeeder extends Seeder
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
            'logo' => 'fal fa-restroom',
            'label' => 'Personal',
            'destination_route' => 'staff_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions,Permission::create(['name' => 'personal_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_tipo_empleados','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_tipo_empleados_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_tipo_empleados_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_tipo_empleados_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_ocupaciones','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_ocupaciones_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_ocupaciones_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_ocupaciones_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empleados','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empleados_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empleados_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empleados_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empleados_buscar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empresas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empresas_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empresas_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empresas_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'personal_empresas_buscar','guard_name' => 'sanctum']));

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
