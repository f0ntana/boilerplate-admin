<?php

use App\Modules\Roles\Models\Permission;
use App\Modules\Roles\Models\Role;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");

        Permission::truncate();
        Role::truncate();

        DB::statement("SET foreign_key_checks = 1");

        $roles = [
            1 => 'Administrador'
        ];

        foreach ($roles as $key => $role) {
            Role::create(['id' => $key, 'name' => $role, 'slug' => str_slug($role)]);
        }

        $permissions = [
            'companies' => 'Empresas',
            'roles' => 'Papéis',
            'users' => 'Usuários'
        ];

        $actions = [
            'index' => 'Listar',
            'create' => 'Criar',
            'edit' => 'Editar',
            'destroy' => 'Deletar',
        ];

        foreach ($permissions as $permissionKey => $permission) {
            foreach ($actions as $actionKey => $action) {
                Permission::create([
                    'name' => $action . ' ' . $permission,
                    'slug' => $permissionKey . '.' . $actionKey,
                ]);
            }
        }

        $permissions = Permission::all();
        $role = Role::first();
        $role->permissions()->attach($permissions);
    }
}
