<?php

namespace Modules\Personal\Database\Seeders;

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
            'destination_route' => 'personal_dashboard',
            'status' => true
        ]);

        $permissions = [];

        array_push($permissions,Permission::create(['name' => 'personal_dashboard','guard_name' => 'sanctum']));

        foreach($permissions as $permission){
            SetModulePermission::create([
                'module_id' => $module->id,
                'permission_id' => $permission->id
            ]);
        }
        
        $role = Role::find(1);
        $role->syncPermissions($permissions);
    }
}
