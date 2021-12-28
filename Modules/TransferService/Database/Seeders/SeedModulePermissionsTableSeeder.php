<?php

namespace Modules\TransferService\Database\Seeders;

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
            'logo' => 'fal fa-truck-moving',
            'label' => 'Servicio de Traslados',
            'destination_route' => 'transferservice_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_clientes','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_clientes_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_clientes_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_clientes_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_clientes_buscar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_locales','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_locales_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_locales_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_locales_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_vehiculos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_vehiculos_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_vehiculos_tripulacion','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_vehiculos_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_vehiculos_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_solicitudes_odt','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_solicitudes_odt_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_solicitudes_odt_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_solicitudes_odt_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_solicitudes_odt_nuevo_programacion','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_salida','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_aceptar_salida','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_retorno','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_orden_carga_guias','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_nota_ocurrencias','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_nota_ocurrencias_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_nota_ocurrencias_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'serviciodetraslados_nota_ocurrencias_eliminar','guard_name' => 'sanctum']));

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
