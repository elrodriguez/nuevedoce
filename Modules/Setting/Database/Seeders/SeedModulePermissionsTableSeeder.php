<?php

namespace Modules\Setting\Database\Seeders;

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
            'logo' => 'fal fa-cogs',
            'label' => 'Configuraciones',
            'destination_route' => 'setting_dashboard',
            'status' => true
        ]);

        $permissions = [];
        
        array_push($permissions,Permission::create(['name' => 'configuraciones_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_empresas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_empresas_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_empresas_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_empresas_entorno_del_sistema','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_establecimientos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_establecimientos_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_establecimientos_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_establecimientos_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_roles','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_roles_permisos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_roles_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios_roles','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios_actividades','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_usuarios_establesimientos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_modulos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_modulos_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_modulos_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_modulos_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_modulos_permisos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_bancos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_bancos_listado','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_bancos_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_bancos_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_bancos_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_bancos_cuentas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_parametros','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_acceso_directo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'configuraciones_acceso_directo_eliminar','guard_name' => 'sanctum']));

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
