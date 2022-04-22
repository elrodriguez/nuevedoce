<?php

namespace Modules\Inventory\Database\Seeders;

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
            'logo' => 'fal fa-cubes',
            'label' => 'Inventario',
            'destination_route' => 'inventory_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions,Permission::create(['name' => 'inventario_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_categorias','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_categorias_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_categorias_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_categorias_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_marcas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_marcas_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_marcas_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_marcas_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_activos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_activos_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_activos_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_activos_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_importar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_fotos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_parte','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_parte_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_parte_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_parte_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_items_parte_agregar_codigo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_kardex','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_kardex_items_stock','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_kardex_active_codes','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_ubicaciones','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_ubicaciones_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_ubicaciones_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_ubicaciones_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_compras','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_compras_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_compras_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_compras_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_movimientos','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_movimientos_trasladar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_movimientos_remover','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_movimientos_ingreso','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_movimientos_salida','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'inventario_traslados','guard_name' => 'sanctum']));

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
