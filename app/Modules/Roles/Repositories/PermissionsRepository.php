<?php

namespace App\Modules\Roles\Repositories;

use App\Bootstrap\Http\Repositories\Repository;
use App\Modules\Roles\Models\Permission;

class PermissionsRepository extends Repository
{

    /**
     * PermissionsRepository constructor.
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string $slug
     * @return \App\Modules\Roles\Models\Permission
     */
    public function getBySlug($slug)
    {
        return Permission::whereSlug($slug)->first();
    }

}
