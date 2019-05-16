<?php

namespace App\Modules\Companies\Repositories;

use App\Bootstrap\Http\Repositories\Repository;
use App\Modules\Companies\Models\Cia;

class CiasRepository extends Repository
{

    /**
     * CiasRepository constructor.
     * @param Cia $model
     */
    public function __construct(Cia $model)
    {
        parent::__construct($model);
    }
}
