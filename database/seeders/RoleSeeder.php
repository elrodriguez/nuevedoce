<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'TI','guard_name' => 'sanctum']); // por defecto siempre sera el id 1
        Role::create(['name' => 'Gerente','guard_name' => 'sanctum']);
        Role::create(['name' => 'Administrador','guard_name' => 'sanctum']);
        Role::create(['name' => 'Almacenero','guard_name' => 'sanctum']);
        $user = User::find(1);
        $user->assignRole('TI');
    }
}
