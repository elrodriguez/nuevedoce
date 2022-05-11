<?php

namespace Modules\Restaurant\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Setting\Entities\SetModule;
use Modules\Setting\Entities\SetModulePermission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class ModulePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();


        $cocinero = Role::create(['name' => 'Cocinero', 'guard_name' => 'sanctum']);
        $moso = Role::create(['name' => 'Moso', 'guard_name' => 'sanctum']);

        $module = SetModule::create([
            'uuid' => 'rest',
            'logo' => 'fal fa-burger-soda',
            'label' => 'Restaurante',
            'destination_route' => 'restaurant_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions, Permission::create(['name' => 'restaurante_dashboard', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_categorias', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_categorias_nuevo', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_categorias_editar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_categorias_eliminar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_comandas', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_comandas_nuevo', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_comandas_editar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_comandas_eliminar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_marcas', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_marcas_nuevo', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_marcas_editar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_marcas_eliminar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_mesas', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_mesas_nuevo', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_mesas_editar', 'guard_name' => 'sanctum']));
        array_push($permissions, Permission::create(['name' => 'restaurante_administracion_mesas_eliminar', 'guard_name' => 'sanctum']));
        $role = Role::find(1);

        foreach ($permissions as $permission) {
            SetModulePermission::create([
                'module_id' => $module->id,
                'permission_id' => $permission->id
            ]);
            $role->givePermissionTo($permission->name);
        }
    }
}
