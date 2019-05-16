<?php

namespace App\Modules\Companies\Repositories;

use App\Bootstrap\Http\Repositories\Repository;
use App\Modules\Companies\Models\Company;

class CompaniesRepository extends Repository
{

    /**
     * CompaniesRepository constructor.
     * @param Company $model
     */
    public function __construct(Company $model)
    {
        parent::__construct($model);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function select()
    {
        return Company::all()
            ->keyBy('id')
            ->map(function ($company) {
                return "{$company->name} - " . ($company->active ? 'ATIVO' : 'INATIVO');
            })
            ->prepend('Selecione...');
    }

}
