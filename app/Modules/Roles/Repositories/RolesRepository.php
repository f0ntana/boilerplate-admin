<?php

namespace App\Modules\Roles\Repositories;

use App\Bootstrap\Http\Repositories\Repository;
use App\Modules\Roles\Models\Role;
use Illuminate\Database\Eloquent\Model;

class RolesRepository extends Repository
{

    /**
     * RolesRepository constructor.
     * @param Role $model
     */
    public function __construct(Role $model)
    {
        parent::__construct($model);
    }

    /**
     * @param array $params
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function create(array $params)
    {
        $permissions = [];
        if (array_key_exists('permissions', $params)) {
            $permissions = $params['permissions'];
            unset($params['permissions']);
        }

        $role = Role::create($params);
        $role->permissions()->attach($permissions);
        return $role;
    }

    public function update(Model $entity, array $params)
    {
        $permissions = [];
        if (array_key_exists('permissions', $params)) {
            $permissions = $params['permissions'];
            unset($params['permissions']);
        }

        $entity->fill($params);
        $entity->save();
        $entity->permissions()->sync($permissions);

        return $entity;
    }

}
