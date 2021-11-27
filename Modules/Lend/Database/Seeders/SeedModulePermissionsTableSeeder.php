<?php

namespace Modules\Lend\Database\Seeders;

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
            'logo' => 'fal fa-hands-usd',
            'label' => 'Prestamos',
            'destination_route' => 'lend_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions,Permission::create(['name' => 'prestamos_dashboard','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_intereses','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_intereses_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_intereses_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_intereses_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_forma_pago','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_forma_pago_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_forma_pago_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_forma_pago_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_cuotas','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_cuotas_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_cuotas_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_cuotas_eliminar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_contrato','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_contrato_nuevo','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_contrato_editar','guard_name' => 'sanctum']));
        array_push($permissions,Permission::create(['name' => 'prestamos_contrato_eliminar','guard_name' => 'sanctum']));

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
